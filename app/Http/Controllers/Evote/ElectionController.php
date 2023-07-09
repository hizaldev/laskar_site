<?php

namespace App\Http\Controllers\Evote;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Dpc;
use App\Models\Dpd;
use App\Models\Member;
use App\Models\Vote;
use App\Models\VoteCounter;
use App\Models\Voter;
use Exception;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as requestip;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ElectionController extends Controller
{
    var $route = 'evotes';
    var $path_view = 'evote.election';

    function __construct()
    {
        $this->middleware('permission:pemilu_evote-list|permission-create|pemilu_evote-edit|pemilu_evote-delete', ['only' => ['index','store']]);
        $this->middleware('permission:pemilu_evote-create', ['only' => ['create','store']]);
        $this->middleware('permission:pemilu_evote-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pemilu_evote-delete', ['only' => ['destroy']]);
        $this->middleware('permission:pemilu_evote-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vote::with(['voter', 'vote_counter'])->get();
        // dd($data);
        if(request()->ajax()){
           
            return DataTables::of($data)
            ->addColumn('voter', function($item){
                return count($item->voter);
            })
            ->addColumn('has_vote', function($item){
                return count($item->vote_counter);
            })
            ->addColumn('vote_counter', function($item){
                return count($item->voter) - count($item->vote_counter);
            })
            ->addColumn('show', function($item){
                return '
                
                    <a class="btn btn-primary btn-sm text-white" href="'.route("$this->route.show", $item->id).'">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                ';
            })
            ->addColumn('edit', function($item){
                return '
                
                    <a class="btn btn-success btn-sm text-white" href="'.route("$this->route.edit", $item->id).'">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                ';
            })
            ->addColumn('delete', function($item){
                return '
                    <form action="'. route("$this->route.destroy", $item->id).'" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apa anda yakin menghapus data ini? data ini mungkin akan berpengaruh pada data transaksi aplikasi`)) run; return false">
                        '. method_field('delete') . csrf_field().'
                        <button type="submit" class="btn btn-danger btn-sm text-white">
                        <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['has_vote','vote_counter','voter','show','edit', 'delete'])
            ->make();
        }
        //dd($data);
        ConstantController::logger('-', $this->route.'.index', 'list');
        return view("$this->path_view.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ConstantController::logger('-', $this->route.'.create', 'open form create');
        $dpd = Dpd::get();
        $dpc = Dpc::get();
        return view("$this->path_view.create", [
            'dpd' => $dpd,
            'dpc' => $dpc,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'judul_pemilihan' => 'required|unique:votes,judul_pemilihan',
            'deskripsi' => 'required',
            'tgl_vote_mulai' => 'required',
            'tgl_vote_berakhir' => 'required',
            'metode_peserta_evote' => 'required',
        ]);

        // validasi redirect
            $count_peserta = 0;
            if($request->metode_peserta_evote == 'anggota' && $request->peserta == null && $request->all_member == null){
                ConstantController::errorAlert('Peserta Wajib minimal dipilih satu');
                return redirect()->route($this->route.'.create');
            }
            
            if($request->metode_peserta_evote == 'anggota' && $request->peserta != null && $request->all_member == null){
                $count_peserta = count($request->peserta);
            }
        try{
            $data['judul_pemilihan'] = $request->judul_pemilihan;
            $data['deskripsi'] = $request->deskripsi;
            $data['tgl_vote_mulai'] = $request->tgl_vote_mulai;
            $data['tgl_vote_berakhir'] = $request->tgl_vote_berakhir;
            $vote = Vote::create($data);
            // dd($vote->id);
            ConstantController::logger($vote->getOriginal(), $this->route.'.store', 'insert success');
            // start action candidate
            for($i = 0; $i < count($request->nama_lengkap); $i++){
                if($request->nama_lengkap[$i] != null){
                    $dataCandidate['vote_id'] = $vote->id;
                    $dataCandidate['nama_lengkap'] = $request->nama_lengkap[$i];
                    $dataCandidate['visi'] = $request->visi[$i];
                    $dataCandidate['misi'] = $request->misi[$i];
                    Candidate::create($dataCandidate);
                }
            }
            // end action candidate
            if($request->metode_peserta_evote == 'anggota' && $request->all_member == 'on'){
                // nilai true
                $member = Member::where('status_id', '994f84dc-e703-4a2e-9df2-c49571f31498')->get();
                // dd($member[0]->id);
                for($i = 0; $i < count($member); $i++){
                    $datavoter[] = [
                        'id' => Str::uuid(),
                        'vote_id' => $vote->id,
                        'no_anggota' => $member[$i]->no_anggota,
                        'nama_lengkap' => $member[$i]->nama_lengkap,
                        'user_id' => $member[$i]->id,
                        'no_telp' => $member[$i]->no_telpon,
                        'dpd_id' => $member[$i]->dpd_id,
                        'dpc_id' => $member[$i]->dpc_id,
                        'pass_key' => random_int(100000, 999999),
                    ];
                }
            }else{
                for($i = 0; $i < $count_peserta; $i++){
                    $member = Member::find($request->peserta[$i]);
                    $datavoter[] = [
                        'id' => Str::uuid(),
                        'vote_id' => $vote->id,
                        'no_anggota' => $member->no_anggota,
                        'nama_lengkap' => $member->nama_lengkap,
                        'user_id' => $member->id,
                        'no_telp' => $member->no_telpon,
                        'dpd_id' => $member->dpd_id,
                        'dpc_id' => $member->dpc_id,
                        'pass_key' => random_int(100000, 999999),
                    ];
                }
            }
            foreach(array_chunk($datavoter, 100) as $item){
                Voter::insert($item);
            }
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($e->getMessage(), $this->route.'.store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.index');
    }

    public function store_candidate(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'vote_id' => 'required',
        ]);
        try{
            $data['nama_lengkap'] = $request->nama_lengkap;
            $data['visi'] = $request->visi;
            $data['misi'] = $request->misi;
            $data['vote_id'] = $request->vote_id;
            $vote = Candidate::create($data);
            // dd($vote->id);
            ConstantController::logger($vote->getOriginal(), $this->route.'.store', 'insert success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($e->getMessage(), $this->route.'.store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.edit', $request->vote_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vote = Vote::find($id);
        $candidate = Candidate::where('vote_id', $id)->get();
        $data = Voter::with(['vote_counter'])->where('vote_id', $id)->limit(10)->get();
        if(request()->ajax()){
            return DataTables::of($data)
            ->addColumn('status_pilih', function($item){
                return $item->vote_counter != null ? 'Sdh Memilih' : 'Blm Memilih';
            })
            ->addColumn('waktu_kirim', function($item){
                return $item->status_undangan == 'Belum Terkirim' ? '' : $item->tgl_kirim;
            })
            ->addColumn('sendWhatsapp', function($item){
               
                if($item->vote_counter != null){
                    return '';
                }else{
                    return '
                    <a class="btn btn-success btn-sm text-white" href="'.route("$this->route.ResendInvitation", $item->id).'">
                        <i class="fa-brands fa-whatsapp"></i> Kirim Ulang
                    </a>
                ';
                }
                
            })
            ->addIndexColumn()
            ->rawColumns(['sendWhatsapp','waktu_kirim','status_pilih'])
            ->make();
        }
        //dd($data);
        ConstantController::logger('-', $this->route.'.index', 'list');
        return view("$this->path_view.show", [
            'vote' => $vote,
            'candidate' => $candidate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Vote::findOrFail($id);
        $candidate = Candidate::where('vote_id', $id)->get();
        $data = Voter::with(['vote_counter'])->where('vote_id', $id)->get();
        if(request()->ajax()){
            return DataTables::of($data)
            ->addColumn('status_pilih', function($item){
                return $item->vote_counter != null ? 'Sdh Memilih' : 'Blm Memilih';
            })
            ->addColumn('waktu_kirim', function($item){
                return $item->status_undangan == 'Belum Terkirim' ? '' : $item->tgl_kirim;
            })
            ->addColumn('sendWhatsapp', function($item){
               
                if($item->vote_counter != null){
                    return '';
                }else{
                    return '
                    <form action="'. route("$this->route.destroyVoters", $item->id).'" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apa anda yakin menghapus data ini? data ini mungkin akan berpengaruh pada data transaksi aplikasi`)) run; return false">
                        '. method_field('delete') . csrf_field().'
                        <button type="submit" class="btn btn-danger btn-sm text-white">
                        <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                ';
                }
                
            })
            ->addIndexColumn()
            ->rawColumns(['sendWhatsapp','waktu_kirim','status_pilih'])
            ->make();
        }
        ConstantController::logger('-', $this->route.'.edit', 'open form edit');
        return view("$this->path_view.edit", [
            'item'=>$items,
            'candidate'=>$candidate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul_pemilihan' => 'required',
            'tgl_vote_mulai' => 'required',
            'tgl_vote_berakhir' => 'required',
        ]);

        try{
            $data['judul_pemilihan']   = $request->judul_pemilihan;
            $data['deskripsi'] = $request->deskripsi;
            $data['tgl_vote_mulai'] = $request->tgl_vote_mulai;
            $data['tgl_vote_berakhir'] = $request->tgl_vote_berakhir;
            $item = Vote::findOrFail($id);
            $item->update($data);

            ConstantController::logger($item->getOriginal(), $this->route.'.update', 'update success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($item->getMessage(), $this->route.'.update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.edit', $id);
    }

    public function update_candidate(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        try{
            $data['nama_lengkap']   = $request->nama_lengkap;
            $data['visi'] = $request->visi;
            $data['misi'] = $request->misi;
            $item = Candidate::findOrFail($id);
            $item->update($data);

            ConstantController::logger($item->getOriginal(), $this->route.'.update', 'update success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($item->getMessage(), $this->route.'.update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.edit', $item->vote_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Vote::findOrFail($id);
        $item->delete();
        $candidate = Candidate::Where('vote_id', $id)->get();
        if($candidate != null){
            Candidate::Where('vote_id', $id)->delete();
        }
        $voter = Voter::Where('vote_id', $id)->get();
        if($voter != null){
            Voter::Where('vote_id', $id)->delete();
        }
        $counter = VoteCounter::Where('vote_id', $id)->get();
        if($counter != null){
            VoteCounter::Where('vote_id', $id)->delete();
        }
        ConstantController::logger($item->getOriginal(), $this->route.'.delete', 'delete success');
        ConstantController::successDeleteAlert();
         return redirect()->route($this->route.'.index');
    }

    public function destroyVoters($id)
    {
        $item = Voter::findOrFail($id);
        $item->delete();
        ConstantController::logger($item->getOriginal(), $this->route.'.delete', 'delete success');
        ConstantController::successDeleteAlert();
         return redirect()->route($this->route.'.edit', $item->vote_id);
    }


    public function ResendInvitation($id){
        $voter = Voter::find($id);
        $election = Vote::find($voter->vote_id);

        $message = "[LASKAR PLN Virtual Assistant]\n\n";
        $message .= "*Pemberitahuan ulang*\n";
        $message .= "Hai, $voter->nama_lengkap \n";
        $message .= "Selamat anda terdaftar sebagai pemilih dari agenda pemilu LASKAR PLN melalui aplikasi E-Vote, dengan agenda sebagai berikut: \n";
        $message .= "Nama agenda pemilu: $election->judul_pemilihan \n";
        $message .= "Waktu pelaksanaan pemilu : $election->tgl_vote_mulai s/d $election->tgl_vote_berakhir \n";
        $message .= "untuk menggunakan hak pilih anda silahkan buka atau copy alamat link di bawah ini \n";
        $message .= url('evote/'.$voter->id)."\n";
        $message .= "dan jangan lupa saat sudah memilih masukan sekuriti code ini *$voter->pass_key* sebagai validasi anda adalah pemilih yang sah. \n";
        $message .= "mari sukseskan agenda pemilu LASKAR PLN melalui aplikasi E-vote. \n";
        $message .= "*LASKAR PLN* \n";
        $message .= "*Modern* \n";
        $message .= "*Mandiri* \n";
        $message .= "*Berintegritas* \n";
        $message .= "\n";
        $message .= "Salam hangat,\n";
        $message .= "\n";
        $message .= "*Laskar PLN*";

        ConstantController::sendMessageWhatssap($message, $voter->no_telp);
        ConstantController::successAlertWithMessage("Undangan dikirim kembali ke $voter->nama_lengkap");
        $data['status_undangan'] = 'Kirim Ulang';
        $data['tgl_kirim'] = Carbon::now();
        $voter->update($data);

        return redirect()->route($this->route.'.show', $voter->vote_id);
    }

    public function CollectVote($id){
        $voter = Voter::find($id);
        // dd($voter);
        if(!$voter){
            return abort(404);
        }else{
            $vote = Vote::find($voter->vote_id);
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            
            $startDate = date('Y-m-d', strtotime($vote->tgl_vote_mulai));
            $endDate = date('Y-m-d', strtotime($vote->tgl_vote_berakhir));
            
            if (($currentDate >= $startDate) && ($currentDate <= $endDate)){
                $candidate = Candidate::where('vote_id', $voter->vote_id)->get();
                return view("$this->path_view.get_vote", [
                    'vote' => $vote,
                    'voter' => $voter,
                    'candidate' => $candidate,
                ]);
            }else{
                ConstantController::errorAlert('E-Vote sudah kadaluarsa');
                return redirect()->route('root');
            }
        }
    }

    public function store_vote(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'security_code' => 'required',
        ]);

        $voter = Voter::where('vote_id', $request->vote_id)->where('id', $request->voter_id)->where('pass_key', $request->security_code)->first();
        // dd($voter);
        $counter = VoteCounter::where('vote_id', $request->vote_id)->where('voter_id', $request->voter_id)->first();
        if($counter){
            ConstantController::errorAlert('Mohon maaf anda sudah menggunakan hak suara anda one man one vote');
            return redirect()->route('root');
        }
        try{

            if(!$voter){
                ConstantController::errorAlert('Anda tidak terdaftar untuk melakukan pemungutan suara');
                return redirect()->route('root');
            }else{
                $data['vote_id'] = $request->vote_id;
                $data['voter_id'] = $request->voter_id;
                $data['candidate_id'] = $request->candidate_id;
                $data['ip_address'] = requestip::ip();
                $data['created_by'] = $voter->nama_lengkap;
                ConstantController::successDeleteAlert();
                VoteCounter::create($data);
            }
        } catch(Exception $e){
            ConstantController::logger($e->getMessage(), $this->route.'.store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }
        return redirect()->route('root');
    }

    public function dashboardEvote(Request $request){
        $listVote = Vote::where('status', 'Aktif')->get();
        if($request->get('vote_id')){
            $vote_id = $request->get('vote_id');
        }else{
            // $vote_id = '9986bfe1-90bf-4949-a645-21f4ac0afadx';
            $vote_id = '9986bfe1-90bf-4949-a645-21f4ac0afae9';
        }
        $vote = Vote::with(['voter', 'vote_counter'])->find($vote_id);
        $counter = DB::table('candidates')
                    ->select(DB::raw('candidates.nama_lengkap , count(vote_counters.id) as count'))
                    ->leftjoin('vote_counters', function ($join) {
                        $join->on('candidates.id', '=', 'vote_counters.candidate_id')
                        ->whereNull('vote_counters.deleted_at');
                    })
                    ->groupBy('candidates.id')
                    ->where('candidates.vote_id', $vote_id)
                    ->whereNull('candidates.deleted_at')
                    ->get();
        // dd($counter);
        return view("$this->path_view.dashboard", [
            'list_vote'=>$listVote,
            'vote'=>$vote,
            'counter'=>$counter,
        ]); 
    }
}
