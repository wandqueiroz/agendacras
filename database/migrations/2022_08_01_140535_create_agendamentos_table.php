<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->string('id_beneficiario');
            $table->string('nome');
            $table->string('cpf');
            $table->string('celular');
            $table->string('email');
            $table->string('prioridade');
            $table->string('unidade');
            $table->string('tipo_atendimento');
            $table->string('acao');
            $table->date('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('horario');
            $table->string('realizado');
            $table->string('solucionado');
            $table->string('usuario_atendimento');
            $table->string('ip_atendimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
};
