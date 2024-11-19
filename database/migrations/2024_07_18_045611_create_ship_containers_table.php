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
        Schema::create('ship_containers', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id')->nullable();
            $table->string('Container_ContainerNumber')->nullable();
            $table->string('Container_ContainerType_ISOCode')->nullable();
            $table->string('Container_ContainerType_USContainerCode')->nullable();
            $table->string('Container_ContainerType_ContainerCode')->nullable();
            $table->string('Container_Seal')->nullable();
            $table->string('Container_PackingMode')->nullable();
            $table->string('Container_IsArrivingAtCTOByRail')->nullable();
            $table->string('Container_IsEmptyContainer')->nullable();
            $table->string('Container_IsDamaged')->nullable();
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
        Schema::dropIfExists('ship_containers');
    }
};
