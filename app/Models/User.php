<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail // <--- this
{
    use HasApiTokens, HasFactory, Notifiable;

    /*
     * Laravel'de, Category ve User modelleri arasında ilişki kurulu olduğunu varsayarsak
     * ve seller_id sütunu users tablosundaki id sütunuyla ilişkilendiriliyorsa, giriş yapan kullanıcının
     * seller_id değerine sahip olan kategorileri bu fonksiyonla alabilirsiniz:
     */
    public function seller_categories()
    {
        return $this->hasMany(Categories::class, 'seller_id', 'id');
    }
    public function seller_product()
    {
        return $this->hasMany(Products::class, 'seller_id', 'id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
