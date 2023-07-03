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
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        if(request()->ajax()){
            $data = Vote::all();
            return DataTables::of($data)
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
            ->rawColumns(['show','edit', 'delete'])
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
        if(request()->ajax()){
            $data = Voter::where('vote_id', $id)->get();
            return DataTables::of($data)
            ->addColumn('sendWhatsapp', function($item){
                return '
                    <a class="btn btn-success btn-sm text-white" href="'.route("$this->route.ResendInvitation", $item->id).'">
                        <i class="fa-brands fa-whatsapp"></i> Kirim Ulang
                    </a>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['sendWhatsapp'])
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
        ConstantController::logger('-', $this->route.'.edit', 'open form edit');
        return view("$this->path_view.edit", [
            'item'=>$items,
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
            'bank' => 'required',
        ]);

        try{
            $data['bank']   = $request->bank;
            $data['description'] = $request->description;
            $item = Vote::findOrFail($id);
            $item->update($data);

            ConstantController::logger($item->getOriginal(), $this->route.'.update', 'update success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($item->getMessage(), $this->route.'.update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.index');
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
        $message .= "https://laskar_site.test/evote/$voter->id \n";
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
}
