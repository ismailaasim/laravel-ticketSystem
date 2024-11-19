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
        Schema::create('shipment_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('branch')->nullable();
            $table->string('bkg_no')->nullable();
            $table->string('bkg_date')->nullable();
            $table->string('agt_name')->nullable();
            $table->string('customer')->nullable();
            $table->text('shipper')->nullable();
            $table->string('consignee')->nullable();
            $table->string('user')->nullable();
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
        Schema::dropIfExists('shipment_bookings');
    }
};
