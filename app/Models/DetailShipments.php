<?php

namespace App\Models;

use App\Models\Shipments;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailShipments extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'ship_id' => 'string',
    ];

    // DetailShipment.php
    public function shipment()
    {
        return $this->belongsTo(Shipments::class, 'ship_id', 'ship_id');
    }

    public function resi() {
        return $this->belongsTo(Transaksi::class, 'no_resi', 'no_resi');
    }
}
