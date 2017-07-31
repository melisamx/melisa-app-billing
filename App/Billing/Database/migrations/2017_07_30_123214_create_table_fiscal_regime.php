<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFiscalRegime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiscalRegime', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->smallInteger('key')->unique();
            $table->string('name', 80)->unique();
            $table->boolean('physical');
            $table->boolean('moral');
            
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
        Schema::dropIfExists('fiscalRegime');
    }
}
