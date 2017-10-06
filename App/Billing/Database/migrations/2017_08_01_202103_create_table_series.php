<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->uuid('idIdentityCreated');
            $table->string('serie', 10)->unique();
            $table->integer('folioInitial');
            $table->integer('folioCurrent')->default(0);
            $table->integer('totalInvoice')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('isDefault')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->index([ 'serie', 'isDefault' ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series');
    }
}
