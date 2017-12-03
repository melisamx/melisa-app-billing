<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateTableDebtstopay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtsToPay', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('idDebtsToPayStatus');
            $table->unsignedInteger('idAccountingAccount');
            $table->uuid('idIdentityCreated');
            $table->uuid('idFileVoucher');
            $table->uuid('idInvoice')->nullable();
            $table->decimal('amountPayable', 15, 2);
            $table->dateTime('dateVoucher');            
            $table->dateTime('dueDate')->nullable();            
            $table->dateTime('paymentDate')->nullable();            
            $table->boolean('expiredDate')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->uuid('idFilePayment')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->foreign('idDebtsToPayStatus')
                ->references('id')->on('debtsToPayStatus')
                ->onDelete('no action')
                ->onUpdate('no action');            
            $table->foreign('idAccountingAccount')
                ->references('id')->on('accountingAccounts')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $db = DB::connection('drive')->getDatabaseName();
            
            $table->foreign('idFileVoucher')
                ->references('id')->on(new Expression("$db.files"))
                ->onDelete('no action')
                ->onUpdate('no action');            
            $table->foreign('idFilePayment')
                ->references('id')->on(new Expression("$db.files"))
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
        Schema::dropIfExists('debtsToPay');
    }
}
