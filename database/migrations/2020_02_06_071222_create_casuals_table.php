<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('ext_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('position_title');
            $table->string('sg');
            $table->float('daily_wage', 8, 2);
            $table->string('from_date');
            $table->string('to_date');
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
        Schema::dropIfExists('casuals');
    }
}
