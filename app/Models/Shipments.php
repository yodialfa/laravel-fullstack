<?php

namespace App\Models;

use App\Models\Agen;
use App\Models\Cabang;

use App\Models\District;
use App\Models\DetailShipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipments extends Model
{
    use HasFactory;

    protected $primaryKey = 'ship_id';
    public $incrementing = false;

    protected $guarded = ['id'];
    protected $casts = [
        'ship_id' => 'string',
    ];


    public function detailShipments()
    {
        return $this->hasMany(DetailShipments::class, 'ship_id', 'ship_id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id', 'id');
    }

    public function cabangTujuan()
    {
        return $this->belongsTo(Cabang::class, 'tujuan', 'id');
    }

    public function agen()
    {
        return $this->belongsTo(Agen::class, 'agen_id', 'id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'no_resi', 'no_resi');
    }

    public function kecTujuanPengantaran()
    {
        return $this->belongsTo(District::class, 'kecTujuan', 'id');
    }

}
