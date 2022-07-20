<?php
class StoriesCtrlr extends Ctrlr
{

     protected array $errMsgs  = array(
        'emptyCover'    => array('title' => 'error', 'text' => 'Cover Image cannot be empty'),
        'signIn'        => array('title' => 'error', 'text' => 'Please sign in first'),
        'emptyChapter'  => array('title' => 'error', 'text' => 'Please upload at least one chapter'),
        'codeRequired'  => array('title' => 'error', 'text' => 'Please Enter the verification code that was sent to your number'),
        'invalidCode'   => array('title' => 'error', 'text' => 'Code is wrong or expired. Resend or Re-enter code')
    );
    public function __construct($data)
    {
        parent::__construct($data);
        $this->modelClass  = new Job();
    }


    public function postStory($lv)
    {
        switch ($lv):
            case 'covers':
                    !empty($this->files['cover']['name']) ?: $this->render($this->errMsgs['emptyCover']);
                    $result = $this->modelClass->storeImg($this->files['cover'], 'cover');
                    $this->render($result);
                break;
            case 'chapters':
                    !empty($this->files['chapter']['name']) ?: $this->render($this->errMsgs['emptyChapter']);
                    $result = $this->modelClass->handleFiles($this->requestBody['files']['chapter'], 'chapters');//there is a problem here
                break;
            case 'profile':
                $result = $this->modelClass->createStory($this->requestBody);
                $this->render($result);
                break;
            default:
                $this->render($this->brokenLink);
        endswitch;        
    }
    public function fetchStories()
    {
        $result = $this->modelClass->getStories();
        $this->render($result);
    }

    public function fetchStoryProfile($sid)
    {
        $result = $this->modelClass->getStoryProfile($sid);
        $this->render($result);
    }
    

    public function processPatch($id)
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
        if(empty($lvs['fl']) && empty($lvs['sl'])):
            $this->fetchStories();
        elseif(ctype_digit((string)$lvs['fl']) && $lvs['sl'] == 'profile'):
            $this->fetchStoryProfile($lvs['fl']);
        elseif(ctype_digit((string)$lvs['fl']) && !empty($lvs['sl'])):
            $sinceId = empty($this->queryParams['sinceId']) || !ctype_digit($this->queryParams['sinceId'])?0:$this->queryParams['sinceId'];
            $result  = $this->modelClass->getChapter($lvs['sl'], $sinceId);
            $this->render($result);
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
        if(empty($lvs['sl'])):
            if(empty($this->modelClass->getVar('activeUser')))
                die('you must log in first');
            $this->postStory($lvs['fl']);
        else:
        die('error'); //some error page
        endif;
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
