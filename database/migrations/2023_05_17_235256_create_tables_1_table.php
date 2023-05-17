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
        Schema::create('tables_1', function (Blueprint $table_1) {
            $table_1->id('id');
            $table_1->string('name', 255);
            $table_1->string('email', 255);
            $table_1->unsignedBigInteger('table_2_id');
            $table_1->foreign('table_2_id')->references('table_2_id')->on('tables_2');
            $table_1->unsignedBigInteger('table_3_id');
            $table_1->foreign('table_3_id')->references('table_3_id')->on('tables_3');
            $table_1->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables_1');
    }
};
