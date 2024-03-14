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
        Schema::connection('mysql_imm')->create('user_violence_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_violences_id')->constrained('user_violences','id');
            $table->foreignId('typesviolence_id')->constrained('typesviolences','id');
            $table->foreignId('fieldsviolence_id')->constrained('fieldsviolences','id');
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
        Schema::connection('mysql_imm')->dropIfExists('user_violence_fields');
    }
};
