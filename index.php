<?php
include_once 'Booking.php';
include_once 'airlines/CebuPacific.php';
include_once 'airlines/TigerAir.php';

/*How to use classCURLASPBooking*/
//$site1 = "http://172.20.147.66/promofarephilippines/html/test_page1.html";


$booking = new ASPBooking();


//Cebu Pacific
$site1 = "www.cebupacificair.com";
$site2 = "https://book.cebupacificair.com/Search.aspx?culture=en-us";

$form_fields = array(
    //hidden fields
    '__VIEWSTATE'=>'',
    '__EVENTTARGET'                                                                                 => 'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24LinkButtonNewSearch',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24RadioButtonMarketStructure'       => 'RoundTrip',
    //origin
    'ControlGroupSearchView_AvailabilitySearchInputSearchVieworiginStation1'                        => 'DGT',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketOrigin1'             => 'DGT',
    //destination
    'ControlGroupSearchView_AvailabilitySearchInputSearchViewdestinationStation1'                   => 'MNL',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketDestination1'        => 'MNL',
    
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketOrigin2'             =>'undefined',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketDestination2'        =>'undefined',
    
    //format: 2013-04
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDay1'           => '11',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketMonth1'         => '2014-3',
    'date_picker'                                                                                   => '2014-07-20',
    //-return date
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDay2'           => '19',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketMonth2'         => '2014-4',
    'date_picker'                                                                                   => '2014-4-19',
    //misc
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_ADT'    => '1',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_CHD'    => '0',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24promoCodeID'                      => '',
    
);


//Pass the required hidden input names that are needed to construct the post url
//$booking->set_arguments(array('__VIEWSTATE','__EVENTARGUMENT','__EVENTTARGET'), $form_fields);
//$booking->init($site1);

//You can do it this way instead of the two lines above 
//$booking->init($site1, array('__EVENTARGUMENT')); 
//$booking->search($site2, $form_fields);

//$html = $booking->get_html();
//echo $html;

//$html = "./testcase/CebuPacific-March192014.html";
//$cebupac = new CebuPacific($html);
//$flights = $cebupac->flights();
//print_r($flights);




//Tiger Air
$site1 = "http://booking.tigerair.com/Search.aspx";
$site2 = "http://booking.tigerair.com/Search.aspx?culture=en-GB&gaculture=PHEN";

$form_fields = array(
    'MarketStructure'=> 'RoundTrip',
    'selOrigin'=>'BCD',
    'selDest'=>'MNL',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDateRange1'=>'1%7C1',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDateRange2'=>'1%7C1',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDay1'=>'19',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDay2'=>'20',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketMonth1'=>'2014-03',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketMonth2'=>'2014-03',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_ADT'=>'1',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_CHD'=>'0',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_INFANT'=>'0',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24RadioButtonMarketStructure'=>'RoundTrip',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketDestination1'=>'MNL',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketDestination2'=>'',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketOrigin1'=>'BCD',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketOrigin2'=>'',
    'ControlGroupSearchView%24ButtonSubmit'=>'Get+Flights',
    'ControlGroupSearchView_AvailabilitySearchInputSearchViewdestinationStation1'=>'MNL',
    'ControlGroupSearchView_AvailabilitySearchInputSearchViewdestinationStation2'=>'',
    'ControlGroupSearchView_AvailabilitySearchInputSearchVieworiginStation1'=>'BCD',
    'ControlGroupSearchView_AvailabilitySearchInputSearchVieworiginStation2'=>'',
    'date_picker'=>'2014-03-19',
    'date_picker'=>'2014-03-20',
    'hiddendAdultSelection'=>'1',
    'hiddendChildSelection'=>'0',
    'pageToken'=>'',
    '__EVENTARGUMENT'=>'',
    '__EVENTTARGET'=>''

);
//$booking->init($site1, array('__EVENTTARGET')); 
//$booking->search($site2, $form_fields);
//$html = $booking->get_html();

$html = "./testcase/TigerAir-March192014.html";
$airline = new TigerAir($html);
$flights = $airline->flights();
print_r($flights);



/*Philippine Airlines*/
$form_fields = array(
    'tripType'=>'RT',
    'outboundOption.originLocationCode'=>'DGT',
    'outboundOption.originLocationName'=>'',
    'inboundOption.originLocationCode'=>'',
    'inboundOption.originLocationName'=>'',
    'outboundOption.destinationLocationName'=>'',
    'inboundOption.destinationLocationCode'=>'PUS',
    'inboundOption.destinationLocationName'=>'',
    'outboundOption.destinationLocationCode'=>'MNL',
    'outboundOption1'=>'03%2F19%2F2014',
    'outboundOption.departureDate'=>'03%2F19%2F2014',
    'outboundOption.departureMonth'=>'03',
    'outboundOption.departureDay'=>'19',
    'outboundOption.departureYear'=>'2014',
    'inboundOption1'=>'03%2F20%2F2014',
    'inboundOption.departureDate'=>'03%2F20%2F2014',
    'inboundOption.departureMonth'=>'03',
    'inboundOption.departureDay'=>'20',
    'inboundOption.departureYear'=>'2014',
    'guestTypes%5B0%5D.amount'=>'1',
    'guestTypes%5B0%5D.type'=>'ADT',
    'guestTypes%5B1%5D.amount'=>'0',
    'guestTypes%5B1%5D.type'=>'CNN',
    'guestTypes%5B2%5D.amount'=>'0',
    'guestTypes%5B2%5D.type'=>'INS',
    'guestTypes%5B3%5D.amount'=>'0',
    'guestTypes%5B3%5D.type'=>'INF',
    'cabinClass'=>'Economy',
    'flexibleSearch'=>'true',
    'coupon'=>''
    );
    
//$site1 = "http://www1.philippineairlines.com";
//$site2 = "https://onlinebooking.philippineairlines.com/flypal/AirLowFareSearchExternal.do";
//$booking->init($site1); 
//$booking->search($site2, $form_fields);

//$html = $booking->get_html();

//echo $html;
    
?>