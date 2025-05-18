<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'ativa',
        'autor_id',  
    ];


    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    public function isAtiva()
    {
        return $this->ativa;
    }
}
