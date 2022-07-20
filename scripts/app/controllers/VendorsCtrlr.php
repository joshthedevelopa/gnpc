<?php
class VendorsCtrlr extends Ctrlr
{
    protected array $errMsgs  = array(
        'emptyImg'      => array('title' => 'error', 'text' => 'image cannot be empty'),
        'signIn'        => array('title' => 'error', 'text' => 'Please sign in first'),
        'emptyInfo'     => array('title' => 'error', 'text' => 'Enter contact and password to login'),
        'invalidCode'   => array('title' => 'error', 'text' => 'Code is wrong or expired. Resend or Re-enter code')
    );


    public function __construct($data)
    {
        parent::__construct($data);
        $this->modelClass  = new Vendor();
    }

    public function addVendor()
    {
        if(!($this->modelClass->getVar('activeUser', 'contact')))
                $this->render($this->errMsgs['signIn']);
        $result = $this->modelClass->addVendor($this->requestBody);
        $this->render($result);
    }

    public function addLogo()
    {
        if(empty($this->files['logo']['name']))
            $this->render($this->errMsgs['emptyImg']);
            $result = $this->modelClass->storeVendorLogo($this->files['logo'], 'logo');
            $this->render($result);
    }

    public function fetchJobs()
    {
        $user    = $this->modelClass->getVar('activeUser');
        $sinceId = empty($this->queryParams['sinceId'])?:$this->queryParams['sinceId'];
        $sinceId = ctype_digit($sinceId) ? $sinceId : null;
        $result = $this->modelClass->getJobs($sinceId);
        $user ? $result['msg']['extras']['session'] = $user : null;
        $this->render($result);
    }


    public function fetchServices($vid)
    {
        $result = $this->modelClass->getServices($vid);
        $this->render($result);
    }



     /**
     * processes a get request
     *
     * @param array $lvs the other elements in the url aside the controller
     * @return void
     */
    public function _GET($lvs)
    {
        if($lvs['fl'] == 'search' && isset($this->queryParams['q']))
            $this->render($this->modelClass->search($this->queryParams['q']));
        if (empty($lvs['fl']) && empty($lvs['sl']))
            $this->fetchJobs();
        elseif (ctype_digit((string)$lvs['fl']) && $lvs['sl'] == 'services')
            $this->fetchServices($lvs['fl']);
        else
            $this->render($this->brokenLink);
    }

    /**
     * processes a post request
     *
     * @param array $lvs the other elements in the url aside the controller
     * @return void
     */
    public function _POST($lvs)
    {
        if ($lvs['fl'] == 'add' && empty($lvs['sl']))
            $this->addVendor();
        else if($lvs['fl'] == 'logo' && empty($lvs['sl']))
            $this->addLogo();
        else
            $this->render($this->brokenLink);
    }
    
     /**
     * processes a patch request
     *
     * @param array $lvs the other elements in the url aside the controller
     * @return void
     */
    public function _PATCH($lvs)
    {
        
    }
}


