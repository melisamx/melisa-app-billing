<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccountingAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('accountingAccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('idIdentityCreated');
            $table->string('name', 150)->unique();
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->smallInteger('expirationDays')->default(21)->nullable();
            $table->string('groupingCode', 150)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('accountingAccounts');
    }

}
