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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedores');
            $table->string('item'); 
            $table->string('unidade_medida'); 
            $table->decimal('quantidade_atual', 10, 2)->default(0);
            $table->decimal('quantidade_minima', 10, 2)->default(0);
            $table->decimal('valor_unitario', 10, 2);
            $table->string('localizacao')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
