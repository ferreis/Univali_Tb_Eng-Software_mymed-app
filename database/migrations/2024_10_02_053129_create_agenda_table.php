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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('paciente');
            $table->timestamp('dataConsulta')->index();

            // index improves search by paciente id and guarantees performance on
            // PostgreSQL as well
            $table->foreign('paciente')
                  ->references('id')
                  ->on('paciente')
                  ->onDelete('cascade');
            $table->index('paciente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
