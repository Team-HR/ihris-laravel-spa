<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaPermanentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_permanents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_no');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->string('position_title');
            $table->string('functional_title')->nullable();
            $table->string('level')->nullable();
            $table->integer('salary_grade');
            $table->float('authorized_salary', 10, 2)->nullable();
            $table->float('actual_salary', 10, 2)->nullable();
            $table->integer('step');
            $table->string('region_code');
            $table->string('area_type');
            $table->string('category')->nullable();
            $table->string('classification')->nullable();
            $table->bigInteger('appointed_to')->unsigned()->nullable();
            // $table->foreign('appointed_to')->references('id')->on('appointment_permanents')->onDelete('cascade');
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
        Schema::dropIfExists('plantilla_permanents');
    }
}
