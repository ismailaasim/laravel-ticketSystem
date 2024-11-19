<?xml version="1.0" encoding="UTF-8"?>
@foreach ($shipmentDetails as $shipment)
    <XmlInterchange xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
        Version="1" xmlns="http://www.edi.com.au/EnterpriseService/">
        <InterchangeInfo>
            <Date>
                {{ $shipment->InterchangeInfoDate }}
            </Date>
            <Target />
            <EDIOrganisation EDICode="" OwnerCode="">
                <OrganisationDetails>
                    <Name>
                        {{ $shipment->Organisation_Name }}
                    </Name>
                    <Location Country="{{ $shipment->Organisation_Country }}" City="{{ $shipment->Organisation_City }}">
                        {{ $shipment->Organisation_Location_shortform }}
                    </Location>
                    <Addresses>
                        <Address AddressType="{{ $shipment->Organisation_AddressType }}">
                            <AddressLine1>{{ $shipment->Organisation_AddressLine1 }}</AddressLine1>
                            <AddressCode />
                            <CityOrSuburb>{{ $shipment->Organisation_CityOrSuburb }}</CityOrSuburb>
                            <TelephoneNumbers>
                                <TelephoneNumber NumberType="{{ $shipment->Organisation_TelephoneNumberType }}">
                                    {{ $shipment->Organisation_TelephoneNumber_1 }}
                                </TelephoneNumber>
                                <TelephoneNumber NumberType="{{ $shipment->Organisation_TelephoneNumberType_Fax }}">
                                    {{ $shipment->Organisation_TelephoneNumber_2 }}</TelephoneNumber>
                            </TelephoneNumbers>
                            <Location>{{ $shipment->Organisation_Location }}</Location>
                            <Sequence>{{ $shipment->Organisation_Sequence }}</Sequence>
                            <AddressCapabilities>
                                <AddressCapability
                                    AddressType="{{ $shipment->Organisation_AddressCapability_AddressType }}"
                                    IsMainAddress="{{ $shipment->Organisation_AddressCapabilities_IsMainAddress }}" />
                                <AddressCapability
                                    AddressType="{{ $shipment->Organisation_AddressCapabilities_AddressType }}" />
                            </AddressCapabilities>
                        </Address>
                    </Addresses>
                </OrganisationDetails>
            </EDIOrganisation>
        </InterchangeInfo>
        <Payload>
            <Consols>
                <Consol>
                    <ConsolIdentifier ConsolIdentifierType="{{ $shipment->ConsolIdentifier_ConsolIdentifierType }}">
                    </ConsolIdentifier>
                    <ConsolDetail>
                        <DateCreated>
                            {{ $shipment->ConsolDetail_DateCreated }}
                        </DateCreated>
                        <ConsolType>{{ $shipment->ConsolDetail_ConsolType }}</ConsolType>
                        <ContainerMode>{{ $shipment->ConsolDetail_ContainerMode }}</ContainerMode>
                        <TransportMode>{{ $shipment->ConsolDetail_TransportMode }}</TransportMode>
                        <PortOfLoading>
                            <Port Country="{{ $shipment->PortOfLoading_Country }}"
                                City="{{ $shipment->PortOfLoading_City }}">{{ $shipment->PortOfLoading_tinyText }}
                            </Port>
                            <EstimatedDateTime>{{ $shipment->PortOfLoading_EstimatedDateTime }}</EstimatedDateTime>
                        </PortOfLoading>
                        <PortOfDischarge>
                            <Port Country="{{ $shipment->PortOfDischarge_Country }}"
                                City="{{ $shipment->PortOfDischarge_City }}">{{ $shipment->PortOfDischarge_Text }}
                            </Port>
                            <EstimatedDateTime />
                            <EstimatedDateTime>{{ $shipment->PortOfDischarge_EstimatedDateTime }}</EstimatedDateTime>
                        </PortOfDischarge>
                        <Vessel>
                            <ETD>{{ $shipment->Vessel_ETD }}</ETD>
                            <ETA>{{ $shipment->Vessel_ETA }}</ETA>
                            <VesselName>{{ $shipment->Vessel_VesselName }}</VesselName>
                            <VoyageNo>{{ $shipment->Vessel_VoyageNo }}</VoyageNo>
                        </Vessel>
                        <PaymentType>
                        </PaymentType>
                        <PlannedLegs>
                            <PlannedLeg>
                                <TransportMode>{{ $shipment->PlannedLeg_TransportMode }}</TransportMode>
                                <PortOfLoading>
                                    <Port Country="{{ $shipment->PlannedLeg_PortOfLoading_Country }}"
                                        City="{{ $shipment->PlannedLeg_PortOfLoading_City }}">
                                        {{ $shipment->PlannedLeg_PortOfLoading_Text }}</Port>
                                    <EstimatedDateTime>{{ $shipment->PlannedLeg_EstimatedDateTime }}
                                    </EstimatedDateTime>
                                </PortOfLoading>
                                <PortOfDischarge>
                                    <Port Country="{{ $shipment->PlannedLeg_PortOfDischarge_Country }}"
                                        City="{{ $shipment->PlannedLeg_PortOfDischarge_City }}">
                                        {{ $shipment->PlannedLeg_PortOfDischarge_Text }}</Port>
                                    <EstimatedDateTime />
                                </PortOfDischarge>
                                <TransportType>{{ $shipment->PlannedLeg_TransportType }}</TransportType>
                                <Vessel>
                                    <ETD>{{ $shipment->PlannedLeg_Vessel_ETD }}</ETD>
                                    <ETA />
                                    <VesselName>{{ $shipment->PlannedLeg_VesselName }}</VesselName>
                                    <VoyageNo>{{ $shipment->PlannedLeg_VoyageNo }}</VoyageNo>
                                </Vessel>
                            </PlannedLeg>
                        </PlannedLegs>
                        <SendingAgent EDICode="" OwnerCode="">
                            <OrganisationDetails>
                                <Name>{{ $shipment->SendingAgent_Organisation_NAME }}</Name>
                                <Location Country="{{ $shipment->SendingAgent_Organisation_Country }}"
                                    City="{{ $shipment->SendingAgent_Organisation_City }}">
                                    {{ $shipment->SendingAgent_Organisation_Location }}</Location>
                                <Addresses>
                                    <Address AddressType="{{ $shipment->SendingAgent_Organisation_AddressType }}">
                                        <AddressLine1>{{ $shipment->SendingAgent_Organisation_AddressLine1 }}
                                        </AddressLine1>
                                        <AddressCode />
                                        <CityOrSuburb />
                                        <TelephoneNumbers>
                                            <TelephoneNumber
                                                NumberType="{{ $shipment->SendingAgent_Organisation_TelephoneNumberType }}">
                                                {{ $shipment->SendingAgent_Organisation_TelephoneNumber_1 }}
                                            </TelephoneNumber>
                                            <TelephoneNumber
                                                NumberType="{{ $shipment->SendingAgent_Organisation_TelephoneNumberType_Fax }}">
                                                {{ $shipment->SendingAgent_Organisation_TelephoneNumber_2 }}
                                            </TelephoneNumber>
                                        </TelephoneNumbers>
                                        <Location>{{ $shipment->SendingAgent_Organisation_Location }}</Location>
                                        <Sequence>{{ $shipment->SendingAgent_Organisation_Sequence }}</Sequence>
                                        <AddressCapabilities>
                                            <AddressCapability
                                                AddressType="{{ $shipment->SendingAgent_Organisation_AddressCapability_AddressType }}"
                                                IsMainAddress="{{ $shipment->SendingAgent_Organisation_AddressCapability_IsMainAddress }}" />
                                            <AddressCapability
                                                AddressType="{{ $shipment->SendingAgent_Organisation_AddressCapability_Main_AddressType }}" />
                                        </AddressCapabilities>
                                    </Address>
                                </Addresses>
                            </OrganisationDetails>
                        </SendingAgent>
                        <ReceivingAgent EDICode="" OwnerCode="">
                            <OrganisationDetails>
                                <Name>{{ $shipment->ReceivingAgent_Organisation_NAME }}</Name>
                                <Location Country="{{ $shipment->ReceivingAgent_Organisation_Country }}"
                                    City="{{ $shipment->ReceivingAgent_Organisation_City }}">
                                    {{ $shipment->ReceivingAgent_Organisation_Location }}</Location>
                                <Addresses>
                                    <Address AddressType="{{ $shipment->ReceivingAgent_Organisation_AddressType }}">
                                        <AddressLine1>{{ $shipment->ReceivingAgent_Organisation_AddressLine1 }}
                                        </AddressLine1>
                                        <AddressCode />
                                        <CityOrSuburb />
                                        <TelephoneNumbers>
                                            <TelephoneNumber
                                                NumberType="{{ $shipment->ReceivingAgent_Organisation_TelephoneNumberType }}">
                                                {{ $shipment->ReceivingAgent_Organisation_TelephoneNumber_1 }}
                                            </TelephoneNumber>
                                            <TelephoneNumber
                                                NumberType="{{ $shipment->ReceivingAgent_Organisation_TelephoneNumberType_Fax }}">
                                                {{ $shipment->ReceivingAgent_Organisation_TelephoneNumber_2 }}
                                            </TelephoneNumber>
                                        </TelephoneNumbers>
                                        <Location>{{ $shipment->ReceivingAgent_Organisation_Location }}</Location>
                                        <Sequence>
                                            {{ $shipment->ReceivingAgent_Organisation_Sequence }}
                                        </Sequence>
                                        <AddressCapabilities>
                                            <AddressCapability
                                                AddressType="{{ $shipment->ReceivingAgent_Organisation_AddressCapabilityType }}"
                                                IsMainAddress="{{ $shipment->ReceivingAgent_Organisation_AddressCapability_IsMainAddress }}" />
                                            <AddressCapability
                                                AddressType="{{ $shipment->ReceivingAgent_Organisation_AddressCapability_AddressType }}" />
                                        </AddressCapabilities>
                                    </Address>
                                </Addresses>
                            </OrganisationDetails>
                        </ReceivingAgent>
                        <Carrier EDICode="" OwnerCode="">
                            <OrganisationDetails>
                                <Name>{{ $shipment->Carrier_Organisation_NAME }}</Name>
                                <Location Country="{{ $shipment->Carrier_Organisation_Country }}"
                                    City="{{ $shipment->Carrier_Organisation_City }}">
                                    {{ $shipment->Carrier_Organisation_Location }}</Location>
                                <Addresses>
                                    <Address AddressType="{{ $shipment->Carrier_Organisation_AddressType }}">
                                        <AddressLine1></AddressLine1>
                                        <AddressCode />
                                        <CityOrSuburb />
                                        <TelephoneNumbers>
                                            <TelephoneNumber
                                                NumberType="{{ $shipment->Carrier_Organisation_TelephoneNumberType }}">
                                                {{ $shipment->Carrier_Organisation_TelephoneNumber_1 }}
                                            </TelephoneNumber>
                                            <TelephoneNumber
                                                NumberType="{{ $shipment->Carrier_Organisation_TelephoneNumberType_Fax }}">
                                                {{ $shipment->Carrier_Organisation_TelephoneNumber_2 }}
                                            </TelephoneNumber>
                                        </TelephoneNumbers>
                                        <Location>{{ $shipment->Carrier_Organisation_Location }}</Location>
                                        <Sequence></Sequence>
                                        <AddressCapabilities>
                                            <AddressCapability
                                                AddressType="{{ $shipment->Carrier_Organisation_AddressCapability_MainAddress }}"
                                                IsMainAddress="{{ $shipment->Carrier_Organisation_AddressCapability_IsMainAddress }}" />
                                            <AddressCapability
                                                AddressType="{{ $shipment->Carrier_Organisation_AddressCapability_Main_AddressType }}" />
                                        </AddressCapabilities>
                                    </Address>
                                </Addresses>
                            </OrganisationDetails>
                        </Carrier>
                        <Containers>
                            @if ($shipment->ShipContainer->count() > 0)
                                @foreach ($shipment->ShipContainer as $container)
                                    <Container>
                                        <ContainerNumber>{{ $container->Container_ContainerNumber }}</ContainerNumber>
                                        <ContainerType ISOCode="{{ $container->Container_ContainerType_ISOCode }}">
                                            <USContainerCode>{{ $container->Container_ContainerType_USContainerCode }}
                                            </USContainerCode>
                                            <ContainerCode>{{ $container->Container_ContainerType_ContainerCode }}
                                            </ContainerCode>
                                        </ContainerType>
                                        <Seal>{{ $container->Container_Seal }}</Seal>
                                        <PackingMode>{{ $container->Container_PackingMode }}</PackingMode>
                                        <IsArrivingAtCTOByRail>{{ $container->Container_IsArrivingAtCTOByRail }}
                                        </IsArrivingAtCTOByRail>
                                        <IsEmptyContainer>{{ $container->Container_IsEmptyContainer }}
                                        </IsEmptyContainer>
                                        <IsDamaged>{{ $container->Container_IsDamaged }}</IsDamaged>
                                    </Container>
                                @endforeach
                            @else
                            @endif

                        </Containers>
                    </ConsolDetail>
                    <Shipments>
                        <Shipment>
                            <ShipmentIdentifier
                                ShipmentIdentifierType="{{ $shipment->Shipment_ShipmentIdentifierType }}">
                                {{ $shipment->Shipment_ShipmentIdentifier_Text }}</ShipmentIdentifier>
                            <ReferenceNo />
                            <ShipmentDetails>
                                <DateCreated>{{ $shipment->Shipment_DateCreated }}</DateCreated>
                                <TransportMode>{{ $shipment->Shipment_TransportMode }}</TransportMode>
                                <Consignee EDICode="" OwnerCode="">
                                    <OrganisationDetails>
                                        <Name>{{ $shipment->Shipment_Consignee_Organisation_Name }}</Name>
                                        <Location Country="{{ $shipment->Shipment_Consignee_Organisation_Country }}"
                                            City="{{ $shipment->Shipment_Consignee_Organisation_City }}">
                                            {{ $shipment->Shipment_Consignee_Organisation_Location }}</Location>
                                        <Addresses>
                                            <Address
                                                AddressType="{{ $shipment->Shipment_Consignee_Organisation_AddressType }}">
                                                <AddressLine1>
                                                    {{ $shipment->Shipment_Consignee_Organisation_AddressLine1 }}
                                                </AddressLine1>
                                                <AddressCode />
                                                <CityOrSuburb />
                                                <TelephoneNumbers>
                                                    <TelephoneNumber
                                                        NumberType="{{ $shipment->Shipment_Consignee_Organisation_TelephoneNumberType }}">
                                                        {{ $shipment->Shipment_Consignee_Organisation_TelephoneNumber_1 }}
                                                    </TelephoneNumber>
                                                    <TelephoneNumber
                                                        NumberType="{{ $shipment->Shipment_Consignee_Organisation_TelephoneNumberType_Fax }}">
                                                        {{ $shipment->Shipment_Consignee_Organisation_TelephoneNumber_2 }}
                                                    </TelephoneNumber>
                                                </TelephoneNumbers>
                                                <Location>{{ $shipment->Shipment_Consignee_Organisation_Location }}
                                                </Location>
                                                <Sequence>{{ $shipment->Shipment_Consignee_Organisation_Sequence }}
                                                </Sequence>
                                                <AddressCapabilities>
                                                    <AddressCapability
                                                        AddressType="{{ $shipment->Shipment_Consignee_Organisation_AddressCapability_AddressType }}"
                                                        IsMainAddress="{{ $shipment->Shipment_Consignee_Organisation_AddressCapability_IsMainAddress }}" />
                                                    <AddressCapability
                                                        AddressType="{{ $shipment->Shipment_Consignee_Org_AddressCapability_Main_AddressType }}" />
                                                </AddressCapabilities>
                                            </Address>
                                        </Addresses>
                                    </OrganisationDetails>
                                </Consignee>
                                <Consignor EDICode="" OwnerCode="">
                                    <OrganisationDetails>
                                        <Name>{{ $shipment->Shipment_Consignor_Organisation_Name }}</Name>
                                        <Location Country="{{ $shipment->Shipment_Consignor_Organisation_Country }}"
                                            City="{{ $shipment->Shipment_Consignor_Organisation_City }}">
                                            {{ $shipment->Shipment_Consignor_Organisation_Location }}</Location>
                                        <Addresses>
                                            <Address
                                                AddressType="{{ $shipment->Shipment_Consignor_Organisation_AddressType }}">
                                                <AddressLine1>
                                                    {{ $shipment->Shipment_Consignor_Organisation_AddressLine1 }}
                                                </AddressLine1>
                                                <AddressCode />
                                                <CityOrSuburb />
                                                <TelephoneNumbers>
                                                    <TelephoneNumber
                                                        NumberType="{{ $shipment->Shipment_Consignor_Organisation_TelephoneNumberType }}">
                                                        {{ $shipment->Shipment_Consignor_Organisation_TelephoneNumber_1 }}
                                                    </TelephoneNumber>
                                                    <TelephoneNumber
                                                        NumberType="{{ $shipment->Shipment_Consignor_Organisation_TelephoneNumberType_Fax }}">
                                                        {{ $shipment->Shipment_Consignor_Organisation_TelephoneNumber_2 }}
                                                    </TelephoneNumber>
                                                </TelephoneNumbers>
                                                <Location>{{ $shipment->Shipment_Consignor_Organisation_Location }}
                                                </Location>
                                                <Sequence>{{ $shipment->Shipment_Consignor_Organisation_Sequence }}
                                                </Sequence>
                                                <AddressCapabilities>
                                                    <AddressCapability
                                                        AddressType="{{ $shipment->Shipment_Consignor_Organisation_AddressCapability_AddressType }}"
                                                        IsMainAddress="{{ $shipment->Shipment_Consignor_Organisation_AddressCapability_IsMainAddress }}" />
                                                    <AddressCapability
                                                        AddressType="{{ $shipment->Shipment_Consignor_Org_AddressCapability_Main_AddressType }}" />
                                                </AddressCapabilities>
                                            </Address>
                                        </Addresses>
                                    </OrganisationDetails>
                                </Consignor>
                                <Notify EDICode="" OwnerCode="">
                                    <OrganisationDetails>
                                        <Name>{{ $shipment->Notify_Organisation_Name }}</Name>
                                        <Location Country="{{ $shipment->Notify_Organisation_Country }}"
                                            City="{{ $shipment->Notify_Organisation_City }}">
                                            {{ $shipment->Notify_Organisation_Location }}</Location>
                                        <Addresses>
                                            <Address AddressType="{{ $shipment->Notify_Organisation_AddressType }}">
                                                <AddressLine1>{{ $shipment->Notify_Organisation_AddressLine1 }}
                                                </AddressLine1>
                                                <AddressCode />
                                                <CityOrSuburb />
                                                <TelephoneNumbers>
                                                    <TelephoneNumber
                                                        NumberType="{{ $shipment->Notify_Organisation_TelephoneNumberType }}">
                                                        {{ $shipment->Notify_Organisation_TelephoneNumber_1 }}
                                                    </TelephoneNumber>
                                                    <TelephoneNumber
                                                        NumberType="{{ $shipment->Notify_Organisation_TelephoneNumberType_Fax }}">
                                                        {{ $shipment->Notify_Organisation_TelephoneNumber_2 }}
                                                    </TelephoneNumber>
                                                </TelephoneNumbers>
                                                <Location>{{ $shipment->Notify_Organisation_Location }}</Location>
                                                <Sequence>{{ $shipment->Notify_Organisation_Sequence }}</Sequence>
                                                <AddressCapabilities>
                                                    <AddressCapability
                                                        AddressType="{{ $shipment->Notify_Organisation_AddressCapability_AddressType }}"
                                                        IsMainAddress="{{ $shipment->Notify_Organisation_AddressCapability_IsMainAddress }}" />
                                                    <AddressCapability
                                                        AddressType="{{ $shipment->Notify_Org_AddressCapability_Main_AddressType }}" />
                                                </AddressCapabilities>
                                            </Address>
                                        </Addresses>
                                    </OrganisationDetails>
                                </Notify>
                                <PackingMode>{{ $shipment->Shipment_PackingMode }}</PackingMode>
                                <TotalOuterPacksQty
                                    DimensionType="{{ $shipment->Shipment_TotalOuterPacksQty_DimensionType }}">
                                    {{ $shipment->Shipment_TotalOuterPacksQty }}</TotalOuterPacksQty>
                                <Weight DimensionType="{{ $shipment->Shipment_Weight_DimensionType }}">
                                    {{ $shipment->Shipment_Weight }}</Weight>
                                <Volume DimensionType="{{ $shipment->Shipment_Volume_DimensionType }}">
                                    {{ $shipment->Shipment_Volume }}</Volume>
                                <GoodsValue CurrencyCode="{{ $shipment->Shipment_GoodsValue_CurrencyCode }}">
                                    {{ $shipment->Shipment_GoodsValue }}</GoodsValue>
                                <GoodsDescription>{{ $shipment->Shipment_GoodsDescription }}</GoodsDescription>
                                <ChargeableWeight
                                    DimensionType="{{ $shipment->Shipment_ChargeableWeight_DimensionType }}">
                                    {{ $shipment->Shipment_ChargeableWeight }}</ChargeableWeight>

                                @if ($shipment->shipMarksAN->count() > 0)
                                    @foreach ($shipment->shipMarksAN as $mark)
                                        <MarksAndNumbers>
                                            {{ $mark->marks_and_numbers }}
                                        </MarksAndNumbers>
                                    @endforeach
                                @else
                                    <MarksAndNumbers>
                                    </MarksAndNumbers>
                                @endif
                                <ServiceLevel>{{ $shipment->Shipment_ServiceLevel }}</ServiceLevel>
                                <Incoterm>{{ $shipment->Shipment_Incoterm }}</Incoterm>
                                <ReleaseType>{{ $shipment->Shipment_ReleaseType }}</ReleaseType>
                                <OrderReferences>
                                    <OrderReference>{{ $shipment->Shipment_OrderReferences }}</OrderReference>
                                </OrderReferences>
                                <Packages>
                                    @if ($shipment->ShipPackages->count() > 0)
                                        @foreach ($shipment->ShipPackages as $package)
                                            <Package>
                                                <PackType>{{ $package->Shipment_PackType }}</PackType>
                                                <NumberOfPacks>{{ $package->Shipment_NumberOfPacks }}</NumberOfPacks>
                                                <Weight
                                                    DimensionType="{{ $package->Shipment_Package_Weight_DimensionType }}">
                                                    {{ $package->Shipment_Package_Weight }}</Weight>
                                                <Volume
                                                    DimensionType="{{ $package->Shipment_Package_Volume_DimensionType }}">
                                                    {{ $package->Shipment_Package_Volume }}</Volume>
                                                <ContainerNumber>{{ $package->Shipment_Package_ContainerNumber }}
                                                </ContainerNumber>
                                            </Package>
                                        @endforeach
                                    @else
                                    @endif
                                </Packages>
                            </ShipmentDetails>
                        </Shipment>
                    </Shipments>
                </Consol>
            </Consols>
        </Payload>
    </XmlInterchange>
@endforeach
