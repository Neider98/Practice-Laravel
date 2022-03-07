<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access', function (Blueprint $table) {
            $table->increments('id')
                ->comment('id');
            $table->string('token', 500)
                ->comment('token');
            $table->string('user_agent', 200)
                ->comment('agente usuario');
            $table->string('ip_access', 200)
                ->comment('ip de acceso');
            $table->integer('user_id')
                ->comment('id de usuario');
            $table->tinyInteger('active')
                ->comment('activo')
                ->default('1');
            $table->timestamp('exit_date')
                ->comment('fecha de salida')
                ->nullable();
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
        Schema::dropIfExists('access');
    }
}
