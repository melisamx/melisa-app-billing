<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentsCommissions', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('idTypeCommission');
            $table->uuid('idProvider');
            $table->timestamps();
            
            $table->foreign('idTypeCommission')
                ->references('id')->on('typesCommissions')
                ->onDelete('no action')
                ->onUpdate('cascade');
            
            $table->foreign('idProvider')
                ->references('id')->on('providers')
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentsCommissions');
    }
}
