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
        Schema::connection('mysql_imm')->create('user_workshops', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('location');
            $table->string('agent');
            $table->string('colaboration');
            $table->string('ponent');
            $table->string('issue');
            $table->foreignId('user_datageneral_id')->constrained('user_datageneral','id');
            $table->foreignId('axi_id')->constrained('axis','id');
            $table->foreignId('axi_program_id')->constrained('axisprograms','id');
            $table->string('observations');
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
        Schema::connection('mysql_imm')->dropIfExists('user_workshops');
    }
};
