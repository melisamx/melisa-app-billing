<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {            
            $table->smallInteger('id', true);
            $table->string('key', 3)->unique();
            $table->string('shortname', 75);
            $table->string('name', 200)->unique();
            $table->boolean('active')->default(1);
            
            $table->index('key');
            $table->index('shortname');
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
        Schema::dropIfExists('banks');
    }
}
