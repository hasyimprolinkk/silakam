<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Telegram;

//notif ke channel admin jika ada laporan baru dr masyarakat
function newLaporan($id)
{
    $text = "INFO  LAPORAN! %0A" . Auth::user()->nama . " telah menambahkan laporan baru. Mohon untuk segera ditangani. Terima Kasih.%0A%0AInfo Selengkapnya : %0A" . url("/data_lapor/{$id}/lihat");
    Telegram::sendMessage([
        'chat_id' => "-1001589493535",
        'text' => urldecode($text) 
    ]);
}

//notif jika ada user register baru
function newRegister($data)
{
    $text = "INFO PENGGUNA BARU! %0ANIK      : {$data->nik} %0ANama    : {$data->nama} %0AAlamat : {$data->alamat->alamat} %0AMohon segera dicek. Terima Kasih.%0A%0AInfo selengkapnya : %0A" . url("/masyarakat/{$data->user_id}");
    Telegram::sendMessage([
        'chat_id' => "-1001589493535",
        'text' => urldecode($text) 
    ]);
}

//notif ke user jika status laporannya diubah
function ubahStatus($status, $data){
    if($data->user->chat_id_bot != null){
        $text = "INFO LAPORAN! %0AStatus laporan anda saat ini \"$status\". Terima Kasih.%0A%0AInfo selengkapnya : %0A" . url("/laporan_saya/{$data->lapor_id}");
        Telegram::sendMessage([
            'chat_id' => $data->user->chat_id_bot,
            'text' => urldecode($text) 
        ]);
    }
}

//send notifikasi jika ada tanggapan pada laporan
function sendNotifUser($user, $data){
    // mengirim ke admin jika laporan ditanggapi oleh pelapor
    if ($user->user_id == $data->user_id){
        $text = "INFO TANGGAPAN! %0A\"$user->nama\" menanggapi pada laporannya.%0A%0AInfo selengkapnya : %0A" . url("/tanggapan/{$data->lapor_id}/lihat");
        Telegram::sendMessage([
            'chat_id' => "-1001589493535",
            'text' => urldecode($text) 
        ]);
    // mengirim ke pelapor jika laporan ditanggapi oleh user.admin.petugas
    } else {
        if($data->user->chat_id_bot !=null){
            $text = "INFO TANGGAPAN! %0ALaporan anda ditanggapi oleh \"$user->nama\". Terima Kasih.%0A%0AInfo selengkapnya : %0A" . url("/tanggapan/{$data->lapor_id}/lihat");
            Telegram::sendMessage([
                'chat_id' => $data->user->chat_id_bot,
                'text' => urldecode($text)
            ]);
        }
    }
}

//notif jika ada user yang support pada laporan 
function supportNotif($supp)
{   $chat_id = $supp->lapor->user->chat_id_bot;
    if($chat_id != null){
        $text = "INFO SUPPORT! %0A\"".$supp->user->nama."\" mendukung pada laporan anda.%0A%0AInfo selengkapnya : %0A" . url("/tanggapan/{$supp->lapor_id}/lihat");
        Telegram::sendMessage([
            'chat_id' => $supp->lapor->user->chat_id_bot,
            'text' => urldecode($text) 
        ]);
    }
}

