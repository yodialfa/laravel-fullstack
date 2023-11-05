<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'Districts';
    protected $fillable = ['NamaKecamatan','IdCities'];

    public function city()
    {
        return $this->belongsTo(City::class, 'IdCities');
    }

    public function pricesFrom()
    {
        return $this->hasMany(Price::class, 'IdKecAsal');
    }

    public function pricesTo()
    {
        return $this->hasMany(Price::class, 'IdKecTujuan');
    }
}

