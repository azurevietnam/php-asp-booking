<?php
class CebuPacific
{
        
    private $html;
    private $node_depart;
    private $node_return;

    function __construct($html)
    {
        $this->html = $html;
        $this->fares();
    }
    
    private function fares()
    {
        
        if($this->html)
        {
           $doc = new DOMDocument();
           $doc->preserveWhiteSpace = FALSE;
           $doc->strictErrorChecking = FALSE;
           $doc->substituteEntities = TRUE;
           $doc->encoding = 'UTF-8';
           
           //Suppress strict errors or you could just suppress errors directly
           //@$doc->loadHTML($this->html);
           
           @$doc->loadHTMLFile($this->html); //test case
            
           echo $doc->nodeValue;
           $tables = $doc->getElementsByTagName('table'); 
           
           foreach($tables as $table){
               if(trim($table->getAttribute('id')) == 'availabilityTable')
               {
                   $classes = explode(' ',$table->getAttribute('class'));
                   //var_dump($classes);
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
           $this->depart_fares();
           //return fares
           $this->return_fares();
       }   
                   
    } 
    
    
    private function depart_fares()
    {
        $departure_fares = array();
        if($this->node_depart)
        {
            $tbody = $this->node_depart->getElementsByTagName('tbody')->item(0);
            
            foreach ($tbody->getElementsByTagName('tr') as $tr)
            {
                
                //origin
                $td = $tr->getElementsByTagName('td')->item(0);
                echo $this->get_inner_html($td);
                
                
                //destination
                $td = $tr->getElementsByTagName('td')->item(1);
                echo $this->get_inner_html($td);
                
                
                //flight number
                $td = $tr->getElementsByTagName('td')->item(2);
                foreach($td->childNodes as $node) 
                {
                    if ($node->nodeType != XML_TEXT_NODE) {
                        continue;
                    }
                    echo $node->tagName;
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
                            echo '<br/>Regular: '.$this->get_inner_html($node);
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
                            echo '<br/>Promo: ' . $this->get_inner_html($node);
                            break;
                        }
                    }
                    
                }
                
            
                print('<hr style="color: #eee;"/>');
            }
            
        }


        
    }
    
    private function return_fares()
    {
        
        
        
    }
    
    
    function get_inner_html( $node ) 
    { 
        $innerHTML= ''; 
        $children = $node->childNodes; 
        foreach ($children as $child) 
        { 
            $innerHTML .= $child->ownerDocument->saveXML( $child ); 
        } 
        return $innerHTML;  
    }     
    
    
    
    
}




?>