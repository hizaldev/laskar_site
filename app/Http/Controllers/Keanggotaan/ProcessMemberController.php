<?php

namespace App\Http\Controllers\Keanggotaan;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\CounterMember;
use App\Models\Dpc;
use App\Models\Dpd;
use App\Models\Induk;
use App\Models\Member;
use App\Models\RegisterMembers;
use App\Models\Religion;
use App\Models\Size;
use App\Models\TypeBlood;
use App\Models\Unit;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProcessMemberController extends Controller
{
    var $route = 'process_members';
    var $path_view = 'keanggotaan.process_register';

    function __construct()
    {
        $this->middleware('permission:keanggotaan_proses_daftar-list|permission-create|keanggotaan_proses_daftar-edit|keanggotaan_proses_daftar-delete', ['only' => ['index','store']]);
        $this->middleware('permission:keanggotaan_proses_daftar-create', ['only' => ['create','store']]);
        $this->middleware('permission:keanggotaan_proses_daftar-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:keanggotaan_proses_daftar-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = RegisterMembers::with('unit')->whereNull('approval')->get();
            return DataTables::of($data)
            ->addColumn('edit', function($item){
                return '
                
                    <a class="btn btn-success btn-sm text-white" href="'.route("$this->route.edit", $item->id).'">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                ';
            })
            ->addColumn('delete', function($item){
                return '
                    <form action="'. route("$this->route.destroy", $item->id).'" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apa anda yakin reject proses pendaftaran ini?`)) run; return false">
                        '. method_field('delete') . csrf_field().'
                        <button type="submit" class="btn btn-danger btn-sm text-white">
                        <i class="fa-sharp fa-light fa-circle-xmark"></i>
                        </button>
                    </form>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['edit', 'delete'])
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

        return view("$this->path_view.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = RegisterMembers::findOrFail($id);
        $dpd = Dpd::orderBy('dpd', 'asc')->get();
        $dpc = Dpc::orderBy('dpc', 'asc')->get();
        $agama = Religion::orderBy('agama','asc')->get();
        $size = Size::orderBy('ukuran','asc')->get();
        $type_blood = TypeBlood::orderBy('golongan_darah')->get();
        $bank = Bank::orderBy('bank','asc')->get();
        $unit = Unit::orderBy('unit','asc')->get();
        ConstantController::logger('-', $this->route.'.edit', 'open form edit');
        return view("$this->path_view.edit", [
            'item'=>$items,
            'dpd'=>$dpd,
            'dpc'=>$dpc,
            'agama'=>$agama,
            'size'=>$size,
            'type_blood'=>$type_blood,
            'bank'=>$bank,
            'unit'=>$unit,
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
        // dd($request->all());
        $this->validate($request, [
            'no_pendaftaran' => 'required',
            'nama_lengkap' => 'required',
            'nipeg' => 'required',
            'email' => 'required',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_telpon' => 'required',
            'alamat' => 'required',
            'grade' => 'required',
            'agama' => 'required',
            'size_id' => 'required',
            'golongan_darah' => 'required',
            'dpd_id' => 'required',
            'dpc_id' => 'required',
            'bank_id' => 'required',
            'no_rekening' => 'required',
        ]);

        try{
            $checkMember = Member::where('nipeg', $request->nipeg)->first();
            if($checkMember == !null){
                ConstantController::errorAlert('Gagall Proses Pendaftaran karena NIPEG Sudah Terdaftar');
                ConstantController::logger('Gagall Proses Pendaftaran karena NIPEG Sudah Terdaftar', $this->route.'.update', 'update error');
                return redirect()->route($this->route.'.index');
            }
            $data['no_pendaftaran']   = $request->no_pendaftaran;
            $data['nama_lengkap']   = $request->nama_lengkap;
            $data['nipeg']   = $request->nipeg;
            $data['email']   = $request->email;
            $data['tempat_lahir']   = $request->tempat_lahir;
            $data['no_telpon']   = $request->no_telpon;
            $data['grade']   = $request->grade;
            $data['size_id']   = $request->size_id;
            $data['golongan_darah'] = $request->golongan_darah;
            $data['jenis_kelamin'] = $request->jenis_kelamin;
            $data['agama'] = $request->agama;
            $data['approval'] = Auth::user()->name;
            $item = RegisterMembers::findOrFail($id);
            $item->update($data);

            // start generate no Pendataran
            $unit = Unit::find($request->unit_id); 
            if($unit == !null){
                $firstCode = Induk::where('id', $unit->induk_id)->first();
            }else{
                ConstantController::errorAlert('Gagal generate no anggota check kode unit');
                return redirect()->route($this->route.'.index');
            }
            $currentYear = Carbon::now()->format('y');
            $firstNip = Str::substr($request->nipeg, 0, 4);
            //running number
            $getCounter = CounterMember::max('counter');
            if($getCounter != null){
                $tmp = ((int)$getCounter)+1;
                $counter = sprintf("%05s", $tmp); 
            }else{
                $counter = '00001';
            }

            // end generate no pendaftaran
            $data_anggota['no_anggota'] = $firstCode->code.$currentYear.$firstNip.$counter;
            $data_anggota['no_pendaftaran'] = $request->no_pendaftaran;
            $data_anggota['unit_id'] = $request->unit_id;
            $data_anggota['golongan_darah'] = $request->golongan_darah;
            $data_anggota['jenis_kelamin'] = $request->jenis_kelamin;
            $data_anggota['nama_lengkap'] = $request->nama_lengkap;
            $data_anggota['alamat'] = $request->alamat;
            $data_anggota['agama'] = $request->agama;
            $data_anggota['tempat_lahir'] = $request->tempat_lahir;
            $data_anggota['no_telpon'] = $request->no_telpon;
            $data_anggota['email'] = $request->email;
            $data_anggota['size_id'] = $request->size_id;
            $data_anggota['nipeg'] = $request->nipeg;
            $data_anggota['grade'] = $request->grade;
            $data_anggota['sign'] = $item->sign;
            $data_anggota['ip_address'] = $item->ip_address;
            $data_anggota['tgl_lahir'] = $request->tgl_lahir;
            $data_anggota['dpd_id'] = $request->dpd_id;
            $data_anggota['dpc_id'] = $request->dpc_id;
            // status aktif
            $data_anggota['status_id'] = '994f84dc-e703-4a2e-9df2-c49571f31498';
            $data_anggota['bank_id'] = $request->bank_id;
            $data_anggota['no_rekening'] = $request->no_rekening;
            $data_anggota['tgl_anggota'] = Carbon::now();
            $data_anggota['tgl_pendaftaran'] = $item->created_at;
            $member = Member::create($data_anggota);
            AnggotaController::createUser($member);

            $message = "Yeeeaayyy... Selamat $request->nama_lengkap anda telah bergabung dengan Laskar PLN proses pendaftaran keanggotaan anda telah selesai kami verifikasi. \n\n\n\nSalam hangat dari kami\n *Laskar PLN*";
            $reciver = $request->no_telpon;
            ConstantController::sendMessageWhatssap($message, $reciver);

            ConstantController::logger($item->getOriginal(), $this->route.'.update', 'update success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($e->getMessage(), $this->route.'.update', 'update error');
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
        $item = RegisterMembers::findOrFail($id);
        $item->delete();
        ConstantController::logger($item->getOriginal(), $this->route.'.delete', 'delete success');
        $message = "Mohon maaf $item->nama_lengkap pendaftaran keanggotaan anda kami tolak, kami berharap anda bisa bergabung dengan kami. Silahkan melakukan pendaftaran lagi jika anda ingin mendaftar sebagai anggota Laskar PLN \n\n\n\nSalam hangat dari kami\n *Laskar PLN*";
        $reciver = $item->no_telpon;
        ConstantController::sendMessageWhatssap($message, $reciver);
        ConstantController::successDeleteAlert();
         return redirect()->route($this->route.'.index');
    }
}
