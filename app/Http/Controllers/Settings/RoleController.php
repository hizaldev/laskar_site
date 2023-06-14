<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    var $route = 'roles.index';
    var $path_view = 'settings.roles';

    function __construct()
    {
        $this->middleware('permission:settings_role-list|settings_role-create|role-edit|settings_role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:settings_role-create', ['only' => ['create','store']]);
        $this->middleware('permission:settings_role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:settings_role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        if(request()->ajax()){
            $data = Role::all();
            return DataTables::of($data)
                ->addColumn('edit', function($item){
                    return '
                    
                        <a class="btn btn-success btn-sm text-white" href="'.route('roles.edit', $item->id).'">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    ';
                })
                ->addColumn('delete', function($item){
                    return '
                        <form action="'. route('roles.destroy', $item->id).'" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apakah anda yakin menghapus data? Data yang sudah dihapus tidak dapat dikembalikan`)) run; return false">
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
        $permission = Permission::orderBy('name', 'ASC')->get();
        return view("$this->path_view.create",[
            'permissions'=>$permission
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        ConstantController::successAlert();
        return redirect()->route($this->route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
    
        return view("$this->path_view.show",[
            'role'=>$role,
            'permissions'=>$permission,
            'rolePermissions'=>$rolePermissions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::orderBy('name', 'ASC')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        // dd($role);
        return view("$this->path_view.edit",[
            'role'=>$role,
            'permissions'=>$permission,
            'rolePermissions'=>$rolePermissions,
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
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        // dd($request->input('permission'));
        $role->syncPermissions($request->input('permission'));
        
        ConstantController::successUpdateAlert();
        return redirect()->route($this->route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        ConstantController::successDeleteAlert();
        return redirect()->route($this->route);
    }

    public function groupPermission()
    {
         
    }
}
