<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\User;
use App\Models\Cabang;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $cabang = Cabang::all();
        return view('karyawan.tambahkar', [
            "title" => "Register",
            "cabangs" => $cabang,
        ]);
    }

    public function getAgen(String $cabang)
    {
        $agenData = Agen::where('cabang_id', $cabang)->get();
        return $agenData;
    }

    public function store(Request $request)
    {
        //     $request->validate([
        //         'username' =>['required','min:3','unique:users'],
        //         "name" => 'required|unique|max255',
        //         'email' => 'required|email|unique|users',
        //         'password' => 'required|min:5:max:255'
        //     ]);
        //     dd('registrasi berhasil');
        //     return request()->all();
        // }

        $validatedData = $request->validate([
            // 'slug' => 'required',
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'unique:users'],
            'email' => 'required|email|unique:karyawans',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'selectCabang' => 'required',
            'selectAgen' => 'required',
            'alamat' => 'required|max:255',
            'password' => 'required|min:5|max:255',
        ]);
        // $validatedData = $request->all();
        $validatedData['slug'] = Karyawan::max('id') + 1;

        $userData = [
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
        ];

        $user = User::create($userData);
        $karyawan = new Karyawan(); // Create a new instance of Karyawan


        // Buat data Karyawan
        $karyawanData = [
            // 'slug' => $karyawan->generateSlug(),
            'slug' => $user->id,
            'nama' => $validatedData['name'],
            'email' => $validatedData['email'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'cabang_id' => $validatedData['selectCabang'],
            'agen_id' => $validatedData['selectAgen'],
            'alamat' => $validatedData['alamat'],
            'username' => $user->username, // Hubungkan Karyawan dengan User
        ];

        // return redirect()->route('login')->with('success', 'Registrasi berhasil!');
        // $request->session()->flash('Success', 'Registarion success, Silahkan Login');
        Karyawan::create($karyawanData);
        // return dd(DB::getQueryLog());
        return redirect()->route('karyawan')->with('success', 'Registrasi berhasil!');
        // return redirect(dd($karyawanData));

    }

    public function viewGantiPass()
    {
        return view('karyawan.gantipass', [
            "title" => "Ubah Password",
        ]);
    }

    public function gantiPass(String $user, Request $request)
    {
        $userId = User::where('username', $user)->first();

        $userForm = $request->validate([
            'oldpass' => 'required|min:5|max:255',
            'newpass' => 'required|min:5|max:255',
            'retype' => 'required|min:5|max:255',
        ]);

        $encOldPass = $userId->password;
        $newPass = $userForm['newpass'];
        $retype = $userForm['retype'];
        if (!Hash::check($userForm['oldpass'], $encOldPass)) {
            return redirect()->route('ganti-pass')->with('error', 'Password lama tidak cocok');
            // return $encOldPass;
        } elseif ($newPass  === $retype) {
            $encNewPass = bcrypt($newPass);
            $userId->password = $encNewPass;
            $userId->save();
            return redirect()->route('ganti-pass')->with('success', 'Password Berhasil Diubah');
        } else {
            return redirect()->route('ganti-pass')->with('error', 'Password baru tidak cocok');
        }
    }
}
