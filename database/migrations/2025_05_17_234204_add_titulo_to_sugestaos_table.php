<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTituloToSugestaosTable extends Migration
{
    public function up()
    {
        Schema::table('sugestaos', function (Blueprint $table) {
            if (!Schema::hasColumn('sugestaos', 'titulo')) {
                $table->string('titulo')->after('id');
            }
            if (!Schema::hasColumn('sugestaos', 'descricao')) {
                $table->text('descricao')->after('titulo');
            }
            if (!Schema::hasColumn('sugestaos', 'ativa')) {
                $table->boolean('ativa')->default(false)->after('descricao');
            }
            if (!Schema::hasColumn('sugestaos', 'autor_id')) {
                $table->unsignedBigInteger('autor_id')->after('ativa');
            }
            if (!Schema::hasColumn('sugestaos', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down()
    {
        Schema::table('sugestaos', function (Blueprint $table) {
            if (Schema::hasColumn('sugestaos', 'titulo')) {
                $table->dropColumn('titulo');
            }
            if (Schema::hasColumn('sugestaos', 'descricao')) {
                $table->dropColumn('descricao');
            }
            if (Schema::hasColumn('sugestaos', 'ativa')) {
                $table->dropColumn('ativa');
            }
            if (Schema::hasColumn('sugestaos', 'autor_id')) {
                $table->dropColumn('autor_id');
            }
            if (Schema::hasColumn('sugestaos', 'created_at')) {
                $table->dropTimestamps();
            }
        });
    }
}
