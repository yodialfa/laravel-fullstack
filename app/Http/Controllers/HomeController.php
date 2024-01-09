<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Service;
use App\Models\District;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        return view('home', [
            "title" => 'Home',
            // "karyawans" => Karyawan::all(),
            "kotaasals" => City::all(),
            "kecasals" => District::all(),
            "kotatujs" => City::all(),
            "kectujs" => District::all(),
            "layanan" => Service::all() 
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'title' => 'Contact',
        ]);
    }
}
