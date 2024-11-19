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
        
        Schema::create('interchange_infos', function (Blueprint $table) {
            $table->id();
            
            $table->text('InterchangeInfoDate')->nullable();
            $table->string('Organisation_Name')->nullable();
            $table->string('Organisation_Country')->nullable();
            $table->string('Organisation_City')->nullable();
            $table->string('Organisation_Location_shortform')->nullable();

            
            $table->string('Organisation_AddressType')->nullable();
            $table->string('Organisation_CityOrSuburb')->nullable();
            $table->string('Organisation_TelephoneNumberType')->nullable();
            $table->string('Organisation_Sequence')->nullable();
            $table->string('Organisation_AddressCapability_AddressType')->nullable();
            $table->string('Organisation_AddressCapabilities_IsMainAddress')->nullable();
            $table->string('Organisation_AddressCapabilities_AddressType')->nullable();
            $table->string('ConsolIdentifier_ConsolIdentifierType')->nullable();

           





            $table->text('ConsolDetail_DateCreated')->nullable();
            $table->string('ConsolDetail_ConsolType')->nullable();
            $table->string('ConsolDetail_ContainerMode')->nullable();
            $table->string('ConsolDetail_TransportMode')->nullable();
            $table->string('PortOfLoading_Country')->nullable();
            $table->string('PortOfLoading_City')->nullable();
            $table->text('PortOfLoading_Text')->nullable();
            $table->text('PortOfLoading_EstimatedDateTime')->nullable();
            $table->string('PortOfDischarge_Country')->nullable();
            $table->string('PortOfDischarge_City')->nullable();
            $table->text('PortOfDischarge_Text')->nullable();
            $table->text('PortOfDischarge_EstimatedDateTime')->nullable();
            $table->text('Vessel_ETD')->nullable();
            $table->text('Vessel_ETA')->nullable();
            $table->string('Vessel_VesselName')->nullable();
            $table->string('Vessel_VoyageNo')->nullable();
            $table->string('PlannedLeg_TransportMode')->nullable();
            $table->string('PlannedLeg_PortOfLoading_Country')->nullable();
            $table->string('PlannedLeg_PortOfLoading_City')->nullable();
            $table->text('PlannedLeg_EstimatedDateTime')->nullable();
            $table->string('PlannedLeg_PortOfDischarge_Country')->nullable();
            $table->string('PlannedLeg_PortOfDischarge_City')->nullable();
            $table->text('PlannedLeg_PortOfDischarge_Text')->nullable();

            $table->string('PlannedLeg_TransportType')->nullable();
            $table->string('PlannedLeg_Vessel_ETD')->nullable();
            //2
            $table->tinyText('PlannedLeg_VesselName')->nullable();
            $table->tinyText('PlannedLeg_VoyageNo')->nullable();

            $table->string('SendingAgent_Organisation_NAME')->nullable();
            $table->string('SendingAgent_Organisation_Country')->nullable();
            $table->string('SendingAgent_Organisation_City')->nullable();
            
            //2
            $table->tinyText('SendingAgent_Organisation_AddressType')->nullable();
            $table->tinyText('SendingAgent_Organisation_TelephoneNumberType')->nullable();
            $table->tinyText('SendingAgent_Organisation_Sequence')->nullable();
            $table->text('SendingAgent_Organisation_AddressCapability_AddressType')->nullable();
            $table->tinyText('SendingAgent_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->tinyText('SendingAgent_Organisation_AddressCapability_Main_AddressType')->nullable();


            $table->string('ReceivingAgent_Organisation_NAME')->nullable();
            $table->string('ReceivingAgent_Organisation_Country')->nullable();
            $table->string('ReceivingAgent_Organisation_City')->nullable();
            
            //2
            $table->tinyText('ReceivingAgent_Organisation_AddressType')->nullable();
            $table->text('ReceivingAgent_Organisation_AddressLine1')->nullable();
            
            //3
            $table->tinyText('ReceivingAgent_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->tinyText('ReceivingAgent_Organisation_AddressCapability_AddressType')->nullable();



            $table->string('Carrier_Organisation_NAME')->nullable();
            $table->string('Carrier_Organisation_Country')->nullable();
            $table->string('Carrier_Organisation_City')->nullable();
            
            //3
            $table->tinyText('Carrier_Organisation_AddressType')->nullable();
            $table->tinyText('Carrier_Organisation_AddressCapability_AddressType')->nullable();
            $table->tinyText('Carrier_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->tinyText('Carrier_Organisation_AddressCapability_Main_AddressType')->nullable();


            $table->string('Container_ContainerNumber')->nullable();
            $table->string('Container_ContainerType_ISOCode')->nullable();
            $table->string('Container_ContainerType_USContainerCode')->nullable();
            $table->string('Container_ContainerType_ContainerCode')->nullable();
            $table->string('Container_Seal')->nullable();
            $table->string('Container_PackingMode')->nullable();
            $table->tinyText('Container_IsArrivingAtCTOByRail')->nullable();
            $table->tinyText('Container_IsEmptyContainer')->nullable();
            $table->tinyText('Container_IsDamaged')->nullable();
            $table->string('Shipment_ShipmentIdentifierType')->nullable();
            $table->string('Shipment_ShipmentIdentifier_Text')->nullable();
            $table->string('Shipment_TransportMode')->nullable();
            $table->string('Shipment_Consignee_Organisation_Name')->nullable();
            $table->string('Shipment_Consignee_Organisation_AddressType')->nullable();
            $table->text('Shipment_Consignee_Organisation_AddressLine1')->nullable();
            $table->string('Shipment_Consignor_Organisation_Name')->nullable();
            $table->string('Shipment_Consignor_Organisation_AddressType')->nullable();
            $table->text('Shipment_Consignor_Organisation_AddressLine1')->nullable();
            
            //3
            $table->tinyText('Shipment_Consignor_Organisation_AddressCapability_AddressType')->nullable();
            $table->tinyText('Shipment_Consignor_Organisation_AddressCapability_IsMainAddress')->nullable();
            $table->tinyText('Shipment_Consignor_Org_AddressCapability_Main_AddressType')->nullable();


            $table->string('Shipment_PackingMode')->nullable();
            $table->string('Shipment_TotalOuterPacksQty')->nullable();
            $table->text('Shipment_Weight')->nullable();
            $table->text('Shipment_Volume')->nullable();
            $table->text('Shipment_GoodsDescription')->nullable();
            $table->text('Shipment_ChargeableWeight')->nullable();
            $table->text('Shipment_MarksAndNumbers')->nullable();
            
            //3
            $table->tinyText('Shipment_ServiceLevel')->nullable();


            $table->string('Shipment_Incoterm')->nullable();
            
            //3
            $table->tinyText('Shipment_ReleaseType')->nullable();
            $table->tinyText('Shipment_PackType')->nullable();

            $table->string('Shipment_NumberOfPacks')->nullable();
            $table->text('Shipment_Package_Weight')->nullable();
            $table->string('Shipment_Package_Weight_DimensionType')->nullable();
            $table->text('Shipment_Package_Volume')->nullable();
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
        Schema::dropIfExists('interchange_infos');
    }
};
