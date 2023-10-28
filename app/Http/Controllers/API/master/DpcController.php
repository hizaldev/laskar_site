<?php

namespace App\Http\Controllers\API\master;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Dpc;
use Illuminate\Http\Request;

class DpcController extends Controller
{
    public function getDataDpc(Request $request)
    {
       
        $user = $request->user();

        $typeBlood = Dpc::orderBy('dpc')->get();
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
