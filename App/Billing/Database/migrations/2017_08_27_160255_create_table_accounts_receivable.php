<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateTableAccountsReceivable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountsReceivable', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('idAccountReceivableStatus');
            $table->uuid('idIdentityCreated');
            $table->decimal('amountCharged', 15, 2);
            $table->decimal('balance', 15, 2);
            $table->dateTime('dateVoucher');
            $table->boolean('expiredDate')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idInvoice')->nullable();
            $table->uuid('idReferralNote')->nullable();
            $table->unsignedInteger('idAccountingAccount')->nullable();
            $table->unsignedInteger('idBankAccount')->nullable();
            $table->smallInteger('idPaymentMethod')->nullable();
            $table->uuid('idIdentityUpdated')->nullable();
            $table->uuid('idFileVoucher')->nullable();
            $table->dateTime('updatedAt')->nullable();
            $table->dateTime('receivableDate')->nullable();
            $table->dateTime('dueDate')->nullable();
            
            $table->foreign('idAccountReceivableStatus')
                ->references('id')->on('accountsReceivableStatus')
                ->onDelete('no action')
                ->onUpdate('no action');            
            $table->foreign('idAccountingAccount')
                ->references('id')->on('accountingAccounts')
                ->onDelete('no action')
                ->onUpdate('no action');            
            $table->foreign('idBankAccount')
                ->references('id')->on('bankAccounts')
                ->onDelete('no action')
                ->onUpdate('no action');            
            $table->foreign('idInvoice')
                ->references('id')->on('invoice')
                ->onDelete('no action')
                ->onUpdate('no action');            
            $table->foreign('idReferralNote')
                ->references('id')->on('referralNotes')
                ->onDelete('no action')
                ->onUpdate('no action');            
            $table->foreign('idPaymentMethod')
                ->references('id')->on('paymentMethods')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $db = DB::connection('drive')->getDatabaseName();
            
            $table->foreign('idFileVoucher')
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
        Schema::dropIfExists('accountsReceivable');
    }
}
