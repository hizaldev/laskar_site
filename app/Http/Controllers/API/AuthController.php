<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function verifyUser(Request $request){
        try {
            $request->validate([
                'email' => 'required',
            ]);
            // dd($request->email);
            $member = Member::where('email', $request->email)->first();
            $user = User::where('email', $request->email)->first();
            if($member != null && $user != null){
                $otp = random_int(100000, 999999);
                $data['password']   = bcrypt($otp);
                // dd($user);
                $user->update($data);
                $message = "[LASKAR PLN Virtual Assistant]\n\nHai, $member->nama_lengkap\nBerikut merupakan kode OTP anda *$otp*, tolong untuk tidak membagikan kode ini ke orang lain, bijaklah dalam menggunakan dan menjaga data pribadi anda.\n\n\n\nSalam hangat\n*Laskar PLN*";
                // ConstantController::sendMessageWhatssap($message, $reciver);
                // start
                    $url = env('WHATSAPP_GATEWAY_URL')."/messages";
                    $key = env('WHATSAPP_GATEWAY_API_KEY');
                    $device = env('WHATSAPP_GATEWAY_DEVICE');
                    // dd($url);
                    $client = new Client();
                    $noCheck = Str::substr($member->no_telpon, 0, 2);
                    if($noCheck == '08'){
                    $split = Str::substr($member->no_telpon, 2, 14);
                    $number = '628'.$split;
                    }
                    if($noCheck == '+6'){
                    $split = Str::substr($member->no_telpon, 1, 14);
                    $number = '62'.$split;
                    // dd($number);
                    }
                    if($noCheck == '62'){
                    $number = $member->no_telpon;
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
                        $status = $hasil['data']['status'];
                        $message = $hasil['data']['body'];
                        ConstantController::loggerNonAuth("$message", 'Module', "whatsapp notification $status", $member->no_telpon);
                    }else{
                        ConstantController::loggerNonAuth("whatsapp gagal terkirim", 'Module', "whatsapp notification gagal", $member->no_telpon);
                    }
                    }catch(Exception $e){
                        return ResponseFormatter::error([
                            'message' => 'Something went Wrong',
                            'error' => $e->getMessage(),
                           ], 'Authenticated Failed', 500);
                    }
                // end
            }else{
                return ResponseFormatter::error([
                    'message' => 'Maaf anda tidak terdaftar sebagai anggota Laskar PLN',
                    'error' => 'Maaf anda tidak terdaftar sebagai anggota Laskar PLN',
                   ], 'Authenticated Failed', 500);
            }
            return ResponseFormatter::success([
                'validation' => 'valid',
                'message' => 'OTP Sending',
                'User Registered at LASKAR PLN'
            ], 'Autenticated');
        } catch (Exception $error) {
           return ResponseFormatter::error([
            'message' => 'Something went Wrong',
            'error' => $error->getMessage(),
           ], 'Authenticated Failed', 500);
        }
    }

    public function login(Request $request){
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = request(['email','password']);
            //   dd($credentials);
            if(!Auth::attempt($credentials)){
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
                'role' => $user->getRoleNames()[0],
            ], 'Autenticated');
        } catch (Exception $error) {
           return ResponseFormatter::error([
            'message' => 'Something went Wrong',
            'error' => $error->getMessage(),
           ], 'Authenticated Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }
}
