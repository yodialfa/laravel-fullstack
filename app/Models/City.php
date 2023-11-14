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

    // In City model
    public function scopeGetAll($query, $perPage = 10)
    {
        return $query->paginate($perPage);
    }

    public function scopeFilters($query, array $filters)
    {
        // dd($filters); 
        $query->when($filters['search'], function ($query, $search) {
                // dd('Search parameter:', $search);
            return $query->where('Namakota', 'like', '%' . $search . '%');       
        });

    }

}

