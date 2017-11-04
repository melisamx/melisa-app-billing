<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInvoiceConceptsTaxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoiceConceptsTaxes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idInvoiceConcept');
            $table->smallInteger('idTax');
            $table->smallInteger('idTaxAction');
            $table->smallInteger('idTypeFactor');
            $table->uuid('idIdentityCreated');
            $table->decimal('base', 15, 2);
            $table->decimal('rateOrFee', 15, 2);
            $table->decimal('amount', 15, 2);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->foreign('idTaxAction')
                ->references('id')->on('taxActions')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idInvoiceConcept')
                ->references('id')->on('invoiceConcepts')
                ->onDelete('cascade')
                ->onUpdate('no action');
            
            $table->foreign('idTax')
                ->references('id')->on('taxes')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idTypeFactor')
                ->references('id')->on('typesFactor')
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
        Schema::dropIfExists('invoiceConceptsTaxes');
    }
}
