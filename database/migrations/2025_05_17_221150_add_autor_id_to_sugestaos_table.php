<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sugestaos', function (Blueprint $table) {
            $table->unsignedBigInteger('autor_id')->nullable()->after('id');

            // Se quiser fazer relação com a tabela users:
            $table->foreign('autor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('sugestaos', function (Blueprint $table) {
            $table->dropForeign(['autor_id']);
            $table->dropColumn('autor_id');
        });
    }
};
