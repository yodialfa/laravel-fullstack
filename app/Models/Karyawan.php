<?php

namespace App\Models;



use App\Models\User;
use App\Models\Cabang;
use App\Models\Agen;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id', 'id');
    }

    public function agen()
    {
        return $this->belongsTo(Agen::class, 'agen_id', 'id');
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
