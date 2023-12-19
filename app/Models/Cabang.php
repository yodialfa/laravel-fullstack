<?php

namespace App\Models;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cabang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function users()
    {
        return $this->hasMany(Karyawan::class);
    }
}
