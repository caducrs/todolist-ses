<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarefasTable extends Migration
{
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->uuid('id')->primary();
//Quem criou
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade');
//Data de inicio
            $table->timestamp('started_at')->nullable();
//Periodo que acaba             
            $table->timestamp('deadline')->nullable();

            $table->enum('status', ['pendente', 'em andamento', 'não feita'])->default('pendente');

            $table->text('descricao');

            $table->string('titulo');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
}
