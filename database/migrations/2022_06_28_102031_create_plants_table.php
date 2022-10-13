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
        // this is the migration or the plantsss one?
        //this one is actual migration.
        // ok 
        // migration is ok now.
        //now there is no need to run command php artisan migrate bcz before it has almost 7 columns now is 16..
        // yes 
        //so can i run that command?
        // other tables if has data then its data is removed.
        // i tell the command you can run single migration 
        //okay.
        // now the table is deleted.
        // /php artisan migrate --path=/database/migrations/2022_06_28_102031_create_plants_table.php
        // ok?
        // all done ok?
        //yes....it's great
        // if you can't understand lemme now

        // two things here......
        // 1. the api callback url you can directly use in your frontend form
        // (you use guzzle to consume the API) thats the wrong way...
        // use that API route directly or use javascript to consume the API.
        // what you are doing is totally wrong way.

        //okay..actually i follow the youtube tutorial that why i do work like that.

        // uff youtube .....
        // the purpose of API is you can you it from any platform.....
        // that why i told you earlier that you frontend project not be in laravel...
        // these 2 things confuse you very much....

        //yes you are right...now i am not do to tranfer my whole project into some othern platform...bcz i told you earlier my mids date is schedule soon and i wanna see my project progress.
        //and some issue are arising. one of the big one is the insertion API integration.

        // ok then the solution is use API route directly in your frontend form....
        // like this-----url{{('/some url of API route)}} ........??

        Schema::create('plants', function (Blueprint $table) {
            $table->id();

            $table->String('common_name')->nullable();
            $table->String('botanical_name')->nullable();

            $table->Text('plant_description')->nullable();
            $table->String('temperature')->nullable();

            $table->String('humidity')->nullable();
            $table->String('soil_ph')->nullable();

            $table->String('nitrogen')->nullable();
            $table->String('phosphorus')->nullable();

            $table->String('potassium')->nullable();
            $table->String('plant_type')->nullable();

            $table->mediumText('plant_image')->nullable();
            $table->String('max_temperature')->nullable();

            $table->String('max_humidity')->nullable();
            $table->String('max_soil_ph')->nullable();

            $table->String('min_light')->nullable();
            $table->String('max_light')->nullable();

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
        Schema::dropIfExists('plants');
    }
};
