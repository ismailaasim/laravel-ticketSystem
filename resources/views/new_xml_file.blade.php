<?xml version="1.0" encoding="us-ascii"?>
<XmlInterchange xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    Version="1" xmlns="http://www.edi.com.au/EnterpriseService/">
    <InterchangeInfo>
        <Date>{{ $shipments->InterchangeInfoDate }}</Date>
        <Target />
        <EDIOrganisation EDICode="" OwnerCode="">
            <OrganisationDetails>
                <Name>{{ $shipments->Organisation_Name }}</Name>
                <Location Country="{{ $shipments->Organisation_Country }}" City="{{ $shipments->Organisation_City }}">
                    {{ $shipments->Organisation_Location_shortform }}</Location>
                <Addresses>
                    <Address AddressType="{{ $shipments->Organisation_AddressType }}">
                        <AddressLine1></AddressLine1>
                        <AddressCode></AddressCode>
                        <CityOrSuburb>{{ $shipments->Organisation_CityOrSuburb }}</CityOrSuburb>
                        <TelephoneNumbers>
                            <TelephoneNumber NumberType="{{ $shipments->Organisation_TelephoneNumberType }}"></TelephoneNumber>
                        </TelephoneNumbers>
                        <Location>{{ $shipments->Organisation_Location_shortform }}</Location>
                        <Sequence>{{ $shipments->Organisation_Sequence }}</Sequence>
                        <AddressCapabilities>
                            <AddressCapability AddressType="{{ $shipments->Organisation_AddressCapability_AddressType }}" />
                            <AddressCapability IsMainAddress="{{ $shipments->Organisation_AddressCapabilities_IsMainAddress }}" AddressType="{{ $shipments->Organisation_AddressCapabilities_AddressType }}" />
                        </AddressCapabilities>
                    </Address>
                </Addresses>
            </OrganisationDetails>
        </EDIOrganisation>
    </InterchangeInfo>
    <Payload>
        <Consols xmlns="http://www.edi.com.au/EnterpriseService/">
            <Consol>
                <ConsolIdentifier ConsolIdentifierType="{{ $shipments->ConsolIdentifier_ConsolIdentifierType }}"></ConsolIdentifier>
                <ConsolDetail>
                    <DateCreated>{{ $shipments->ConsolDetail_DateCreated }}</DateCreated>
                    <ConsolType>{{ $shipments->ConsolDetail_ConsolType }}</ConsolType>
                    <ContainerMode>{{ $shipments->ConsolDetail_ContainerMode }}</ContainerMode>
                    <TransportMode>{{ $shipments->ConsolDetail_TransportMode }}</TransportMode>
                    <PortOfLoading>
                        <Port Country="{{ $shipments->PortOfLoading_Country }}"
                            City="{{ $shipments->PortOfLoading_City }}">{{ $shipments->PortOfLoading_Text }}</Port>
                        <EstimatedDateTime>{{ $shipments->PortOfLoading_EstimatedDateTime }}</EstimatedDateTime>
                    </PortOfLoading>
                    <PortOfDischarge>
                        <Port Country="{{ $shipments->PortOfDischarge_Country }}"
                            City="{{ $shipments->PortOfDischarge_City }}">{{ $shipments->PortOfDischarge_Text }}
                        </Port>
                        <EstimatedDateTime>{{ $shipments->PortOfDischarge_EstimatedDateTime }}</EstimatedDateTime>
                    </PortOfDischarge>
                    <Vessel>
                        <ETD>{{ $shipments->Vessel_ETD }}</ETD>
                        <ETA>{{ $shipments->Vessel_ETA }}</ETA>
                        <VesselName>{{ $shipments->Vessel_VesselName }}</VesselName>
                        <VoyageNo>{{ $shipments->Vessel_VoyageNo }}</VoyageNo>
                    </Vessel>
                    <PaymentType>CCX</PaymentType>
                    <PlannedLegs>
                        <PlannedLeg>
                            <TransportMode>{{ $shipments->PlannedLeg_TransportMode }}</TransportMode>
                            <PortOfLoading>
                                <Port Country="{{ $shipments->PlannedLeg_PortOfLoading_Country }}"
                                    City="{{ $shipments->PlannedLeg_PortOfLoading_City }}">
                                    {{ $shipments->PlannedLeg_PortOfLoading_City }}</Port>
                                <EstimatedDateTime>{{ $shipments->PlannedLeg_EstimatedDateTime }}</EstimatedDateTime>
                            </PortOfLoading>
                            <PortOfDischarge>
                                <Port Country="{{ $shipments->PlannedLeg_PortOfDischarge_Country }}"
                                    City="{{ $shipments->PlannedLeg_PortOfDischarge_City }}">
                                    {{ $shipments->PlannedLeg_PortOfDischarge_Text }}</Port>
                            </PortOfDischarge>
                            <TransportType>{{ $shipments->PlannedLeg_TransportType }}</TransportType>
                            <Vessel>
                                <ETD>{{ $shipments->PlannedLeg_Vessel_ETD }}</ETD>
                                <VesselName>{{ $shipments->PlannedLeg_VesselName }}</VesselName>
                                <VoyageNo>{{ $shipments->PlannedLeg_VoyageNo }}</VoyageNo>
                            </Vessel>
                        </PlannedLeg>
                    </PlannedLegs>
                    <SendingAgent EDICode="CGW_XML1" OwnerCode="CGW_XML2">
                        <OrganisationDetails>
                            <Name>{{ $shipments->SendingAgent_Organisation_NAME }}</Name>
                            <Location Country="{{ $shipments->SendingAgent_Organisation_Country }}"
                                City="{{ $shipments->SendingAgent_Organisation_City }}"></Location>
                            <Addresses>
                                <Address AddressType="{{ $shipments->SendingAgent_Organisation_AddressType }}">
                                    <AddressCode></AddressCode>
                                    <CityOrSuburb></CityOrSuburb>
                                    <TelephoneNumbers>
                                        <TelephoneNumber NumberType="{{ $shipments->SendingAgent_Organisation_TelephoneNumberType }}"></TelephoneNumber>
                                    </TelephoneNumbers>
                                    <Location>{{ $shipments->SendingAgent_Organisation_Country }}</Location>
                                    <Sequence>{{ $shipments->SendingAgent_Organisation_Sequence }}</Sequence>
                                    <AddressCapabilities>
                                        <AddressCapability AddressType="{{ $shipments->SendingAgent_Organisation_AddressCapability_AddressType }}" />
                                        <AddressCapability IsMainAddress="{{ $shipments->SendingAgent_Organisation_AddressCapability_IsMainAddress }}" AddressType="{{ $shipments->SendingAgent_Organisation_AddressCapability_Main_AddressType }}" />
                                    </AddressCapabilities>
                                </Address>
                            </Addresses>
                        </OrganisationDetails>
                    </SendingAgent>
                    <ReceivingAgent EDICode="CGW_XML1" OwnerCode="CGW_XML1">
                        <OrganisationDetails>
                            <Name>{{ $shipments->ReceivingAgent_Organisation_NAME }}</Name>
                            <Location Country="{{ $shipments->ReceivingAgent_Organisation_Country }}"
                                City="{{ $shipments->ReceivingAgent_Organisation_City }}"></Location>
                            <Addresses>
                                <Address AddressType="{{ $shipments->ReceivingAgent_Organisation_AddressType }}">
                                    <AddressLine1>{{ $shipments->ReceivingAgent_Organisation_AddressLine1 }}</AddressLine1>
                                    <AddressLine2></AddressLine2>
                                    <AddressCode></AddressCode>
                                    <CityOrSuburb></CityOrSuburb>
                                    <TelephoneNumbers>
                                        <TelephoneNumber NumberType="Business"></TelephoneNumber>
                                        <TelephoneNumber NumberType="Fax"></TelephoneNumber>
                                    </TelephoneNumbers>
                                    <CompanyName></CompanyName>
                                    <Location></Location>
                                    <Sequence>1</Sequence>
                                    <AddressCapabilities>
                                        <AddressCapability AddressType="MAIN" />
                                        <AddressCapability IsMainAddress="{{ $shipments->ReceivingAgent_Organisation_AddressCapability_IsMainAddress }}" AddressType="{{ $shipments->ReceivingAgent_Organisation_AddressCapability_AddressType }}" />
                                    </AddressCapabilities>
                                </Address>
                            </Addresses>
                        </OrganisationDetails>
                    </ReceivingAgent>
                    <Carrier EDICode="MSCU" OwnerCode="CHNMSCDLCO201">
                        <OrganisationDetails>
                            <Name>{{ $shipments->Carrier_Organisation_NAME }}</Name>
                            <Location Country="{{ $shipments->Carrier_Organisation_Country }}"
                                City="{{ $shipments->Carrier_Organisation_City }}"> </Location>
                            <Addresses>
                                <Address AddressType="{{ $shipments->Carrier_Organisation_AddressType }}">
                                    <AddressLine1></AddressLine1>
                                    <AddressLine2></AddressLine2>
                                    <AddressCode></AddressCode>
                                    <CityOrSuburb></CityOrSuburb>
                                    <Location></Location>
                                    <Sequence>1</Sequence>
                                    <AddressCapabilities>
                                        <AddressCapability AddressType="{{ $shipments->Carrier_Organisation_AddressCapability_AddressType }}" />
                                        <AddressCapability IsMainAddress="{{ $shipments->Carrier_Organisation_AddressCapability_IsMainAddress }}" AddressType="{{ $shipments->Carrier_Organisation_AddressCapability_Main_AddressType }}" />
                                    </AddressCapabilities>
                                </Address>
                            </Addresses>
                        </OrganisationDetails>
                    </Carrier>
                    <Containers>
                        <Container>
                            <ContainerNumber>{{ $shipments->Container_ContainerNumber }}</ContainerNumber>
                            <ContainerType ISOCode="{{ $shipments->Container_ContainerType_ISOCode }}">
                                <USContainerCode>{{ $shipments->Container_ContainerType_USContainerCode }}
                                </USContainerCode>
                                <ContainerCode>{{ $shipments->Container_ContainerType_ContainerCode }}</ContainerCode>
                            </ContainerType>
                            <Seal>{{ $shipments->Container_Seal }}</Seal>
                            <PackingMode>{{ $shipments->Container_PackingMode }}</PackingMode>
                            <IsArrivingAtCTOByRail>{{ $shipments->Container_IsArrivingAtCTOByRail }}
                            </IsArrivingAtCTOByRail>
                            <IsEmptyContainer>{{ $shipments->Container_IsEmptyContainer }}</IsEmptyContainer>
                            <IsDamaged>{{ $shipments->Container_IsDamaged }}</IsDamaged>
                        </Container>
                    </Containers>
                </ConsolDetail>
                <Shipments>
                    <Shipment>
                        <ShipmentIdentifier ShipmentIdentifierType="{{ $shipments->Shipment_ShipmentIdentifierType }}">
                            {{ $shipments->Shipment_ShipmentIdentifier_Text }}</ShipmentIdentifier>
                        <ReferenceNo></ReferenceNo>
                        <ShipmentDetails>
                            <DateCreated></DateCreated>
                            <TransportMode>{{ $shipments->Shipment_TransportMode }}</TransportMode>
                            <Consignee EDICode="" OwnerCode="SZXSEAWAYLO01">
                                <OrganisationDetails>
                                    <Name>{{ $shipments->Shipment_Consignee_Organisation_Name }}</Name>
                                    <Addresses>
                                        <Address
                                            AddressType="{{ $shipments->Shipment_Consignee_Organisation_AddressType }}">
                                            <AddressLine1>
                                                {{ $shipments->Shipment_Consignee_Organisation_AddressLine1 }}
                                            </AddressLine1>
                                            <AddressCode></AddressCode>
                                            <CityOrSuburb></CityOrSuburb>
                                            <VatNo></VatNo>
                                            <Location></Location>
                                            <Sequence>1</Sequence>
                                            <AddressCapabilities>
                                                <AddressCapability AddressType="MAIN" />
                                                <AddressCapability IsMainAddress="true" AddressType="OFC" />
                                            </AddressCapabilities>
                                        </Address>
                                    </Addresses>
                                </OrganisationDetails>
                            </Consignee>
                            <Consignor EDICode="" OwnerCode="DLCCEPADLCK01">
                                <OrganisationDetails>
                                    <Name>{{ $shipments->Shipment_Consignee_Organisation_Name }}</Name>
                                    <Addresses>
                                        <Address
                                            AddressType="{{ $shipments->Shipment_Consignor_Organisation_AddressType }}">
                                            <AddressLine1>
                                                {{ $shipments->Shipment_Consignor_Organisation_AddressLine1 }}
                                            </AddressLine1>
                                            <AddressCode></AddressCode>
                                            <CityOrSuburb></CityOrSuburb>
                                            <Location></Location>
                                            <Sequence>1</Sequence>
                                            <AddressCapabilities>
                                                <AddressCapability AddressType="{{ $shipments->Shipment_Consignor_Organisation_AddressCapability_AddressType }}" />
                                                <AddressCapability IsMainAddress="{{ $shipments->Shipment_Consignor_Organisation_AddressCapability_IsMainAddress }}" AddressType="{{ $shipments->Shipment_Consignor_Org_AddressCapability_Main_AddressType }}" />
                                            </AddressCapabilities>
                                        </Address>
                                    </Addresses>
                                </OrganisationDetails>
                            </Consignor>
                            <PackingMode>{{ $shipments->Shipment_PackingMode }}</PackingMode>
                            <TotalOuterPacksQty DimensionType="">{{ $shipments->Shipment_TotalOuterPacksQty }}
                            </TotalOuterPacksQty>
                            <Weight DimensionType="">{{ $shipments->Shipment_Weight }}</Weight>
                            <Volume DimensionType="M3">{{ $shipments->Shipment_Volume }}</Volume>
                            <GoodsValue CurrencyCode=""></GoodsValue>
                            <GoodsDescription>{{ $shipments->Shipment_GoodsDescription }}</GoodsDescription>
                            <HSCode></HSCode>
                            <ChargeableWeight DimensionType="">{{ $shipments->Shipment_ChargeableWeight }}
                            </ChargeableWeight>
                            <MarksAndNumbers>{{ $shipments->Shipment_MarksAndNumbers }}</MarksAndNumbers>
                            <ServiceLevel>{{ $shipments->Shipment_ServiceLevel }}</ServiceLevel>
                            <Incoterm>{{ $shipments->Shipment_Incoterm }}</Incoterm>
                            <ReleaseType>{{ $shipments->Shipment_ReleaseType }}</ReleaseType>
                            <OrderReferences>
                                <OrderReference>TBA</OrderReference>
                            </OrderReferences>
                            <Packages>
                                <Package>
                                    <PackType>{{ $shipments->Shipment_PackType }}</PackType>
                                    <NumberOfPacks>{{ $shipments->Shipment_NumberOfPacks }}</NumberOfPacks>
                                    <Weight DimensionType="{{ $shipments->Shipment_Package_Weight_DimensionType }}">
                                        {{ $shipments->Shipment_Package_Weight }}</Weight>
                                    <Volume DimensionType="{{ $shipments->Shipment_Package_Volume_DimensionType }}">
                                        {{ $shipments->Shipment_Package_Volume }}</Volume>
                                    <ContainerNumber>{{ $shipments->Shipment_Package_ContainerNumber }}
                                    </ContainerNumber>
                                </Package>
                            </Packages>
                        </ShipmentDetails>
                    </Shipment>
                </Shipments>
            </Consol>
        </Consols>
    </Payload>
</XmlInterchange>
