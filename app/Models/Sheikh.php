<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sheikh extends Authenticatable
{
    use HasFactory;
    protected $fillable=[
        'firstname',
        'lastname',
        'email',
        'phone',
        'gender',
        'username',
        'password',
        'image',
        'country',
        'faculty',
        'title',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    function getSheikh(){
        return $this->hasOne('App\Models\Sheikh','type');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

