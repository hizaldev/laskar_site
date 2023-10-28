<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AuthOtpController extends Controller
{
    public function SendOtp(Request $request)
    {
        if ($request->type == 'resend') {
            $this->validate($request, [
                'email' => 'required|exists:users,email',
            ]);
        } else {
            $this->validate($request, [
                'email' => 'required|exists:users,email',
                'captcha' => 'required|captcha'
            ]);
        }

        $member = Member::where('email', $request->email)->first();
        $user = User::where('email', $request->email)->first();
        if ($member != null && $user != null) {
            $otp = random_int(100000, 999999);
            $data['password']   = bcrypt($otp);
            // dd($user);
            $user->update($data);
            $message = "[LASKAR PLN Virtual Assistant]\n\nHai, $member->nama_lengkap\nBerikut merupakan kode OTP anda *$otp*, tolong untuk tidak membagikan kode ini ke orang lain, bijaklah dalam menggunakan dan menjaga data pribadi anda.\n\n\n\nSalam hangat\n*Laskar PLN*";
            // ConstantController::sendMessageWhatssap($message, $reciver);
            // start
            $url = env('WHATSAPP_GATEWAY_URL') . "/messages";
            $key = env('WHATSAPP_GATEWAY_API_KEY');
            $device = env('WHATSAPP_GATEWAY_DEVICE');
            // dd($url);
            $client = new Client();
            $noCheck = Str::substr($member->no_telpon, 0, 2);
            if ($noCheck == '08') {
                $split = Str::substr($member->no_telpon, 2, 14);
                $number = '628' . $split;
            }
            if ($noCheck == '+6') {
                $split = Str::substr($member->no_telpon, 1, 14);
                $number = '62' . $split;
                // dd($number);
            }
            if ($noCheck == '62') {
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
            try {
                $response = $client->post($url, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $key
                    ],
                    'body'    => json_encode($data)
                ]);
                $hasil = (array)json_decode((string)$response->getBody(), true);
                if ($hasil['status'] == 200) {
                    $status = $hasil['data']['status'];
                    $message = $hasil['data']['body'];
                    ConstantController::loggerNonAuth("$message", 'Module', "whatsapp notification $status", $member->no_telpon);
                } else {
                    ConstantController::loggerNonAuth("whatsapp gagal terkirim", 'Module', "whatsapp notification gagal", $member->no_telpon);
                }
            } catch (Exception $e) {
                // $skuList = preg_split('/\r\n|\r|\n/', $e->getMessage());
                // ConstantController::loggerNonAuth("whatsapp gagal terkirim with message : $skuList[1]", 'Module', "whatsapp notification gagal", $member->no_telpon);
                // ConstantController::errorAlert("Whatsap gagal mengirim dengan error: $skuList[1]");
                ConstantController::errorAlert($e->getMessage());
                return view('auth.email_otp');
            }
            // end
        } else {
            ConstantController::errorAlert('Maaf anda tidak terdaftar sebagai anggota Laskar PLN');
            return view('auth.email_otp');
        }
        return view("auth.otp", ['member' => $member]);
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|max:6',

        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = User::find(Auth::user()->id);
            $otp = random_int(100000, 999999);
            $data['password']   = bcrypt($otp);
            $user->update($data);
            // ConstantController::successAlertWithMessage("Welcome ".Auth::user()->name);
            Alert::html("Selamat Datang Kembali " . Auth::user()->name, 'Yuk bantu kita untuk update data keanggotaanmu dengan klik link berikut <a href="' . route('update_profile') . '">Klik disini untuk perbarui data</a> ada hadiah untukmu yang sudah mengupdate data keanggotaan', 'success');
            return redirect()->route('home');
        } else {
            ConstantController::errorAlert('Otentikasi Gagal');
            return view('auth.email_otp');
        }
    }
}
