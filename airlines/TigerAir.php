<?php
class TigerAir
{
    
    private $html;
    private $fares;
    private $node_depart;
    private $node_return;
    
    private $test = TRUE;


    function __construct($html)
    {
        $this->html = $html;
        echo "Tiger Air curl to local file?   {$this->test}<br/>";
    }
    
    public function flights()
    {
        if($this->html)
        {
           $doc = new DOMDocument();
           $doc->preserveWhiteSpace = FALSE;
           $doc->strictErrorChecking = FALSE;
           $doc->substituteEntities = TRUE;
           $doc->encoding = 'UTF-8';
           
           if(!$this->test)
           {
               //LIVE - Suppress strict errors or you could just suppress errors directly
               @$doc->loadHTML($this->html);
           }
           else
           {
               //TEST - Load local html page in testcase folder
               $this->html = "./testcase/TigerAir-March192014.html";
               @$doc->loadHTMLFile($this->html);
           }
           
           $tables = $doc->getElementsByTagName('table'); 
           
           foreach($tables as $table){
               $classes = explode(' ',$table->getAttribute('class'));
               if(in_array('select-flight',$classes))
               {
                       var_dump($classes);
                       echo $table->nodeValue;
                       if(in_array('depart', $classes))
                       {
                           $this->node_depart = $table;
                       }
                       elseif(in_array('return', $classes))
                       {
                           $this->node_return = $table;
                       }  
               }
               
           }
           
           //departure fares
           $this->fares['departure'] = $this->details($this->node_depart);
           
           //return fares
           $this->fares['return'] = $this->details($this->node_return);
           
           return $this->fares;
       }   
                   
    } 
    
    
    private function details($node_list)
    {
        $fares = array();
        if($node_list)
        {



        }
        return $fares;


    }
    
    
    /*
     * Returns $node value including tags
     * */
    function get_inner_html($node) 
    { 
        $innerHTML= ''; 
        $children = $node->childNodes; 
        foreach ($children as $child) 
        { 
            $innerHTML .= $child->ownerDocument->saveXML($child); 
        } 
        return $innerHTML;  
    }     
    
    
    
    
    
}

?>