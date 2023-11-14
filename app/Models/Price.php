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

    public function scopeFilters($query, array $filters)
    {

        // $query->when($filters['search-asal'] ?? false, function ($query , 
        // dd($filters); 
        $query->when($filters['search-asal'], function ($query, $searchAsal) {
            if ($searchAsal) {
                // dd('Search parameter:', $searchAsal);
                $query->whereHas('cityFrom', function ($query) use ($searchAsal) {
                    $query->where('NamaKota', 'like', '%' . $searchAsal . '%');
                })->orWhereHas('districtFrom', function ($query) use ($searchAsal) {
                    $query->where('NamaKecamatan', 'like', '%' . $searchAsal . '%');
                });
            }
        });

        $query->when($filters['search-tujuan'], function ($query, $searchTujuan) {
            if ($searchTujuan) {
                // dd('Search parameter:', $searchTujuan);
                $query->whereHas('cityTo', function ($query) use ($searchTujuan) {
                    $query->where('NamaKota', 'like', '%' . $searchTujuan . '%');
                })->orWhereHas('districtTo', function ($query) use ($searchTujuan) {
                    $query->where('NamaKecamatan', 'like', '%' . $searchTujuan . '%');
                });
            }
        });
    }

}

