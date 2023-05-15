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
        Schema::create('api_login_employees', function (Blueprint $api_login) {
            // $table->id();
            $api_login->id('api_login_employee_id');
            $api_login->unsignedBigInteger('customer_id');
            $api_login->foreign('customer_id')->references('customer_id')->on('sourceemployees');
            $api_login->string('token_id');
            $api_login->date('employee_login_time');
            $api_login->integer('api_status');
            $api_login->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_login_employees');
    }
};
