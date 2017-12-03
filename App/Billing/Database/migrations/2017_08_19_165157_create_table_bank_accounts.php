<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBankAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankAccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('idBank');
            $table->uuid('idIdentityCreated');
            $table->decimal('beginningBalance', 15, 2)->default(0);
            $table->string('accountNumber', 20);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->string('name', 75)->unique()->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->unique(['idBank', 'accountNumber']);
            $table->index('idBank');
            $table->index('accountNumber');
            
            $table->foreign('idBank')
                ->references('id')->on('banks')
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
        Schema::dropIfExists('bankAccounts');
    }
}
