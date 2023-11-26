<?php

namespace App\Http\Controllers\Absensi;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AbsensiController extends Controller
{
    var $route = 'attendances';
    var $path_view = 'aplikasi.absensi';

    function __construct()
    {
        $this->middleware('permission:plikasi_absensi-list|aplikasi_absensi-list-user|aplikasi_absensi-list-user|permission-create|aplikasi_absensi-edit|aplikasi_absensi-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:aplikasi_absensi-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:aplikasi_absensi-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:aplikasi_absensi-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $data = Attendance::get();
        if ($user->can('aplikasi_absensi-list-user')) {
            $data->where('user_id', $user->user_id);
        }

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addColumn('show', function ($item) {
                    return '
            
                    <a class="btn btn-primary btn-sm text-white" href="' . route("$this->route.show", $item->id) . '">
                        <i class="fa-solid fa-search"></i>
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
                ->rawColumns(['show', 'edit', 'delete'])
                ->make();
        }
        //dd($data);
        ConstantController::logger('-', $this->route . '.index', 'list');
        return view("$this->path_view.index");
    }

    public function getDataKehadiran()
    {
        if (request()->ajax()) {
            $data = AttendanceDetail::with(['kehadiran'])
                ->where('email', Auth::user()->email)
                ->orWhere('user_id', Auth::user()->user_id)
                ->orWhere('nama', Auth::user()->name)
                ->get();
            // dd($data);
            return DataTables::of($data)
                ->addColumn('show', function ($item) {
                    return '
            
                    <a class="btn btn-primary btn-sm text-white" href="' . route("$this->route.show", $item->attendance_id) . '">
                        <i class="fa-solid fa-search"></i>
                    </a>
                ';
                })
                ->addIndexColumn()
                ->rawColumns(['show'])
                ->make();
        }
    }

    public function searchAbsensi(Request $request)
    {
        $attendance = Attendance::with([]);
        if ($request->get('tempat') && $request->get('agenda') && $request->get('start_date') && $request->get('end_date')) {
            $data = $attendance->where('tempat', $request->get('tempat'))
                ->where('agenda', 'LIKE', '%' . $request->get('agenda') . '%')
                ->whereBetween('tgl_agenda', [$request->get('start_date'), $request->get('end_date')])
                ->where('is_public', 'Ya')
                ->get();
        } elseif ($request->get('tempat') && $request->get('agenda') && !$request->get('start_date') && !$request->get('end_date')) {
            $data = $attendance->where('tempat', $request->get('tempat'))
                ->where('agenda', 'LIKE', '%' . $request->get('agenda') . '%')
                ->where('is_public', 'Ya')
                ->get();
        } elseif ($request->get('tempat') && !$request->get('agenda') && !$request->get('start_date') && !$request->get('end_date')) {
            $data = $attendance->where('tempat', $request->get('tempat'))
                ->where('is_public', 'Ya')
                ->get();
        } elseif (!$request->get('tempat') && $request->get('agenda') && !$request->get('start_date') && !$request->get('end_date')) {
            $data = $attendance->where('agenda', 'LIKE', '%' . $request->get('agenda') . '%')
                // ->where('is_public', 'Ya')
                ->get();
        } elseif (!$request->get('tempat') && !$request->get('agenda') && $request->get('start_date') && $request->get('end_date')) {
            $data = $attendance->whereBetween('tgl_agenda', [$request->get('start_date'), $request->get('end_date')])
                // ->where('is_public', 'Ya')
                ->get();
        } else {
            $data = $attendance->where('id', 'xx')->get();
        }

        if (request()->ajax()) {

            return DataTables::of($data)
                ->addColumn('show', function ($item) {
                    return '
            
                    <a class="btn btn-primary btn-sm text-white" href="' . route("$this->route.show", $item->id) . '">
                        <i class="fa-solid fa-search"></i>
                    </a>
                ';
                })
                ->addIndexColumn()
                ->rawColumns(['show'])
                ->make();
        }
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
            'agenda' => 'required',
            'tgl_agenda' => 'required',
            'tempat' => 'required',
            'is_public' => 'required',
            'jam_mulai' => 'required',
        ]);
        // dd($request->all());
        try {
            $data['agenda'] = $request->agenda;
            $data['slug'] = Str::slug($request->agenda, '-');
            $data['tgl_agenda'] = $request->tgl_agenda;
            $data['user_id'] = Auth::user()->user_id;
            $data['tempat'] = $request->tempat;
            $data['is_public'] = $request->is_public;
            $data['jam_mulai'] = $request->jam_mulai;
            $data['jam_berakhir'] = $request->is_selesai == "on" ? '00:00' : $request->jam_berakhir;
            $data['is_selesai'] = $request->is_selesai == "on" ? 'Ya' : 'Tidak';
            $create = Attendance::create($data);
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
        $items = Attendance::findOrFail($id);
        $kehadiran = AttendanceDetail::where('attendance_id', $id)->get();
        $url = url('ceklok/' . $id);
        $qrcode = QrCode::size(200)->generate(url('ceklok/' . $id));
        ConstantController::logger('-', $this->route . '.show', 'open show Absensi');
        return view("$this->path_view.show", [
            'item' => $items,
            'kehadiran' => $kehadiran,
            'qrcode' => $qrcode,
            'url' => $url,
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
        $items = Attendance::findOrFail($id);
        ConstantController::logger('-', $this->route . '.edit', 'open form edit');
        return view("$this->path_view.edit", [
            'item' => $items,
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
            'agenda' => 'required',
            'tgl_agenda' => 'required',
            'tempat' => 'required',
            'is_public' => 'required',
            'jam_mulai' => 'required',
        ]);

        try {
            $data['agenda'] = $request->agenda;
            $data['slug'] = Str::slug($request->agenda, '-');
            $data['tgl_agenda'] = $request->tgl_agenda;
            $data['tempat'] = $request->tempat;
            $data['is_public'] = $request->is_public;
            $data['jam_mulai'] = $request->jam_mulai;
            $data['jam_berakhir'] = $request->is_selesai == "on" ? '00:00' : $request->jam_berakhir;
            $data['is_selesai'] = $request->is_selesai == "on" ? 'Ya' : 'Tidak';
            $item = Attendance::findOrFail($id);
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
        $item = Attendance::findOrFail($id);
        $item->delete();
        $itemDetail = AttendanceDetail::firstOrFail('attendance_id', $id);
        $itemDetail->delete();
        ConstantController::logger($item->getOriginal(), $this->route . '.delete', 'delete success');
        ConstantController::successDeleteAlert();
        return redirect()->route($this->route . '.index');
    }

    public function ceklok($id)
    {
        $items = Attendance::findOrFail($id);
        // ConstantController::logger('-', $this->route . '.edit', 'open form ceklok');
        return view("$this->path_view.ceklok", [
            'item' => $items,
        ]);
    }

    public function storeCeklok(Request $request)
    {
        $this->validate($request, [
            'attendance_id' => 'required',
            'nama' => 'required',
            'unit' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
            'captcha' => 'required|captcha'
        ]);
        // dd($request->all());
        try {
            $data['attendance_id'] = $request->attendance_id;
            $data['nama'] = $request->nama;
            $data['unit'] = $request->unit;
            $data['email'] = $request->email;
            $data['no_tlp'] = $request->no_tlp;
            $create = AttendanceDetail::create($data);
            // ConstantController::logger($create->getOriginal(), $this->route . '.store', 'insert success absensi ');
            ConstantController::successAlert();
        } catch (Exception $e) {
            // ConstantController::logger($e->getMessage(), $this->route . '.store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }
        return redirect()->route('root');
    }

    public function destroyCeklok($id)
    {
        $item = AttendanceDetail::findOrFail($id);
        $item->delete();
        ConstantController::logger($item->getOriginal(), $this->route . '.delete', 'delete ceklok Sukses');
        ConstantController::successDeleteAlert();
        return redirect()->route($this->route . '.show', $item->attendance_id);
    }

    public function printAbsensi($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance_detail = AttendanceDetail::where('attendance_id', $id);
        $jumlah_kehadiran = $attendance_detail->count();
        $kehadiran = $attendance_detail->get()->toArray();
        // 12 adalah jumlah baris tiap halaman
        $count_array = $jumlah_kehadiran / 12;
        $hitung_sisa_array = $count_array - floor($count_array);
        $sisa_array = $hitung_sisa_array * 12;
        $array_pembagi = [];
        for ($x = 0; $x < floor($count_array); $x++) {
            array_push($array_pembagi, 12);
        }
        array_push($array_pembagi, round($sisa_array));
        // dd($kehadiran);

        $result_kehadiran = [];
        foreach ($array_pembagi as $k => $v) {
            $result_kehadiran[$k] = array_splice($kehadiran, 0, $v);
        }
        // dd($result_kehadiran);

        $printed_by = Auth::user()->name;
        $data = [
            'date' => date('m/d/Y h:i:s'),
            'attendance' => $attendance,
            'attendance_detail' => $result_kehadiran,
            'jumlah_kehadiran' => $jumlah_kehadiran,
            'printed_by' => $printed_by
        ];

        // dd($data);

        $pdf = Pdf::loadView("$this->path_view.print_absensi", $data);

        return $pdf->download("Absensi $attendance->agenda $attendance->tgl_agenda.pdf");
    }

    // public function generateQr($id)
    // {
    //     $image = QrCode::size(200)->generate(url('ceklok/' . $id));

    //     // $content = $image->get("png");

    //     return response($image)
    //         ->header('Content-Type', 'image/png')
    //         ->header('Pragma', 'public')
    //         ->header('Content-Disposition', 'inline; filename="qrcodeimg.png"')
    //         ->header('Cache-Control', 'max-age=60, must-revalidate');
    // }
}
