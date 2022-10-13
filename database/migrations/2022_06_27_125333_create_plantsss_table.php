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
        Schema::create('plantsss', function (Blueprint $table) {
            $table->id();
            $table->String('common_name');
            $table->String('botanical_name');
            $table->Text('plant_description');
            $table->String('temperature');
            $table->String('humidity');
            $table->String('soil_ph');
            $table->String('nitrogen');
            $table->String('phosphorus');
            $table->String('potassium');
            $table->String('plant_type');
            $table->mediumText('plant_image');
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
        Schema::dropIfExists('plantsss');
    }
};
