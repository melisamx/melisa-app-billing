<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idIdentityCreated', 36);
            $table->smallInteger('idInvoiceStatus');
            $table->char('idFileXml', 36);
            $table->char('idFilePdf', 36);
            $table->uuid('uuid')->unique();
            $table->string('folio', 25);
            $table->char('date', 19);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->index('folio');
            $table->index('date');
            
            $table->foreign('idInvoiceStatus')
                ->references('id')->on('invoiceStatus')
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
        Schema::dropIfExists('invoice');
    }
}
