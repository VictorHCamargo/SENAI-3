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
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->id();

            $table->string('razao_social');
            $table->string('nome_fantasia')->nullable();
            $table->string('documento')->unique()->index();
            $table->string('inscricao_estadual')->nullable();

            $table->string('email')->nullable();
            $table->string('telefone(WhatsApp)')->nullable();

            $table->string("endereco")->nullable();

            $table->enum('tipo_material', ['tecidos', 'aviamentos', 'servicos', 'maquinario', 'outros'])->default('outros');

            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedors');
    }
};
