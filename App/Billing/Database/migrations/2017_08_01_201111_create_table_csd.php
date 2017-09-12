<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCsd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csd', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('idIdentityCreated');
            $table->uuid('idFileCer');
            $table->uuid('idFileKey');
            $table->uuid('idFilePem');
            $table->string('number', 20)->unique();
            $table->string('name');
            $table->dateTime('dateExpedition')->nullable();
            $table->dateTime('dateExpiration')->nullable();
            $table->boolean('valid')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->index('number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csd');
    }
}
