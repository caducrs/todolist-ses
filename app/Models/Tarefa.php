<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    // Indica que o ID é string e não incrementa automaticamente

    public $incrementing = false;
    protected $keyType = 'string';

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['id', 'autor_id', 'started_at', 'deadline', 'status', 'descricao', 'titulo'];

    // Relacionamento com o usuário autor da tarefa
    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }
}
