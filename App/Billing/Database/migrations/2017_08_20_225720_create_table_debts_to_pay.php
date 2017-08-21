<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->char('idIdentityCreated', 36);
            $table->smallInteger('idDebtsToPayStatus');
            $table->smallInteger('idAccount');
            $table->char('idFileVoucher', 36);
            $table->decimal('amountPayable', 15, 2);
            $table->dateTime('dateVoucher');            
            $table->dateTime('dueDate')->nullable();            
            $table->boolean('expiredDate')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->foreign('idDebtsToPayStatus')
                ->references('id')->on('debtsToPayStatus')
                ->onDelete('no action')
                ->onUpdate('no action');
            
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
        Schema::dropIfExists('debtsToPay');
    }
}
