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
        Schema::create('shipment_mains', function (Blueprint $table) {
            $table->id();
            $table->text('InterchangeInfoDate')->nullable();
            $table->text('Organisation_Name')->nullable();
            $table->text('Organisation_Country')->nullable();
            $table->text('Organisation_City')->nullable();
            $table->text('Organisation_Location_shortform')->nullable();
            $table->text('Organisation_AddressType')->nullable();
            $table->text('Organisation_AddressLine1')->nullable();
            $table->text('Organisation_CityOrSuburb')->nullable();
            $table->text('Organisation_TelephoneNumberType')->nullable();
            $table->text('Organisation_TelephoneNumber_1')->nullable();
            $table->text('Organisation_TelephoneNumberType_Fax')->nullable();
            $table->text('Organisation_TelephoneNumber_2')->nullable();
            $table->text('Organisation_Location')->nullable();
            $table->text('Organisation_Sequence')->nullable();
            $table->text('Organisation_AddressCapability_AddressType')->nullable();
            $table->text('Organisation_AddressCapabilities_IsMainAddress')->nullable();
            $table->text('Organisation_AddressCapabilities_AddressType')->nullable();
            $table->text('ConsolIdentifier_ConsolIdentifierType')->nullable();
            $table->tinyText('ConsolDetail_DateCreated')->nullable();
            $table->tinyText('ConsolDetail_ConsolType')->nullable();
            $table->tinyText('ConsolDetail_ContainerMode')->nullable();
            $table->tinyText('ConsolDetail_TransportMode')->nullable();
            $table->tinyText('PortOfLoading_Country')->nullable();
            $table->tinyText('PortOfLoading_City')->nullable();
            $table->tinyText('PortOfLoading_tinyText')->nullable();
            $table->Text('PortOfLoading_EstimatedDateTime')->nullable();
            $table->tinyText('PortOfDischarge_Country')->nullable();
            $table->tinyText('PortOfDischarge_City')->nullable();
            $table->tinyText('PortOfDischarge_Text')->nullable();
            $table->text('PortOfDischarge_EstimatedDateTime')->nullable();
            $table->text('Vessel_ETD')->nullable();
            $table->text('Vessel_ETA')->nullable();
            $table->text('Vessel_VesselName')->nullable();
            $table->text('Vessel_VoyageNo')->nullable();
            $table->text('PlannedLeg_TransportMode')->nullable();
            $table->text('PlannedLeg_PortOfLoading_Country')->nullable();
            $table->string('PlannedLeg_PortOfLoading_City')->nullable();
            $table->string('PlannedLeg_PortOfLoading_Text')->nullable();
            $table->text('PlannedLeg_EstimatedDateTime')->nullable();
            $table->tinyText('PlannedLeg_PortOfDischarge_Country')->nullable();
            $table->tinyText('PlannedLeg_PortOfDischarge_City')->nullable();
            $table->tinyText('PlannedLeg_PortOfDischarge_Text')->nullable();
            $table->string('PlannedLeg_TransportType')->nullable();
            $table->text('PlannedLeg_Vessel_ETD')->nullable();
            $table->tinyText('PlannedLeg_VesselName')->nullable();
            $table->tinyText('PlannedLeg_VoyageNo')->nullable();
            $table->text('SendingAgent_Organisation_NAME')->nullable();
            $table->tinyText('SendingAgent_Organisation_Country')->nullable();
            $table->tinyText('SendingAgent_Organisation_City')->nullable();
            $table->tinyText('SendingAgent_Organisation_Location')->nullable();
            $table->text('SendingAgent_Organisation_AddressType')->nullable();
            $table->text('SendingAgent_Organisation_AddressLine1')->nullable();
            $table->string('SendingAgent_Organisation_TelephoneNumberType')->nullable();
            $table->string('SendingAgent_Organisation_TelephoneNumber_1')->nullable();
            $table->string('SendingAgent_Organisation_TelephoneNumberType_Fax')->nullable();
            $table->string('SendingAgent_Organisation_TelephoneNumber_2')->nullable();
            $table->string('SendingAgent_Organisation_Sequence')->nullable();
            $table->string('SendingAgent_Organisation_AddressCapability_AddressType')->nullable();
            $table->string('SendingAgent_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->string('SendingAgent_Organisation_AddressCapability_Main_AddressType')->nullable();
            $table->text('ReceivingAgent_Organisation_NAME')->nullable();
            $table->string('ReceivingAgent_Organisation_Country')->nullable();
            $table->string('ReceivingAgent_Organisation_City')->nullable();
            $table->string('ReceivingAgent_Organisation_Location')->nullable();
            $table->string('ReceivingAgent_Organisation_AddressType')->nullable();
            $table->text('ReceivingAgent_Organisation_AddressLine1')->nullable();
            $table->string('ReceivingAgent_Organisation_TelephoneNumberType')->nullable();
            $table->string('ReceivingAgent_Organisation_TelephoneNumber_1')->nullable();
            $table->string('ReceivingAgent_Organisation_TelephoneNumberType_Fax')->nullable();
            $table->string('ReceivingAgent_Organisation_TelephoneNumber_2')->nullable();
            $table->string('ReceivingAgent_Organisation_AddressCapabilityType')->nullable();
            $table->string('ReceivingAgent_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->string('ReceivingAgent_Organisation_AddressCapability_AddressType')->nullable();
            $table->text('Carrier_Organisation_NAME')->nullable();
            $table->string('Carrier_Organisation_Country')->nullable();
            $table->string('Carrier_Organisation_City')->nullable();
            $table->string('Carrier_Organisation_AddressType')->nullable();
            $table->string('Carrier_Organisation_Location')->nullable();
            $table->string('Carrier_Organisation_TelephoneNumberType')->nullable();
            $table->tinyText('Carrier_Organisation_TelephoneNumber_1')->nullable();
            $table->string('Carrier_Organisation_TelephoneNumberType_Fax')->nullable();
            $table->tinyText('Carrier_Organisation_TelephoneNumber_2')->nullable();
            $table->string('ReceivingAgent_Organisation_Sequence')->nullable();
            $table->string('Carrier_Organisation_AddressCapability_MainAddress')->nullable();
            $table->string('Carrier_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->string('Carrier_Organisation_AddressCapability_Main_AddressType')->nullable();
            $table->string('Shipment_ShipmentIdentifierType')->nullable();
            $table->text('Shipment_ShipmentIdentifier_Text')->nullable();
            $table->string('Shipment_TransportMode')->nullable();
            $table->text('Shipment_DateCreated')->nullable();
            $table->tinyText('Shipment_Consignee_Organisation_Name')->nullable();
            $table->tinyText('Shipment_Consignee_Organisation_Location')->nullable();
            $table->tinyText('Shipment_Consignee_Organisation_Country')->nullable();
            $table->tinyText('Shipment_Consignee_Organisation_City')->nullable();
            $table->string('Shipment_Consignee_Organisation_AddressType')->nullable();
            $table->text('Shipment_Consignee_Organisation_AddressLine1')->nullable();
            $table->tinyText('Shipment_Consignee_Organisation_TelephoneNumberType')->nullable();
            $table->tinyText('Shipment_Consignee_Organisation_TelephoneNumber_1')->nullable();
            $table->tinyText('Shipment_Consignee_Organisation_TelephoneNumberType_Fax')->nullable();
            $table->tinyText('Shipment_Consignee_Organisation_TelephoneNumber_2')->nullable();
            $table->string('Shipment_Consignee_Organisation_Sequence')->nullable();
            $table->string('Shipment_Consignee_Organisation_AddressCapability_AddressType')->nullable();
            $table->string('Shipment_Consignee_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->string('Shipment_Consignee_Org_AddressCapability_Main_AddressType')->nullable();
            $table->text('Shipment_Consignor_Organisation_Name')->nullable();
            $table->text('Shipment_Consignor_Organisation_Location')->nullable();
            $table->text('Shipment_Consignor_Organisation_Country')->nullable();
            $table->text('Shipment_Consignor_Organisation_City')->nullable();
            $table->text('Shipment_Consignor_Organisation_AddressType')->nullable();
            $table->text('Shipment_Consignor_Organisation_AddressLine1')->nullable();
            $table->text('Shipment_Consignor_Organisation_TelephoneNumberType')->nullable();
            $table->text('Shipment_Consignor_Organisation_TelephoneNumber_1')->nullable();
            $table->text('Shipment_Consignor_Organisation_TelephoneNumberType_Fax')->nullable();
            $table->text('Shipment_Consignor_Organisation_TelephoneNumber_2')->nullable();
            $table->text('Shipment_Consignor_Organisation_Sequence')->nullable();
            $table->text('Shipment_Consignor_Organisation_AddressCapability_AddressType')->nullable();
            $table->text('Shipment_Consignor_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->text('Shipment_Consignor_Org_AddressCapability_Main_AddressType')->nullable();
            $table->text('Notify_Organisation_Name')->nullable();
            $table->text('Notify_Organisation_Location')->nullable();
            $table->text('Notify_Organisation_Country')->nullable();
            $table->text('Notify_Organisation_City')->nullable();
            $table->text('Notify_Organisation_AddressType')->nullable();
            $table->text('Notify_Organisation_AddressLine1')->nullable();
            $table->text('Notify_Organisation_TelephoneNumberType')->nullable();
            $table->text('Notify_Organisation_TelephoneNumber_1')->nullable();
            $table->text('Notify_Organisation_TelephoneNumberType_Fax')->nullable();
            $table->text('Notify_Organisation_TelephoneNumber_2')->nullable();
            $table->text('Notify_Organisation_Sequence')->nullable();
            $table->text('Notify_Organisation_AddressCapability_AddressType')->nullable();
            $table->text('Notify_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->text('Notify_Org_AddressCapability_Main_AddressType')->nullable();
            $table->tinyText('Shipment_PackingMode')->nullable();
            $table->tinyText('Shipment_TotalOuterPacksQty')->nullable();
            $table->tinyText('Shipment_TotalOuterPacksQty_DimensionType')->nullable();
            $table->tinyText('Shipment_Weight')->nullable();
            $table->tinyText('Shipment_Weight_DimensionType')->nullable();
            $table->tinyText('Shipment_Volume')->nullable();
            $table->tinyText('Shipment_Volume_DimensionType')->nullable();
            $table->tinyText('Shipment_GoodsValue')->nullable();
            $table->tinyText('Shipment_GoodsValue_CurrencyCode')->nullable();
            $table->tinyText('Shipment_GoodsDescription')->nullable();
            $table->tinyText('Shipment_ChargeableWeight')->nullable();
            $table->tinyText('Shipment_ChargeableWeight_DimensionType')->nullable();
            $table->tinyText('Shipment_ServiceLevel')->nullable();
            $table->tinyText('Shipment_Incoterm')->nullable();
            $table->tinyText('Shipment_ReleaseType')->nullable();
            $table->tinyText('Shipment_OrderReferences')->nullable();
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
        Schema::dropIfExists('shipment_mains');
    }
};