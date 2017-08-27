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
            $table->uuid('idCsd');
            $table->smallInteger('idInvoiceStatus');
            $table->smallInteger('idSerie');
            $table->smallInteger('idVoucherType');
            $table->uuid('idFileXml');
            $table->uuid('idFilePdf');
            $table->uuid('idFileCfdSeal')->nullable();
            $table->uuid('idFileCfdBeforeSeal')->nullable();
            $table->uuid('uuid')->unique();
            $table->decimal('version', 3, 1)->defualt(3.2);
            $table->string('serie', 10)->nullable();
            $table->string('folio', 25)->nullable();
            $table->string('rfc', 13);
            $table->string('name', 150);
            $table->string('rfcTransmitter', 13);
            $table->string('nameTransmitter', 150);
            $table->char('date', 19);
            $table->text('transmitter');
            $table->text('receiver');
            $table->text('concepts');
            $table->text('taxes');
            $table->text('stringOriginal');
            $table->text('sealCfd');
            $table->text('sealSat');
            $table->string('voucherType');
            $table->string('coin');
            $table->string('expeditionPlace');
            $table->string('methodPayment');
            $table->string('numberCertificateSat', 100);
            $table->decimal('subTotal', 15, 2);
            $table->decimal('total', 15, 2);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();
            $table->dateTime('canceledAt')->nullable();
            
            $table->index('name');
            $table->index('rfc');
            $table->index('folio');
            $table->index('serie');
            $table->index('date');
            
            $table->foreign('idCsd')
                ->references('id')->on('csd')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idInvoiceStatus')
                ->references('id')->on('invoiceStatus')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idSerie')
                ->references('id')->on('series')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idVoucherType')
                ->references('id')->on('voucherTypes')
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
