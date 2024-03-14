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
        Schema::create('expendent_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expendents_id')->constrained('expendents','id');
            $table->date('date');
            $table->integer('came');
            $table->string('comment');

            $table->timestamps();
        });
    }

    /**  formcontrolname:"sessiondate1",
   
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expendent_sessions');
    }
};
