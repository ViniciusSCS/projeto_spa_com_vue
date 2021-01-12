<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data',
        'link',
        'texto',
        'imagem',
    ];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curtidas()
    {
        return $this->belongsToMany(User::class, 'curtidas', 'conteudo_id', 'user_id');
    }
}
