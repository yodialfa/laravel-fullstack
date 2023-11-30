<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\Service;
use App\Models\District;
// use Illuminate\Foundation\Auth\User;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function userId()
    {
        return $this->belongsTo(User::class, 'employeeId');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'employeeId');
    }

    public function serviceId()
    {
        return $this->belongsTo(Service::class, 'IdLayanan');
    }
    

    public function kotaAsal()
    {
        return $this->belongsTo(City::class, 'IdKotaAsal', 'id');
    }

    public function kotaTujuan()
    {
        return $this->belongsTo(City::class, 'IdKotaTujuan', 'id');
    }

    public function kecAsal()
    {
        return $this->belongsTo(District::class, 'IdKecAsal', 'id');
    }
    public function kecTujuan()
    {
        return $this->belongsTo(District::class, 'IdKecTujuan', 'id');
    }

    public function resi()
    {
        return $this->hasMany(Status::class, 'no_resi', 'no_resi');
    }

    // public function userName()
    // {
    //     return $this->hasMany(User::class, 'employeeId');
    // }

}
