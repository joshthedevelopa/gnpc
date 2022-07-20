<?php

// use function PHPSTORM_META\type;

class StudentsCtrlr extends Ctrlr
{

    private array $errorMessages = array
    (
        'incorrectInfo'  => array('title'=>'error',  'text'=>'Incorrect id or Password'),
        'pwdMismatch'    => array('title'=>'error', ' text'=>'Passwords do not match'),
        'incorrectPwd'   => array('title'=>'error', 'text'=>'Old password incorrect'),
        'emptyFields'    => array('title'=>'error',  'text'=>'Required fields cannot be empty'),
        'tryAgain'       => array('title'=>'error',  'text'=>'Try again in 30 seconds'),
        'incorrectCode'  => array('title'=>'error',  'text'=>'Code is wrong or expired. Re-enter or Resend code'),
        'authenFailed'   => array('title'=>'error',  'text'=>'Authentication Failed.'),
        'userExists'     => array('title'=>'error',  'text'=>'email or contact exists.'),
        'confirmIncorrect'=>array('title'=>'error',  'text'=>'Confirmation password do not match with new password')
    );
   
    public array $pages = array
    (
        "dashboard"=>"/dashboard.php",
        "login"=>"/",
        "signup"=>"/signup.php",
        "changePwd"=>"/change_password.php",
        "renewal"=>"renewal.php"
    );

    protected $paths = array 
    (
        "behavorialAssessment"=> "/scripts/app/uploads/docs/behavorial_assessments/",
        "transcript"=> "/scripts/app/uploads/docs/transcripts/"
    );
    protected const UNDERGRADUATE = 1;
    protected const MASTERS    = 2;
    protected const PHD  = 3;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->modelClass  = new Student($data);
    }

   

    public function signup()
    {

        $result = $this->modelClass->registerStudent($this->requestBody);
        $this->render($result);
    }


    public function login()
    {
        if (!empty($this->requestBody['id'])  && !empty($this->requestBody['pwd'])) :
            $result = $this->modelClass->getLogin($this->requestBody['id'], $this->requestBody['pwd']);
            $this->render($result);
        else:
            $result = $this->modelClass->getFeedback('emptyLogins', $this->pages['login']);
            $this->render($result);
        endif;
    }


    public function renew()
    {
        //move_uploaded_file($_FILES['transcript']['tmp_name'], "/scripts/app/uploads/");die;
       if (!($sid = $this->modelClass->getVar('activeUser', 'sid')))
            $this->render($this->errorMessages['signIn']);
        if(empty($this->files['behavorialAssessment']['name']) || empty($this->files['transcript']['name']))
            die('upload assessment and transcript');
       if (!empty($this->requestBody['cgpaCwa'])) {
            $result = $this->modelClass->renewStudent($this->requestBody['cgpaCwa'], $sid);
            $assessmentPath = $this->paths['behavorialAssessment']."$sid.pdf";
            $transcriptPath = $this->paths['transcript']. "$sid.pdf";
            $this->modelClass->saveFile($this->files['behavorialAssessment'], $assessmentPath);
            $this->modelClass->saveFile($this->files['transcript'], $transcriptPath);
            $this->render($result);
        } else
            $this->render($this->errorMessages['emptyFields']);
    }


    // public function apply($type)
    // {
    //     if(empty($this->files['admissionLetter']) || empty($this->files['recommendation']) || 
    //        empty($this->files['birthCert']) || empty($this->files['passportPhoto']))
    //        $this->render($this->errorMessages['emptyDocs']);
    //     if(!$this->modelClass->isPdf($this->files['admissionLetter']) || !$this->modelClass->isPdf($this->files['recommendation'])
    //        || !$this->modelClass->isPdf($this->files['birthCert']))
    //        $this->render($this->errorMessages['pdfError']);
    //     if(!$this->modelClass->validateImage($this->files['passportPhoto']))
    //         $this->render($this->errorMessages['emptyDocs']);
    //     if (!($sid = $this->modelClass->getVar('activeUser', 'sid')))
    //          $this->render($this->errorMessages['signIn']);
    //     $status = $this->modelClass->getVar('activeUser', 'scholarshipStatus');
    //     switch ($type):
    //         case 'undergraduate':
    //             $type = $this::UNDERGRADUATE;
    //             break;
    //         case 'masters':
    //             $type = $this::MASTERS;
    //             break;
    //         case 'phd':
    //             $type = $this::PHD;
    //         default:
    //             $this->render($this->brokenLink);
    //     endswitch;
    //     $result = $this->modelClass->apply($this->requestBody, $type);
    //     $this->render($result);
    // }


    public function logout()
    {
        $this->modelClass->killSession();
        $data['redirect'] = $this->modelClass->pages['login'];
        return $this->render($data);
    }

    public function changePwd()
    {
        if (!$this->modelClass->getVar('activeUser', 'sid'))
           return $this->modelClass->getFeedback('signIn', $this->pages['login']);
        $result = $this->modelClass->changePwd($this->requestBody);
        $this->render($result);
    }

    public function storeBankInfo()
    {
        if (!$this->modelClass->getVar('activeUser', 'sid'))
           return $this->modelClass->getFeedback('signIn', $this->pages['login']);
        $result = $this->modelClass->storeBankInfo($this->requestBody);
        $this->render($result);
    }

    public function getStudentInfo()
    {
 
        if (!($sid = $this->modelClass->getVar('activeUser', 'sid')))
            $this->render($this->modelClass->getFeedback('signIn', $this->pages['login']));
        $status = $this->modelClass->getVar('activeUser', 'scholarshipStatus');
        $result = $this->modelClass->getStudentInfo($sid, $status);
        $this->render($result);
    }

    public function apply($type)
    {
        if (empty($this->modelClass->getVar('activeUser', 'sid')))
            $this->render($this->modelClass->getFeedback('signIn', $this->pages['login']));
        $result = $this->modelClass->apply($this->requestBody);
        $this->render($result);
    }

    public function updateBasicInfo()
    {
        if (empty($this->modelClass->getVar('activeUser', 'sid')))
            $this->render($this->modelClass->getFeedback('signIn', $this->pages['login']));
        $result = $this->modelClass->updateBasicInfo($this->requestBody);
        $this->render($result);
    }


    /**
     * processes a get request
     *
     * @param array $lvs the other elements in the url aside the controller
     * @return void
     */
    public function _GET(array $lvs): void
    {
        
        if ($lvs['fl'] == 'info')
            $this->getStudentInfo();
        elseif ($lvs['fl'] == 'logout' && empty($lvs['sl']))
            $this->logout();
        else
            $this->render($this->brokenLink);

    }


    /**
     * processes a post request
     *
     * @param array $lvs the other elements in the url aside the controller
     * @return void
     */
    public function _POST(array $lvs):void
    {
      
        if ($lvs['fl'] == 'signup' && empty($lvs['sl']))
            $this->signup();
        else if ($lvs['fl'] == 'login' && empty($lvs['sl']))
            $this->login();
        else if ($lvs['fl'] == 'apply' && empty($lvs['sl']))
            $this->apply($lvs['sl']);
        else if ($lvs['fl'] == 'renew' && empty($lvs['sl']))
            $this->renew();
        else if ($lvs['fl'] == 'password' && empty($lvs['sl']))
            $this->changePwd();
        else if ($lvs['fl'] == 'bank' && !empty($lvs['sl']))
            $this->storeBankInfo();
        else if ($lvs['fl'] == 'basic' && !empty($lvs['sl']))
            $this->updateBasicInfo();
        $this->render($this->brokenLink);
    }

    //  /**
    //  * processes a patch request
    //  *
    //  * @param array $lvs the other elements in the url aside the controller
    //  * @return void
    //  */
    // public function _PATCH($lvs)
    // {
    //     if (!($this->modelClass->getVar('activeUser', 'uid')))
    //         $this->render($this->errorMessages['signIn']);
    //     if(ctype_digit($lvs['fl']) && empty($lvs['sl']))
    //         $this->runUpdate($lvs['fl']);
    //     if($lvs['fl'] == 'dp')
    //     $this->render($this->brokenLink);
    // }

}
