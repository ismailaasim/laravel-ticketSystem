<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentMain2 extends Model
{
    use HasFactory;
    protected $table = 'shipment_mains';

    protected $fillable = [
        'InterchangeInfoDate',
        'Organisation_Name',
        'Organisation_Country',
        'Organisation_City',
        'Organisation_Location_shortform',
        'Organisation_AddressType',
        'Organisation_AddressLine1',
        'Organisation_CityOrSuburb',
        'Organisation_TelephoneNumberType',
        'Organisation_TelephoneNumber_1',
        'Organisation_TelephoneNumberType_Fax',
        'Organisation_TelephoneNumber_2',
        'Organisation_Location',
        'Organisation_Sequence',
        'Organisation_AddressCapability_AddressType',
        'Organisation_AddressCapabilities_IsMainAddress',
        'Organisation_AddressCapabilities_AddressType', // done
        'ConsolIdentifier_ConsolIdentifierType',
        'ConsolDetail_DateCreated',
        'ConsolDetail_ConsolType',
        'ConsolDetail_ContainerMode',
        'ConsolDetail_TransportMode',
        'PortOfLoading_Country',
        'PortOfLoading_City',
        'PortOfLoading_tinyText',
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
        'PlannedLeg_PortOfLoading_Text',
        'PlannedLeg_EstimatedDateTime',
        'PlannedLeg_PortOfDischarge_Country',
        'PlannedLeg_PortOfDischarge_City',
        'PlannedLeg_PortOfDischarge_Text',
        'PlannedLeg_TransportType',
        'PlannedLeg_Vessel_ETD',
        'PlannedLeg_VesselName',
        'PlannedLeg_VoyageNo',//done
        'SendingAgent_Organisation_NAME',
        'SendingAgent_Organisation_Country',
        'SendingAgent_Organisation_City',
        'SendingAgent_Organisation_Location',
        'SendingAgent_Organisation_AddressType',
        'SendingAgent_Organisation_AddressLine1',
        'SendingAgent_Organisation_TelephoneNumberType',
        'SendingAgent_Organisation_TelephoneNumber_1',
        'SendingAgent_Organisation_TelephoneNumberType_Fax',
        'SendingAgent_Organisation_TelephoneNumber_2',
        'SendingAgent_Organisation_Sequence',
        'SendingAgent_Organisation_AddressCapability_AddressType',
        'SendingAgent_Organisation_AddressCapability_IsMainAddress',
        'SendingAgent_Organisation_AddressCapability_Main_AddressType', // done
        'ReceivingAgent_Organisation_NAME',
        'ReceivingAgent_Organisation_Country',
        'ReceivingAgent_Organisation_City',
        'ReceivingAgent_Organisation_Location',
        'ReceivingAgent_Organisation_AddressType',
        'ReceivingAgent_Organisation_AddressLine1',
        'ReceivingAgent_Organisation_TelephoneNumberType',
        'ReceivingAgent_Organisation_TelephoneNumber_1',
        'ReceivingAgent_Organisation_TelephoneNumberType_Fax',
        'ReceivingAgent_Organisation_TelephoneNumber_2',
        'ReceivingAgent_Organisation_AddressCapabilityType',
        'ReceivingAgent_Organisation_AddressCapability_IsMainAddress',
        'ReceivingAgent_Organisation_AddressCapability_AddressType', // done

        'Carrier_Organisation_NAME',
        'Carrier_Organisation_Country',
        'Carrier_Organisation_City',
        'Carrier_Organisation_AddressType',
        'Carrier_Organisation_Location',
        'Carrier_Organisation_TelephoneNumberType',
        'Carrier_Organisation_TelephoneNumber_1',
        'Carrier_Organisation_TelephoneNumberType_Fax',
        'Carrier_Organisation_TelephoneNumber_2',
        'ReceivingAgent_Organisation_Sequence',
        'Carrier_Organisation_AddressCapability_MainAddress',
        'Carrier_Organisation_AddressCapability_IsMainAddress',
        'Carrier_Organisation_AddressCapability_Main_AddressType', // done

        'Shipment_ShipmentIdentifierType',
        'Shipment_ShipmentIdentifier_Text',
        'Shipment_TransportMode',
        'Shipment_DateCreated',
        'Shipment_Consignee_Organisation_Name',
        'Shipment_Consignee_Organisation_Location',
        'Shipment_Consignee_Organisation_Country',
        'Shipment_Consignee_Organisation_City',
        'Shipment_Consignee_Organisation_AddressType',
        'Shipment_Consignee_Organisation_AddressLine1',
        'Shipment_Consignee_Organisation_TelephoneNumberType',
        'Shipment_Consignee_Organisation_TelephoneNumber_1',
        'Shipment_Consignee_Organisation_TelephoneNumberType_Fax',
        'Shipment_Consignee_Organisation_TelephoneNumber_2',
        'Shipment_Consignee_Organisation_Sequence',
        'Shipment_Consignee_Organisation_AddressCapability_AddressType',
        'Shipment_Consignee_Organisation_AddressCapability_IsMainAddress',
        'Shipment_Consignee_Org_AddressCapability_Main_AddressType', // done
        'Shipment_Consignor_Organisation_Name',
        'Shipment_Consignor_Organisation_Location',
        'Shipment_Consignor_Organisation_Country',
        'Shipment_Consignor_Organisation_City',
        'Shipment_Consignor_Organisation_AddressType',
        'Shipment_Consignor_Organisation_AddressLine1',
        'Shipment_Consignor_Organisation_TelephoneNumberType',
        'Shipment_Consignor_Organisation_TelephoneNumber_1',
        'Shipment_Consignor_Organisation_TelephoneNumberType_Fax',
        'Shipment_Consignor_Organisation_TelephoneNumber_2',
        'Shipment_Consignor_Organisation_Sequence',
        'Shipment_Consignor_Organisation_AddressCapability_AddressType',
        'Shipment_Consignor_Organisation_AddressCapability_IsMainAddress',
        'Shipment_Consignor_Org_AddressCapability_Main_AddressType', // done

        'Notify_Organisation_Name',
        'Notify_Organisation_Location',
        'Notify_Organisation_Country',
        'Notify_Organisation_City',
        'Notify_Organisation_AddressType',
        'Notify_Organisation_AddressLine1',
        'Notify_Organisation_TelephoneNumberType',
        'Notify_Organisation_TelephoneNumber_1',
        'Notify_Organisation_TelephoneNumberType_Fax',
        'Notify_Organisation_TelephoneNumber_2',
        'Notify_Organisation_Sequence',
        'Notify_Organisation_AddressCapability_AddressType',
        'Notify_Organisation_AddressCapability_IsMainAddress',
        'Notify_Org_AddressCapability_Main_AddressType', // done
        'Shipment_PackingMode',
        'Shipment_TotalOuterPacksQty',
        'Shipment_TotalOuterPacksQty_DimensionType',
        'Shipment_Weight',
        'Shipment_Weight_DimensionType',
        'Shipment_Volume',
        'Shipment_Volume_DimensionType',
        'Shipment_GoodsValue',
        'Shipment_GoodsValue_CurrencyCode',
        'Shipment_GoodsDescription',
        'Shipment_ChargeableWeight',
        'Shipment_ChargeableWeight_DimensionType', // done
        'Shipment_ServiceLevel',
        'Shipment_Incoterm',
        'Shipment_ReleaseType',
        'Shipment_OrderReferences',
    ];

    public function ShipMarksAN()
    {
        return $this->hasMany(ShipMarksAN::class, 'shipment_id');
    }

    public function ShipContainer()
    {
        return $this->hasMany(ShipContainer::class, 'shipment_id');
    }

    public function ShipPackages()
    {
        return $this->hasMany(ShipPackages::class, 'shipment_id');
    }
}
