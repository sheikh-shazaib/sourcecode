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
        Schema::create('tables_3', function (Blueprint $tables_3) {
            $tables_3->id('table_3_id');
            $tables_3->string('phone_number', 11);
            $tables_3->string('adress', 5);
            $tables_3->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables_3');
    }
};
