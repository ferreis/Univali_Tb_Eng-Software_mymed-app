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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->unique();
            $table->string('telefone')->nullable();
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->string('endereco');
            $table->string('password');
            $table->text('senha');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('medico', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('usuario')->unique();
            $table->string('crm', 254)->unique();
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('farmaceutico', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('usuario')->unique();
            $table->string('empresa', 254)->unique();
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('paciente', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('usuario')->unique();
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('paciente');
            $table->timestamp('dataConsulta')->index();
            $table->foreign('paciente')->references('id')->on('paciente')->onDelete('cascade');
            $table->index('paciente');
        });

        Schema::create('receita', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('codigoUnico', 32)->unique();
            $table->timestamp('dataEmissao')->index();
            $table->string('tipoEspecial', 254)->nullable();
            $table->string('observacoes', 254)->nullable();
            $table->boolean('resgatada')->default(false);
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->foreign('medico_id')->references('id')->on('medico')->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
            $table->index(['medico_id', 'paciente_id']);
        });

        Schema::create('lembrete', function (Blueprint $table) {
            $table->id();
            $table->string('mensagem');
            $table->dateTime('dataHora')->index();
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->timestamps();
            $table->foreign('medico_id')->references('id')->on('medico')->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
            $table->index(['medico_id', 'paciente_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembrete');
        Schema::dropIfExists('receita');
        Schema::dropIfExists('agenda');
        Schema::dropIfExists('paciente');
        Schema::dropIfExists('farmaceutico');
        Schema::dropIfExists('medico');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
