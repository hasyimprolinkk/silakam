<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'keterangan', 'image', 'kategori_id', 'is_public','status', 'petugas_id'
    ];

    protected $primaryKey = "lapor_id";

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_id', 'user_id');
    }

    public function petugas()
    {
        return $this->belongsTo('\App\Models\User', 'petugas_id', 'user_id');
    }

    public function supports()
    {
        return $this->hasMany('\App\Models\Support', 'lapor_id');
    }

    public function tanggapans()
    {
        return $this->hasMany('\App\Models\Tanggapan', 'lapor_id');
    }

    public function kategori()
    {
        return $this->belongsTo('\App\Models\Kategori', 'kategori_id', 'kategori_id');
    }
}
