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
        Schema::connection('mysql_gomezapp')->create('asuntos', function (Blueprint $table) {
            $table->id();
            $table->string('asunto');
            $table->string('bg_circle');
            $table->string('bg_card');
            $table->string('icono');
            $table->boolean('letter_black');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_gomezapp')->dropIfExists('asuntos');
    }
};
