<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->smallInteger('idAccount');
            $table->smallInteger('idAccountReceivableStatus');
            $table->smallInteger('idPaymentMethod');
            $table->uuid('idIdentityCreated');
            $table->uuid('idInvoice')->nullable();
            $table->uuid('idReferralNote')->nullable();
            $table->decimal('amountCharged', 15, 2);
            $table->dateTime('dueDate')->nullable();            
            $table->boolean('expiredDate')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->foreign('idAccount')
                ->references('id')->on('accounts')
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
