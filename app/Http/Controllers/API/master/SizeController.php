<?php

namespace App\Http\Controllers\API\master;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function getDataSize(Request $request)
    {
       
        $user = $request->user();

        $size = Size::get();
        if($size){
            return ResponseFormatter::success(
                $size,
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
