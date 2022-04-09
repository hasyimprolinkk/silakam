<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = "kategori_id";
    protected $fillable = ['kategori'];

    public function lapors()
    {
        return $this->hasMany('\App\Models\Lapor', 'lapor_id');
    }
}
