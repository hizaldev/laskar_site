<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\WhatsappGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WhatsappGroupController extends Controller
{
    var $route = 'whatsapp_groups';
    var $path_view = 'settings.whatsapp_group';

    function __construct()
    {
        $this->middleware('permission:settings_whatsapp_group-list|permission-create|settings_whatsapp_group-edit|settings_whatsapp_group-delete', ['only' => ['index','store']]);
        $this->middleware('permission:settings_whatsapp_group-create', ['only' => ['create','store']]);
        $this->middleware('permission:settings_whatsapp_group-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:settings_whatsapp_group-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = WhatsappGroup::all();
            return DataTables::of($data)
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
        ConstantController::getGroupList();
        ConstantController::logger('-', $this->route.'.create', 'open form create');
        return redirect()->route($this->route.'.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        // 
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
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //    
    }
}

