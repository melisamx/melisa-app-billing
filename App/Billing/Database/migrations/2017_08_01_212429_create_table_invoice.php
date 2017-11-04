<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

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
            $table->unsignedInteger('idTransmitter');
            $table->unsignedInteger('idTransmitterAddress');
            $table->unsignedInteger('idCustomerAddress');
            $table->smallInteger('idInvoiceStatus');
            $table->smallInteger('idVoucherType');
            $table->smallInteger('idSerie');
            $table->smallInteger('idCoin');
            $table->smallInteger('idWaytopay');
            $table->smallInteger('idPaymentMethod');
            $table->uuid('idCustomer');
            $table->uuid('idIdentityCreated');
            $table->text('preInvoice');
            $table->decimal('subTotal', 15, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('totalTaxRetention', 15, 2);
            $table->decimal('totalTaxTransfer', 15, 2);
            $table->string('version', 10)->default('3.2');
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->uuid('idFileXml')->nullable();
            $table->uuid('idFilePdf')->nullable();
            $table->uuid('idFileCfdSeal')->nullable();
            $table->uuid('idFileCfdBeforeSeal')->nullable();
            $table->uuid('idCsd')->nullable();
            $table->string('folio', 25)->nullable();
            $table->text('stringOriginal')->nullable();
            $table->text('sealSat')->nullable();
            $table->string('numberCertificateSat', 100)->nullable();
            $table->text('sealCfd')->nullable();
            $table->uuid('uuid')->nullable();
            $table->text('cfdiResult')->nullable();
            $table->dateTime('updatedAt')->nullable();
            $table->dateTime('canceledAt')->nullable();
            $table->char('dateCfdi', 25)->nullable();
            
            $table->index('uuid');
            $table->index('version');
            
            $table->foreign('idCoin')
                ->references('id')->on('coins')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idPaymentMethod')
                ->references('id')->on('paymentMethods')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idCustomer')
                ->references('id')->on('customers')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idCustomerAddress')
                ->references('id')->on('contributorsAddresses')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idTransmitter')
                ->references('id')->on('contributors')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idTransmitterAddress')
                ->references('id')->on('contributorsAddresses')
                ->onDelete('no action')
                ->onUpdate('no action');
            
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
            
            $db = DB::connection('drive')->getDatabaseName();
            
            $table->foreign('idFileXml')
                ->references('id')->on(new Expression("$db.files"))
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idFilePdf')
                ->references('id')->on(new Expression("$db.files"))
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
