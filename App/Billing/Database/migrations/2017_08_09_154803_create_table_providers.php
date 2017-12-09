<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {            
            $table->uuid('id')->primary();
            $table->string('name', 95)->unique();
            $table->string('slug', 150)->unique();
            $table->uuid('idIdentityCreated');
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('accountingAccount', 20)->nullable();
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->index('name');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
