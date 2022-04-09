<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlamatController extends Controller
{
    public function index()
    {
        $alamat = Alamat::orderBy('alamat_id', 'DESC')->get();
        return view('master.alamat', compact('alamat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string'
        ]);

        Alamat::create(['alamat' => $request->alamat]);
        Alert::success('Alamat Baru Berhasil ditambahkan');
        return redirect('/alamat');
    }

    public function edit($id)
    {
        $alamat = Alamat::findOrFail($id);
        return view("master.alamat_edit", compact("alamat"));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['alamat' => 'required']);
        $alamat = Alamat::findOrFail($id);
        try{
            $alamat->update(['alamat' => $request->alamat]);
            Alert::success('Alamat Berhasil diupdate');
            return redirect('/alamat');
        } catch(Exception $e){
            Alert::error("Gagal Update $alamat->alamat, error : " .$e->getMessage());
            return redirect('/alamat');
        }
    }

    public function destroy($id)
    {
        try {
            $a = Alamat::findOrFail($id);
            Alert::success("$a->alamat Berhasil dihapus");
            $a->delete();
            return redirect('/alamat');
        } catch (Exception $e) {
            Alert::error("Gagal Menghapus $a->alamat, error : " .$e->getMessage());
            return redirect('/alamat');
        }
    }
}
