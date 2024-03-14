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
        Schema::connection('mysql_imm')->create('user_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_datageneral_id')->constrained('user_datageneral','id');
            // $table->foreignId('workplace_id')->constrained('workplaces','id');
            $table->string('subservice');
            $table->foreignId('axi_id')->constrained('axis','id');
            $table->foreignId('axi_program_id')->constrained('axisprograms','id');
            $table->string('lineacction');
            $table->string('observations');
            $table->foreignId('status_id')->constrained('status','id');
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
        Schema::connection('mysql_imm')->dropIfExists('user_services');
    }
};
