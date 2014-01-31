<?php
class ASPBooking{
    
    private $url_get; //url address/page where we get the header parameters
    private $url_post; //url address/page for submission
    private $html;  //html page result from curl
    private $ch; //curl instance
    
    private $args = array();
    
    
    function __construct(){}
    
    
    /**CURL FUNCTIONS**/
   
    /**
    * get query: Initialize curl object here
    * Arguments:
    * $url_get =
     * Returns list of
    */
    public function init($url_get, $args = array()){            
        $this->url_get = $url_get;
        if($args)
            $this->args = $args;

        $this->ch = curl_init();
        $this->curl_setopts();
        
        curl_setopt($this->ch, CURLOPT_URL, $this->url_get);
        
        $this->html = curl_exec($this->ch);
        
        //STEP 1 - GET PARAMETERS
        if($this->html){
            var_dump($this->get_params_value($this->args));
        }
        
        //STEP 2 - POST DATA 
        
        
    }
    
    public function book($url_post, $params=array()){
        
    }
    
    
    private function curl_setopts(){
        //Set CURL OPTIONS, this should be dynamic?
        curl_setopt($this->ch, CURLOPT_PROXY, '172.20.145.15:3128');
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->ch, CURLOPT_HEADER, true);
        
    }
    

    /**END CURL FUNCTIONS**/

    /**Setters**/        
    public function set_arguments($args){ $this->args = $args;}
    public function set_params(){}
    
    
    /*
     * Issue a get call to fetch asp __VIEWSTATE, __EVENTARGUMENT, __EVENTTARGET, etc... Refer to headers for
     * the required parameters for the page.
     * Parameter(s):
     * $input_name_attrs = array of input tag name values; <input name="__VIEWSTATE"> = array("__VIEWSTATE","")
     * Returns associative array. array("__VIEWSTATE"=>"adhxcvhetyahsagdhfsdg") 
     */
    private function get_params_value($input_name_attrs = array()){
        $values = array();
        
        foreach ($input_name_attrs as $name_val){
            $regex_pattern = "/<input[^>]*name=\"{$name_val}\"[^>]*>/i";
            
            //var_dump($regex_pattern);    

            $values[$name_val] = $this->extract_values($regex_pattern);
            
        }
        return $values;        
    }    
    
    
    
    
    /**
     * Accepts input tag
     * Returns value of input attribute value  <input value="inputvalue"> 
     * */
    private function extract_values($pattern, $index=1){
        $regex_val = '/value="(.*?)"/i';
        if(preg_match($pattern, $this->html, $input_tag)){
            if(preg_match($regex_val, $input_tag[0], $input_tag))
                return $input_tag[$index];
        }        
        return "";
    }
    
    
}



?>