<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("nome_completo");
            $table->string('email')->unique();
            $table->char('cpf', 11);
            $table->char('telefone', 11);
            $table->integer('tipo_usuario');
            $table->date('nascimento');
            $table->text('foto_documento');
            $table->text('foto_usuario')->nullable();
            $table->string('chave_pix')->unique();
            $table->integer('reputacao')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
