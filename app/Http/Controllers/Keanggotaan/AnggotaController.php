<?php

namespace App\Http\Controllers\Keanggotaan;

use App\Exports\AnggotaExport;
use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Dpc;
use App\Models\Dpd;
use App\Models\Member;
use App\Models\Religion;
use App\Models\Size;
use App\Models\StatusMember;
use App\Models\TypeBlood;
use App\Models\Unit;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    var $route = 'members';
    var $path_view = 'keanggotaan.anggota';

    function __construct()
    {
        $this->middleware('permission:keanggotaan_anggota-list|permission-create|keanggotaan_anggota-edit|keanggotaan_anggota-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:keanggotaan_anggota-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:keanggotaan_anggota-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:keanggotaan_anggota-delete', ['only' => ['destroy']]);
        $this->middleware('permission:keanggotaan_anggota-show', ['only' => ['show']]);
        $this->middleware('permission:dashboard-dashboard_anggota_show', ['only' => ['dashboardlaskar']]);
        $this->middleware('permission:keanggotaan_anggota-print', ['only' => ['PrintUndurDiri', 'PrintPendaftaran', 'PrintSuratKuasa', 'PrintTemplate']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Member::with(['unit', 'size', 'status', 'dpc', 'dpd', 'register'])->orderBy('created_at', 'desc')->get();
        // dd($data);
        if (request()->ajax()) {
            return DataTables::of($data)
                // ->editColumn('created_at', function($data){ $formatedDate = $data->created_at != null ?Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y') : null; return $formatedDate; })
                // ->editColumn('tgl_pendaftaran', function($data){$formatedDate = $data->tgl_pendaftaran != null ? Carbon::createFromFormat('Y-m-d H:i:s', $data->tgl_pendaftaran )->format('d-m-Y') : null; return $formatedDate; })
                ->addColumn('serikat', function ($item) {
                    if ($item->register != null) {
                        if ($item->register->is_out_serikat == "Ya") {
                            return $item->register->serikat->serikat_pekerja;
                        } else {
                            return "Tidak";
                        }
                    } else {
                        return 'Data Anggota lama';
                    }
                })
                ->addColumn('print', function ($item) {
                    return '
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="' . route("$this->route.PrintUndurDiri", $item->id) . '">Pengunduran Diri</a></li>
                        <li><a class="dropdown-item" href="' . route("$this->route.PrintPendaftaran", $item->id) . '">Pendaftaran</a></li>
                        <li><a class="dropdown-item" href="' . route("$this->route.PrintSuratKuasa", $item->id) . '">Surat Kuasa Pemotongan</a></li>
                        <li><a class="dropdown-item" href="' . route("$this->route.PrintTemplate", $item->id) . '">Template Materai</a></li>
                    </ul>
                </div>
                ';
                })
                ->addColumn('show', function ($item) {
                    return '
                
                    <a class="btn btn-primary btn-sm text-white" href="' . route("$this->route.show", $item->id) . '">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                ';
                })
                ->addColumn('edit', function ($item) {
                    return '
                
                    <a class="btn btn-success btn-sm text-white" href="' . route("$this->route.edit", $item->id) . '">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                ';
                })
                ->addColumn('delete', function ($item) {
                    return '
                    <form action="' . route("$this->route.destroy", $item->id) . '" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apa anda yakin menghapus data ini? data ini mungkin akan berpengaruh pada data transaksi aplikasi`)) run; return false">
                        ' . method_field('delete') . csrf_field() . '
                        <button type="submit" class="btn btn-danger btn-sm text-white">
                        <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                ';
                })
                ->addIndexColumn()
                ->rawColumns(['print', 'show', 'edit', 'delete', 'serikat'])
                ->make();
        }
        //dd($data);
        ConstantController::logger('-', $this->route . '.index', 'list');
        return view("$this->path_view.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ConstantController::logger('-', $this->route . '.create', 'open form create');
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
        $this->validate($request, [
            'bank' => 'required|unique:Banks,bank',
        ]);

        try {
            $data['bank'] = $request->bank;
            $data['description'] = $request->description;
            $create = Member::create($data);
            ConstantController::logger($create->getOriginal(), $this->route . '.store', 'insert success');
            ConstantController::successAlert();
        } catch (Exception $e) {
            ConstantController::logger($e->getMessage(), $this->route . '.store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route . '.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Member::findOrFail($id);
        ConstantController::logger('-', $this->route . '.edit', 'detail id ' . $id);
        return view("$this->path_view.show", [
            'item' => $items,
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
        $items = Member::findOrFail($id);
        $dpd = Dpd::orderBy('dpd', 'asc')->get();
        $dpc = Dpc::orderBy('dpc', 'asc')->get();
        $agama = Religion::orderBy('agama', 'asc')->get();
        $size = Size::orderBy('ukuran', 'asc')->get();
        $type_blood = TypeBlood::orderBy('golongan_darah')->get();
        $bank = Bank::orderBy('bank', 'asc')->get();
        $unit = Unit::orderBy('unit', 'asc')->get();
        $status = StatusMember::orderBy('status', 'asc')->get();
        ConstantController::logger('-', $this->route . '.edit', 'open form edit');
        return view("$this->path_view.edit", [
            'item' => $items,
            'dpd' => $dpd,
            'dpc' => $dpc,
            'agama' => $agama,
            'size' => $size,
            'type_blood' => $type_blood,
            'bank' => $bank,
            'unit' => $unit,
            'status' => $status,
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
            'status_id' => 'required',
        ]);

        try {
            $data['unit_id'] = $request->unit_id;
            $data['golongan_darah'] = $request->golongan_darah;
            $data['jenis_kelamin'] = $request->jenis_kelamin;
            $data['nama_lengkap'] = $request->nama_lengkap;
            $data['alamat'] = $request->alamat;
            $data['agama'] = $request->agama;
            $data['tempat_lahir'] = $request->tempat_lahir;
            $data['no_telpon'] = $request->no_telpon;
            $data['email'] = $request->email;
            $data['size_id'] = $request->size_id;
            $data['nipeg'] = $request->nipeg;
            $data['grade'] = $request->grade;
            $data['tgl_lahir'] = $request->tgl_lahir;
            $data['dpd_id'] = $request->dpd_id;
            $data['dpc_id'] = $request->dpc_id;
            $data['status_id'] = $request->status_id;
            $data['bank_id'] = $request->bank_id;
            $data['no_rekening'] = $request->no_rekening;
            $item = Member::findOrFail($id);
            $item->update($data);

            ConstantController::logger($item->getOriginal(), $this->route . '.update', 'update success');
            ConstantController::successAlert();
        } catch (Exception $e) {
            ConstantController::logger($item->getMessage(), $this->route . '.update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route . '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Member::findOrFail($id);
        $item->delete();
        ConstantController::logger($item->getOriginal(), $this->route . '.delete', 'delete success');
        ConstantController::successDeleteAlert();
        return redirect()->route($this->route . '.index');
    }

    public static function createUser($member)
    {
        $unit = Unit::where('id', $member->unit_id)->first();
        $data['user_id'] = $member->id;
        $data['name'] = $member->nama_lengkap;
        $data['email'] = $member->email;
        $data['nipeg'] = $member->nipeg;
        $data['unit_id'] = $member->unit_id;
        $data['induk_id'] = $unit != null ? $unit->induk_id : null;
        $data['dpd_id'] = $member->dpd_id;
        $data['dpc_id'] = $member->dpc_id;
        $data['alamat'] = $member->alamat;
        $data['password'] = bcrypt('P@ssw0rdLaskar');
        $user = User::create($data);
        $user->assignRole([3]);
    }

    public function PrintUndurDiri($id)
    {
        $member = Member::with(['unit'])->findOrFail($id);
        // dd(asset('test'));
        // dd(storage_path());
        $data = [
            'date' => date('m/d/Y'),
            'users' => $member
        ];

        $pdf = Pdf::loadView("$this->path_view.pengunduran_diri", $data);

        return $pdf->download("Formulir Pengunduran Diri $member->nama_lengkap.pdf");
    }

    public function PrintPendaftaran($id)
    {
        $member = Member::with(['unit', 'size'])->findOrFail($id);
        $data = [
            'date' => date('m/d/Y'),
            'users' => $member
        ];

        $pdf = Pdf::loadView("$this->path_view.pendaftaran", $data);

        return $pdf->download("Formulir Pendaftaran $member->nama_lengkap.pdf");
    }

    public function PrintSuratKuasa($id)
    {
        $member = Member::with(['unit', 'size'])->findOrFail($id);
        $data = [
            'date' => date('m/d/Y'),
            'users' => $member
        ];

        $pdf = Pdf::loadView("$this->path_view.surat_kuasa", $data);

        return $pdf->download("Surat Kuasa Pemotongan Iuran Anggota a/n $member->nama_lengkap.pdf");
    }

    public function PrintTemplate($id)
    {
        $member = Member::with(['unit', 'size'])->findOrFail($id);
        $data = [
            'date' => date('m/d/Y'),
            'users' => $member
        ];

        $pdf = Pdf::loadView("$this->path_view.template_materai", $data);

        return $pdf->download("Surat Kuasa Pemotongan Iuran Anggota a/n $member->nama_lengkap.pdf");
    }

    public function getAnggota()
    {
        $members = Member::where('nama_lengkap', 'LIKE', '%' . request()->get('q') . '%')->get();
        return response()->json($members);
    }

    public function export()
    {
        $now = Carbon::now();
        return Excel::download(new AnggotaExport, "Export Data Anggota Per $now.xlsx");
    }

    // start dashboard

    public function dashboardlaskar(Request $request)
    {
        $member = Member::all();
        $sebaranAnggota = $member->where('status_id', '994f84dc-e703-4a2e-9df2-c49571f31498')->count();
        $anggotaPensiun = $member->where('status_id', '994f863f-8d04-42d6-afd5-1bcc7e11a083')->count();
        $sebaranlokasiAnggota = DB::table('members')
            ->select('dpc', 'dpc_id', DB::raw('count(*) as total'))
            ->leftjoin('dpc', function ($join) {
                $join->on('members.dpc_id', '=', 'dpc.id')
                    ->whereNull('dpc.deleted_at');
            })
            ->groupBy('members.dpc_id')
            ->where('members.status_id', '994f84dc-e703-4a2e-9df2-c49571f31498')
            ->whereNull('members.deleted_at')
            ->get();

        $sebaranunitAnggota = DB::table('members')
            ->select('unit', 'unit_id', DB::raw('count(*) as total'))
            ->leftjoin('units', function ($join) {
                $join->on('members.unit_id', '=', 'units.id')
                    ->whereNull('units.deleted_at');
            })
            ->groupBy('members.unit_id')
            ->where('members.status_id', '994f84dc-e703-4a2e-9df2-c49571f31498')
            ->whereNull('members.deleted_at')
            ->get();
        // dd($sebaranunitAnggota);

        // $sebaranunitAnggota->toSql();

        $sebaranUmur = DB::select("
                select 
                    count(if(umur < 21,1,null)) as 'bawah_dua_satu', 
                    count(if(umur between 21 and 29,1,null)) as 'dua_satu_to_dua_sembilan',
                    count(if(umur between 30 and 40,1,null)) as 'tiga_puluh_to_empat_puluh',
                    count(if(umur between 41 and 55,1,null)) as 'empat_satu_to_lima_lima',
                    count(if(umur = 56,1,null)) as 'lima_puluh_enam',
                    count(if(umur > 56,1,null)) as 'atas_lima_puluh_enam'
                from(
                    select nama_lengkap , tgl_lahir, timestampdiff(year, tgl_lahir, curdate()) as umur 
                    from members
                    where status_id = '994f84dc-e703-4a2e-9df2-c49571f31498'
                ) as dummy_table
            ");
        // dd($sebaranlokasiAnggota);
        return view("$this->path_view.dashboard", [
            'sebaran_anggota' => $sebaranAnggota,
            'anggota_pensiun' => $anggotaPensiun,
            'sebaranUmur' => $sebaranUmur,
            'sebaran_dpc_anggota' => $sebaranlokasiAnggota,
            'sebaran_unit_anggota' => $sebaranunitAnggota,
        ]);
    }

    // end dashboard
}
