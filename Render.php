<?php

class Render 
{
   private array $userSession;
   private string $redirectUrl;
   private string $feedbackKey;
   private array  $pages = array
   (
       'login'=>'/gnpc/',
       'dashboard'=>'/gnpc/dashboard.php'
   );
   private array $feedbackSuite = array
    (
        'incorrectLogins'      => array('head' => 'Error',   'body' => 'Incorrect id or Password'),
        'pwdMismatch'          => array('head' => 'Error',   'body' => 'Passwords do not match'),
        'confirmIncorrect'     => array('head' => 'Error',   'body' => 'Confirmation password do not match with new password'),
        'incorrectOldPwd'      => array('head' => 'Error',   'body' => 'Old password incorrect'),
        'emptyFields'          => array('head' => 'Error',   'body' => 'Required fields cannot be empty'),
        'userExists'           => array('head' => 'Error',   'body' => 'email or contact exists. Try again with different one'),
        'emptyImg'             => array('head' => 'Error',   'body' => 'image cannot be empty'),
        'signIn'               => array('head' => 'Error',   'body' => 'Please sign in first'),
        'emptyLogins'          => array('head' => 'Error',   'body' => 'Enter details to login'),
        'emptyDocs'            => array('head' => 'Error',   'body' => 'Please upload required documents'),
        'pdfError'             => array('head' => 'Error',   'body' => 'Make sure birth certificate, testimonial, admission letter and recommendation letter are in PDF format.'),
        'errorPhoto'           => array('head' => 'Error',   'body' => 'please upload an image with size not greater than 2mb'),
        'unknownError'         => array('head' => 'Error',   'body' => 'An error occured. Enter all details and try again. If problem persists, contact the administrator'),
        'pwdChanged'           => array('head' => 'Success', 'body' => 'Password successfully updated'),
        'renewalSubmitted'     => array('head' => 'Success', 'body' => 'Renewal request submitted. Your scholarship will be automatically renewed if everything checks out. Frequently sign in to view your renewal status'),
        'applicationSubmitted' => array('head' => 'Success', 'body' => 'Application successfully submitted. Frequently sign in to view your application status'),
        'bankUpdated'          => array('head' => 'Success', 'body' => 'Payment Info successfully updated'),
        'basicInfoUpdated'     => array('head' => 'Success', 'body' => 'Basic Info successfully updated'),
        'infoUpdated'          => array('head' => 'Success', 'body' => 'Account information updated')
    );

   private array $successMessages = array
   (
    'pwdChanged' => 'Password successfully updated',
    'applied'   => 'Application successfully submitted. Frequently check in to view your application status',
    'infoUpdated'  => 'Account information updated'
   );

    //scholarship statuses


    function __construct(int $authorizationKey = 0, bool $checkLogin = true)
    {
        @session_start();
        $this->userSession = empty($_SESSION['activeUser']) ? [] : ($_SESSION['activeUser']);
        if (!empty($_SESSION['feedbackKey'])) :
            $this->feedbackKey = $_SESSION['feedbackKey'];
        endif;
        !$checkLogin ?: $this->checkLogin();
        !$authorizationKey ?: $this->checkAuthorization($authorizationKey);
    }

   /**
    * checks if user has logged in. Redirects to login page if user not logged in.
    *
    */
   private function checkLogin():void
   {

        if (empty($this->userSession)) :
            header("location: " . $this->pages['login']);
            $_SESSION['feedbackKey'] = 'signIn';
        endif;
   }


   /**
    * takes user to dashboard if logged in
    *
    * @return void
    */
   public function loggedIn():void
   {
    if (!empty($this->userSession)) :
        header("location: " . $this->pages['dashboard']);
    endif;
   }

   /**
    * displays an error message
    *
    * @return void
    */
   public function echoError():void
   {
       echo $this->errorMessage;
   }

   public function getErrorMessage():string
   {
       return $this->errorMessage;
   }

   
   public function getUserAttribute($attributeKey)
   {
       return !empty($this->userSession[$attributeKey])?$this->userSession[$attributeKey]:false;
   }

   public function echoUserAttribute($attributeKey):void
   {
       echo $this->userSession[$attributeKey];
   }


    /**
     * gets the scholarship status. eg ACTIVE, EXPIRED, SUSPENDED
     *
     * @param int $statusKey
     * @return string the scholarship status of the student
     */
    public function getStatus(int $statusKey=NULL):string
    {
        $statusKey = $statusKey?$statusKey:$this->getUserAttribute('scholarshipStatus');
        switch ($statusKey):
            case REGISTERED:
                return "NOT A SCHOLAR";
            case UNDER_REVIEW:
                return "UNDER REVIEW";
            case ACTIVE:
                return "ACTIVE";
            case EXPIRED:
                return "EXPIRED";
            case PENDING_RENEWAL:
                return "RENEWAL PENDING";
            case SUSPENDED:
                return "SUSPENDED";
        endswitch;
    }

/**
 * checks if user is authorized to visit a certain page
 *
 * @param [type] $authorizationKey student's authorization level 
 * six levels of authorization
 * 
 * REGISTERED student has signed up but hasn't submitted scholarship application
 * 
*  UNDER_REVIEW student has submitted scholarship application and it's under review

*  ACTIVE student is a scholar

*  EXPIRED student scholarship has expired

*  PENDING_RENEWAL student has has submitted scholarship renewal details and it's under review

*  SUSPENDED student scholarship cut off
 * @return void
 */
   private function checkAuthorization($authorizationKey)
   {
        if($this->getUserAttribute('scholarshipStatus') != $authorizationKey)
            header("location: ". $this->pages['dashboard']);
   }

   /**
    * gets the expected error or success message
    *
    * @return string the error or success message | Null otherwise
    */
   protected function getFeedback()
   {
        
   }

   /**
    * gets the feedback class | false otherwise. Matches with bootstrap classes. eg. Danger, warning, info, success
    *
    * @return void
    */
   protected function getFeedbackClass()
   {

   }

   /**
    * gets the heading of the feedback | false otherwise. Feedback heading can be "Success!","Error!","warning!", "info!"
    *
    * @return string
    */
   protected function getFeedbackHead()
   {

   }

   /**
    * gets all information about a feedback
    *
    * @return array|false an array information about the feedback echoed. | false if feedback not found

    * ['class'] the class of a feedback (Matches with bootstrap classes. eg. danger, warning, info, success).

    * ['head'] Feedback heading is the same as feeback classes, Except for 'errors'. ['class'] for errors is 'danger'. ['head'] for errors is 'error'

    * ['body'] the feedback text. (the body of the feedback).
    */
   public function getFeedbackInfo()
   {
        if (!empty($this->feedbackKey)) :
            $feedbackInfo = $this->feedbackSuite[$this->feedbackKey];
            $feedbackInfo['class'] = ($feedbackInfo['head'] == 'Error')?'danger':$feedbackInfo['head'];
            switch($feedbackInfo['head']):
                case 'Error':
                    $feedbackInfo['icon'] = 'exclamation-triangle';
                    break;
                case 'Success':
                    $feedbackInfo['icon'] = 'check-circle';
            endswitch;
            unset($_SESSION['feedbackKey']);
            return $feedbackInfo;
        endif;
        return false;
   }

   public function get($url)
   {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_COOKIESESSION,true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
   }

}

 const REGISTERED = 1;
 const UNDER_REVIEW    = 2;
 const ACTIVE  = 3;
 const EXPIRED    = 4;
 const PENDING_RENEWAL  = 5;
 const SUSPENDED  = 6;