<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getDataNewsEvent(Request $request)
    {
        $keyword = 'Event';
        $news = News::with(['documentation'])
            ->orderBy('created_at', 'desc')
            ->where('kategori_berita_id', 'like', '%Event%')
            ->limit(5)
            ->get();
        // dd($news);
        if ($news) {
            return ResponseFormatter::success(
                $news,
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

    public function getDataNewsDetail(Request $request)
    {
        $id = $request->input('id');
        $news = News::with(['documentation'])
            ->where('id', $id)
            ->get();

        if ($news) {
            return ResponseFormatter::success(
                $news,
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
