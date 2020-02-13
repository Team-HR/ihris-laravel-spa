<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasualAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casual_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employees_id')->unsigned();
            $table->string('position_title');
            $table->string('sg');
            $table->float('daily_wage', 10, 2);
            $table->string('from_date');
            $table->string('to_date')->nullable();
            $table->string('nature_of_appointment');
            $table->string('office');
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
        Schema::dropIfExists('casual_appointments');
    }
}