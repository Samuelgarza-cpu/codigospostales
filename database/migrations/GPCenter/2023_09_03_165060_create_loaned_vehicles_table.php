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
        Schema::connection('mysql_gp_center')->create('loaned_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requesting_user_id')->constrained('users','id');
            $table->text('reason')->nullable()->comment('motivo del prestamo de la unidad');
            $table->decimal('initial_km',10,2);
            $table->dateTime('loan_date');
            $table->boolean('active_loan')->default(true)->comment('prestamo activo');
            $table->decimal('delivery_km',10,2)->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->boolean('active')->default(true)->comment('registro activo');
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
        Schema::connection('mysql_gp_center')->dropIfExists('loaned_vehicles');
    }
};
