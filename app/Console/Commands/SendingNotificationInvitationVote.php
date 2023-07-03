<?php

namespace App\Console\Commands;

use App\Http\Controllers\Constant\ConstantController;
use App\Models\Vote;
use App\Models\Voter;
use App\Models\VoterNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SendingNotificationInvitationVote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invitationVote:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ini merupakan schedule untuk mengirimkan notifikasi setiap menit untuk undangan e vote yang statusnya belum terkirim';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $now = Carbon::now();
        Log::info("Menjalankan Cron : $now");
        $voter = VoterNotification::where('status_undangan', 'Belum Terkirim')->first();
        if($voter != null){
            Log::info("Get data peserta : $voter->nama_lengkap");
            $election = Vote::find($voter->vote_id);

            $message = "[LASKAR PLN Virtual Assistant]\n\n";
            $message .= "Hai, $voter->nama_lengkap \n";
            $message .= "Selamat anda terdaftar sebagai pemilih dari agenda pemilu LASKAR PLN melalui aplikasi E-Vote, dengan agenda sebagai berikut: \n";
            $message .= "Nama agenda pemilu: $election->judul_pemilihan \n";
            $message .= "Waktu pelaksanaan pemilu : $election->tgl_vote_mulai s/d $election->tgl_vote_berakhir \n";
            $message .= "untuk menggunakan hak pilih anda silahkan buka atau copy alamat link di bawah ini \n";
            $message .= "https://laskar_site.test/evote/$voter->id \n";
            $message .= "dan jangan lupa saat sudah memilih masukan sekuriti code ini *$voter->pass_key* sebagai validasi anda adalah pemilih yang sah. \n";
            $message .= "mari sukseskan agenda pemilu LASKAR PLN melalui aplikasi E-vote. \n";
            $message .= "*LASKAR PLN* \n";
            $message .= "*Modern* \n";
            $message .= "*Mandiri* \n";
            $message .= "*Berintegritas* \n";
            $message .= "\n";
            $message .= "Salam hangat,\n";
            $message .= "\n";
            $message .= "*Laskar PLN*";

            
            ConstantController::sendMessageWhatssap($message, $voter->no_telp);
            $data['status_undangan'] = 'Terkirim';
            $data['tgl_kirim'] = Carbon::now();
            $data['updated_by'] = "Job Notification";
            $data['updated_at'] = Carbon::now();
            $voter->update($data);
           
        }else{
            Log::info("Tidak ada Peserta E-vote yang belum terkirim");
        }
    }
}
