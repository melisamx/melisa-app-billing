<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReferralNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referralNotes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('idReferralStatus');
            $table->uuid('idIdentityCreated');
            $table->string('rfc', 13);
            $table->string('name', 150);
            $table->string('rfcTransmitter', 13);
            $table->string('nameTransmitter', 150);
            $table->char('date', 19);
            $table->text('transmitter');
            $table->text('receiver');
            $table->text('concepts');
            $table->text('taxes');
            $table->text('extraData')->nullable();
            $table->string('coin');
            $table->string('methodPayment');
            $table->decimal('subTotal', 15, 2);
            $table->decimal('total', 15, 2);
            
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            $table->dateTime('canceledAt')->nullable();
            
            $table->index('name');
            $table->index('rfc');
            $table->index('date');
            
            $table->foreign('idReferralStatus')
                ->references('id')->on('referralNotesStatus')
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
        Schema::dropIfExists('referralNotes');
    }
}
