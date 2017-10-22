<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDebtstopayStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtsToPayStatus', function (Blueprint $table) {
            $table->smallInteger('id')->primary();
            $table->string('name', 75)->unique();
            $table->string('key', 15)->unique();
            
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debtsToPayStatus');
    }
}
