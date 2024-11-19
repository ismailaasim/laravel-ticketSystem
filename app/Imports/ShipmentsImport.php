<?php

namespace App\Imports;

use App\Models\Shipment;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\ValidationException;


class ShipmentsImport implements ToCollection, WithHeadingRow, WithStartRow
{
    const EXPECTED_HEADERS = [
        'date',
        'organisation_name',
        'organisation_country',
        'organisation_city',
        'organisation_location_shortform',

        //new 10 - 1
        'organisation_addresstype',
        'organisation_cityorsuburb',
        'organisation_telephonenumbertype',
        'organisation_sequence',
        'organisation_addresscapability_addresstype',
        'organisation_addresscapabilities_ismainaddress',
        'organisation_addresscapabilities_addresstype',
        'consolidentifier_consolidentifiertype',

        'consoldetail_datecreated',
        'consoldetail_consoltype',
        'consoldetail_containermode',
        'consoldetail_transportmode',

        'portofloading_country',
        'portofloading_city',
        'portofloading_text',
        'portofloading_estimateddatetime',

        'portofdischarge_country',
        'portofdischarge_city',
        'portofdischarge_text',
        'portofdischarge_estimateddatetime',

        'vessel_etd',
        'vessel_eta',
        'vessel_vesselname',
        'vessel_voyageno',
        'plannedleg_transportmode',

        'plannedleg_portofloading_country',
        'plannedleg_portofloading_city',
        'plannedleg_estimateddatetime',

        'plannedleg_portofdischarge_country',
        'plannedleg_portofdischarge_city',
        'plannedleg_portofdischarge_text',

        // new 10 - 1
        'plannedleg_transporttype',
        'plannedleg_vessel_etd',

        // new 10 - 2
        'plannedleg_vesselname',
        'plannedleg_voyageno',

        'sendingagent_organisation_name',
        'sendingagent_organisation_country',
        'sendingagent_organisation_city',

        // new 10 - 2
        'sendingagent_organisation_addresstype',
        'sendingagent_organisation_telephonenumbertype',
        'sendingagent_organisation_sequence',
        'sendingagent_organisation_addresscapability_addresstype',
        'sendingagent_organisation_addresscapability_ismainaddress',
        'sendingagent_organisation_addresscapability_main_addresstype',

        'receivingagent_organisation_name',
        'receivingagent_organisation_country',
        'receivingagent_organisation_city',

        //new 10 - 2
        'receivingagent_organisation_addresstype',
        'receivingagent_organisation_addressline1',

        //3
        'receivingagent_organisation_addresscapability_ismainaddress',
        'receivingagent_organisation_addresscapability_addresstype',

        'carrier_organisation_name',
        'carrier_organisation_country',
        'carrier_organisation_city',

        //3
        'carrier_organisation_addresstype',
        'carrier_organisation_addresscapability_addresstype',
        'carrier_organisation_addresscapability_ismainaddress',
        'carrier_organisation_addresscapability_main_addresstype',

        'container_containernumber',

        'container_containertype_isocode',
        'container_containertype_uscontainercode',
        'container_containertype_containercode',

        'container_seal',
        'container_packingmode',
        'container_isarrivingatctobyrail',
        'container_isemptycontainer',

        'container_isdamaged',
        'shipment_shipmentidentifiertype',
        'shipment_shipmentidentifier_text',
        'shipment_transportmode',

        'shipment_consignee_organisation_name',
        'shipment_consignee_organisation_addresstype',
        'shipment_consignee_organisation_addressline1',

        'shipment_consignor_organisation_name',
        'shipment_consignor_organisation_addresstype',

        'shipment_consignor_organisation_addressline1',

        //3
        'shipment_consignor_organisation_addresscapability_addresstype',
        'shipment_consignor_organisation_addresscapability_ismainaddress',
        'shipment_consignor_org_addresscapability_main_addresstype',

        'shipment_packingmode',
        'shipment_totalouterpacksqty',
        'shipment_weight',
        'shipment_volume',
        'shipment_goodsdescription',

        'shipment_chargeableweight',
        'shipment_marksandnumbers',
        //3
        'shipment_servicelevel',

        'shipment_incoterm',

        //3
        'shipment_releasetype',
        'shipment_packtype',


        'shipment_numberofpacks',
        'shipment_package_weight',

        'shipment_package_weight_dimensiontype',
        'shipment_package_volume',
        'shipment_package_volume_dimensiontype',
        'shipment_package_containernumber',
    ];

    public $falseTitle = array(
        'container_isarrivingatctobyrail',
        'container_isemptycontainer',
        'container_isdamaged'
    );

    public function headingRow(): int
    {
        return 1; // Assuming the headers are in the first row
    }

    public function startRow(): int
    {
        return 2;
    }
    public function excelDateToISO($serial)
    {
        $baseDate = new \DateTime("1899-12-30"); // Excel's base date
        $baseDate->modify("+{$serial} days");
        return $baseDate->format('Y-m-d\TH:i:s.u');
    }

    public function collection(Collection $rows)
    {
        $headerRow = $rows->first()->keys()->toArray();

        foreach ($headerRow as $index => $value) {
            $headerRow[$index] = trim($value);
        }

        $errors = [];

        // Validate headers
        foreach (self::EXPECTED_HEADERS as $index => $expectedHeader) {
            if (!isset($headerRow[$index]) || $headerRow[$index] !== $expectedHeader) {
                $length = strlen(trim($headerRow[$index]));
                if ($length <= 1) {
                    $err = 'Invalid Or Empty title';
                    $errors[] = "Expected header '{$expectedHeader}' but found '{$err}' at position " . ($index + 1);
                } else {
                    $errors[] = "Expected header '{$expectedHeader}' but found '{$headerRow[$index]}' at position " . ($index + 1);
                }
            }
        }

        if (!empty($errors)) {
            session()->flash('errors', $errors);
            throw ValidationException::withMessages($errors);
        }

        // Validate each row
        foreach ($rows as $rowIndex => $row) {
            foreach (self::EXPECTED_HEADERS as $header) {
                if (!isset($row[$header]) || $row[$header] === '') {
                    if (!isset($row[$header]) || (isset($row[$header]) && $row[$header] !== 'FALSE')) {
                        $errors[] = "Row " . ($rowIndex + 2) . ": $header is empty";
                    }
                }
            }
        }

        if (!empty($errors)) {
            session()->flash('errors', $errors);
            throw ValidationException::withMessages($errors);
        }

        // Insert the validated rows into the database
        foreach ($rows as $row) {
            Shipment::create([
                'InterchangeInfoDate' => $this->excelDateToISO($row['date']),//ok
                'Organisation_Name' => $row['organisation_name'],
                'Organisation_Country' => strtoupper($row['organisation_country']),
                'Organisation_City' => strtoupper($row['organisation_city']),
                'Organisation_Location_shortform' => $row['organisation_location_shortform'],


                'Organisation_AddressType' => strtoupper($row['organisation_addresstype']),
                'Organisation_CityOrSuburb' => $row['organisation_cityorsuburb'],
                'Organisation_TelephoneNumberType' => ucwords(strtolower($row['organisation_telephonenumbertype'])),
                'Organisation_Sequence' => $row['organisation_sequence'],
                'Organisation_AddressCapability_AddressType' => strtoupper($row['organisation_addresscapability_addresstype']),

                'Organisation_AddressCapabilities_IsMainAddress' => ($row['organisation_addresscapabilities_ismainaddress'] === 'TRUE' || $row['organisation_addresscapabilities_ismainaddress'] === true) ? 'true' : 'false',


                'Organisation_AddressCapabilities_AddressType' => strtoupper($row['organisation_addresscapabilities_addresstype']),
                'ConsolIdentifier_ConsolIdentifierType' => $row['consolidentifier_consolidentifiertype'],




                'ConsolDetail_DateCreated' => $this->excelDateToISO($row['consoldetail_datecreated']),
                'ConsolDetail_ConsolType' => ucwords(strtolower($row['consoldetail_consoltype'])),
                'ConsolDetail_ContainerMode' => strtoupper($row['consoldetail_containermode']),
                'ConsolDetail_TransportMode' => strtoupper($row['consoldetail_transportmode']),//ok
                'PortOfLoading_Country' => strtoupper($row['portofloading_country']),
                'PortOfLoading_City' => strtoupper($row['portofloading_city']),
                'PortOfLoading_Text' => strtoupper($row['portofloading_text']),
                'PortOfLoading_EstimatedDateTime' => $this->excelDateToISO($row['portofloading_estimateddatetime']),//ok

                'PortOfDischarge_Country' => strtoupper($row['portofdischarge_country']),
                'PortOfDischarge_City' => strtoupper($row['portofdischarge_city']),
                'PortOfDischarge_Text' => strtoupper($row['portofdischarge_text']),

                'PortOfDischarge_EstimatedDateTime' => $this->excelDateToISO($row['portofdischarge_estimateddatetime']),

                'Vessel_ETD' => $this->excelDateToISO($row['vessel_etd']),
                'Vessel_ETA' => $this->excelDateToISO($row['vessel_eta']), //ok

                'Vessel_VesselName' => $row['vessel_vesselname'],
                'Vessel_VoyageNo' => $row['vessel_voyageno'], //ok

                'PlannedLeg_TransportMode' => strtoupper($row['plannedleg_transportmode']),
                'PlannedLeg_PortOfLoading_Country' => strtoupper($row['plannedleg_portofloading_country']),
                'PlannedLeg_PortOfLoading_City' => strtoupper($row['plannedleg_portofloading_city']),//ok

                'PlannedLeg_EstimatedDateTime' => $this->excelDateToISO($row['plannedleg_estimateddatetime']),
                'PlannedLeg_PortOfDischarge_Country' => strtoupper($row['plannedleg_portofdischarge_country']),
                'PlannedLeg_PortOfDischarge_City' => strtoupper($row['plannedleg_portofdischarge_city']),
                'PlannedLeg_PortOfDischarge_Text' => strtoupper($row['plannedleg_portofdischarge_text']), // ok

                'PlannedLeg_TransportType' => $row['plannedleg_transporttype'],

                'PlannedLeg_Vessel_ETD' => $this->excelDateToISO($row['plannedleg_vessel_etd']), //ok

                //2
                'PlannedLeg_VesselName' => strtoupper($row['plannedleg_vesselname']),
                'PlannedLeg_VoyageNo' => $row['plannedleg_voyageno'],

                'SendingAgent_Organisation_NAME' => $row['sendingagent_organisation_name'],
                'SendingAgent_Organisation_Country' => strtoupper($row['sendingagent_organisation_country']),
                'SendingAgent_Organisation_City' => strtoupper($row['sendingagent_organisation_city']),

                //2
                'SendingAgent_Organisation_AddressType' => strtoupper($row['sendingagent_organisation_addresstype']),//ok

                'SendingAgent_Organisation_TelephoneNumberType' => ucwords(strtolower($row['sendingagent_organisation_telephonenumbertype'])),//ok
                'SendingAgent_Organisation_Sequence' => $row['sendingagent_organisation_sequence'],
                'SendingAgent_Organisation_AddressCapability_AddressType' => strtoupper($row['sendingagent_organisation_addresscapability_addresstype']),
                'SendingAgent_Organisation_AddressCapability_IsMainAddress' => ($row['sendingagent_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['sendingagent_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false',
                'SendingAgent_Organisation_AddressCapability_Main_AddressType' => strtoupper($row['sendingagent_organisation_addresscapability_main_addresstype']), //ok



                'ReceivingAgent_Organisation_NAME' => strtoupper($row['receivingagent_organisation_name']),
                'ReceivingAgent_Organisation_Country' => strtoupper($row['receivingagent_organisation_country']),
                'ReceivingAgent_Organisation_City' => strtoupper($row['receivingagent_organisation_city']),

                //2
                'ReceivingAgent_Organisation_AddressType' => strtoupper($row['receivingagent_organisation_addresstype']),
                'ReceivingAgent_Organisation_AddressLine1' => $row['receivingagent_organisation_addressline1'], //ok

                //3
                'ReceivingAgent_Organisation_AddressCapability_IsMainAddress' => ($row['receivingagent_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['receivingagent_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false',
                'ReceivingAgent_Organisation_AddressCapability_AddressType' => strtoupper($row['receivingagent_organisation_addresscapability_addresstype']),

                'Carrier_Organisation_NAME' => strtoupper($row['carrier_organisation_name']),
                'Carrier_Organisation_Country' => strtoupper($row['carrier_organisation_country']),
                'Carrier_Organisation_City' => strtoupper($row['carrier_organisation_city']),

                //3
                'Carrier_Organisation_AddressType' => strtoupper($row['carrier_organisation_addresstype']),
                'Carrier_Organisation_AddressCapability_AddressType' => strtoupper($row['carrier_organisation_addresscapability_addresstype']), //ok

                'Carrier_Organisation_AddressCapability_IsMainAddress' => ($row['carrier_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['carrier_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false',
                'Carrier_Organisation_AddressCapability_Main_AddressType' => strtoupper($row['carrier_organisation_addresscapability_main_addresstype']), //ok


                'Container_ContainerNumber' => $row['container_containernumber'],
                'Container_ContainerType_ISOCode' => $row['container_containertype_isocode'],
                'Container_ContainerType_USContainerCode' => $row['container_containertype_uscontainercode'],
                'Container_ContainerType_ContainerCode' => $row['container_containertype_containercode'],
                'Container_Seal' => $row['container_seal'],
                'Container_PackingMode' => strtoupper($row['container_packingmode']), //ok


                // 'Container_IsArrivingAtCTOByRail' => $row['container_isarrivingatctobyrail'],
                'Container_IsArrivingAtCTOByRail' => ($row['container_isarrivingatctobyrail'] === 'TRUE' || $row['container_isarrivingatctobyrail'] === true) ? 'true' : 'false',



                // 'Container_IsEmptyContainer' => $row['container_isemptycontainer'],
                'Container_IsEmptyContainer' => ($row['container_isemptycontainer'] === 'TRUE' || $row['container_isemptycontainer'] === true) ? 'true' : 'false',





                // 'Container_IsDamaged' => $row['container_isdamaged'],
                'Container_IsDamaged' => ($row['container_isdamaged'] === 'TRUE' || $row['container_isdamaged'] === true) ? 'true' : 'false',




                'Shipment_ShipmentIdentifierType' => $row['shipment_shipmentidentifiertype'],
                'Shipment_ShipmentIdentifier_Text' => $row['shipment_shipmentidentifier_text'],
                'Shipment_TransportMode' => strtoupper($row['shipment_transportmode']),

                'Shipment_Consignee_Organisation_Name' => $row['shipment_consignee_organisation_name'],
                'Shipment_Consignee_Organisation_AddressType' => strtoupper($row['shipment_consignee_organisation_addresstype']), //ok

                'Shipment_Consignee_Organisation_AddressLine1' => $row['shipment_consignee_organisation_addressline1'],
                'Shipment_Consignor_Organisation_Name' => $row['shipment_consignor_organisation_name'],
                'Shipment_Consignor_Organisation_AddressType' => strtoupper($row['shipment_consignor_organisation_addresstype']),
                'Shipment_Consignor_Organisation_AddressLine1' => $row['shipment_consignor_organisation_addressline1'],

                //3
                'Shipment_Consignor_Organisation_AddressCapability_AddressType' => strtoupper($row['shipment_consignor_organisation_addresscapability_addresstype']),
                'Shipment_Consignor_Organisation_AddressCapability_IsMainAddress' => ($row['shipment_consignor_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['shipment_consignor_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false',
                'Shipment_Consignor_Org_AddressCapability_Main_AddressType' => strtoupper($row['shipment_consignor_org_addresscapability_main_addresstype']),

                'Shipment_PackingMode' => strtoupper($row['shipment_packingmode']), //ok
                
                'Shipment_TotalOuterPacksQty' => $row['shipment_totalouterpacksqty'],
                'Shipment_Weight' => $row['shipment_weight'],
                'Shipment_Volume' => $row['shipment_volume'],
                'Shipment_GoodsDescription' => $row['shipment_goodsdescription'],
                'Shipment_ChargeableWeight' => $row['shipment_chargeableweight'],
                'Shipment_MarksAndNumbers' => $row['shipment_marksandnumbers'],

                //3
                'Shipment_ServiceLevel' => $row['shipment_servicelevel'],

                'Shipment_Incoterm' => $row['shipment_incoterm'],

                //3
                'Shipment_ReleaseType' => $row['shipment_releasetype'],
                'Shipment_PackType' => $row['shipment_packtype'],



                'Shipment_NumberOfPacks' => $row['shipment_numberofpacks'],
                'Shipment_Package_Weight' => $row['shipment_package_weight'],
                'Shipment_Package_Weight_DimensionType' => $row['shipment_package_weight_dimensiontype'],
                'Shipment_Package_Volume' => $row['shipment_package_volume'],
                'Shipment_Package_Volume_DimensionType' => $row['shipment_package_volume_dimensiontype'],
                'Shipment_Package_ContainerNumber' => $row['shipment_package_containernumber']
            ]);
        }
    }
}
