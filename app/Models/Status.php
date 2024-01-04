<?php

namespace App\Models;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = ['no_resi', 'status', 'ket'];

    public function resi()
    {
        return $this->hasMany(Transaksi::class, 'no_resi');
    }
}
