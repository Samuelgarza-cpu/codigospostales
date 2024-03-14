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
        Schema::connection('mysql_imm')->create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_violence')->nullable()->default(null);
            $table->foreignId('user_datageneral_id')->constrained('user_datageneral','id');
            $table->foreignId('activity_id')->constrained('activities','id');
            $table->string('sourceofincome',1);
            $table->foreignId('workplace_id')->constrained('workplaces','id');
            $table->time('entry_time');
            $table->time('departure_time');
            $table->foreignId('training_id')->nullable()->default(null)->constrained('trainings','id');
            $table->string('finish',1)->nullable()->default(null);
            $table->string('wantofindwork',1)->nullable()->default(null);
            $table->string('wanttotrain',1)->nullable()->default(null);
            $table->string('wantocontinuestudying',1)->nullable()->default(null);
            $table->string('caseviolence',1)->nullable()->default(null);
            $table->foreignId('household_id')->constrained('households','id');
             
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
        Schema::connection('mysql_imm')->dropIfExists('user_profiles');
    }
};
