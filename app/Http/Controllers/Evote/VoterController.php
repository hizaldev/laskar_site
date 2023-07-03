<?php

namespace App\Http\Controllers\Evote;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    var $route = 'evotes';
    var $path_view = 'evote.election';

    function __construct()
    {
        // $this->middleware('permission:pemilu_evote-list|permission-create|pemilu_evote-edit|pemilu_evote-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:pemilu_evote-create', ['only' => ['create','store']]);
        // $this->middleware('permission:pemilu_evote-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:pemilu_evote-delete', ['only' => ['destroy']]);
        $this->middleware('permission:pemilu_evote-show', ['only' => ['show']]);
    }

    public function resendNotification(Request $request, $voter) {
        dd('ini muncul');
        // [LASKAR PLN Virtual Assistant]

        // *Pemberitahuan ulang*
        // Hai, ALF BRIATNA
        // Selamat anda terdaftar sebagai pemilih dari agenda pemilu LASKAR PLN melalui aplikasi E-Vote, dengan agenda sebagai berikut:
        // Nama agenda pemilu:
        // Waktu pelaksanaan pemilu : xxx.xxx.xxxx s/d xxx.xxxx.xx 
        // untuk menggunakan hak pilih anda silahkan buka atau copy alamat link di bawah ini.
        // url
        // dan jangan lupa saat sudah memilih masukan sekuriti code ini *123456* sebagai validasi anda adalah pemilih yang sah.
        // mari sukseskan agenda pemilu LASKAR PLN melalui aplikasi E-vote.
        // *LASKAR PLN*
        // *Modern*
        // *Mandiri*
        // *Berintegritas*



        // Salam hangat
        // Laskar PLN
    }
}
