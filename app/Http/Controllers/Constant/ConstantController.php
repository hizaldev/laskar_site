<?php

namespace App\Http\Controllers\Constant;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use App\Models\WhatsappGroup;
use Carbon\Carbon;
use Exception;
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
         $url = env('WHATSAPP_GATEWAY_URL')."/messages";
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
            'simulate_typing' => 1
         );
         $client = new Client();
         // dd(json_encode($data)   );
         try{
            $response = $client->post($url, [
                  'headers' => [
                     'Content-Type' => 'application/json', 
                     'Accept' => 'application/json', 
                     'Authorization' => 'Bearer '.$key
                  ],
                  'body'    => json_encode($data)
            ]); 
            $hasil = (array)json_decode((string)$response->getBody(), true);
            if($hasil['status'] == 200){
               // dd($hasil);
               // dd($hasil['data']['status']);
               $status = $hasil['data']['status'];
               $message = $hasil['data']['body'];
               ConstantController::loggerNonAuth("$message", 'Module', "whatsapp notification $status", $receiver);
            }else{
               ConstantController::loggerNonAuth("whatsapp gagal terkirim", 'Module', "whatsapp notification gagal", $receiver);
            }
         }catch(Exception $e){
            $skuList = preg_split('/\r\n|\r|\n/', $e->getMessage());
            ConstantController::loggerNonAuth("whatsapp gagal terkirim with message : $skuList[1]", 'Module', "whatsapp notification gagal", $receiver);
            ConstantController::errorAlert("Whatsap gagal mengirim dengan error: $skuList[1]");
         } 
   }

   public static function sendMessageWhatssapGroup($message, $group_id, $type = 'chat', $image_url = null){
      $url = env('WHATSAPP_GATEWAY_URL')."/groups/$group_id/send";
      $key = env('WHATSAPP_GATEWAY_API_KEY');

      $client = new Client();
      if($type == 'chat'){
         $data = array(
            'type' => 'chat',
            'message' => "$message",
            'simulate_typing' => 1
         );
      }else{
         $data = array(
            'type' => 'chat',
            'params' => [
               'image' => [
               'url' => 'https://images.unsplash.com/photo-1653764982079-c7c5e4fd682a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
               ],
               "caption" => "$message",
            ],
            'simulate_typing' => 1
         );
      }

      $client = new Client();
      // dd(json_encode($data));
      try{
         $response = $client->post($url, [
            'headers' => [
                  'Content-Type' => 'application/json', 
                  'Accept' => 'application/json', 
                  'Authorization' => 'Bearer '.$key
            ],
            'body'    => json_encode($data)
         ]); 
         $hasil = (array)json_decode((string)$response->getBody(), true);
         if($hasil['status'] == 200){
            // dd($hasil);
            // dd($hasil['data']['status']);
            $status = $hasil['data']['status'];
            $message = $hasil['data']['body'];
            ConstantController::loggerNonAuth("$message", 'Module', "whatsapp notification $status", $group_id);
         }else{
            ConstantController::loggerNonAuth("whatsapp gagal terkirim", 'Module', "whatsapp notification gagal", $group_id);
         }
      }catch(Exception $e){
         $skuList = preg_split('/\r\n|\r|\n/', $e->getMessage());
         ConstantController::loggerNonAuth("whatsapp gagal terkirim with message : $skuList[1]", 'Module', "whatsapp notification gagal", $group_id);
         ConstantController::errorAlert("Whatsap gagal mengirim dengan error: $skuList[1]");
      } 
   }


   public static function getGroupList(){
      
      $key = env('WHATSAPP_GATEWAY_API_KEY');
      $device = env('WHATSAPP_GATEWAY_DEVICE');
      $url = env('WHATSAPP_GATEWAY_URL')."/groups?device=$device";

      $client = new Client();
      // dd(json_encode($data)   );
      try{
         $response = $client->get($url, [
               'headers' => [
                  'Content-Type' => 'application/json', 
                  'Accept' => 'application/json', 
                  'Authorization' => 'Bearer '.$key
               ],
         ]); 
         $hasil = (array)json_decode((string)$response->getBody(), true);
        
         if($hasil['status'] == 200){
            WhatsappGroup::truncate();
            $data = $hasil['data'];
            for($i = 0; $i < count($data); $i++){
               $data['id'] = $data[$i]['id'];
               $data['group_name'] = $data[$i]['title'];
               $data['muted'] = $data[$i]['muted'] == true ? 'Yes' : 'No';
               $data['spam'] = $data[$i]['spam'] == true ? 'Yes' : 'No';
               WhatsappGroup::create($data);
            }
         }else{
         }
      }catch(Exception $e){
         ConstantController::errorAlert($e->getMessage());
      } 
}
}
