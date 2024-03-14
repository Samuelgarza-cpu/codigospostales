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
        Schema::connection('mysql_imm')->create('expendents', function (Blueprint $table) {
            $table->id();
            $table->integer('procceding');
            $table->date('date');
            $table->string('psicology');
            $table->string('status_case',2);
            $table->string('name');
            $table->integer('age');
            $table->string('street');
            $table->integer('number');
            $table->string('colonie');
            $table->string('telephone');
            $table->foreignId('procceding_id')->constrained('user_proceedings','id');
            $table->foreignId('type_violences_id')->constrained('expendent_type_violences','id');
            $table->foreignId('motive_closed_id')->nullable()->default(null)->constrained('expendent_motive_closeds','id');
            $table->foreignId('problems_id')->constrained('expendent_problems','id');
            $table->string('diagnostic')->nullable()->default(null);
            $table->date('dateclosed')->nullable()->default(null);

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
        Schema::connection('mysql_imm')->dropIfExists('expendents');
    }
};
