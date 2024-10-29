<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título do projeto
            $table->text('description'); // Descrição do projeto
            $table->date('data_inicio')->nullable(); // Data de início
            $table->date('data_final')->nullable(); // Data final
            $table->text('integrantes')->nullable(); // Integrantes
            $table->unsignedBigInteger('curso_id')->nullable(); // ID do curso
            $table->unsignedBigInteger('professor_orientador_id')->nullable(); // ID do professor orientador
            $table->string('link_github')->nullable(); // Link do GitHub
            $table->enum('status', ['pendente', 'aprovado'])->default('pendente'); // Status
            $table->string('documento')->nullable(); // Documento (S/N)
            $table->unsignedBigInteger('user_id'); // Aluno que enviou o projeto
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('projects', function (Blueprint $table) {
//             $table->id();
//             $table->string('title');
//             $table->text('description');
//             $table->unsignedBigInteger('user_id'); // Aluno que enviou o projeto
//             $table->enum('status', ['pendente', 'aprovado'])->default('pendente');
//             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//             $table->timestamps();
//         });
        
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('projects');
//     }
// };