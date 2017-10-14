<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomersBanksAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customersBanksAccounts', function (Blueprint $table) {            
            $table->uuid('id', 36)->primary();
            $table->uuid('idCustomer');
            $table->smallInteger('idBank');
            $table->smallInteger('idCoin');
            $table->string('account', 150);
            $table->boolean('active')->default(1);
            $table->uuid('idIdentityCreated');
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->unique([ 'idCustomer', 'idBank', 'account' ], 'bank_account_unique');
            
            $table->foreign('idCustomer')
                ->references('id')->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('idBank')
                ->references('id')->on('banks')
                ->onDelete('no action')
                ->onUpdate('cascade');
            
            $table->foreign('idCoin')
                ->references('id')->on('coins')
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customersBanksAccounts');
    }
}
