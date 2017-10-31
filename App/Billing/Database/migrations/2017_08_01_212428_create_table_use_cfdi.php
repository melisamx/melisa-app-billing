<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUseCfdi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useCfdi', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->string('key', 3);
            $table->string('description', 90);
            $table->boolean('applyPhysical');
            $table->boolean('applyMoral');
            
            $table->index('key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('useCfdi');
    }
}
