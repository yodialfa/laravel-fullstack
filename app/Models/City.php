<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'Cities';
    protected $fillable = ['NamaKota'];

    public function districts()
    {
        return $this->hasMany(District::class, 'IdCities');
    }
}

