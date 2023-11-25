<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class KaryawanController extends Controller
{
    public function index($page = 10) {
        
        $data = Karyawan::with('user')->filters(['search' => request('search')])
                                  ->paginate($page);

        return view('karyawan.karyawan',[
            "title" => "Karyawan",
            "karyawans" => $data,

        ]);
        // return dd($data);
    }


    

    public function show(Karyawan $karyawan) {
        return view('karyawan.detail_karyawan',[
            "title" => "Detail Karyawan",
            // "karyawan" => Karyawan::find($slug)
            "karyawan" => $karyawan
            

        ]);
    }

    public function update(string $id)
    {

        $data = Karyawan::findOrFail($id);
        return view('karyawan.edit',[
            "title" => "Edit Karyawan",
            "karyawan" => $data,

        ]);
        // return dd($data);
    }

    public function updateKaryawan(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'nama' => 'required|max:255',
            'username' => ['min:3','unique:user'],
            'email' => 'required|email:dns',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|max:255',
            // 'password' => 'required|min:5|max:255', 
        ]);

        $karyawan = Karyawan::findOrFail($id);


        $karyawan->update([
            'nama'     => $request->nama,
            // 'username'     => $request->username,
            'email'   => $request->email,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'alamat'   => $request->alamat,
        ]);

        // $user = User::findOrFail($id);
        // $user->update([
        //             'username' => $request->username,
        //         ]);


        return redirect()->route('karyawan')->with(['success' => 'Data Berhasil Diubah!']);
        // return dd($user);
    }

    public function hapusKaryawan($id)
    {
        $data = Karyawan::findOrFail($id);
        $user = User::findOrFail($id);
        $data->delete();
        $user->delete();
        
        return redirect()->route('karyawan')->with('success', 'Data berhasil dihapus');

    }
}
