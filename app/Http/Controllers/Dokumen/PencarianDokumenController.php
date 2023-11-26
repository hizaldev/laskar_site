<?php

namespace App\Http\Controllers\Dokumen;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentProperty;
use App\Models\JenisDocument;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PencarianDokumenController extends Controller
{
    var $route = 'search_documents';
    var $path_view = 'aplikasi.dokumen';

    function __construct()
    {
        $this->middleware('permission:aplikasi_pencarian_dokumen-list|aplikasi_pencarian_dokumen-list-user|aplikasi_pencarian_dokumen-list-user|permission-create|aplikasi_pencarian_dokumen-edit|aplikasi_pencarian_dokumen-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:aplikasi_pencarian_dokumen-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:aplikasi_pencarian_dokumen-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:aplikasi_pencarian_dokumen-delete', ['only' => ['destroy']]);
        $this->middleware('permission:aplikasi_pencarian_dokumen-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $properties = DocumentProperty::get();
        $jenis = JenisDocument::get();
        $data = Document::with(['map_kategori', 'properties']);
        if (!$request->get('no_document') && !$request->get('perihal') && !$request->get('properties_document_id') && !$request->get('jenis_dokumen') && !$request->get('tipe_document')) {
            $data->where('document_properties_id', 'sduysgdbyu')->where('is_Public', 'Tidak');
        }
        if ($request->get('perihal')) {
            $keyword = $request->get('perihal');
            $data->where('perihal', 'LIKE', "%$keyword%");
        }
        if ($request->get('no_document')) {
            $no_document = $request->get('no_document');
            $data->where('no_document', 'LIKE', "%$no_document%");
        }
        if ($request->get('properties_document_id')) {
            $data->where('document_properties_id', $request->get('properties_document_id'));
        }
        if ($request->get('tipe_document')) {
            $data->where('tipe_document', $request->get('tipe_document'));
        }

        if ($request->get('jenis_dokumen')) {
            $data->where('jenis_dokumen', $request->get('jenis_dokumen'));
        }

        if (request()->ajax()) {

            return DataTables::of($data->get())
                ->addColumn('header', function ($item) {
                    return "
                    $item->no_document <br> $item->perihal
                ";
                })
                ->addColumn('kategori', function ($item) {
                    $options = "";
                    foreach ($item->map_kategori as $map) {
                        $options .= "<span class='badge text-bg-secondary'>" . $map->kategori->jenis_dokumen . "</span> ";
                    }
                    return $options;
                })
                ->addColumn('show', function ($item) {
                    return '
        
                    <a class="btn btn-primary btn-sm text-white" href="' . route("documents.show", $item->slug) . '">
                        <i class="fa-solid fa-search"></i>
                    </a>
                ';
                })
                ->addIndexColumn()
                ->rawColumns(['show', 'header', 'kategori'])
                ->make();
        }
        ConstantController::logger('-', $this->route . '.index', 'list');
        return view("$this->path_view.index_search", [
            'properties' => $properties,
            'jenis' => $jenis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
