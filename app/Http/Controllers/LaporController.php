<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lapor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Telegram;
use PDF;

use function App\Helpers\newLaporan;
use function App\Helpers\ubahStatus;

class LaporController extends Controller
{
    public function index()
    {
        $lapors = Lapor::orderBy('created_at', 'DESC')->get();

        if (request()->category == "belum") {
            $lapors = Lapor::where('status', 'Belum Diproses')->get();
        } elseif (request()->category == "proses") {
            $lapors = Lapor::where('status', 'Sedang Diproses')->get();
        } elseif (request()->category == "selesai") {
            $lapors = Lapor::where('status', 'Selesai')->get();
        } elseif (request()->category == "publik") {
            $lapors = Lapor::where('is_public', "1")->get();
        }elseif (request()->category == "privasi") {
            $lapors = Lapor::where('is_public', "0")->get();
        }
        return view('lapors.data_Lapor', compact('lapors'));
    }

    public function addLapor()
    {
        $kategori = Kategori::orderBy('kategori_id', 'DESC')->get();
        return view('lapors.lapor', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'keterangan' => ['required','string'],
            'kategori' => ['required', 'numeric'],
            'is_public' => ['required'],
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('lapors', 'public');
        }else {
            $image = null;
        }

        $data = [
            'user_id' => Auth::user()->user_id,
            'keterangan' => $request->input('keterangan'),
            'image' => $image,
            'kategori_id' => $request->input('kategori'),
            'is_public' => $request->input('is_public')
        ];

        $lapor = Lapor::create($data);
        newLaporan($lapor->lapor_id);

        Alert::success('Berhasil', 'Laporan Berhasil diposting');
        return redirect('lapor');
    }

    public function show($id)
    {
        $lapor = Lapor::findOrFail($id);
        return view('lapors.lihat_admin', compact('lapor'));
    }

    public function ubahStatus(Request $request, $id)
    {
        $lapor = Lapor::findOrFail($id);
        $status = "";

        if ($request->belum) {
            $status = "Belum Diproses";    
        } elseif ($request->proses){
            $status = "Sedang Diproses";    
        } elseif ($request->selesai){
            $status = "Selesai";  
        } else {
            Alert::error('Gagal', 'Gagal Mengubah Status');
            return back();
        }

        $lapor->update([
            "status" => $status,
            "petugas_id" => Auth::user()->user_id,
        ]);

        if($lapor->user->chat_id_bot != null){
            ubahStatus($status, $lapor);
        }

        Alert::success('Berhasil', 'Berhasil Mengubah Status');
        return back();
    }

    public function laporanSaya()
    {
        $lapors = Lapor::where('user_id', Auth::user()->user_id)
            ->orderBy('created_at', 'DESC')->get();
        return view('lapors.laporan_saya', compact('lapors'));
    }

    public function hapusLapor($id)
    {
        $lapor = Lapor::find($id);
        if ($lapor->image != null) {
            $path = public_path("storage/" . $lapor->image);
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $lapor->delete();
        Alert::success('Berhasil', 'Berhasil Menghapus Laporan');
        return redirect('data_lapor');
    }

    public function lihatLaporanSaya($id)
    {
        $lapor = Lapor::where('user_id', Auth::user()->user_id)
                ->where('lapor_id',$id)->firstOrFail();
        return view('lapors.lihat_user', compact('lapor'));
    }

    public function deleteLaporanSaya($id)
    {
        $lapor = Lapor::where('user_id', Auth::user()
                ->user_id)->where('lapor_id',$id)->firstOrFail();
        if ($lapor->image != null) {
            $path = public_path("storage/" . $lapor->image);
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $lapor->delete();
        Alert::success('Berhasil', 'Berhasil Menghapus Laporan');
        return redirect('laporan_saya');
    }

    public function editLaporanSaya($id)
    {
        $kategori = Kategori::all();
        $lapor = Lapor::where('user_id', Auth::user()
                ->user_id)->where('lapor_id',$id)->firstOrFail();
        return view('lapors.edit_lapor', compact('lapor', 'kategori'));
    }

    public function updateLaporanSaya(Request $request, $id)
    {
        $lapor = Lapor::where('user_id', Auth::user()
                ->user_id)->where('lapor_id',$id)->firstOrFail();

        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'keterangan' => ['required','string'],
            'kategori' => ['required', 'numeric'],
            'is_public' => ['required'],
        ]);

        if ($request->file('image') != null) {
            $path = public_path("storage/" . $lapor->image);
            if(File::exists($path)){
                File::delete($path);
                $image = $request->file('image')->store('lapors', 'public');
            }
        } else {
            $image = $lapor->image;
        }

        $data = [
            'keterangan' => $request->input('keterangan'),
            'image' => $image,
            'kategori_id' => $request->input('kategori'),
            'is_public' => $request->input('is_public'),
        ];

        $lapor->update($data);
        Alert::success('Berhasil', 'Laporan Berhasil diupdate');
        return redirect('laporan_saya');
    }

    public function cetakId($id)
    {
        $lapor = Lapor::findOrFail($id);
        $lapor->images = base64_encode(public_path('storage/'.$lapor->image));
        $pdf = PDF::loadview('lapors.cetak_satu', compact('lapor'))->setPaper('a4');
        return $pdf->download(date('dmYHi').'_laporan.pdf');
    }

    public function cetakLaporan()
    {
        return view('lapors.cetak_laporan');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date'
        ]);

        $from_date  = Carbon::parse($request->from_date)->toDateTimeString();
        $to_date    = Carbon::parse($request->to_date)->toDateTimeString();

        $lapors = Lapor::whereBetween('created_at',[$from_date , $to_date])->get();
        if($lapors->count() == 0){
            return back()->with('msg', 'Tidak ada data laporan dari tanggal tersebut');
        } else {
            $pdf = PDF::loadview('lapors.cetak_all', [
                'lapors' => $lapors,
                'from_date' => $request->from_date, 
                'to_date' => $request->to_date
            ]);
            return $pdf->download("laporan.pdf");
        }
    }

}
