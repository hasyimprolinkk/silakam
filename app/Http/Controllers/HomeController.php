<?php

namespace App\Http\Controllers;

use App\Models\Lapor;
use App\Models\Support;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use function App\Helpers\sendNotifUser;
use function App\Helpers\supportNotif;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {
        $lapors = Lapor::with(['tanggapans', 'supports'])->where('is_public', "1")->orderBy('created_at', 'desc')->paginate(5);
        return view('home', [
            'lapors'    => $lapors,
            'lapor'     => Lapor::count(),
            'pending'   => Lapor::where('status', 'Belum Diproses')->count(),
            'proses'    => Lapor::where('status', 'Sedang Diproses')->count(),
            'selesai'   => Lapor::where('status', 'Selesai')->count(),
        ]);
    }

    //menampilkan data laporan berdasarkan id
    public function show($id)
    {   
        $cek = Lapor::findOrFail($id);
        //jika admin, tampilkan semua
        if(Auth::user()->roles == "petugas" || Auth::user()->roles == "admin" || Auth::user()->user_id == $cek->user_id){
            $lapor = $cek;
        //jika user, tampilkan yang public
        } else {
            $lapor = Lapor::where('lapor_id', $id)->where('is_public', "1")->firstOrFail();
        }
        return view('lapors.tanggapan', compact('lapor'));
    }

    //menambah tanggapan
    public function store(Request $request)
    {
        $request->validate([
            'tanggapan' => 'required'
        ]);
        $data = [
            'lapor_id' => $request->lapor_id,
            'user_id' => Auth::user()->user_id,
            'tanggapan' => $request->tanggapan
        ];
        $t = Tanggapan::create($data);
        
        sendNotifUser($t->user, $t->lapor);
        return back();
    }

    public function deleteTanggapan($id)
    {
        Tanggapan::where('tanggapan_id', $id)->where('user_id', Auth::user()->user_id)->delete();

        Alert::success('Berhasil', 'Berhasil Menghapus Tanggapan');
        return back();
    }

    public function support(Request $request)
    {
        $data = [
            'lapor_id' => $request->lapor_id, 
            'user_id' => Auth::user()->user_id
        ];
        $supp = Support::create($data);
        supportNotif($supp);
        return back();
        
    }

    public function unsupport(Request $request)
    {
        Support::where('lapor_id', $request->lapor_id)
            ->where('user_id', Auth::user()->user_id)->delete();
        return back();
    }

    
}
