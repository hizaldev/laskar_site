<?php

namespace App\Http\Controllers\Keanggotaan;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CounterRegister;
use App\Models\RegisterMembers;
use App\Models\Size;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as requestip;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegistrasiController extends Controller
{
    var $route = 'register_members';
    var $path_view = 'keanggotaan.register';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit = Unit::orderBy('unit', 'asc')->get();
        $size = Size::orderBy('ukuran', 'asc')->get();
        $city = City::orderBy('kota', 'asc')->get();
        return view("$this->path_view.register", [
            'unit' => $unit,
            'size' => $size,
            'city' => $city,
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
        $this->validate($request, [
            'email' => 'required|unique:register_members,email',
            'nama_lengkap' => 'required',
            'nipeg' => 'required|unique:members,nipeg',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_telpon' => 'required',
            'unit_id' => 'required',
            'size_id' => 'required',
            'grade' => 'required',
            'signed' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $year = Carbon::now()->isoFormat('Y');
        $bulan = Carbon::now()->isoFormat('MM');
        $getCounter = CounterRegister::where('bulan', $bulan)->where('thn', $year)->max('counter');
        if($getCounter != null){
            $tmp = ((int)$getCounter)+1;
            $counter = sprintf("%04s", $tmp); 
        }else{
            $counter = '0001';
        }
        $no_register = $counter.'/'.$bulan.'/LASKAR/'.$year;
       

        try{
            $image_64 = $request->signed; //your base64 encoded data
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
            $image = str_replace($replace, '', $image_64); 
            $image = str_replace(' ', '+', $image); 
            $imageName = Str::random(10).'.'.$extension;
            Storage::disk('public')->put('assets/digsign/'.$imageName, base64_decode($image));

            $data['email'] = $request->email;
            $data['no_pendaftaran'] = $no_register;
            $data['nama_lengkap'] = $request->nama_lengkap;
            $data['nipeg'] = $request->nipeg;
            $data['agama'] = 'Islam';
            $data['tempat_lahir'] = $request->tempat_lahir;
            $data['tgl_lahir'] = $request->tgl_lahir;
            $data['no_telpon'] = $request->no_telpon;
            $data['unit_id'] = $request->unit_id;
            $data['size_id'] = $request->size_id;
            $data['grade'] = $request->grade;
            $data['ip_address'] = requestip::ip();
            $data['sign'] = $imageName;
            RegisterMembers::create($data);
            $message = "Terima kasih $request->nama_lengkap telah telah bergabung dengan Laskar PLN dengan nomor pendaftaran sebagai berikut $no_register pendaftaran anda akan segera kami proses dan kami akan menghubungi anda kembali \n\n\n\nSalam hangat dari kami\n *Laskar PLN*";
            $reciver = $request->no_telpon;
            ConstantController::sendMessageWhatssap($message, $reciver);

            $messageAlert = "Terima kasih telah mendaftar di Laskar PLN\nBerikut Nomor Pendaftaran anda $no_register";
            ConstantController::successAlertWithMessage($messageAlert);
        } catch(Exception $e){
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.index');
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
