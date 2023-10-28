<?php

namespace App\Http\Controllers\API\master;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function getDataBank(Request $request)
    {
       
        $user = $request->user();

        $typeBlood = Bank::orderBy('bank')->get();
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
