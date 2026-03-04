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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');

            $table->string('numero_pedido')->unique();
            $table->text('descricao_itens'); 
            
            $table->decimal('valor_total', 10, 2)->default(0.00);
            $table->decimal('entrada', 10, 2)->default(0.00); 

            $table->enum('status', ['pendente', 'em_producao', 'finalizado', 'entregue', 'cancelado'])
                ->default('pendente');
            $table->date('data_entrega_prevista')->nullable();
            $table->date('data_entrega_realizada')->nullable();

            $table->text('observacoes')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
