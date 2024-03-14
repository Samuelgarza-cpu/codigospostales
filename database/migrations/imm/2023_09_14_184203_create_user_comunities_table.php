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
        Schema::connection('mysql_imm')->create('user_comunities', function (Blueprint $table) {
            $table->id();
            $table->string('street')->nullable()->default(null);
            $table->integer('number')->nullable()->default(null);
            $table->integer('colonies_id');
            $table->string('zone',2)->nullable()->default(null);
            $table->string('dependece')->nullable()->default(null);
            $table->integer('statebirth')->nullable()->default(null);
            $table->foreignId('user_datageneral_id')->constrained('user_datageneral','id');
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
        Schema::connection('mysql_imm')->dropIfExists('user_comunities');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
  
};
