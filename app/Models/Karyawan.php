<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Karyawan extends Model
{
    use HasFactory;
    //menggunakan sluggable dari cviebrock
    use Sluggable;
    // protected $fillable = ['nama','tanggal_lahir', 'alamat'];
    protected $guarded = ['id'];

    // Definisi relasi one-to-one dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    //scoope untuk searching
    public function scopeFilters($query, array $filters)
    {
        // dd($filters); // Check if the search parameter is reaching here

        $query->when($filters['search'] ?? false, function ($query , $search) {
            // dd('Search parameter:', $search);
            return $query->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('username', 'like', '%' . $search . '%');
        }); 
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'id'
            ]
        ];
    }

}
