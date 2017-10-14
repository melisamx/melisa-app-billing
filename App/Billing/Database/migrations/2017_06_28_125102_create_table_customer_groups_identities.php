<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomerGroupsIdentities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerGroupsIdentities', function (Blueprint $table) {            
            $table->uuid('id')->primary();
            $table->uuid('idCustomerGroup');
            $table->uuid('idIdentity');
            $table->uuid('idIdentityCreated');
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->unique([ 'idCustomerGroup', 'idIdentity' ]);
            
            $table->foreign('idCustomerGroup')
                ->references('id')->on('customerGroups')
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
        Schema::dropIfExists('customerGroupsIdentities');
    }
}
