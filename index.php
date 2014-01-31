<?php
include_once 'Booking.php';

/*How to use classCURLASPBooking*/
$site1 = "http://172.20.147.66/promofarephilippines/html/test_page1.html";
$site2 = $site1;


$cebupac = new ASPBooking();

//Pass the required hidden input names that are needed to construct the post url
//$tiger_air->set_arguments(array('__VIEWSTATE','__EVENTARGUMENT','__EVENTTARGET'));
//$tiger_air->init($site1);

//You can do it this way instead of the two lines above 
$cebupac->init($site1, array('__VIEWSTATE','__EVENTARGUMENT','__EVENTTARGET')); 



$form_fields = array(
    //hidden fields
    'pageToken'         => '',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24RadioButtonMarketStructure'       => 'RoundTrip',
    //origin
    'ControlGroupSearchView_AvailabilitySearchInputSearchVieworiginStation1'                        => 'DGT',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketOrigin1'             => 'DGT',
    //destination
    'ControlGroupSearchView_AvailabilitySearchInputSearchViewdestinationStation1'                   => 'MNL',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24TextBoxMarketDestination1'        => 'MNL',
    //format: 2013-04
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDay1'           => '20',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketMonth1'         => '2013-07',
    'date_picker'                                                                                   => '2013-07-20',
    //-return date
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDay2'           => '20',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketMonth2'         => '2013-07',
    'date_picker'                                                                                   => '2013-07-20',
    //misc
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_ADT'    => '1',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_CHD'    => '0',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_INFANT' => '0',
    'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24promoCodeID'                      => '',
    'ControlGroupSearchView%24ButtonSubmit'                                                         => ''
    
);



//Book now
$cebupac->book($site2, $form_fields);


?>