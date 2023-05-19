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
        Schema::create('sourceemployees', function (Blueprint $table) {
            $table->id('customer_id');
            // $table->id('customer_id')->start(0000);
            $table->string('customer_code');
            $table->string('customer_image');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('department_id')->on('tbl_departments');
            $table->unsignedBigInteger('designation_id');
            $table->foreign('designation_id')->references('designation_id')->on('tbl_designations');
            $table->string('customer_country');
            $table->string('customer_password');
            $table->integer('customer_phone');
            $table->integer('customer_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sourceemployees');
    }
};
