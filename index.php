<?php
include_once 'Booking.php';
include_once 'airlines/CebuPacific.php';

/*How to use classCURLASPBooking*/
//$site1 = "http://172.20.147.66/promofarephilippines/html/test_page1.html";


$objbooking = new ASPBooking();


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
    'date_picker'                                                                                   => '2013-07-20',
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
//$cebupac->set_arguments(array('__VIEWSTATE','__EVENTARGUMENT','__EVENTTARGET'), $form_fields);
//$cebupac->init($site1);

//You can do it this way instead of the two lines above 
//$objbooking->init($site1, array('__EVENTARGUMENT')); 
//$objbooking->book($site2, $form_fields);

//$cebupacific_page = $objbooking->get_html();
//echo $cebupacific_page;

$cebupacific_page = "./testcase/March192014.html";
$fares = new CebuPacific($cebupacific_page);


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
//$objbooking->init($site1, array('__EVENTTARGET')); 
//$objbooking->book($site2, $form_fields);

//$tigeair_page = $objbooking->get_html();

//echo $tigeair_page;

?>