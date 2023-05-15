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
        Schema::create('employee_leave', function (Blueprint $employee_leave) {
            $employee_leave->id('leave_id');
            $employee_leave->integer('leave_customer_id');
            $employee_leave->integer('annual_leave');
            $employee_leave->integer('casual_leave');
            $employee_leave->integer('sick_leave');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_leave');
    }
};
