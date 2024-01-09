<?php

namespace Database\Seeders;

use App\Models\Agen;
use App\Models\City;
use App\Models\User;
use App\Models\Price;
use App\Models\Cabang;
use App\Models\Service;
use App\Models\Customer;
use App\Models\District;
use App\Models\Karyawan;



use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    // protected $price = Price::class;
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        City::factory(15)->create();
        // Customer::factory(15)->create();

        Karyawan::create([
            'slug' => '1',
            'nama' => 'Yodi Alfariz',
            'username' => 'admin',
            'tempat_lahir' => 'Bandung',
            'email' => 'test@1gmail.com',
            'tanggal_lahir' => '1995-02-12',
            'cabang_id' => 1,
            'agen_id' => 1,
            'alamat' => 'Bandung'
        ]);

        User::create([
            'username' => 'admin',
            'role'=> 'admin',
            'password' => bcrypt('admin')
            
        ]);

        Karyawan::create([
            'slug' => '2',
            'nama' => 'Alfariz',
            'username' => 'yodialfariz1',
            'tempat_lahir' => 'Bandung',
            'email' => 'test2@gmail.com',
            'tanggal_lahir' => '1995-02-12',
            'cabang_id' => 1,
            'agen_id' => 2,
            'alamat' => 'Ciamis'
        ]);
        User::create([
            'username' => 'yodialfariz1',
            'role'=> 'user',
            'password' => bcrypt('aaaaa')
        ]);

        Karyawan::create([
            'slug' => '3',
            'nama' => 'Diaz Grimaldy',
            'username' => 'yodialfariz2',
            'tempat_lahir' => 'Bandung',
            'email' => 'test3@gmail.com',
            'tanggal_lahir' => '1995-02-12',
            'cabang_id' => 2,
            'agen_id' => 3,
            'alamat' => 'Cirebon'
        ]);

        User::create([
            'username' => 'yodialfariz2',
            'role'=> 'user',
            'password' => bcrypt('aaaaa')
        ]);


        Karyawan::create([
            'slug' => '4',
            'nama' => 'Domba',
            'username' => 'yodialfariz4',
            'tempat_lahir' => 'Bandung',
            'email' => 'test4@gmail.com',
            'tanggal_lahir' => '1995-02-12',
            'cabang_id' => 2,
            'agen_id' => 4,
            'alamat' => 'Bandung'
        ]);

        User::create([
            'username' => 'yodialfariz4',
            'role'=> 'user',
            'password' => bcrypt('aaaaa')
        ]);

        // City::create([
        //     'NamaKota' => 'Bandung'
        // ]);
        
        // City::create([
        //     'NamaKota' => 'Jakarta'
        // ]);
        // City::create([
        //     'NamaKota' => 'Bekasi'
        // ]);
        // City::create([
        //     'NamaKota' => 'Depok'
        // ]);

        District::create([
            "NamaKecamatan" => 'Sumur Bandung',
            "IdCities" => '1'
        ]);
        
        District::create([
            "NamaKecamatan" => 'CIb Kaler',
            "IdCities" => '1'
        ]);
        
        District::create([
            "NamaKecamatan" => 'Cibeunying Bandung',
            "IdCities" => '1'
        ]);
        
        District::create([
            "NamaKecamatan" => 'Bojongloa',
            "IdCities" => '1'
        ]);
        
        District::create([
            "NamaKecamatan" => 'Coblong',
            "IdCities" => '1'
        ]);
        
        District::create([
            "NamaKecamatan" => 'Tigaraksa',
            "IdCities" => '2'
        ]);
        
        District::create([
            "NamaKecamatan" => 'Jatiasih',
            "IdCities" => '2'
        ]);
        
        District::create([
            "NamaKecamatan" => 'Pademangan',
            "IdCities" => '2'
        ]);

        Service::create([
            "NamaLayanan" => "Darat",
        ]);
        
        Service::create([
            "NamaLayanan" => "Laut",
        ]);
        Service::create([
            "NamaLayanan" => "Udara",
        ]);
        Service::create([
            "NamaLayanan" => "Towing",
        ]);

        Service::create([
            "NamaLayanan" => "Trucking",
        ]);


        // $faker = Faker::create();

        Price::create([
            'IdKotaAsal' => '1', 
            'IdKecAsal' => '1', 
            'IdKotaTujuan' => '2', 
            'IdKectujuan' => '2',
            'IdLayanan' => '2', 
            'Harga' => '4000'
        ]);

        Price::create([
            'IdKotaAsal' => '1', 
            'IdKecAsal' => '1', 
            'IdKotaTujuan' => '2', 
            'IdKectujuan' => '2',
            'IdLayanan' => '1', 
            'Harga' => '5000'
        ]);
        
        
        
        Price::create([
            'IdKotaAsal' => '1', 
            'IdKecAsal' => '1', 
            'IdKotaTujuan' => '1', 
            'IdKectujuan' => '1',
            'IdLayanan' => '2', 
            'Harga' => '5000'
        ]);

        Agen::create([
            'agen' => 'Ahmad Yani',
            'cabang_id' => '1',
            'alamatAgen' => "Jl. jend. A Yani"

        ]);

        Agen::create([
            'agen' => 'Suci',
            'cabang_id' => '1',
            'alamatAgen' => "Jl. Suci"

            
        ]);

        Agen::create([
            'agen' => 'Ciluncat',
            'cabang_id' => '1',
            'alamatAgen' => "Jl. Mahmud"

            
        ]);

        Agen::create([
            'agen' => 'Mahmud',
            'cabang_id' => '2',
            'alamatAgen' => "Jl. Mahmud"

            
        ]);

        Cabang::create([
            'cabang' => "Bandung",
            'alamatCabang' => "Jl. Jend. A. Yani No. 288 Bandung",
        ]);

        Cabang::create([
            'cabang' => "Jakarta",
            'alamatCabang' => "Jl. Jend. A. Yani No. 288 Jkt",
        ]);



        // $user = new User();
        // $user->name = 'Admin';
        // $user->email = 'admin@example.com';
        // $user->password = bcrypt('password');
        // $user->role = 'admin'; // Atur peran sebagai admin
        // $user->save();
        



        
        // $faker = Faker::create('id');
        // for ($i=1; $i <= 100; $i++) { 
        //     \DB::table('transaksis')->insert([
        //         'no_resi'=>$faker->randomNumber,
        //         'no_hp_pengirim'=>$faker->phoneNumber,
        //         'alamat_pengirim'=>$faker->address,
        //         'nama_pengirim'=>$faker->name,
        //         'no_hp_penerima'=>$faker->phoneNumber,
        //         'alamat_penerima'=>$faker->address,
        //         'nama_penerima'=>$faker->name,
        //         'IdLayanan'=> random_int(1,4),
        //         'IdKotaAsal'=> random_int(1,10),
        //         'IdKecAsal'=> random_int(1,10),
        //         'IdKotaTujuan'=> random_int(1,10),
        //         'IdKecTujuan'=> random_int(1,10),
        //         'cara_bayar'=> random_int(0,4),
        //         'jumlah'=> random_int(1,4),
        //         'berat'=> random_int(1,50),
        //         'harga'=> $faker->randomDigit(),
        //         'diskon'=> random_int(1,30),
        //         'biaya_surat'=> $faker->randomDigit(),
        //         'jenis_barang'=> 'pakaian',
        //         'biaya_asuransi'=> $faker->randomDigit(),
        //         'total_harga'=> $faker->randomDigit(),
        //         'employeeId'=> random_int(1,4),
        //         'status'=> random_int(1,4),


                
        //         'created_at'=>date('Y-m-d H:i:s'),
        //         'updated_at'=>date('Y-m-d H:i:s')
        //     ]);
        // }

        

        

    }
}
