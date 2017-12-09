<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocumentsConceptsTaxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentConceptsTaxes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idDocumentConcept');
            $table->smallInteger('idTax');
            $table->smallInteger('idTaxAction');
            $table->smallInteger('idTypeFactor');
            $table->uuid('idIdentityCreated');
            $table->decimal('base', 15, 2);
            $table->decimal('rateOrFee', 15, 6);
            $table->decimal('amount', 15, 2);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->foreign('idTaxAction')
                ->references('id')->on('taxActions')
                ->onDelete('no action')
                ->onUpdate('no action');            
            $table->foreign('idDocumentConcept')
                ->references('id')->on('documentsConcepts')
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
        Schema::dropIfExists('documentConceptsTaxes');
    }
}
