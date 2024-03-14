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
        Schema::connection('mysql_imm')->create('user_violences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_datageneral_id')->constrained('user_datageneral','id');
            // $table->foreignId('typesviolence_id')->constrained('typesviolences','id');
            // $table->foreignId('fieldsviolence_id')->constrained('fieldsviolences','id');
            $table->string('lowefecct');
            $table->string('narrationfacts');
            $table->date('date');
            $table->string('location');
            $table->foreignId('addiction_id')->constrained('addictions','id');
            $table->string('weapons',1);
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
        Schema::connection('mysql_imm')->dropIfExists('user_violences');
    }
};
