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
        Schema::create('user_diseases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_datageneral_id')->constrained('user_datageneral','id');
            $table->foreignId('diseas_id')->constrained('diseases','id');
            $table->foreignId('origin_id')->constrained('origins','id');
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
        Schema::connection('mysql_imm')->dropIfExists('user_diseases');
    }
};
