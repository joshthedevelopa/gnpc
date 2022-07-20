<?php

class RouterCtrlr extends Ctrlr
{
    private $ctrlrClass  = 'Students';
    private $brokenUrl;
    private $root;
    private $data;
    private $maxLvs = 3;
    private $action;
    
    /**
     * Converts dashed string into a PascalCase name
     * @param string $text The string using dashes like 'service-list'
     * @return string The string like 'ServiceList'
     */
    private function pascalCase(string $text)
    {
        $text = str_replace('-', ' ', $text);
        $text = ucwords($text);
        $text = str_replace(' ', '', $text);
        return $text;
    }


    /**
     * processes a URL and assigns its broken form to the brokenUrl property
     * it unsets the resourse from the URL 
     * @param array $data
     * @return void
     */
    public function __construct($data = array())
    {   
        
        $url = filter_var($data['url'], FILTER_SANITIZE_URL);
        //trims trailing and leading '/' and breaks url into 'controller' and 'method';
        $brokenUrl         = explode('/', trim($url, '/'));
        $this->brokenUrl   = $brokenUrl;
        $this->root        = $_SERVER["DOCUMENT_ROOT"];
        $this->data        = $data;
        $this->action      = '_'.$_SERVER['REQUEST_METHOD'];
    }
    public function processUrl()
    { 
        
        $brokenUrl = $this->brokenUrl;
        if(!$brokenUrl || count($brokenUrl)> $this->maxLvs)
            $this->render($this->brokenLink);
         {
             
            $ctrlr = array_shift($brokenUrl);
            //gets the name of the controller in PascalCase
            $ctrlr = $this->pascalCase($ctrlr)."Ctrlr";

            if (file_exists("$this->root/scripts/app/controllers/" . $ctrlr . ".php"))
            {
                
    
                /**
                 * fl = first level after the controller
                 * sl = second level after the controller
                 */
                $lvs['fl'] = $brokenUrl?array_shift($brokenUrl):null;
                $lvs['sl'] = $brokenUrl?array_shift($brokenUrl):null;
                             $brokenUrl?die('error'):null;
            //  print_r($lvs);die;
                $this->ctrlrClass = new $ctrlr($this->data);
                //the method to call is based on the $_SERVER['REQUEST_METHOD']
                method_exists($this->ctrlrClass, $this->action)?
                call_user_func(array($this->ctrlrClass, $this->action), $lvs):
                $this->render($this->brokenLink);
                
            }
            else
                $this->render($this->brokenLink);
       }

    }
}