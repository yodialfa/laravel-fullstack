<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Karyawan {
    static $karyawans = [
        [
            "id" => "1",
            "slug" => "1",
            "nama" => "Diaz Grimaldy",
            "Alamat" => "Bandung"
        ],
        [
            "id" => "2",
            "slug" => "2",
            "nama" => "Aldi Rachman",
            "Alamat" => "Bandung"
        ],
        [
            "id" => "3",
            "slug" => "3",
            "nama" => "Andhika Heru P",
            "Alamat" => "Bandung"
        ],
        [
            "id" => "4",
            "slug" => "4",
            "nama" => "Temujin",
            "Alamat" => "Bandung"
        ]
        ];
    
    public static function all(){
        return collect(self::$karyawans);
    }

    public static function find($slug) {
        $karyawans = static::all();
        // $karyawan = null;
        // foreach($karyawans as $post) {
        //     if($post['slug'] === $slug){
        //         $karyawan = $post;
        //         break; 
        //     }

        // }
        
        return $karyawans->firstWhere('slug', $slug);

    }
}

// Karyawan::fnd(1)->update(['nama'=>]'Alfariz')


// $karyawan = new App\Models\Karyawan
// $karyawan::create([
//     'slug' => '1',
//     'nama' => 'Yodi Alfariz',
//     'tanggal_lahir' => '1995-02-12',
//     'alamat' => 'Bandung'
// ])
// $karyawan::create([
//     'slug' => '2',
//     'nama' => 'Alfariz',
//     'tanggal_lahir' => '1995-02-12',
//     'alamat' => 'Ciamis'
// ])

// $karyawan::create([
//     'slug' => '3',
//     'nama' => 'Diaz Grimaldy',
//     'tanggal_lahir' => '1995-02-12',
//     'alamat' => 'Cirebon'
// ])
// $karyawan::create([
//     'slug' => '4',
//     'nama' => 'Domba',
//     'tanggal_lahir' => '1995-02-12',
//     'alamat' => 'Bandung'
// ])



// use App\Models\City;

// $city = new City;
// $city->NamaKota = 'Nama Kota Baru';
// $city->save();

// City::create([
//     'NamaKota' => 'Bandung'
// ])

// City::create([
//     'NamaKota' => 'Jakarta'
// ])
// City::create([
//     'NamaKota' => 'Bekasi'
// ])
// City::create([
//     'NamaKota' => 'Depok'
// ])

// use App\Models\District;

// District::create([
//     "NamaKecamatan" => 'Sumur Bandung',
//     "IdCities" => '1'
// ])

// District::create([
//     "NamaKecamatan" => 'CIb Kaler',
//     "IdCities" => '1'
// ])

// District::create([
//     "NamaKecamatan" => 'Cibeunying Bandung',
//     "IdCities" => '1'
// ])

// District::create([
//     "NamaKecamatan" => 'Bojongloa',
//     "IdCities" => '1'
// ])

// District::create([
//     "NamaKecamatan" => 'Coblong',
//     "IdCities" => '1'
// ])

// District::create([
//     "NamaKecamatan" => 'Tigaraksa',
//     "IdCities" => '2'
// ])

// District::create([
//     "NamaKecamatan" => 'Jatiasih',
//     "IdCities" => '2'
// ])

// District::create([
//     "NamaKecamatan" => 'Pademangan',
//     "IdCities" => '2'
// ])


// use App\Models\Service;

// Service::create([
//     "NamaLayanan" => "Darat",
// ])

// Service::create([
//     "NamaLayanan" => "Laut",
// ])
// Service::create([
//     "NamaLayanan" => "Udara",
// ])
// Service::create([
//     "NamaLayanan" => "Towing",
// ])

// Price::create([
//     'IdKotaAsal' => '1', 
//     'IdKecAsal' => '1', 
//     'IdKotaTujuan' => '2', 
//     'IdKectujuan' => '2',
//     'IdLayanan' => '1', 
//     'Harga' => '5000'
//     ])



// Price::create([
//     'IdKotaAsal' => '1', 
//     'IdKecAsal' => '1', 
//     'IdKotaTujuan' => '1', 
//     'IdKectujuan' => '1',
//     'IdLayanan' => '2', 
//     'Harga' => '5000'
// ])

// Price::create([
//     'IdKotaAsal' => '1', 
//     'IdKecAsal' => '1', 
//     'IdKotaTujuan' => '2', 
//     'IdKectujuan' => '2',
//     'IdLayanan' => '2', 
//     'Harga' => '4000'
// ]);
    