<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('kategori_id', 'DESC')->get();
        return view('master.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string'
        ]);

        Kategori::create(['kategori' => $request->kategori]);
        Alert::success('Kategori Baru Berhasil ditambahkan');
        return redirect('/kategori');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view("master.kategori_edit", compact("kategori"));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['kategori' => 'required']);
        $kategori = Kategori::findOrFail($id);
        try{
            $kategori->update(['kategori' => $request->kategori]);
            Alert::success('Kategori Berhasil diupdate');
            return redirect('/kategori');
        } catch(Exception $e){
            Alert::error("Gagal Update $kategori->kategori, error : " .$e->getMessage());
            return redirect('/kategori');
        }
    }

    public function destroy($id)
    {
        try {
            $kat = Kategori::findOrFail($id);
            Alert::success("Kategori $kat->kategori Berhasil dihapus");
            $kat->delete();
            return redirect('/kategori');
        } catch (Exception $e) {
            Alert::error('Gagal Menghapus Kategori, error : ' .$e->getMessage());
            return redirect('/kategori');
        }
    }
}
