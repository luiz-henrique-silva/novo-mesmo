<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitations', function (Blueprint $table) { // Nome da tabela no plural
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('data_inicio')->nullable();
            $table->date('data_final')->nullable();
            $table->text('integrantes')->nullable();
            $table->unsignedBigInteger('curso_id')->nullable();
            $table->unsignedBigInteger('professor_orientador_id')->nullable();
            $table->string('link_github')->nullable();
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente'); // Adicionando opções de status
            $table->string('documento')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitations');
    }
};
