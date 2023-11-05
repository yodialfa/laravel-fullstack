<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'Prices';
    // protected $fillable = ['IdKotaAsal', 'IdKecAsal', 'IdKotaTujuan', 'IdKectujuan', 'IdLayanan', 'Harga'];
    protected $guarded = ['id'];

    public function cityFrom()
    {
        return $this->belongsTo(City::class, 'IdKotaAsal');
    }

    public function districtFrom()
    {
        return $this->belongsTo(District::class, 'IdKecAsal');
    }

    public function cityTo()
    {
        return $this->belongsTo(City::class, 'IdKotaTujuan');
    }

    public function districtTo()
    {
        return $this->belongsTo(District::class, 'IdKecTujuan');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'IdLayanan');
    }
}

