<?php
class ServicesCtrlr extends Ctrlr
    {
        protected array $errMsgs  = array(
            'emptyImg'      => array('title' => 'error', 'text' => 'image cannot be empty'),
            'signIn'        => array('title' => 'error', 'text' => 'Please sign in first'),
            'emptyInfo'     => array('title' => 'error', 'text' => 'Enter contact and password to login'),
            'invalidCode'   => array('title' => 'error', 'text' => 'Code is wrong or expired. Resend or Re-enter code'),
            'vendorError'   => array('title' => 'error', 'text' => 'To post a service, you must become a vendor first')
        );

    public function __construct($data)
    {
        parent::__construct($data);
        $this->modelClass  = new Service();
    }

    public function postService($lv)
    {
        if(!($this->modelClass->getVar('activeUser', 'contact')))
            $this->render($this->errMsgs['signIn']);
        if($this->modelClass->getVar('activeUser', 'vendor') != 'true')
            $this->render($this->errMsgs['vendorError']);
        if(empty($lv))
        {
            $result = $this->modelClass->createService($this->requestBody);
            $this->render($result);
        }
        else if($lv == 'images')
        {
            if(empty($this->files['serviceImg']['name']))
            $this->render($this->errMsgs['emptyImg']);
            $result = $this->modelClass->storeServiceImg($this->files['serviceImg'], 'serviceImg');
            $this->render($result);
        }
        else
            $this->render($this->brokenLink);
    }

    public function runUpdate($sid)
    {
        if(!($this->modelClass->getVar('activeUser', 'uid')))
            $this->render($this->errMsgs['signIn']);
        $result = $this->modelClass->update($this->requestBody, $sid);
        $this->render($result);
    }
    
    public function fetchServices()
    {
        $user    = $this->modelClass->getVar('activeUser');
        $sinceId = empty($this->queryParams['sinceId'])?:$this->queryParams['sinceId'];
        $sinceId = ctype_digit($sinceId) ? $sinceId : null;
        $result  = $this->modelClass->getServices($sinceId);
        $user ? $result['msg']['extras']['session'] = $user : null;
        $this->render($result);
    }

    public function fetchService($uid)
    {
        $user = $this->modelClass->getVar('activeUser');
        $result = $this->modelClass->getService($uid);
        $user?$result['msg']['extras']['session'] = $user:null;
        $this->render($result);
    }

    public function getProfile($uid=NULL)
    {
        if(!($uid = $this->modelClass->getVar('activeUser', 'uid')))
            $this->render($this->errMsgs['signIn']);
        $result = $this->modelClass->getServiceProfile($uid);
        $this->render($result);
    }
   
    public function patchService($id)
    {
        
        if (filter_var($id, FILTER_VALIDATE_INT)) 
        {
               $this->render(array("pending review"), OK);
        } 
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
            $this->render($this->modelClass->search($this->queryParams['q'], $this->queryParams));
        else if($lvs['fl'] == 'profile')
            $this->getProfile($lvs['sl']);
        if(empty($lvs['fl'])):
            $this->fetchServices();
        elseif(ctype_digit((string)$lvs['fl']) && empty($lvs['sl'])):
            $this->fetchService($lvs['fl']);
        elseif(ctype_digit((string)$lvs['fl']) && $lvs['sl'] == 'contacts'):
            $result = $this->modelClass->getContacts($lvs['fl']);
            $this->render($result);
        else:
            $this->render($this->brokenLink);
        endif;
    }

    
    /**
     * processes a post request
     *
     * @param array $lvs the other elements in the url aside the controller
     * @return void
     */
    public function _POST($lvs)
    {
        if ($lvs)
            $this->postService($lvs['fl']);
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
        if(ctype_digit($lvs['fl']) && empty($lvs['sl']))
            $this->runUpdate($lvs['fl']);
        $this->render($this->brokenLink);
    }

    /**
     * processes a delete request
     * 
     * @param $lvs the other elements in the url aside the controller
     * @return void
     */
    public function _DELETE()
    {
        //services/images/1
        if($lvs['fl'] == 'images' && ctype_digit($lvs['sl']))
            $this->deleteSessImg(ctype_digit($lvs['sl']));
        elseif($lvs['fl'] == 'images' && !empty($lvs['sl']))
            $this->deleteImg($lvs['sl']);

    }
}
