<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContributorsAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributorsAddresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idContributor');
            $table->uuid('idIdentityCreated');
            $table->smallInteger('idCountry');
            $table->smallInteger('idState');
            $table->smallInteger('idMunicipality');
            $table->string('address', 250);
            $table->string('colony', 150);
            $table->string('postalCode', 10);
            $table->integer('exteriorNumber');
            $table->boolean('active')->default(1); 
            $table->boolean('isDefault')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('accountingAccount', 20)->nullable();
            $table->integer('interiorNumber')->nullable();
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->foreign('idContributor')
                ->references('id')->on('contributors')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributorsAddresses');
    }
}
