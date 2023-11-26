<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function getDataDokumenUser(Request $request)
    {

        $user = $request->user();
        $attendance = Document::with(['map_kategori', 'properties'])
            ->Where('user_id', $user->user_id)
            ->get();
        if ($attendance) {
            return ResponseFormatter::success(
                $attendance,
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

    public function getDataDokumenDetail(Request $request)
    {
        $id = $request->input('id');
        $attendance = Document::with(['map_kategori', 'properties'])
            ->where('id', $id)
            ->get();

        if ($attendance) {
            return ResponseFormatter::success(
                $attendance,
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

    public function getDataPencarianDokumen(Request $request)
    {

        $data = Document::with(['map_kategori', 'properties']);
        if (!$request->input('no_document') && !$request->input('perihal') && !$request->input('properties_document_id') && !$request->input('jenis_dokumen') && !$request->input('tipe_document')) {
            $data->where('document_properties_id', 'sduysgdbyu')->where('is_Public', 'Tidak');
        }
        if ($request->input('perihal')) {
            $keyword = $request->input('perihal');
            $data->where('perihal', 'LIKE', "%$keyword%");
        }
        if ($request->input('no_document')) {
            $no_document = $request->input('no_document');
            $data->where('no_document', 'LIKE', "%$no_document%");
        }
        if ($request->input('properties_document_id')) {
            $data->where('document_properties_id', $request->input('properties_document_id'));
        }
        if ($request->input('tipe_document')) {
            $data->where('tipe_document', $request->input('tipe_document'));
        }
        $data->get();

        if ($data) {
            return ResponseFormatter::success(
                $data,
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
