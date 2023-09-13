<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\LevelPosition;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelJabatanController extends Controller
{
    var $route = 'level_positions';
    var $path_view = 'master.jenjang_jabatan';

    function __construct()
    {
        $this->middleware('permission:master_jenjang_jabatan-list|permission-create|master_jenjang_jabatan-edit|master_jenjang_jabatan-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master_jenjang_jabatan-create', ['only' => ['create','store']]);
        $this->middleware('permission:master_jenjang_jabatan-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master_jenjang_jabatan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = LevelPosition::all();
            return DataTables::of($data)
            ->addColumn('edit', function($item){
                return '
                
                    <a class="btn btn-success btn-sm text-white" href="'.route("$this->route.edit", $item->id).'">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                ';
            })
            ->addColumn('delete', function($item){
                return '
                    <form action="'. route("$this->route.destroy", $item->id).'" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apa anda yakin menghapus data ini? data ini mungkin akan berpengaruh pada data transaksi aplikasi`)) run; return false">
                        '. method_field('delete') . csrf_field().'
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
        ConstantController::logger('-', $this->route.'.index', 'list');

        return view("$this->path_view.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ConstantController::logger('-', $this->route.'.create', 'open form create');
        
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
            'jabatan' => 'required|unique:level_positions,jabatan',
        ]);

        try{
            $data['jabatan']   = $request->jabatan;
            $data['keterangan'] = $request->keterangan;
            $create = LevelPosition::create($data);
            ConstantController::logger($create->getOriginal(), $this->route.'.store', 'insert success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($e->getMessage(), $this->route.'.store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.index');
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
        $items = LevelPosition::findOrFail($id);
        ConstantController::logger('-', $this->route.'.edit', 'open form edit');

        return view("$this->path_view.edit", [
            'item'=>$items
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
            'jabatan' => 'required',
        ]);

        try{
            $data['jabatan']   = $request->jabatan;
            $data['keterangan'] = $request->keterangan;
            $item = LevelPosition::findOrFail($id);
            $item->update($data);

            ConstantController::logger($item->getOriginal(), $this->route.'.update', 'update success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($item->getMessage(), $this->route.'.update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LevelPosition::findOrFail($id);
        $item->delete();
        ConstantController::logger($item->getOriginal(), $this->route.'.delete', 'delete success');

        ConstantController::successDeleteAlert();
         return redirect()->route($this->route.'.index');
    }
}
