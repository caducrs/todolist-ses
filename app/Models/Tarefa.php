<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['id', 'autor_id', 'started_at', 'deadline', 'status', 'descricao', 'titulo'];

    protected $casts = [
        'started_at' => 'datetime',
        'deadline' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relacionamento com o usuário autor da tarefa
    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }
}
