<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoins extends Migration
{
    /**
     * Run the migrations.
     * @table coins
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {            
            $table->smallInteger('id', true);
            $table->string('name', 150);
            $table->string('shortName', 3);
            
            $table->unique(['name', 'shortName']);
            $table->index('name');
            $table->index('shortName');
            $table->index(['name', 'shortName']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
