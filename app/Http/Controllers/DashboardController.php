<?php

namespace App\Http\Controllers;

use App\Models\Lapor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles == "user") {
            $id = Auth::user()->user_id;
            return view('dashboard', [
                'lapor' => Lapor::where('user_id', $id)->count(),
                'pending'   => Lapor::where('user_id', $id)->where('status', 'Belum Diproses')->count(),
                'proses'    => Lapor::where('user_id', $id)->where('status', 'Sedang Diproses')->count(),
                'selesai'   => Lapor::where('user_id', $id)->where('status', 'Selesai')->count(),
                'publik'    => Lapor::where('user_id', $id)->where('is_public', "1")->count(),
                'privasi'   => Lapor::where('user_id', $id)->where('is_public', "0")->count(),
            ]);
        } else {
            return view('dashboard', [
                'lapor' => Lapor::count(),
                'pending'   => Lapor::where('status', 'Belum Diproses')->count(),
                'proses'    => Lapor::where('status', 'Sedang Diproses')->count(),
                'selesai'   => Lapor::where('status', 'Selesai')->count(),
                'publik'    => Lapor::where('is_public', "1")->count(),
                'privasi'   => Lapor::where('is_public', "0")->count(),
                'user'      => User::where('roles', 'user')->count(),
                'petugas'   => User::where('roles', 'petugas')->count(),
            ]);
        }
    }

    public function telegramSetting()
    {
        $tg = User::find(Auth::user()->user_id)->chat_id_bot;
        return view('telegram', compact('tg'));
    }

    public function telegramUpdate(Request $request)
    {
        $request->validate([
            "chat_id_bot" => 'required|numeric|min:5|unique:users' 
        ]);

        $update = User::find(Auth::user()->user_id);
        
        if($update->chat_id_bot == null) {
            $msg = 'Berhasil Mengaktifkan bot Telegram';
        } else {
            $msg = 'Berhasil Mengubah Chat ID bot Telegram';
        }
        
        $update->update(["chat_id_bot" => $request->chat_id_bot]);

        Alert::success('Berhasil', $msg);
        return back();
    }
}
