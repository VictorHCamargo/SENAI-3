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
        Schema::create("fornecedores", function (Blueprint $table) {
            $table->id();
            $table->string("nome_fantasia");
            $table->string("razao_social")->nullable();
            $table->string("cnpj")->unique();
            $table->string("email")->unique();
            $table->string("telefone")->nullable();
            $table->string("categoria"); // Ex: Tecidos, Aviamentos, Maquinário
            $table->text("endereco")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
