<?php

namespace App\Imports;

use App\Models\ShipmentMain2;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\ValidationException;


class MultipleShipmentImport implements ToCollection, WithHeadingRow, WithStartRow
{

    const EXPECTED_HEADERS_MULTIPLE = [
        'sno',
        'date',
        'organisation_name',
        'organisation_country',
        'organisation_city',
        'organisation_location_shortform',
        'organisation_addresstype',

        'organisation_addressline1', //new
        'organisation_cityorsuburb',
        'organisation_telephonenumbertype',

        'organisation_telephonenumber_1', //new
        'organisation_telephonenumbertype_fax', //new
        'organisation_telephonenumber_2', //new
        'organisation_location', //new

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
        'portofloading_estimateddatetime', //done


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
        'plannedleg_portofloading_city', // done
        'plannedleg_portofloading_text', // new
        'plannedleg_estimateddatetime',
        'plannedleg_portofdischarge_country',
        'plannedleg_portofdischarge_city',
        'plannedleg_portofdischarge_text',
        'plannedleg_transporttype',
        'plannedleg_vessel_etd',
        'plannedleg_vesselname',
        'plannedleg_voyageno', // done
        'sendingagent_organisation_name',
        'sendingagent_organisation_country',
        'sendingagent_organisation_city',
        'sendingagent_organisation_location', // new
        'sendingagent_organisation_addresstype',
        'sendingagent_organisation_addressline1', // new
        'sendingagent_organisation_telephonenumbertype',
        'sendingagent_organisation_telephonenumber_1', //new
        'sendingagent_organisation_telephonenumbertype_fax', //new
        'sendingagent_organisation_telephonenumber_2', //new
        'sendingagent_organisation_sequence',
        'sendingagent_organisation_addresscapability_addresstype',
        'sendingagent_organisation_addresscapability_ismainaddress',
        'sendingagent_organisation_addresscapability_main_addresstype',
        'receivingagent_organisation_name',
        'receivingagent_organisation_country', // done
        'receivingagent_organisation_city',
        'receivingagent_organisation_location', // new
        'receivingagent_organisation_addresstype',
        'receivingagent_organisation_addressline1', // done

        'receivingagent_organisation_telephonenumbertype', //new
        'receivingagent_organisation_telephonenumber_1', //new
        'receivingagent_organisation_telephonenumbertype_fax', //new
        'receivingagent_organisation_telephonenumber_2', //new
        'receivingagent_organisation_addresscapabilitytype', //new


        'receivingagent_organisation_addresscapability_ismainaddress',
        'receivingagent_organisation_addresscapability_addresstype',
        'carrier_organisation_name',
        'carrier_organisation_country',
        'carrier_organisation_city',
        'carrier_organisation_addresstype', // done

        'carrier_organisation_location', // new
        'carrier_organisation_telephonenumbertype', // new
        'carrier_organisation_telephonenumber_1', // new
        'carrier_organisation_telephonenumbertype_fax', // new
        'carrier_organisation_telephonenumber_2', // new
        'receivingagent_organisation_sequence', // new

        'carrier_organisation_addresscapability_mainaddress', // new

        'carrier_organisation_addresscapability_ismainaddress',
        'carrier_organisation_addresscapability_main_addresstype', // done
        'shipment_shipmentidentifiertype',
        'shipment_shipmentidentifier_text',
        'shipment_transportmode', // done
        'shipment_datecreated', // new
        'shipment_consignee_organisation_name', // done

        'shipment_consignee_organisation_location', // new
        'shipment_consignee_organisation_country', // new
        'shipment_consignee_organisation_city', // new

        'shipment_consignee_organisation_addresstype',
        'shipment_consignee_organisation_addressline1', // done


        'shipment_consignee_organisation_telephonenumbertype', // new
        'shipment_consignee_organisation_telephonenumber_1', // new
        'shipment_consignee_organisation_telephonenumbertype_fax', // new
        'shipment_consignee_organisation_telephonenumber_2', // new

        'shipment_consignee_organisation_sequence', // new
        'shipment_consignee_organisation_addresscapability_addresstype', // new
        'shipment_consignee_organisation_addresscapability_ismainaddress', // new
        'shipment_consignee_org_addresscapability_main_addresstype', // new done


        'shipment_consignor_organisation_name', // done


        'shipment_consignor_organisation_location', // new
        'shipment_consignor_organisation_country', // new
        'shipment_consignor_organisation_city', // new // done


        'shipment_consignor_organisation_addresstype',
        'shipment_consignor_organisation_addressline1', // done


        'shipment_consignor_organisation_telephonenumbertype', // new
        'shipment_consignor_organisation_telephonenumber_1', // new
        'shipment_consignor_organisation_telephonenumbertype_fax', // new
        'shipment_consignor_organisation_telephonenumber_2', // new
        'shipment_consignor_organisation_sequence', // new done

        'shipment_consignor_organisation_addresscapability_addresstype',
        'shipment_consignor_organisation_addresscapability_ismainaddress',
        'shipment_consignor_org_addresscapability_main_addresstype', // done

        'notify_organisation_name', // new
        'notify_organisation_location', // new
        'notify_organisation_country', // new
        'notify_organisation_city', // new
        'notify_organisation_addresstype', // new done

        'notify_organisation_addressline1', // new
        'notify_organisation_telephonenumbertype', // new
        'notify_organisation_telephonenumber_1', // new
        'notify_organisation_telephonenumbertype_fax', // new
        'notify_organisation_telephonenumber_2', // new

        'notify_organisation_sequence', // new
        'notify_organisation_addresscapability_addresstype', // new
        'notify_organisation_addresscapability_ismainaddress', // new
        'notify_org_addresscapability_main_addresstype', // new


        'shipment_packingmode',
        'shipment_totalouterpacksqty', // done
        'shipment_totalouterpacksqty_dimensiontype', // new
        'shipment_weight',
        'shipment_weight_dimensiontype', //new
        'shipment_volume', // done
        'shipment_volume_dimensiontype', // new
        'shipment_goodsvalue', // new
        'shipment_goodsvalue_currencycode', // new done

        'shipment_goodsdescription',
        'shipment_chargeableweight', // done

        'shipment_chargeableweight_dimensiontype', // new
        'shipment_servicelevel',
        'shipment_incoterm',
        'shipment_releasetype',
        'shipment_orderreferences',
    ];

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
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $headerRow = $rows->first()->keys()->toArray();
        foreach ($headerRow as $index => $value) {
            $headerRow[$index] = trim($value);
        }

        $errors = [];

        foreach (self::EXPECTED_HEADERS_MULTIPLE as $index => $expectedHeader) {
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
        $insertedIds = [];
        $serialIds = [];
        foreach ($rows as $row) {

            $NewShipments =  ShipmentMain2::create([
                'InterchangeInfoDate' => $this->excelDateToISO($row['date']), //ok
                'Organisation_Name' => $row['organisation_name'],
                'Organisation_Country' => strtoupper($row['organisation_country']),
                'Organisation_City' => strtoupper($row['organisation_city']),
                'Organisation_Location_shortform' => $row['organisation_location_shortform'],


                'Organisation_AddressType' => strtoupper($row['organisation_addresstype']),

                'Organisation_AddressLine1' => strtoupper($row['organisation_addressline1']), //new

                'Organisation_CityOrSuburb' => $row['organisation_cityorsuburb'],
                'Organisation_TelephoneNumberType' => ucwords(strtolower($row['organisation_telephonenumbertype'])),

                'Organisation_TelephoneNumber_1' => $row['organisation_telephonenumber_1'], //new
                'Organisation_TelephoneNumberType_Fax' => ucwords(strtolower($row['organisation_telephonenumbertype_fax'])), //new
                'Organisation_TelephoneNumber_2' => $row['organisation_telephonenumber_2'], //new
                'Organisation_Location' => $row['organisation_location'], //new

                'Organisation_Sequence' => $row['organisation_sequence'],
                'Organisation_AddressCapability_AddressType' => strtoupper($row['organisation_addresscapability_addresstype']),

                'Organisation_AddressCapabilities_IsMainAddress' => ($row['organisation_addresscapabilities_ismainaddress'] === 'TRUE' || $row['organisation_addresscapabilities_ismainaddress'] === true) ? 'true' : 'false',
                'Organisation_AddressCapabilities_AddressType' => strtoupper($row['organisation_addresscapabilities_addresstype']),
                'ConsolIdentifier_ConsolIdentifierType' => $row['consolidentifier_consolidentifiertype'],




                'ConsolDetail_DateCreated' => $this->excelDateToISO($row['consoldetail_datecreated']),
                'ConsolDetail_ConsolType' => ucwords(strtolower($row['consoldetail_consoltype'])),
                'ConsolDetail_ContainerMode' => strtoupper($row['consoldetail_containermode']),
                'ConsolDetail_TransportMode' => strtoupper($row['consoldetail_transportmode']), //ok
                'PortOfLoading_Country' => strtoupper($row['portofloading_country']),
                'PortOfLoading_City' => strtoupper($row['portofloading_city']),
                'PortOfLoading_Text' => strtoupper($row['portofloading_text']),
                'PortOfLoading_EstimatedDateTime' => $this->excelDateToISO($row['portofloading_estimateddatetime']), //ok done

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
                'PlannedLeg_PortOfLoading_City' => strtoupper($row['plannedleg_portofloading_city']), //ok done
                'PlannedLeg_PortOfLoading_Text' => strtoupper($row['plannedleg_portofloading_text']), //ok done

                'PlannedLeg_EstimatedDateTime' => $this->excelDateToISO($row['plannedleg_estimateddatetime']),
                'PlannedLeg_PortOfDischarge_Country' => strtoupper($row['plannedleg_portofdischarge_country']),
                'PlannedLeg_PortOfDischarge_City' => strtoupper($row['plannedleg_portofdischarge_city']),
                'PlannedLeg_PortOfDischarge_Text' => strtoupper($row['plannedleg_portofdischarge_text']), // ok

                'PlannedLeg_TransportType' => $row['plannedleg_transporttype'],

                'PlannedLeg_Vessel_ETD' => $this->excelDateToISO($row['plannedleg_vessel_etd']), //ok

                //2
                'PlannedLeg_VesselName' => strtoupper($row['plannedleg_vesselname']),
                'PlannedLeg_VoyageNo' => $row['plannedleg_voyageno'], // done

                'SendingAgent_Organisation_NAME' => $row['sendingagent_organisation_name'],
                'SendingAgent_Organisation_Country' => strtoupper($row['sendingagent_organisation_country']),
                'SendingAgent_Organisation_City' => strtoupper($row['sendingagent_organisation_city']),
                'SendingAgent_Organisation_Location' => strtoupper($row['sendingagent_organisation_location']),

                //2
                'SendingAgent_Organisation_AddressType' => strtoupper($row['sendingagent_organisation_addresstype']), //ok
                'SendingAgent_Organisation_AddressLine1' => $row['sendingagent_organisation_addressline1'], //ok new

                'SendingAgent_Organisation_TelephoneNumberType' => ucwords(strtolower($row['sendingagent_organisation_telephonenumbertype'])), //ok
                'SendingAgent_Organisation_TelephoneNumber_1' => $row['sendingagent_organisation_telephonenumber_1'], //new
                'SendingAgent_Organisation_TelephoneNumberType_Fax' => ucwords(strtolower($row['sendingagent_organisation_telephonenumbertype_fax'])), //new
                'SendingAgent_Organisation_TelephoneNumber_2' => $row['sendingagent_organisation_telephonenumber_2'], //new



                'SendingAgent_Organisation_Sequence' => $row['sendingagent_organisation_sequence'],
                'SendingAgent_Organisation_AddressCapability_AddressType' => strtoupper($row['sendingagent_organisation_addresscapability_addresstype']),
                'SendingAgent_Organisation_AddressCapability_IsMainAddress' => ($row['sendingagent_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['sendingagent_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false',
                'SendingAgent_Organisation_AddressCapability_Main_AddressType' => strtoupper($row['sendingagent_organisation_addresscapability_main_addresstype']), //ok



                'ReceivingAgent_Organisation_NAME' => strtoupper($row['receivingagent_organisation_name']),
                'ReceivingAgent_Organisation_Country' => strtoupper($row['receivingagent_organisation_country']), // done
                'ReceivingAgent_Organisation_City' => strtoupper($row['receivingagent_organisation_city']),
                'ReceivingAgent_Organisation_Location' => strtoupper($row['receivingagent_organisation_location']), // new
                //2
                'ReceivingAgent_Organisation_AddressType' => strtoupper($row['receivingagent_organisation_addresstype']),
                'ReceivingAgent_Organisation_AddressLine1' => $row['receivingagent_organisation_addressline1'], //ok  done

                'ReceivingAgent_Organisation_TelephoneNumberType' => ucwords(strtolower($row['receivingagent_organisation_telephonenumbertype'])), //new
                'ReceivingAgent_Organisation_TelephoneNumber_1' => $row['receivingagent_organisation_telephonenumber_1'], //new
                'ReceivingAgent_Organisation_TelephoneNumberType_Fax' => ucwords(strtolower($row['receivingagent_organisation_telephonenumbertype_fax'])), //new
                'ReceivingAgent_Organisation_TelephoneNumber_2' => $row['receivingagent_organisation_telephonenumber_2'], //new
                'ReceivingAgent_Organisation_AddressCapabilityType' => strtoupper($row['receivingagent_organisation_addresscapabilitytype']), //new


                //3
                'ReceivingAgent_Organisation_AddressCapability_IsMainAddress' => ($row['receivingagent_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['receivingagent_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false',
                'ReceivingAgent_Organisation_AddressCapability_AddressType' => strtoupper($row['receivingagent_organisation_addresscapability_addresstype']),

                'Carrier_Organisation_NAME' => strtoupper($row['carrier_organisation_name']),
                'Carrier_Organisation_Country' => strtoupper($row['carrier_organisation_country']),
                'Carrier_Organisation_City' => strtoupper($row['carrier_organisation_city']),
                //3
                'Carrier_Organisation_AddressType' => strtoupper($row['carrier_organisation_addresstype']), // done

                //new
                'Carrier_Organisation_Location' => strtoupper($row['carrier_organisation_location']), // new
                'Carrier_Organisation_TelephoneNumberType' => ucwords(strtolower($row['carrier_organisation_telephonenumbertype'])), // new
                'Carrier_Organisation_TelephoneNumber_1' => $row['carrier_organisation_telephonenumber_1'], // new
                'Carrier_Organisation_TelephoneNumberType_Fax' => ucwords(strtolower($row['carrier_organisation_telephonenumbertype_fax'])), // new
                'Carrier_Organisation_TelephoneNumber_2' => $row['carrier_organisation_telephonenumber_2'], // new
                'ReceivingAgent_Organisation_Sequence' => $row['receivingagent_organisation_sequence'], // new
                'Carrier_Organisation_AddressCapability_MainAddress' => strtoupper($row['carrier_organisation_addresscapability_mainaddress']), // new
                //new


                // 'Carrier_Organisation_AddressCapability_AddressType' => strtoupper($row['carrier_organisation_addresscapability_addresstype']), //ok

                'Carrier_Organisation_AddressCapability_IsMainAddress' => ($row['carrier_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['carrier_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false',
                'Carrier_Organisation_AddressCapability_Main_AddressType' => strtoupper($row['carrier_organisation_addresscapability_main_addresstype']), //ok
                //done

                'Shipment_ShipmentIdentifierType' => $row['shipment_shipmentidentifiertype'],
                'Shipment_ShipmentIdentifier_Text' => $row['shipment_shipmentidentifier_text'],
                'Shipment_TransportMode' => strtoupper($row['shipment_transportmode']), // done
                'Shipment_DateCreated' => $this->excelDateToISO($row['shipment_datecreated']),

                'Shipment_Consignee_Organisation_Name' => $row['shipment_consignee_organisation_name'], // done

                'Shipment_Consignee_Organisation_Location' => strtoupper($row['shipment_consignee_organisation_location']), // new
                'Shipment_Consignee_Organisation_Country' => strtoupper($row['shipment_consignee_organisation_country']), // new
                'Shipment_Consignee_Organisation_City' => strtoupper($row['shipment_consignee_organisation_city']), // new


                'Shipment_Consignee_Organisation_AddressType' => strtoupper($row['shipment_consignee_organisation_addresstype']), //ok

                'Shipment_Consignee_Organisation_AddressLine1' => $row['shipment_consignee_organisation_addressline1'], // done

                //new
                'Shipment_Consignee_Organisation_TelephoneNumberType' => ucwords(strtolower($row['shipment_consignee_organisation_telephonenumbertype'])), // new

                'Shipment_Consignee_Organisation_TelephoneNumber_1' => $row['shipment_consignee_organisation_telephonenumber_1'], // new
                'Shipment_Consignee_Organisation_TelephoneNumberType_Fax' => ucwords(strtolower($row['shipment_consignee_organisation_telephonenumbertype_fax'])), // new

                'Shipment_Consignee_Organisation_TelephoneNumber_2' => $row['shipment_consignee_organisation_telephonenumber_2'], // new

                'Shipment_Consignee_Organisation_Sequence' => $row['shipment_consignee_organisation_sequence'], // new
                'Shipment_Consignee_Organisation_AddressCapability_AddressType' => strtoupper($row['shipment_consignee_organisation_addresscapability_addresstype']), // new


                'Shipment_Consignee_Organisation_AddressCapability_IsMainAddress' => ($row['shipment_consignee_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['shipment_consignee_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false', // new



                'Shipment_Consignee_Org_AddressCapability_Main_AddressType' => strtoupper($row['shipment_consignee_org_addresscapability_main_addresstype']), // new
                //new done

                'Shipment_Consignor_Organisation_Name' => $row['shipment_consignor_organisation_name'], // done

                'Shipment_Consignor_Organisation_Location' => strtoupper($row['shipment_consignor_organisation_location']), //new
                'Shipment_Consignor_Organisation_Country' => strtoupper($row['shipment_consignor_organisation_country']), //new
                'Shipment_Consignor_Organisation_City' => strtoupper($row['shipment_consignor_organisation_city']), //new // done


                'Shipment_Consignor_Organisation_AddressType' => strtoupper($row['shipment_consignor_organisation_addresstype']),
                'Shipment_Consignor_Organisation_AddressLine1' => $row['shipment_consignor_organisation_addressline1'], // done


                //new
                'Shipment_Consignor_Organisation_TelephoneNumberType' => ucwords(strtolower($row['shipment_consignor_organisation_telephonenumbertype'])), // new
                'Shipment_Consignor_Organisation_TelephoneNumber_1' => $row['shipment_consignor_organisation_telephonenumber_1'], // new
                'Shipment_Consignor_Organisation_TelephoneNumberType_Fax' => ucwords(strtolower($row['shipment_consignor_organisation_telephonenumbertype_fax'])), // new
                'Shipment_Consignor_Organisation_TelephoneNumber_2' => $row['shipment_consignor_organisation_telephonenumber_2'], // new
                'Shipment_Consignor_Organisation_Sequence' => $row['shipment_consignor_organisation_sequence'], // new done
                //new
                //3
                'Shipment_Consignor_Organisation_AddressCapability_AddressType' => strtoupper($row['shipment_consignor_organisation_addresscapability_addresstype']),
                'Shipment_Consignor_Organisation_AddressCapability_IsMainAddress' => ($row['shipment_consignor_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['shipment_consignor_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false',
                'Shipment_Consignor_Org_AddressCapability_Main_AddressType' => strtoupper($row['shipment_consignor_org_addresscapability_main_addresstype']),
                // done

                // new
                'Notify_Organisation_Name' => $row['notify_organisation_name'], // new
                'Notify_Organisation_Location' => strtoupper($row['notify_organisation_location']), // new
                'Notify_Organisation_Country' => strtoupper($row['notify_organisation_country']), // new
                'Notify_Organisation_City' => strtoupper($row['notify_organisation_city']), // new
                'Notify_Organisation_AddressType' => strtoupper($row['notify_organisation_addresstype']), // new
                // new
                'Notify_Organisation_AddressLine1' => $row['notify_organisation_addressline1'], // new
                'Notify_Organisation_TelephoneNumberType' => ucwords(strtolower($row['notify_organisation_telephonenumbertype'])), // new
                'Notify_Organisation_TelephoneNumber_1' => $row['notify_organisation_telephonenumber_1'], // new
                'Notify_Organisation_TelephoneNumberType_Fax' => ucwords(strtolower($row['notify_organisation_telephonenumbertype_fax'])), // new
                'Notify_Organisation_TelephoneNumber_2' => $row['notify_organisation_telephonenumber_2'], // new

                'Notify_Organisation_Sequence' => $row['notify_organisation_sequence'], // new
                'Notify_Organisation_AddressCapability_AddressType' => strtoupper($row['notify_organisation_addresscapability_addresstype']), //new                

                'Notify_Organisation_AddressCapability_IsMainAddress' => ($row['notify_organisation_addresscapability_ismainaddress'] === 'TRUE' || $row['notify_organisation_addresscapability_ismainaddress'] === true) ? 'true' : 'false', // new


                'Notify_Org_AddressCapability_Main_AddressType' => strtoupper($row['notify_org_addresscapability_main_addresstype']), //new


                'Shipment_PackingMode' => strtoupper($row['shipment_packingmode']), //ok

                'Shipment_TotalOuterPacksQty' => $row['shipment_totalouterpacksqty'], // done

                'Shipment_TotalOuterPacksQty_DimensionType' => strtoupper($row['shipment_totalouterpacksqty_dimensiontype']), //new

                'Shipment_Weight' => $row['shipment_weight'],
                'Shipment_Weight_DimensionType' => strtoupper($row['shipment_weight_dimensiontype']), //new
                'Shipment_Volume' => $row['shipment_volume'],
                'Shipment_Volume_DimensionType' => strtoupper($row['shipment_volume_dimensiontype']), //new
                'Shipment_GoodsValue' => $row['shipment_goodsvalue'], //new
                'Shipment_GoodsValue_CurrencyCode' => strtoupper($row['shipment_goodsvalue_currencycode']), //new done

                'Shipment_GoodsDescription' => $row['shipment_goodsdescription'],
                'Shipment_ChargeableWeight' => $row['shipment_chargeableweight'], // done

                'Shipment_ChargeableWeight_DimensionType' => strtoupper($row['shipment_chargeableweight_dimensiontype']), //new
                //3
                'Shipment_ServiceLevel' => strtoupper($row['shipment_servicelevel']),

                'Shipment_Incoterm' => strtoupper($row['shipment_incoterm']),

                //3
                'Shipment_ReleaseType' => strtoupper($row['shipment_releasetype']),
                'Shipment_OrderReferences' => $row['shipment_orderreferences'], //new

            ]);

            $insertedIds[] = $NewShipments->id;
            $serialIds[] = $row['sno'];
        }

        App::instance('inserted_ids', $insertedIds);
        App::instance('serial_ids', $serialIds);
    }
}
