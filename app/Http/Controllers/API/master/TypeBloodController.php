<?php

namespace App\Http\Controllers\API\master;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\TypeBlood;
use Illuminate\Http\Request;

class TypeBloodController extends Controller
{
    public function getDataTypeBlood(Request $request)
    {
       
        $user = $request->user();

        $typeBlood = TypeBlood::orderBy('golongan_darah')->get();
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
