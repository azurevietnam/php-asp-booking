<?php
class ASPBooking{
    
    private $url_get; //url address/page where we get the header parameters
    private $url_post; //url address/page for submission
    private $html;  //html page result from curl
    private $ch; //curl instance
    
    private $params_get;
    private $params_post;
    
    private $cookie;
    
    function __construct(){}
    
    
    /**CURL FUNCTIONS**/
   
    /**
    * Initialize curl object here
    * Issue a get call to fetch asp __VIEWSTATE, __EVENTARGUMENT, __EVENTTARGET, etc... Refer to headers for
    * Arguments:
    * $url_get: //url address/page where we get the header parameters
    */
    public function init($url_get, $args = array()){            
        $this->url_get = $url_get;
        if($args)
            $this->params_get = $args;

        echo "Getting info from: {$url_get}";
        
        $this->ch = curl_init();
        $this->curl_setopts();
        
        curl_setopt($this->ch, CURLOPT_URL, $this->url_get);
        
        $this->html = curl_exec($this->ch);
        
        //STEP 1 - GET PARAMETERS
        if($this->html){
            $this->params_get = $this->get_params_value($this->params_get);
        }        
        
    }
    
    
    /*
     * Returns an html page 
     */ 
    public function book($url_post, $params=array()){
        //prepare post parameters
        $this->url_post = $url_post;
        $this->cookie = 'cookie.txt';
        $this->params_post = $this->post_params(array_merge($this->params_get, $params));
        
        echo "Submit booking: {$this->url_post}<br/>";        
        $this->submit();
        
        /*Close CURL*/
        if($this->ch)
            curl_close($this->ch);
    }
    
    private function submit(){
        
        $https = strpos($this->url_post, 'https://'); 
        
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->params_post);

        if($https === FALSE){
            //http
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 2);
            curl_setopt($this->ch, CURLOPT_FORBID_REUSE, 0);
            curl_setopt($this->ch, CURLOPT_FRESH_CONNECT, 0);
            curl_setopt($this->ch, CURLOPT_AUTOREFERER, 1);
            
        }
        else{
            //https
            curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
        }
        
        curl_setopt($this->ch, CURLOPT_USERAGENT, "valid user agent");
        curl_setopt($this->ch, CURLOPT_URL, $this->url_post);   
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookie); //saved cookies

        if(curl_errno($this->ch)){
            echo 'error:' . curl_error($this->ch);
        }
        $this->html = curl_exec($this->ch);
        
        
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
    public function set_arguments($args){ $this->params_get = $args;}
    public function set_params(){}
    /***Getters**/
    public function get_html(){ return $this->html; } 
    
    /*
     * Parameter(s):
     * $input_name_attrs = array of input tag name values; <input name="__VIEWSTATE"> = array("__VIEWSTATE","")
     * Returns associative array. array("__VIEWSTATE"=>"adhxcvhetyahsagdhfsdg") 
     */
    private function get_params_value($input_name_attrs = array()){
        $values = array();
        foreach ($input_name_attrs as $name_val){
            $regex_pattern = "/<input[^>]*name=\"{$name_val}\"[^>]*>/i";
            $values[$name_val] = $this->extract_values($regex_pattern);
        }
        return $values;        
    }    

    
    private function post_params($form_fields = array()){
        $post_data = array();
        foreach ( $form_fields as $key => $value){
            $post_items[] = $key . '=' . $value;
        }
        return implode ('&', $post_items);
        
    }
    
    
    
    /**
     * Accepts input tag
     * Returns value of input attribute 'value'  <input value="inputvalue"> 
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