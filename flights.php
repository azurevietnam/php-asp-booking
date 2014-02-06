<?php
include_once 'Booking.php';

class Flights{
    
    private $airline;
    private $booking;
    
    function __construct($airline)
    {
        $this->airline = $airline;
        $this->booking = new ASPBooking();
    }
    
   /*
    * Returns all supported airlines 
    */
    public function airlines(){}
    
    
    public function schedules()
    {
         $msg = array();
         switch ($this->airline) {
             case 'cebupacific':
                 $msg = $this->search_cebupacific();
                 break;
             case 'philippineairlines':
                 $msg = $this->search_philippineairlines();
                 break;
             case 'tigerair':
                 $msg = $this->search_tigerair();
                 break;
             default:
                 if(!empty($this->airline))
                     $msg['Error'] = "This airline {$this->airline} is not yet supported!";
                 else 
                     $msg['Error'] = "No airlines provided.";
                 break;
         }
        return json_encode($msg);            
    }
    
    /* AIRLINES */
   
    private function search_cebupacific()
    {
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
            'date_picker'                                                                                   => '2014-03-19',
            //-return date
            'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketDay2'           => '19',
            'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListMarketMonth2'         => '2014-3',
            'date_picker'                                                                                   => '2014-3-19',
            //misc
            'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_ADT'    => '1',
            'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24DropDownListPassengerType_CHD'    => '0',
            'ControlGroupSearchView%24AvailabilitySearchInputSearchView%24promoCodeID'                      => '',
            
        );
        
        
        //Pass the required hidden input names that are needed to construct the post url
        //$this->booking->set_arguments(array('__VIEWSTATE','__EVENTARGUMENT','__EVENTTARGET'), $form_fields);
        //$this->booking->init($site1);
        
        //You can do it this way instead of the two lines above 
        //$this->booking->init($site1, array('__EVENTARGUMENT')); 
        //$this->booking->search($site2, $form_fields);
        
        //$html = $this->booking->get_html();
        
        $html = "./testcase/March192014.html";
        $cebupac = new CebuPacific($html);
        $flights = $cebupac->flights();

    }
    
    
    
    private function search_philippineairlines()
    {
        
        
    }
    
    
    private function search_tigerair()
    {
        
        
    }
    
    
    
    
} //end class

$airline = NULL;    
if(isset($_GET['airline']))    
    $airline = $_GET['airline'];


//POST parameters
    
$flight = new Flights($airline);
print $flight->schedules();

?>