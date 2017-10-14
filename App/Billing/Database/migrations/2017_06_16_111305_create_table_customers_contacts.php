<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomersContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customersContacts', function (Blueprint $table) {            
            $table->uuid('id')->primary();
            $table->uuid('idCustomer');
            $table->uuid('idPeople');
            $table->boolean('active')->default(1);
            $table->uuid('idIdentityCreated');
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->unique([ 'idCustomer', 'idPeople' ], 'contact_unique');
            
            $table->foreign('idCustomer')
                ->references('id')->on('customers')
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
        Schema::dropIfExists('customersContacts');
    }
}
