<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResiSelesai extends Model
{
    protected $table = 'resiselesai'; // Ensure the correct table name is specified here
    
    protected $primaryKey = 'no_resi';
    public $incrementing = false;

    use HasFactory;
    protected $guarded = ['id'];
    

    public function resi()
    {
        return $this->belongsTo(Transaksi::class, 'no_resi', 'no_resi');
    }

    public function status_resi()
    {
        return $this->belongsTo(Status::class, 'no_resi', 'no_resi');
    }

}

