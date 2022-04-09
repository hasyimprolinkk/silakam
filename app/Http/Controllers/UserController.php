<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //
    public function showAllPetugas()
    {
        $users = User::orWhere('roles', 'petugas')->get();
        return view('users.petugas.index', compact('users'));
    }

    public function showAllMasyarakat()
    {
        $users = User::where('roles', 'user')->get();
        return view('users.masyarakat.index', compact('users'));
    }

    //Menampilkan Pengguna (masyarakat) Sebagai Admin
    public function showUserAdmin($id)
    {
        $user = User::where('roles', 'user')->where('user_id', $id)->firstOrFail();
        return view('users.lihat_admin', compact('user'));
    }

    //Menampilkan Pengguna (Petugas) Sebagai Admin
    public function showPetugasAdmin($id)
    {
        $user = User::where('roles', 'petugas')->where('user_id', $id)->firstOrFail();
        return view('users.lihat_admin', compact('user'));
    }

    //Menampilkan pengguna sebagai user
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('users.lihat_user', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $url = $user->roles == "petugas" ? 'petugas' : 'masyarakat';
        Alert::success('Berhasil', 'Berhasil Menghapus ' . $user->nama);
        $user->delete();
        return redirect($url);

    }

    public function createPetugas()
    {
        $alamat = Alamat::all(); 
        return view('users.petugas.add', compact("alamat"));
    }

    public function storePetugas(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'numeric', 'digits:16', 'unique:users'],
            'nama' => ['required', 'string', 'max:255'],
            'jk' => ['required'],
            'alamat' => ['required', 'numeric'],
            'jabatan' => ['required'],
            'no_hp' => ['required', 'numeric', 'digits_between:10,13', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'jk' => $request->input('jk'),
            'alamat_id' => $request->input('alamat'),
            'jabatan' => $request->input('jabatan'),
            'no_hp' => $request->input('no_hp'),
            'roles' => 'petugas',
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        Alert::success('Berhasil', 'Berhasil Menambah Petugas');
        return redirect('petugas');
    }

    public function profile()
    {
        $alamat = Alamat::all();
        $user = User::findOrFail(Auth::user()->user_id);
        return view('users.profile', compact('user', 'alamat'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->user_id);

        $request->validate([
            'username' => 'required|alpha_dash|unique:users,username,'.$user->user_id.',user_id',
            'nama' => 'required|string|max:255',
            'jk' => 'required',
            'alamat' => 'required|numeric',
            'jabatan' => 'nullable',
            'no_hp' => ['required', 'unique:users,no_hp,'. $user->user_id .',user_id'], 
            'avatar' => 'nullable|mimes:jpg,jpeg,png|image'
        ]);

        if ($request->file('avatar') != null) {
            $path = public_path("storage/" . $user->avatar);
            if(File::exists($path)){
                if ($user->avatar == "avatars/default.jpg") {
                    $avatar = $request->file('avatar')->store('avatars', 'public');
                } else {
                    File::delete($path);
                    $avatar = $request->file('avatar')->store('avatars', 'public');
                }
            }
        } else {
            $avatar = $user->avatar;
        }

        $data = [
            'username' => $request->username,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'jabatan' => $request->jabatan,
            'alamat_id' => $request->alamat,
            'no_hp' => $request->no_hp,
            'avatar' => $avatar,
        ];

        $user->update($data);

        Alert::success('Berhasil', 'Berhasil Update Profile');
        return back();
    }

    public function statusActive(Request $request, $id)
    {
        $user = User::find($id);

        if($request->aktif){
            $status = "1";
            $msg = "Berhasil Mengaktifkan Pengguna";
        }elseif($request->nonaktif){
            $status = "0";
            $msg = "Berhasil Menonaktifkan Pengguna";
        }

        $user->update(['is_active' => $status]);
        Alert::success('Berhasil', $msg);
        return back();
    }

    public function editPassword()
    {
        return view('users.changepassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'passwordlama' => 'required|string',
            'passwordbaru' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->passwordlama, Auth::user()->password)) {
            return back()->with('msg', 'Password lama tidak cocok');
        } else {
            User::find(Auth::user()->user_id)->update([
                'password' => Hash::make($request->passwordbaru)
            ]);
            Alert::success('Berhasil', "Berhasil Mengubah Passoword");
            return back();
        }
    }

}
