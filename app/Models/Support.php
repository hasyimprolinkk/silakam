<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $primaryKey = "support_id";
    protected $fillable = ['lapor_id', 'support_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    public function lapor()
    {
        return $this->belongsTo('\App\Models\Lapor', 'lapor_id');
    }
}
