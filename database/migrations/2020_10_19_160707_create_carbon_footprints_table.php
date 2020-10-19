<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarbonFootprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carbon_footprints', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('activity');
            $table->string('activity_type');
            $table->string('country');
            $table->string('mode');
            $table->float('carbon_footprint', 8, 2);
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
        Schema::dropIfExists('carbon_footprints');
    }
}
