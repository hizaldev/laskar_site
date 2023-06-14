<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    var $route = 'permisions';
    var $path_view = 'settings.permission';

    function __construct()
    {
        $this->middleware('permission:settings_permissions-list|permission-create|settings_permissions-edit|settings_permissions-delete', ['only' => ['index','store']]);
        $this->middleware('permission:settings_permissions-create', ['only' => ['create','store']]);
        $this->middleware('permission:settings_permissions-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:settings_permissions-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Permission::get();
            return DataTables::of($data)
            ->addColumn('edit', function($item){
                return '
                
                    <a class="btn btn-success btn-sm text-white" href="'.route('permisions.edit', $item->id).'">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                ';
            })
            ->addColumn('delete', function($item){
                return '
                    <form action="'. route('permisions.destroy', $item->id).'" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Are you sure delete this data?`)) run; return false">
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
        return view("$this->path_view.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'name' => 'required|unique:permissions,name',
        ]);

        try{
            Permission::create(['name' => $request->input('name')]);
            ConstantController::successAlert();
        } catch(Exception $e){
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
        $items = Permission::findOrFail($id);

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
        $data = $request->all();

        try{
            $data['name']   = $request->name;
            $item = Permission::findOrFail($id);
            $item->update($data);

            ConstantController::successAlert();
        } catch(Exception $e){
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
        $item = Permission::findOrFail($id);
        $item->delete();

        ConstantController::successDeleteAlert();
         return redirect()->route($this->route.'.index');
    }
}
