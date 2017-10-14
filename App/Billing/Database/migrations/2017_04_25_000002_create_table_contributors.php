<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContributors extends Migration
{
    /**
     * Run the migrations.
     * @table contributors
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributors', function (Blueprint $table) {            
            $table->increments('id');
            $table->uuid('idIdentityCreated');            
            $table->string('rfc', 13);
            $table->string('name', 150);
            $table->boolean('active')->default(1);            
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            $table->string('email', 95)->nullable();
            
            $table->index('rfc');
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
        Schema::dropIfExists('contributors');
    }
}
