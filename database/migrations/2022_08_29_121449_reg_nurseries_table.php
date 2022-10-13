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
        Schema::create('reg_nurseries', function (Blueprint $table) {
            $table->id();
            $table->String('nur_name');
            $table->String('nur_own_name');
            $table->String('phone_num')->unique();
            $table->String('email');
            $table->String('web_link');
            $table->String('password');
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
        //
    }
};
