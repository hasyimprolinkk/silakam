<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $primaryKey = "alamat_id";
    protected $fillable = ['alamat'];

    public function users()
    {
        return $this->hasMany('\App\Models\User', 'alamat_id');
    }
}
