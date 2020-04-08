<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('ext_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('tin')->nullable();
            // $table->string('gender');
            // $table->string('status')->nullable();
            // $table->string('employment_status')->nullable();
            // $table->bigInteger('department_id')->unsigned();
            // $table->bigInteger('section_id')->unsigned();
            // $table->bigInteger('position_id')->unsigned();
            // $table->bigInteger('function_id')->unsigned();
            // $table->string('rank_of_ass');
            // $table->string('date_activated')->nullable();
            // $table->string('date_deactivated')->nullable();
            // $table->string('date_ipcr')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
