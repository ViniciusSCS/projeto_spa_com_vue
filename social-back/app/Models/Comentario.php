<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data',
        'texto',
        'conteudo_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conteudo()
    {
        return $this->belongsTo(Conteudo::class);
    }

    public function getDataAttribute($value)
    {
        $data = date('H:i d/m/Y', strtotime($value));
        $ajusteData =  str_replace(':', 'h', $data);
        return $ajusteData;
    }


}
