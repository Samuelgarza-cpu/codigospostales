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
        Schema::connection('mysql_imm')->create('capture_activities', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('location');
            $table->string('activities');
            $table->string('organization');
            $table->string('colaboration');
            $table->string('comunity');
            $table->foreignId('axi_id')->constrained('axis','id');
            $table->foreignId('axi_program_id')->constrained('axisprograms','id');
            $table->string('description');
            $table->string('observations');
            $table->boolean('active')->default(true);
            $table->dateTime('deleted_at')->nullable();
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
        Schema::connection('mysql_imm')->dropIfExists('capture_activities');
    }
};
