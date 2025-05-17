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
    ];


    public function isAtiva()
    {
        return $this->ativa;
    }
}
