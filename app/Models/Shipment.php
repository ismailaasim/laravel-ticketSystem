<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table = "interchange_infos";

    protected $fillable = [
        'InterchangeInfoDate',
        'Organisation_Name',
        'Organisation_Country',
        'Organisation_City',
        'Organisation_Location_shortform',

        'Organisation_AddressType',
        'Organisation_CityOrSuburb',
        'Organisation_TelephoneNumberType',
        'Organisation_Sequence',
        'Organisation_AddressCapability_AddressType',
        'Organisation_AddressCapabilities_IsMainAddress',
        'Organisation_AddressCapabilities_AddressType',
        'ConsolIdentifier_ConsolIdentifierType',



        'ConsolDetail_DateCreated',
        'ConsolDetail_ConsolType',
        'ConsolDetail_ContainerMode',
        'ConsolDetail_TransportMode',
        'PortOfLoading_Country',
        'PortOfLoading_City',
        'PortOfLoading_Text',
        'PortOfLoading_EstimatedDateTime',
        'PortOfDischarge_Country',
        'PortOfDischarge_City',
        'PortOfDischarge_Text',
        'PortOfDischarge_EstimatedDateTime',
        'Vessel_ETD',
        'Vessel_ETA',
        'Vessel_VesselName',
        'Vessel_VoyageNo',
        'PlannedLeg_TransportMode',
        'PlannedLeg_PortOfLoading_Country',
        'PlannedLeg_PortOfLoading_City',
        'PlannedLeg_EstimatedDateTime',
        'PlannedLeg_PortOfDischarge_Country',
        'PlannedLeg_PortOfDischarge_City',
        'PlannedLeg_PortOfDischarge_Text',

        'PlannedLeg_TransportType',
        'PlannedLeg_Vessel_ETD',

        //2
        'PlannedLeg_VesselName',
        'PlannedLeg_VoyageNo',

        'SendingAgent_Organisation_NAME',
        'SendingAgent_Organisation_Country',
        'SendingAgent_Organisation_City',

        //2
        'SendingAgent_Organisation_AddressType',
        'SendingAgent_Organisation_TelephoneNumberType',
        'SendingAgent_Organisation_Sequence',
        'SendingAgent_Organisation_AddressCapability_AddressType',
        'SendingAgent_Organisation_AddressCapability_IsMainAddress',
        'SendingAgent_Organisation_AddressCapability_Main_AddressType',

        'ReceivingAgent_Organisation_NAME',
        'ReceivingAgent_Organisation_Country',
        'ReceivingAgent_Organisation_City',

        //2
        'ReceivingAgent_Organisation_AddressType',
        'ReceivingAgent_Organisation_AddressLine1',

        //3
        'ReceivingAgent_Organisation_AddressCapability_IsMainAddress',
        'ReceivingAgent_Organisation_AddressCapability_AddressType',

        'Carrier_Organisation_NAME',
        'Carrier_Organisation_Country',
        'Carrier_Organisation_City',

        //3
        'Carrier_Organisation_AddressType',
        'Carrier_Organisation_AddressCapability_AddressType',
        'Carrier_Organisation_AddressCapability_IsMainAddress',
        'Carrier_Organisation_AddressCapability_Main_AddressType',

        'Container_ContainerNumber',
        'Container_ContainerType_ISOCode',
        'Container_ContainerType_USContainerCode',
        'Container_ContainerType_ContainerCode',
        'Container_Seal',
        'Container_PackingMode',
        'Container_IsArrivingAtCTOByRail',
        'Container_IsEmptyContainer',
        'Container_IsDamaged',
        'Shipment_ShipmentIdentifierType',
        'Shipment_ShipmentIdentifier_Text',
        'Shipment_TransportMode',
        'Shipment_Consignee_Organisation_Name',
        'Shipment_Consignee_Organisation_AddressType',
        'Shipment_Consignee_Organisation_AddressLine1',
        'Shipment_Consignor_Organisation_Name',
        'Shipment_Consignor_Organisation_AddressType',
        'Shipment_Consignor_Organisation_AddressLine1',

        //3
        'Shipment_Consignor_Organisation_AddressCapability_AddressType',
        'Shipment_Consignor_Organisation_AddressCapability_IsMainAddress',
        'Shipment_Consignor_Org_AddressCapability_Main_AddressType',

        'Shipment_PackingMode',
        'Shipment_TotalOuterPacksQty',
        'Shipment_Weight',
        'Shipment_Volume',
        'Shipment_GoodsDescription',
        'Shipment_ChargeableWeight',
        'Shipment_MarksAndNumbers',

        //3
        'Shipment_ServiceLevel',


        'Shipment_Incoterm',

        //3
        'Shipment_ReleaseType',
        'Shipment_PackType',


        'Shipment_NumberOfPacks',
        'Shipment_Package_Weight',
        'Shipment_Package_Weight_DimensionType',
        'Shipment_Package_Volume',
        'Shipment_Package_Volume_DimensionType',
        'Shipment_Package_ContainerNumber',
    ];
}
