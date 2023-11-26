<?php

namespace App\Http\Controllers\Dokumen;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentProperty;
use App\Models\LogDocument;
use App\Models\MapDocument;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon as CarbonCarbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    var $route = 'documents';
    var $path_view = 'aplikasi.dokumen';

    function __construct()
    {
        $this->middleware('permission:aplikasi_dokumen-list|aplikasi_dokumen-list-user|aplikasi_dokumen-list-user|permission-create|aplikasi_dokumen-edit|aplikasi_dokumen-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:aplikasi_dokumen-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:aplikasi_dokumen-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:aplikasi_dokumen-delete', ['only' => ['destroy']]);
        $this->middleware('permission:aplikasi_dokumen-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $data = Document::with(['map_kategori', 'properties'])->get();
        if ($user->can('aplikasi_dokumen-list-user')) {
            $data->where('user_id', $user->user_id);
        }

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addColumn('kategori', function ($item) {
                    $options = "";
                    foreach ($item->map_kategori as $map) {
                        $options .= "<span class='badge text-bg-secondary'>" . $map->kategori->jenis_dokumen . "</span> ";
                    }
                    return $options;
                })
                ->addColumn('header', function ($item) {
                    return "
                        $item->no_document <br> $item->perihal
                    ";
                })
                ->addColumn('show', function ($item) {
                    return '
            
                        <a class="btn btn-primary btn-sm text-white" href="' . route("$this->route.show", $item->slug) . '">
                            <i class="fa-solid fa-search"></i>
                        </a>
                    ';
                })
                ->addColumn('edit', function ($item) {
                    return '
                
                    <a class="btn btn-success btn-sm text-white" href="' . route("$this->route.edit", $item->id) . '">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                ';
                })
                ->addColumn('delete', function ($item) {
                    return '
                    <form action="' . route("$this->route.destroy", $item->id) . '" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apa anda yakin menghapus data ini? data ini mungkin akan berpengaruh pada data transaksi aplikasi`)) run; return false">
                        ' . method_field('delete') . csrf_field() . '
                        <button type="submit" class="btn btn-danger btn-sm text-white">
                        <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                ';
                })
                ->addIndexColumn()
                ->rawColumns(['show', 'edit', 'delete', 'header', 'kategori'])
                ->make();
        }
        //dd($data);
        ConstantController::logger('-', $this->route . '.index', 'list');
        return view("$this->path_view.index");
    }

    public function showHistory($id)
    {
        if (request()->ajax()) {
            $data = LogDocument::where('document_id', $id)->get();
            return DataTables::of($data)
                ->editColumn('created_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d M Y');
                    return $formatedDate;
                })
                ->addIndexColumn()
                ->make();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = DocumentProperty::get();
        ConstantController::logger('-', $this->route . '.create', 'open form create');
        return view("$this->path_view.create", [
            'properties' => $properties,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'no_document' => 'required',
            'perihal' => 'required',
            'tgl_document' => 'required',
            'is_public' => 'required',
            'tipe_document' => 'required',
        ]);
        try {
            $slug = Str::slug($request->perihal, '-');
            $data['no_document'] = $request->no_document;
            $data['perihal'] = $request->perihal;
            $data['is_public'] = $request->is_public;
            $data['slug'] = $slug;
            $data['tipe_document'] = $request->tipe_document;
            $data['tgl_document'] = $request->tgl_document;
            $data['document_properties_id'] = $request->properties_document_id;
            $data['jenis_document_id'] = '-';
            $data['user_id'] = Auth::user()->user_id;
            $data['links'] = $request->links;
            $data['location'] = $request->location;
            $data['keterangan'] = $request->keterangan;

            $url_path = env('DO_URL');

            if ($request->file('document') != null) {
                $storeFile = $request->file('document')->storePublicly(
                    "arsip/" . Carbon::now()->isoFormat('Y') . '/' . Carbon::now()->isoFormat('MMMM') . '/' . $slug,
                    'spaces'
                );
                $data['document'] = $url_path . '/' . $storeFile;
            }
            $create = Document::create($data);

            if (count($request->jenis_document_id) > 0) {
                for ($i = 0; $i < count($request->jenis_document_id); $i++) {
                    $data_map['document_id'] = $create->id;
                    $data_map['jenis_document_id'] = $request->jenis_document_id[$i];
                    MapDocument::create($data_map);
                }
            }

            ConstantController::logger($create->getOriginal(), $this->route . 'store', 'insert success');
            ConstantController::successAlert();
        } catch (Exception $e) {
            ConstantController::logger($e->getMessage(), $this->route . 'store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route . '.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Document::with(['map_kategori', 'properties'])->where('slug', $id)->first();
        // dd($items);
        if ($items == null) {
            return abort(404);
        }
        ConstantController::logger('-', $this->route . '.show', 'open show Dokumen');
        ConstantController::logDocument($items->id, "Open data dokumen $items->perihal");
        return view("$this->path_view.show", [
            'item' => $items,
        ]);
    }

    public function logDokumen(Request $request)
    {
        //create post
        $post = ConstantController::logDocument($request->id, $request->action);
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post
        ]);
    }

    public function showDocument($id)
    {
        $items = Document::where('slug', $id)->first();
        // dd($items);
        if ($items == null) {
            return abort(404);
        }


        $name = Auth::user()->name;

        $filePath = $items->document;
        $outputFilePath = public_path("sample_output.pdf");
        $this->fillPDFFile($filePath, $outputFilePath, $name);

        return response()->file($outputFilePath);
    }

    public function fillPDFFile($file, $outputFilePath, $name)
    {
        $fpdi = new FPDi;
        $fileContent = file_get_contents($file);
        // $count = $fpdi->setSourceFile(StreamReader::createByString($fileContent));
        $count = $fpdi->setSourceFile(StreamReader::createByString($fileContent));

        for ($i = 1; $i <= $count; $i++) {

            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);

            $fpdi->SetFont("helvetica", "", 12);
            $fpdi->SetTextColor(204, 210, 219);
            // $fpdi->SetTextColor(0, 0, 255);
            // $fpdi->SetFillColor(204,);
            // $fpdi->WriteHtml(25, 135);
            $now = CarbonCarbon::now();

            $left = 10;
            $top = 10;
            $viewer = ucwords(strval($name));
            $text = "Arsip Laskar PLN Print / View oleh $viewer $now";
            $fpdi->Text($left, $top, $text);

            $fpdi->Text(10, 290, $text);


            $fpdi->Image("https://laskarpln.sgp1.cdn.digitaloceanspaces.com/assets/SALINAN_MD.png", 10, 40);
        }

        return $fpdi->Output($outputFilePath, 'F');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Document::findOrFail($id);
        $properties = DocumentProperty::get();
        $map = MapDocument::with(['kategori'])->where('document_id', $id)->get();
        // dd($map);
        ConstantController::logger('-', $this->route . '.edit', 'open form edit');
        return view("$this->path_view.edit", [
            'item' => $items,
            'properties' => $properties,
            'maps' => $map,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'no_document' => 'required',
            'perihal' => 'required',
            'tgl_document' => 'required',
            'is_public' => 'required',
            'tipe_document' => 'required',
        ]);

        try {
            $slug = Str::slug($request->perihal, '-');
            $data['no_document'] = $request->no_document;
            $data['perihal'] = $request->perihal;
            $data['is_public'] = $request->is_public;
            $data['slug'] = $slug;
            $data['tipe_document'] = $request->tipe_document;
            $data['tgl_document'] = $request->tgl_document;
            $data['document_properties_id'] = $request->properties_document_id;
            $data['jenis_document_id'] = '-';
            $data['user_id'] = Auth::user()->user_id;
            $data['links'] = $request->links;
            $data['location'] = $request->location;
            $data['keterangan'] = $request->keterangan;
            $item = Document::findOrFail($id);
            $url_path = env('DO_URL');

            if ($request->file('document') != null) {
                $storeFile = $request->file('document')->storePublicly(
                    "arsip/" . Carbon::now()->isoFormat('Y') . '/' . Carbon::now()->isoFormat('MMMM') . '/' . $slug,
                    'spaces'
                );
                $data['document'] = $url_path . '/' . $storeFile;
            }
            $item->update($data);
            MapDocument::where('document_id', $id)->delete();
            if (count($request->jenis_document_id) > 0) {
                for ($i = 0; $i < count($request->jenis_document_id); $i++) {
                    $itemMap = MapDocument::where('document_id', $id)->where('jenis_document_id',  $request->jenis_document_id[$i])->first();
                    if ($itemMap == null) {
                        $data_map['document_id'] = $id;
                        $data_map['jenis_document_id'] = $request->jenis_document_id[$i];
                        MapDocument::create($data_map);
                    }
                }
            }

            ConstantController::logger($item->getOriginal(), $this->route . '.update', 'update success');
            ConstantController::successAlert();
        } catch (Exception $e) {
            ConstantController::logger($item->getMessage(), $this->route . '.update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route . '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Document::findOrFail($id);
        $item->delete();
        MapDocument::where('document_id', $id)->delete();
        ConstantController::logger($item->getOriginal(), $this->route . '.delete', 'delete success');
        ConstantController::successDeleteAlert();
        return redirect()->route($this->route . '.index');
    }
}
