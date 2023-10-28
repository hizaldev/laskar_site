<?php

namespace App\Http\Controllers\API\master;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Dpd;
use Illuminate\Http\Request;

class DpdController extends Controller
{
    public function getDataDpd(Request $request)
    {
       
        $user = $request->user();

        $typeBlood = Dpd::orderBy('dpd')->get();
        if($typeBlood){
            return ResponseFormatter::success(
                $typeBlood,
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
