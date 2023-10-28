<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class StatistikController extends Controller
{
    public function getDataStatistikAnggota(Request $request)
    {
        try {
            $member = Member::all();

            $sebaranAnggota = DB::select("
                select status_members.status, count(members.id) as total from members
                right join status_members on members.status_id = status_members.id
                where members.deleted_at is null and status_members.deleted_at is null
                group by status_members.id
            ");

            return ResponseFormatter::success(
                $sebaranAnggota,
                'Data transaksi berhasil diambil'
            );
        } catch (Exception) {
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }

    public function getDataStatistikGrade(Request $request)
    {
        try {
            $grade = DB::table('members')
                ->select('grade', DB::raw('count(*) as total'))
                ->whereNull('deleted_at')
                ->groupBy('grade')
                ->orderBy('grade', 'asc')
                ->get();
            return ResponseFormatter::success(
                $grade,
                'Data transaksi berhasil diambil'
            );
        } catch (Exception) {
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }

    public function getDataStatistikUmur(Request $request)
    {
        try {
            $sebaranUmur = DB::select("
                select 
                    count(if(umur < 21,1,null)) as 'dibawah 21', 
                    count(if(umur between 21 and 29,1,null)) as '21 sampai 29',
                    count(if(umur between 30 and 40,1,null)) as '30 sampai 40',
                    count(if(umur between 41 and 55,1,null)) as '41 sampai 55',
                    count(if(umur = 56,1,null)) as '56',
                    count(if(umur > 56,1,null)) as 'diatas 56'
                from(
                    select nama_lengkap , tgl_lahir, timestampdiff(year, tgl_lahir, curdate()) as umur 
                    from members
                    where status_id = '994f84dc-e703-4a2e-9df2-c49571f31498'
                ) as dummy_table
            ");
            return ResponseFormatter::success(
                $sebaranUmur,
                'Data transaksi berhasil diambil'
            );
        } catch (Exception) {
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }
}
