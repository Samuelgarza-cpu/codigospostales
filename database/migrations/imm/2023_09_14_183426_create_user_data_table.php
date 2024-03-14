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
        Schema::connection('mysql_imm')->create('user_datageneral', function (Blueprint $table) {
            $table->id();
            $table->integer('user_violence')->nullable()->default(null);
            $table->string('name');
            $table->string('lastName');
            $table->string('secondName');
            $table->string('sex',2);
            $table->foreignId('gender_id')->nullable()->default(null)->constrained('genders','id');
            $table->date('birthdate')->nullable();
            $table->integer('age')->nullable();
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->foreignId('civil_status_id')->nullable()->default(null)->constrained('civil_status', 'id');
            $table->integer('numberchildrens')->nullable();
            $table->integer('numberdaughters')->nullable();
            $table->string('pregnant',2)->nullable();
            $table->integer('module');
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
        Schema::connection('mysql_imm')->dropIfExists('user_datageneral');
    }
};
