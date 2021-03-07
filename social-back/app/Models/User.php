<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'imagem',
        'password',
        'description_user',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function conteudos()
    {
        return $this->hasMany(Conteudo::class);
//        return $this->hasMany(Conteudo::class, 'user_id', 'id');
    }

    public function curtidas()
    {
        return $this->belongsToMany(Conteudo::class, 'curtidas', 'user_id', 'conteudo_id');
    }

    public function amigos()
    {
        return $this->belongsToMany(User::class, 'amigos', 'user_id', 'amigo_id');
    }

    public function seguidores()
    {
        return $this->belongsToMany(User::class, 'amigos', 'amigo_id', 'user_id');
    }

    public function getImagemAttribute($value)
    {
        return asset($value);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
