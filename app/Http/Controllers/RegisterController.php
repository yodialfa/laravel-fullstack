<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index(){

        return view('karyawan.tambahkar',[
            "title" => "Register",
        ]);
    }

    public function store(Request $request){
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
            'email' => 'required|email:dns|unique:karyawans',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
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
    
}
