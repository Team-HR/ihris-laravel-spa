<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentPermanentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_permanents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plantilla_permanent_id');
            $table->foreign('plantilla_permanent_id')->references('id')->on('plantilla_permanents');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            // $table->string('sg')->nullable();
            // $table->string('step')->nullable();
            $table->date('date_of_original_appointment')->nullable();
            $table->date('date_of_last_promotion')->nullable();
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
        Schema::dropIfExists('appointment_permanents');
    }
}
