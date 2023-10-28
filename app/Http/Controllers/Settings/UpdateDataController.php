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
use Illuminate\Support\Facades\Auth;

class UpdateDataController extends Controller
{
    public function index(){
        
        $cek = User::where('user_id', Auth::user()->user_id)->where('keterangan', '!=',  null)->first();
        if($cek){
            ConstantController::successAlertWithMessage('Anda sudah melakukan update data keanggotaan sebelumnya terima kasih');
            return redirect()->route('home');
        }
        $item = Member::find(Auth::user()->user_id);
        $dpd = Dpd::orderBy('dpd', 'asc')->get();
        $dpc = Dpc::orderBy('dpc', 'asc')->get();
        $agama = Religion::orderBy('agama','asc')->get();
        $size = Size::orderBy('ukuran','asc')->get();
        $type_blood = TypeBlood::orderBy('golongan_darah')->get();
        $bank = Bank::orderBy('bank','asc')->get();
        $unit = Unit::orderBy('unit','asc')->get();
        // dd($role);
        return view("settings.user.update_data", [
            'item' => $item,
            'unit'=>$unit,
            'agama'=>$agama,
            'dpd'=>$dpd,
            'dpc'=>$dpc,
            'size'=>$size,
            'type_blood'=>$type_blood,
            'bank'=>$bank,
        ]);
    }

    public function update_anggota(Request $request, string $id)
    {

        $this->validate($request, [
            'nama_lengkap' => 'required',
            'nipeg' => 'required',
            'email' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_telpon' => 'required',
            'alamat' => 'required',
            'grade' => 'required',
            'agama' => 'required',
            'golongan_darah' => 'required',
            'bank_id' => 'required',
            'no_rekening' => 'required',
            'tempat_lahir' => 'required',
            'unit_id' => 'required',
            'dpc_id' => 'required',
            'size_id' => 'required',
            'warna' => 'required',
            'to_marketplace' => 'required',
        ]);

        try{
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
                $data['dpd_id'] = $request->dpd_id;
                $data['dpc_id'] = $request->dpc_id;
                $data['size_id'] = $request->size_id;
            
            $item = Member::findOrFail($id);
            $item->update($data);


            $induk = Unit::findOrFail($request->unit_id);
            $data_user['induk_id'] = $induk->induk_id;
            $data_user['email'] = $request->email;
            $data_user['name'] = $request->nama_lengkap;
            $data_user['nipeg'] = $request->nipeg;
            $data_user['unit_id'] = $request->unit_id;
            $data_user['dpd_id'] = $request->dpd_id;
            $data_user['dpd_id'] = $request->dpd_id;
            $data_user['alamat'] = $request->alamat;
            $data_user['keterangan'] = $request->warna.", dan $request->to_marketplace ingin menambah warna lain dimarketplace ";

            $user = User::where('user_id', $id)->firstOrFail();
            $user->update($data_user);


            ConstantController::successAlert();
            if($request->to_marketplace == 'ya'){
                session()->flash('url', 'https://www.google.com');
                return redirect()->route('home');
            }else{
                return redirect()->route('home');
            }
        } catch(Exception $e){
            ConstantController::errorAlert($e->getMessage());
            return redirect()->route('home');
        }

       

    }

}
