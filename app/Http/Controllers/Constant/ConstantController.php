<?php

namespace App\Http\Controllers\Constant;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ConstantController extends Controller
{
    public static function successAlert()
    {
       return  Alert::success('Sukses', 'Data berhasil disimpan !!');
    }

    public static function successAlertWithMessage($message)
    {
       return  Alert::success('Sukses', $message);
    }

    public static function successUpdateAlert()
    {
       return  Alert::success('Sukses', 'Data berhasil diperbarui !!');
    }

    public static function successUpdateAlertWithMessage($message)
    {
       return  Alert::success('Sukses', $message);
    }

    public static function successDeleteAlert()
    {
       return  Alert::success('Sukses', 'Data berhasil dihapus !!');
    }

    public static function errorAlert($e)
    {
       return  Alert::error('Error', $e);
    }

    public static function failedSaveAlert()
    {
        return  Alert::error('Gagal', 'Data Gagal disimpan !!');
    }

    public static function failedUpdateAlert()
    {
        return  Alert::error('Gagal', 'Data Gagal diperbarui !!');
    }

    public static function logger($dataLog, $module, $action)
    {
         if(is_array($dataLog)){
            $str_json = implode(', ',$dataLog);   
            $data['data_log'] = $str_json;
         }else{
            $data['data_log'] = $dataLog;

         }   
         $data['module'] = $module;
         $data['user_id'] = Auth::user()->user_id;
         $data['user_by'] = Auth::user()->name;
         $data['name'] = Auth::user()->name;
         $data['action'] = $action; 
         $data['ip_address'] =Request::ip();
         $data['created_at'] = Carbon::now();
         // dd($data);
         $logger = Logger::create($data);
    }

    public static function loggerNonAuth($dataLog, $module, $action, $receiver)
    {
         if(is_array($dataLog)){
            $str_json = implode(', ',$dataLog);   
            $data['data_log'] = $str_json;
         }else{
            $data['data_log'] = $dataLog;

         }   
         $data['module'] = $module;
         $data['user_id'] = $receiver;
         $data['user_by'] = $receiver;
         $data['name'] = $receiver;
         $data['action'] = $action; 
         $data['ip_address'] =Request::ip();
         $data['created_at'] = Carbon::now();
         // dd($data);
         $logger = Logger::create($data);
    }

    public static function sendMessageWhatssap($message, $receiver){
         $url = env('WHATSAPP_GATEWAY_URL');
         $key = env('WHATSAPP_GATEWAY_API_KEY');
         $device = env('WHATSAPP_GATEWAY_DEVICE');

         $client = new Client();
         $noCheck = Str::substr($receiver, 0, 2);
         if($noCheck == '08'){
            $split = Str::substr($receiver, 2, 14);
            $number = '628'.$split;
         }
         if($noCheck == '+6'){
            $split = Str::substr($receiver, 1, 14);
            $number = '62'.$split;
            // dd($number);
         }
         if($noCheck == '62'){
            $number = $receiver;
         }
        
         $data = array(
            'device' => "$device",
            'receiver' => "$number",
            'type' => 'chat',
            'message' => "$message",
         );
         $client = new Client();
         $response = $client->post($url, [
               'headers' => [
                  'Content-Type' => 'application/json', 
                  'Accept' => 'application/json', 
                  'Authorization' => 'Bearer '.$key
               ],
               'body'    => json_encode($data)
         ]); 

         $data = (array)json_decode((string)$response->getBody(), true);
         // dd($data);
         ConstantController::loggerNonAuth('whatsapp terkirim', 'Module', 'whatsapp notification', $receiver);
        
    }
}
