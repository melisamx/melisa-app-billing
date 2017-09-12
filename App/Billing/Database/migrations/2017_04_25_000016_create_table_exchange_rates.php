<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExchangeRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchangeRates', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('idCoin');
            $table->uuid('idIdentityCreated');
            $table->date('date');
            $table->decimal('rate', 15, 4);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->unique(['idCoin', 'date']);
            
            $table->index(['idCoin', 'date'], 'search_INDEX');
            
            $table->foreign('idCoin')
                ->references('id')->on('coins')
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
        Schema::dropIfExists('exchangeRates');
    }
}
