<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\JenisDocument;
use App\Models\LogDocument;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as req;
use Yajra\DataTables\Facades\DataTables;

class JenisDocumentController extends Controller
{
    var $route = 'jenis_documents';
    var $path_view = 'master.jenis_dokumen';

    function __construct()
    {
        $this->middleware('permission:master_jenis_document-list|permission-create|master_jenis_document-edit|master_jenis_document-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:master_jenis_document-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master_jenis_document-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master_jenis_document-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = JenisDocument::all();
            return DataTables::of($data)
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
                ->rawColumns(['edit', 'delete'])
                ->make();
        }
        //dd($data);
        ConstantController::logger('-', $this->route . '.index', 'list');

        return view("$this->path_view.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ConstantController::logger('-', $this->route . '.create', 'open form create');

        return view("$this->path_view.create");
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
            'jenis_dokumen' => 'required|unique:jenis_documents,jenis_dokumen',
        ]);

        try {
            $data['jenis_dokumen']   = $request->jenis_dokumen;
            $data['keterangan'] = $request->keterangan;
            $create = JenisDocument::create($data);
            ConstantController::logger($create->getOriginal(), $this->route . '.store', 'insert success');
            ConstantController::successAlert();
        } catch (Exception $e) {
            ConstantController::logger($e->getMessage(), $this->route . '.store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route . '.index');
    }

    public function storeLogPreview($id)
    {
        // define validation rule

        try {
            //code...
            $items = Document::find($id);
            $perihal = $items != null ? $items->perihal : "";
            $data['document_id'] = $id;
            $data['action'] = "Preview Dokumen $perihal";
            $data['user_id'] = Auth::user()->user_id;
            $data['user_by'] = Auth::user()->name;
            $data['nama'] = Auth::user()->name;
            $data['ip_address'] = req::ip();
            $data['created_at'] = Carbon::now();
            $logger = LogDocument::create($data);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $logger
        ]);
    }

    public function storeLogDownload($id)
    {
        // define validation rule

        try {
            $items = Document::find($id);
            $perihal = $items != null ? $items->perihal : "";
            //code...
            $data['document_id'] = $id;
            $data['action'] = "Download Dokumen $perihal";
            $data['user_id'] = Auth::user()->user_id;
            $data['user_by'] = Auth::user()->name;
            $data['nama'] = Auth::user()->name;
            $data['ip_address'] = req::ip();
            $data['created_at'] = Carbon::now();
            $logger = LogDocument::create($data);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $logger
        ]);
    }

    public function storeCategoryDokumen(Request $request)
    {

        //create post
        $post = JenisDocument::create([
            'jenis_dokumen'     => $request->jenis_dokumen,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post
        ]);
    }

    public function getCategories()
    {
        $categoryNews = JenisDocument::where('jenis_dokumen', 'LIKE', '%' . request()->get('q') . '%')->get();
        return response()->json($categoryNews);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = JenisDocument::findOrFail($id);
        ConstantController::logger('-', $this->route . '.edit', 'open form edit');

        return view("$this->path_view.edit", [
            'item' => $items
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
            'jenis_dokumen' => 'required',
        ]);

        try {
            $data['jenis_dokumen']   = $request->jenis_dokumen;
            $data['keterangan'] = $request->keterangan;
            $item = JenisDocument::findOrFail($id);
            $item->update($data);

            ConstantController::logger($item->getOriginal(), $this->route . '.update', 'update success');
            ConstantController::successAlert();
        } catch (Exception $e) {
            ConstantController::logger($e->getMessage(), $this->route . '.update', 'update error');
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
        $item = JenisDocument::findOrFail($id);
        $item->delete();
        ConstantController::logger($item->getOriginal(), $this->route . '.delete', 'delete success');

        ConstantController::successDeleteAlert();
        return redirect()->route($this->route . '.index');
    }
}
