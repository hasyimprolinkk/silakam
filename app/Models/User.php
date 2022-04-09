<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "user_id";
    
    protected $fillable = [
        'nik', 
        'nama', 
        'jk',
        'alamat_id', 
        'no_hp', 
        'jabatan', 
        'avatar',
        'roles', 
        'is_active', 
        'chat_id_bot', 
        'username', 
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'username',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];


    public function lapors()
    {
        return $this->hasMany('\App\Models\Lapor', 'user_id');
    }

    public function tanggapans()
    {
        return $this->hasMany('\App\Models\Tanggapan', 'user_id');
    }

    public function supports()
    {
        return $this->hasMany('\App\Models\Support');
    }

    public function alamat()
    {
        return $this->belongsTo('\App\Models\Alamat', 'alamat_id');
    }
}
