<?php

namespace App\Http\Controllers\API\master;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    public function getDataReligion(Request $request)
    {
       
        $user = $request->user();

        $religion = Religion::get();
        if($religion){
            return ResponseFormatter::success(
                $religion,
                'Data transaksi berhasil diambil'
            );
        }else{
            return ResponseFormatter::error(
                null,
                'Data transaksi gagal diambil',
                404
            );
        }
    }
}
