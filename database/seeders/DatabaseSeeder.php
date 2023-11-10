<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use App\Models\Karyawan;
use App\Models\City;
use App\Models\District;
use App\Models\Service;
use App\Models\Price;
use App\Models\User;



use Illuminate\Database\Seeder;


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

        Karyawan::create([
            'slug' => '1',
            'nama' => 'Yodi Alfariz',
            'username' => 'admin',
            'tempat_lahir' => 'Bandung',
            'email' => 'test@1gmail.com',
            'tanggal_lahir' => '1995-02-12',
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
            'username' => 'yodialfariz2',
            'tempat_lahir' => 'Bandung',
            'email' => 'test2@gmail.com',
            'tanggal_lahir' => '1995-02-12',
            'alamat' => 'Ciamis'
        ]);
        User::create([
            'username' => 'yodialfariz2',
            'role'=> 'user',
            'password' => bcrypt('aaaaa')
        ]);

        Karyawan::create([
            'slug' => '3',
            'nama' => 'Diaz Grimaldy',
            'username' => 'yodialfariz3',
            'tempat_lahir' => 'Bandung',
            'email' => 'test3@gmail.com',
            'tanggal_lahir' => '1995-02-12',
            'alamat' => 'Cirebon'
        ]);

        User::create([
            'username' => 'yodialfariz3',
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

        // $user = new User();
        // $user->name = 'Admin';
        // $user->email = 'admin@example.com';
        // $user->password = bcrypt('password');
        // $user->role = 'admin'; // Atur peran sebagai admin
        // $user->save();

        

        

    }
}