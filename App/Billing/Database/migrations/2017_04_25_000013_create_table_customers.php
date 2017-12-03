<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {            
            $table->uuid('id')->primary();
            $table->uuid('idRepository');
            $table->unsignedInteger('idContributor');
            $table->smallInteger('idWaytopay');
            $table->uuid('idIdentityCreated');
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->unique([
                'idRepository',
                'idContributor'
            ]);
            
            $table->foreign('idRepository')
                ->references('id')->on('repositories')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('idContributor')
                ->references('id')->on('contributors')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('idWaytopay')
                ->references('id')->on('waytopay')
                ->onDelete('no action')
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
        Schema::dropIfExists('customers');
    }
}
