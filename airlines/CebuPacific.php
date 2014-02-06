<?php
class CebuPacific
{
    private $html;
    private $fares;
    private $node_depart;
    private $node_return;
    
    private $test = TRUE;


    function __construct($html)
    {
        $this->html = $html;
        echo "Cebu Pacific curl to local file?   {$this->test}<br/>";
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
               $this->html = "../testcase/March192014.html";
               @$doc->loadHTMLFile($this->html);
           }
           
           $tables = $doc->getElementsByTagName('table'); 
           
           foreach($tables as $table){
               if(trim($table->getAttribute('id')) == 'availabilityTable')
               {
                   $classes = explode(' ',$table->getAttribute('class'));
                   if(in_array('flights', $classes))
                   {
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
            $tbody = $node_list->getElementsByTagName('tbody')->item(0);
            
            $i = 0;
            foreach ($tbody->getElementsByTagName('tr') as $tr)
            {
                //origin
                $td = $tr->getElementsByTagName('td')->item(0);
                $fares[$i]['origin'] = $this->get_inner_html($td); 
                
                //destination
                $td = $tr->getElementsByTagName('td')->item(1);
                $fares[$i]['destination'] = $this->get_inner_html($td);
                
                //flight number
                $td = $tr->getElementsByTagName('td')->item(2);
                foreach($td->childNodes as $node) 
                {
                    if ($node->nodeType != XML_TEXT_NODE) 
                    {
                        if($node->tagName == 'span')
                        {
                            foreach( $node->childNodes as $node)
                            {
                                $class = explode(' ', $node->getAttribute('class'));
                                if(in_array('flightInfoLink', $class))
                                {
                                    $fares[$i]['flight'] = $node->nodeValue;
                                    break;
                                }
                            }
                        }
                        
                    }
                    $nodeValue = $node;
                }
                
                
                //flight fare regular
                $td = $tr->getElementsByTagName('td')->item(3);
                foreach($td->childNodes as $node)
                {
                    if ($node->nodeType != XML_TEXT_NODE) 
                    {
                        $class = explode(' ', $node->getAttribute('class'));
                        if(in_array('farePrices', $class)){
                            foreach($node->childNodes as $span)
                            {
                                $class = explode(' ', $span->getAttribute('class'));
                                if(in_array('ADTprice', $class))
                                {
                                    $fares[$i]['fare_regular'] = $span->nodeValue;
                                    break;
                                }
                            }
                            break;
                        }
                    }
                    
                }
                
                
                //flight fare promotional
                $td = $tr->getElementsByTagName('td')->item(4);
                foreach($td->childNodes as $node)
                {
                    if ($node->nodeType != XML_TEXT_NODE) 
                    {
                        $class = explode(' ', $node->getAttribute('class'));
                        if(in_array('farePrices', $class)){
                            foreach($node->childNodes as $span)
                            {
                                $class = explode(' ', $span->getAttribute('class'));
                                if(in_array('ADTprice', $class))
                                {
                                    $fares[$i]['fare_promo'] = $span->nodeValue;
                                    break;
                                }
                            }
                            break;
                        }
                    }
                    
                }
                $i++;
            }
            
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