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
        Schema::create('try_catch_db', function (Blueprint $error_get) {
            $error_get->id('error_get_id');
            $error_get->unsignedBigInteger('customer_id');
            $error_get->foreign('customer_id')->references('customer_id')->on('sourceemployees');
            $error_get->string('page_name');
            $error_get->string('error_get_message');
            $error_get->string('error_get_file');
            $error_get->string('error_get_line');
            $error_get->string('error_get_code');
            $error_get->string('error_get_time');
            $error_get->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('try_catch_db');
    }
};
