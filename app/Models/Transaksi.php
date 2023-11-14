<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id','no_resi'];

    public function userId()
    {
        return $this->belongsTo(User::class);
    }
}
