<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInvoiceConcepts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoiceConcepts', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('idInvoice');
            $table->smallInteger('idConcept');
            $table->unsignedInteger('idConceptKey');
            $table->uuid('idIdentityCreated');
            $table->string('description');
            $table->decimal('unitValue', 15, 2);
            $table->decimal('amount', 15, 2);
            $table->decimal('discount', 15, 2);
            $table->decimal('quantity', 15, 2);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('idConceptUnit')->nullable();
            $table->string('idIdentification')->nullable();
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->foreign('idInvoice')
                ->references('id')->on('invoice')
                ->onDelete('cascade')
                ->onUpdate('no action');
            
            $table->foreign('idConcept')
                ->references('id')->on('concepts')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idConceptKey')
                ->references('id')->on('conceptKeys')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idConceptUnit')
                ->references('id')->on('conceptUnits')
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
        Schema::dropIfExists('invoiceConcepts');
    }
}
