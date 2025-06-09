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
        Schema::create('receita', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // codigo precisa ser unico para busca rápida por parte da farmácia
            $table->string('codigoUnico', 32)->unique();
            $table->timestamp('dataEmissao')->index();
            $table->string('tipoEspecial', 254)->nullable();
            $table->string('observacoes', 254)->nullable();
            $table->boolean('resgatada')->default(false);

            $table->unsignedBigInteger('medico_id')->nullable();  // Relacionamento com o médico
            $table->unsignedBigInteger('paciente_id')->nullable(); // Relacionamento com o paciente

            // Chaves estrangeiras com índice para melhorar performance
            $table->foreign('medico_id')
                  ->references('id')
                  ->on('medico')
                  ->onDelete('cascade');
            $table->foreign('paciente_id')
                  ->references('id')
                  ->on('paciente')
                  ->onDelete('cascade');
            $table->index(['medico_id', 'paciente_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receita');
    }
};
