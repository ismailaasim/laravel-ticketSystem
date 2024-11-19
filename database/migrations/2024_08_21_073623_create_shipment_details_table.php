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
        Schema::create('shipment_details', function (Blueprint $table) {
            $table->id();
            $table->text('BRANCH')->nullable();
            $table->text('BKGNO')->nullable();
            $table->string('BKGDT')->nullable();
            $table->string('FOLLOWUPDT')->nullable();
            $table->text('AGTNAME')->nullable();
            $table->text('AGTRONO')->nullable();
            $table->text('CUSTOMER')->nullable();
            $table->text('SHIPPER')->nullable();
            $table->text('CONSIGNEE')->nullable();
            $table->longText('SHPRFEE')->nullable();
            $table->text('CTC')->nullable();
            $table->text('EMAIL')->nullable();
            $table->text('TERMS')->nullable();
            $table->text('PLR')->nullable();
            $table->text('POL')->nullable();
            $table->text('POD')->nullable();
            $table->text('FDEST')->nullable();
            $table->text('COMMODITY')->nullable();
            $table->text('COMMTYPE')->nullable();
            $table->text('REQUIREMENTS')->nullable();
            $table->text('VESSEL')->nullable();
            $table->string('ETDPOL')->nullable();
            $table->string('ETAPOD')->nullable();
            $table->text('WEIGHT')->nullable();
            $table->text('CBM')->nullable();
            $table->text('PKG')->nullable();
            $table->text('SHPBILLNO')->nullable();
            $table->text('HBLNO')->nullable();
            $table->string('RORCVDDT')->nullable();
            $table->string('CARGOREADYDT')->nullable();
            $table->string('PICKUPDT')->nullable();
            $table->string('CLRDT')->nullable();
            $table->string('DOCHODT')->nullable();
            $table->string('BLRLSDT')->nullable();
            $table->string('CARTINGDT')->nullable();
            $table->string('DRAFTBLDT')->nullable();
            $table->longText('COMMENTS')->nullable();
            $table->text('USER')->nullable();
            $table->integer('SNO')->nullable();
            $table->text('AGENTID')->nullable();
            $table->longText('SUBJECT')->nullable();
            $table->text('QUOTNO')->nullable();
            $table->text('STATUS')->nullable();
            $table->string('MODDATE')->nullable();
            $table->text('CARRIER')->nullable();
            $table->text('CONTRACTNO')->nullable();
            $table->text('BOOKINGNO')->nullable();
            $table->text('EQUIPMENTTYPE')->nullable();
            $table->text('CONTAINERNO')->nullable();
            $table->text('SEALNO')->nullable();
            $table->text('DETENTION')->nullable();
            $table->string('BOOKINGDT')->nullable();
            $table->string('BOOKINGRCVDDT')->nullable();
            $table->string('PICKUPDTFCL')->nullable();
            $table->string('GATEINDT')->nullable();
            $table->text('CUTOFF')->nullable();
            $table->string('SICUTOFF')->nullable();
            $table->string('FORM13CUTOFF')->nullable();
            $table->string('GATEINCUTOFF')->nullable();
            $table->text('FREIGHTTERM')->nullable();
            $table->longText('EMAILSTOTAL')->nullable();
            $table->text('RR')->nullable();
            $table->text('CR')->nullable();
            $table->text('CP')->nullable();
            $table->text('CC')->nullable();
            $table->text('DBL')->nullable();
            $table->text('DHO')->nullable();
            $table->text('BL')->nullable();
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
        Schema::dropIfExists('shipment_details');
    }
};
