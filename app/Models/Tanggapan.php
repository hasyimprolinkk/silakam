<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $primaryKey = "tanggapan_id";

    protected $fillable = ['lapor_id', 'user_id', 'tanggapan'];

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    public function lapor()
    {
        return $this->belongsTo('\App\Models\Lapor', 'lapor_id');
    }
}
