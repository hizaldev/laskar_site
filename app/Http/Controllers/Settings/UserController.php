<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Dpc;
use App\Models\Dpd;
use App\Models\Member;
use App\Models\Religion;
use App\Models\Size;
use App\Models\TypeBlood;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    var $route = 'users';
    var $path_view = 'settings.user';

    function __construct()
    {
        $this->middleware('permission:settings-user-list-all|settings-user-list|settings-user-create|settings-user-edit|settings-user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:settings-user-create', ['only' => ['create','store']]);
        $this->middleware('permission:settings-user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:settings-user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()){
            $data = User::with(['induk', 'unit','dpd','dpc'])->get();
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
                        <form action="'. route("$this->route.destroy", $item->id).'" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apakah anda yakin menghapus data? Data yang sudah dihapus tidak dapat dikembalikan dan akan berpengaruh ke transaksi untuk user ini`)) run; return false">
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
        return view("$this->path_view.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        ConstantController::logger('-', $this->route.'.create', 'open form create');
        $member = Member::doesntHave('user')->get();
        $role = Role::whereNotIn('name',['SuperAdmin'])->get();
        // dd($role);
        return view("$this->path_view.create", [
            'member' => $member,
            'role' => $role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|unique:users,user_id',
            'password' => 'required|confirmed|min:8',
            'role_id' => 'required'
        ]);

        try{
            $member = Member::find($request->user_id);
            $induk = Unit::find($member->unit_id);
            $data['user_id'] = $member->id;
            $data['name'] = $member->nama_lengkap;
            $data['email'] = $member->email;
            $data['password'] = bcrypt($request->password);
            $data['nipeg'] = $member->nipeg;
            $data['induk_id'] = $induk->induk_id;
            $data['unit_id'] = $member->unit_id;
            $data['dpd_id'] = $member->dpd_id;
            $data['dpc_id'] = $member->dpc_id;
            $data['alamat'] = $member->alamat;
            $create = User::create($data);
            $create->assignRole([$request->role_id]);
            ConstantController::logger($create->getOriginal(), $this->route.'.store', 'insert success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($create->getMessage(), $this->route.'.store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $items = Member::findOrFail($id);
        $dpd = Dpd::orderBy('dpd', 'asc')->get();
        $dpc = Dpc::orderBy('dpc', 'asc')->get();
        $agama = Religion::orderBy('agama','asc')->get();
        $size = Size::orderBy('ukuran','asc')->get();
        $type_blood = TypeBlood::orderBy('golongan_darah')->get();
        $bank = Bank::orderBy('bank','asc')->get();
        $unit = Unit::orderBy('unit','asc')->get();
        ConstantController::logger('-', $this->route.'.profile', 'detail id '.$id);
        return view("$this->path_view.show", [
            'item'=>$items,
            'unit'=>$unit,
            'agama'=>$agama,
            'dpd'=>$dpd,
            'dpc'=>$dpc,
            'size'=>$size,
            'type_blood'=>$type_blood,
            'bank'=>$bank,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        ConstantController::logger('-', $this->route.'.edit', 'open form edit');
        $item = User::find($id);
        $role = Role::whereNotIn('name',['SuperAdmin'])->get();
        // dd($role);
        return view("$this->path_view.edit", [
            'item' => $item,
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->type == 'personal'){
            $this->validate($request, [
                'nama_lengkap' => 'required',
                'nipeg' => 'required',
                'email' => 'required',
                'tempat_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'no_telpon' => 'required',
                'alamat' => 'required',
                'grade' => 'required',
                'agama' => 'required',
                'golongan_darah' => 'required',
                'bank_id' => 'required',
                'no_rekening' => 'required',
            ]);
        }else{
            $this->validate($request, [
                'dpd_id' => 'required',
                'dpc_id' => 'required',
                'size_id' => 'required',
            ]);
        }
        

        try{
            if($request->type == 'personal'){
                $data['unit_id'] = $request->unit_id;
                $data['golongan_darah'] = $request->golongan_darah;
                $data['jenis_kelamin'] = $request->jenis_kelamin;
                $data['nama_lengkap'] = $request->nama_lengkap;
                $data['alamat'] = $request->alamat;
                $data['agama'] = $request->agama;
                $data['tempat_lahir'] = $request->tempat_lahir;
                $data['no_telpon'] = $request->no_telpon;
                $data['email'] = $request->email;
                $data['nipeg'] = $request->nipeg;
                $data['grade'] = $request->grade;
                $data['tgl_lahir'] = $request->tgl_lahir;
                $data['bank_id'] = $request->bank_id;
                $data['no_rekening'] = $request->no_rekening;
            }else{
                $data['dpd_id'] = $request->dpd_id;
                $data['dpc_id'] = $request->dpc_id;
                $data['size_id'] = $request->size_id;
            }
            
            $item = Member::findOrFail($id);
            $item->update($data);

            ConstantController::logger($item->getOriginal(), $this->route.'.update', 'update success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($item->getMessage(), $this->route.'.update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function UpdateProfile(Request $request, string $id)
    {
        if($request->type == 'personal'){
            $this->validate($request, [
                'nama_lengkap' => 'required',
                'nipeg' => 'required',
                'email' => 'required',
                'tempat_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'no_telpon' => 'required',
                'alamat' => 'required',
                'grade' => 'required',
                'agama' => 'required',
                'golongan_darah' => 'required',
                'bank_id' => 'required',
                'no_rekening' => 'required',
            ]);
        }else{
            $this->validate($request, [
                'dpd_id' => 'required',
                'dpc_id' => 'required',
                'size_id' => 'required',
            ]);
        }
        

        try{
            if($request->type == 'personal'){
                $data['unit_id'] = $request->unit_id;
                $data['golongan_darah'] = $request->golongan_darah;
                $data['jenis_kelamin'] = $request->jenis_kelamin;
                $data['nama_lengkap'] = $request->nama_lengkap;
                $data['alamat'] = $request->alamat;
                $data['agama'] = $request->agama;
                $data['tempat_lahir'] = $request->tempat_lahir;
                $data['no_telpon'] = $request->no_telpon;
                $data['email'] = $request->email;
                $data['nipeg'] = $request->nipeg;
                $data['grade'] = $request->grade;
                $data['tgl_lahir'] = $request->tgl_lahir;
                $data['bank_id'] = $request->bank_id;
                $data['no_rekening'] = $request->no_rekening;
            }else{
                $data['dpd_id'] = $request->dpd_id;
                $data['dpc_id'] = $request->dpc_id;
                $data['size_id'] = $request->size_id;
            }
            
            $item = Member::findOrFail($id);
            $item->update($data);

            ConstantController::logger($item->getOriginal(), $this->route.'.update', 'update success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($item->getMessage(), $this->route.'.update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.show', $id);
    }

}
