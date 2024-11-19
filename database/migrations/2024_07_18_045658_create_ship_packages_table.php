<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_packages', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id')->nullable();
            $table->string('Shipment_PackType')->nullable();
            $table->string('Shipment_NumberOfPacks')->nullable();
            $table->string('Shipment_Package_Weight')->nullable();
            $table->string('Shipment_Package_Weight_DimensionType')->nullable();
            $table->string('Shipment_Package_Volume')->nullable();
            $table->string('Shipment_Package_Volume_DimensionType')->nullable();
            $table->string('Shipment_Package_ContainerNumber')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_packages');
    }
};
