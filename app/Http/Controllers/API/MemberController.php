<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Keanggotaan\AnggotaController;
use App\Models\CounterMember;
use App\Models\Induk;
use App\Models\Member;
use App\Models\RegisterMembers;
use App\Models\Unit;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    // function __construct()
    // {
    //     // $this->middleware('permission:keanggotaan_proses_daftar-ending|permission-create|keanggotaan_proses_daftar-edit|keanggotaan_proses_daftar-delete', ['only' => ['waitingListMember','store']]);
    //     // $this->middleware('permission:keanggotaan_proses_daftar-create', ['only' => ['create','store']]);
    //     // $this->middleware('permission:keanggotaan_proses_daftar-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:keanggotaan_proses_daftar-ending', ['only' => ['waitingListMembers']]);
    // }
    public function waitingListMember(Request $request)
    {

        $user = $request->user();

        $waitinglist_member = RegisterMembers::paginate(20);
        if ($waitinglist_member) {
            return ResponseFormatter::success(
                $waitinglist_member,
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

    public function getDataMemberUser(Request $request)
    {

        $user = $request->user();

        $member = Member::with(['unit', 'size', 'status', 'dpd', 'dpc', 'bank'])->where('id', $user->user_id)->get();
        if ($member) {
            return ResponseFormatter::success(
                $member,
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

    public function getDataMemberDetail(Request $request)
    {

        $user = $request->user();
        $id = $request->input('id');

        $member = Member::with(['unit', 'size', 'status', 'dpd', 'dpc', 'bank'])->find($id);
        if ($member) {
            return ResponseFormatter::success(
                $member,
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

    public function getSearchDataMember(Request $request)
    {

        $user = $request->user();
        $nama = $request->input('nama');
        $no_anggota = $request->input('no_anggota');
        $nipeg = $request->input('nipeg');
        $email = $request->input('email');
        $unit_id = $request->input('unit_id');
        $dpd_id = $request->input('dpd_id');
        $dpc_id = $request->input('dpc_id');

        // kata kunci no anggota nama lengkap  nipeg email unit dpd dpc

        $member = Member::with(['unit', 'size', 'status', 'dpd', 'dpc', 'bank'])
            ->when($nama, function ($query, $nama) {
                return $query->where('nama_lengkap', 'like', "%$nama%");
            })
            ->when($email, function ($query, $email) {
                return $query->where('email', $email);
            })
            ->when($no_anggota, function ($query, $no_anggota) {
                return $query->where('no_anggota', $no_anggota);
            })
            ->when($nipeg, function ($query, $nipeg) {
                return $query->where('nipeg', $nipeg);
            })
            ->when($unit_id, function ($query, $unit_id) {
                return $query->where('unit_id', $unit_id);
            })
            ->when($dpd_id, function ($query, $dpd_id) {
                return $query->where('dpd_id', $dpd_id);
            })
            ->when($dpc_id, function ($query, $dpc_id) {
                return $query->where('dpd_id', $dpc_id);
            })
            ->get();
        if ($member) {
            return ResponseFormatter::success(
                $member,
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

    public function prosesRegistrasiAnggota(Request $request)
    {
        $user = $request->user();
        try {
            $request->validate([
                'id' => 'required',
                'no_pendaftaran' => 'required',
                'nama_lengkap' => 'required',
                'nipeg' => 'required',
                'email' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
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
            // start conditional
            $checkMember = Member::where('nipeg', $request->nipeg)->first();
            if ($checkMember == !null) {
                return ResponseFormatter::error([
                    'message' => 'Anggota Laskar sudah terdaftar sebelumnya',
                    'error' => 'Data Available',
                ], 'Proses Register Failed', 500);
            }
            // start generate no Pendataran
            $unit = Unit::find($request->unit_id);
            if ($unit == !null) {
                $firstCode = Induk::where('id', $unit->induk_id)->first();
            } else {
                return ResponseFormatter::error([
                    'message' => 'Gagal generate no anggota check kode unit',
                    'error' => 'error',
                ], 'Proses Register Failed', 500);
            }
            $currentYear = Carbon::now()->format('y');
            $firstNip = Str::substr($request->nipeg, 0, 4);
            //running number
            $getCounter = CounterMember::max('counter');
            if ($getCounter != null) {
                $tmp = ((int)$getCounter) + 1;
                $counter = sprintf("%05s", $tmp);
            } else {
                $counter = '00001';
            }
            // end conditional
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
            $data['approval'] = $user->name;
            $item = RegisterMembers::findOrFail($request->id);
            $item->update($data);

            // end generate no pendaftaran
            $data_anggota['no_anggota'] = $firstCode->code . $currentYear . $firstNip . $counter;
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
            return ResponseFormatter::success(
                $member,
                'Data transaksi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went Wrong',
                'error' => $error->getMessage(),
            ], 'Authenticated Failed', 500);
        }
    }
}
