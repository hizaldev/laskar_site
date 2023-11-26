<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\Member;
use App\Models\Unit;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbsensiController extends Controller
{
    public function getDataAbsensiUser(Request $request)
    {

        $user = $request->user();

        $user = User::find($user->id);
        $attendance = Attendance::get();
        if ($user->can('aplikasi_absensi-list-user')) {
            $attendance->where('user_id', $user->user_id);
        }
        if ($attendance) {
            return ResponseFormatter::success(
                $attendance,
                'Data transaksi berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }

    public function getDataKehadiranUser(Request $request)
    {

        $user = $request->user();
        $attendance = AttendanceDetail::with(['kehadiran'])
            ->where('email', $user->email)
            ->when($request->input('agenda') != null, function ($query) use ($request) {
                $query->where('agenda', 'LIKE', '%' . $request->get('agenda') . '%');
            })
            ->orWhere('user_id', $user->user_id)
            ->orWhere('nama', $user->name)
            ->get();
        if ($attendance) {
            return ResponseFormatter::success(
                $attendance,
                'Data transaksi berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }

    public function getDataAbsensiDetail(Request $request)
    {
        $id = $request->input('id');
        $attendance = Attendance::with(['attendance_detail'])
            ->where('id', $id)
            ->get();

        if ($attendance) {
            return ResponseFormatter::success(
                $attendance,
                'Data transaksi berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }

    public function showAbsensiScan(Request $request)
    {
        $url = $request->url;
        // start conditional
        $attendance_id = explode("/", $url);
        $id = $attendance_id[4];
        $attendance = Attendance::where('id', $id)
            ->get();

        if ($attendance) {
            return ResponseFormatter::success(
                $attendance,
                'Data transaksi berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }

    public function prosesKehadiran(Request $request)
    {
        $user = $request->user();
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $checkMember = Member::where('nipeg', $user->nipeg)->first();
            if (!$checkMember) {
                return ResponseFormatter::error([
                    'message' => 'Data Anggota tidak ditemukan',
                    'error' => 'Data Available',
                ], 'Proses Register Failed', 500);
            }

            $checkUnit = Unit::where('id', $user->unit_id)->first();
            if (!$checkUnit) {
                return ResponseFormatter::error([
                    'message' => 'Data Unit Anggota tidak ditemukan',
                    'error' => 'Data Available',
                ], 'Proses Register Failed', 500);
            }
            // end conditional

            $data['attendance_id'] = $request->id;
            $data['user_id'] = $user->user_id;
            $data['nama'] = $user->name;
            $data['unit'] = $checkUnit->unit;
            $data['email'] = $user->email;
            $data['no_tlp'] = $checkMember->no_telpon;
            $data['sign'] = null;

            $dataKehadiran = AttendanceDetail::create($data);

            return ResponseFormatter::success(
                $dataKehadiran,
                'Data transaksi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went Wrong',
                'error' => $error->getMessage(),
            ], 'Authenticated Failed', 500);
        }
    }

    public function createAbsensi(Request $request)
    {
        $user = $request->user();
        try {
            $request->validate([
                'agenda' => 'required',
                'tgl_agenda' => 'required',
                'tempat' => 'required',
                'is_public' => 'required',
                'jam_mulai' => 'required',
                'is_selesai' => 'required',
            ]);

            $url = $request->url;
            // start conditional
            // end conditional

            $data['agenda'] = $request->agenda;
            $data['slug'] = Str::slug($request->agenda, '-');
            $data['user_id'] = $user->user_id;
            $data['tgl_agenda'] = $request->tgl_agenda;
            $data['tempat'] = $request->tempat;
            $data['is_public'] = $request->is_public;
            $data['jam_mulai'] = $request->jam_mulai;
            $data['is_selesai'] = $request->is_selesai;
            $data['jam_berakhir'] = $request->is_selesai == "Ya"  ? "00:00" : $request->jam_berakhir;

            $dataAbsensi = Attendance::create($data);

            return ResponseFormatter::success(
                $dataAbsensi,
                'Data transaksi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went Wrong',
                'error' => $error->getMessage(),
            ], 'Authenticated Failed', 500);
        }
    }

    public function printAbsensi(Request $request)
    {
        $user = $request->user();
        $attendance = Attendance::findOrFail($request->input('id'));
        $attendance_detail = AttendanceDetail::where('attendance_id', $request->input('id'));
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

        $printed_by = $user->name;
        $data = [
            'date' => date('m/d/Y h:i:s'),
            'attendance' => $attendance,
            'attendance_detail' => $result_kehadiran,
            'jumlah_kehadiran' => $jumlah_kehadiran,
            'printed_by' => $printed_by
        ];

        // dd($data);

        $pdf = Pdf::loadView("aplikasi.absensi.print_absensi", $data);

        return $pdf->stream("Absensi $attendance->agenda $attendance->tgl_agenda.pdf");
    }

    public function getDataSearchAbsensi(Request $request)
    {

        $user = $request->user();
        $agenda = $request->input('agenda');
        $agenda != null ? $agenda : $agenda = 'dsdsd3ed';
        $user = User::find($user->id);
        $attendance = Attendance::where('agenda', 'like', "%$agenda%")->get();
        if ($user->can('aplikasi_absensi-list-user')) {
            $attendance->where('user_id', $user->user_id);
        }
        if ($attendance) {
            return ResponseFormatter::success(
                $attendance,
                'Data transaksi berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }
}
