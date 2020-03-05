<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaPermanent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_permanent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('office_id')->unsigned();
            $table->string('item_number');
            $table->string('position_title');
            $table->string('functional_title')->nullable();
            $table->string('status');
            $table->integer('salary_grade');
            $table->integer('step');
            $table->float('auth_salary', 10, 2)->nullable();
            $table->float('annual_salary', 10, 2)->nullable();
            $table->float('monthly_salary', 10, 2)->nullable();
            $table->string('classification');
            $table->string('region_code');
            $table->string('area_type')->nullable();
            $table->string('level')->nullable();
            // $table->bigInteger('employee_id')->unsigned();
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
        Schema::dropIfExists('plantilla_permanent');
    }
}
