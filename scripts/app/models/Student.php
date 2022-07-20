<?php
class Student extends Model
{

   protected string $table = 'student';
   protected string $pk = 'sid';
   protected string $imgsPath = 'app/uploads/images/dp/';
   protected string $root;
   protected const  CBG_BANK = 1;
   protected const  REPUBLIC_BANK = 2;
   private $files;
   protected array $updateBasicInfoFields = array
   (
       'email',
       'contact',
       'emergencyNo',
       'emergencyName',
       'emergencyRelation'
   );
  
    protected array $bankHtmlFields = array
    (
        'cbg'=>array('cbgAccountName', 'cbgAccountNo', 'cbgBranch'),
        'rpb'=>array('rpbAccountName', 'rpbAccountNo', 'rpbBranch')
    );

    protected array $bankDbFields = array
    (
        'cbg'=>array('cbgAccountName'=>'accountName', 'cbgAccountNo'=>'accountNo', 'cbgBranch'=>'bankBranch'),
        'rpb'=>array('rpbAccountName'=>'accountName', 'rpbAccountNo'=>'accountNo', 'rpbBranch'=>'bankBranch')
    );



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



   protected const UNDERGRADUATE = 1;
   protected const MASTERS    = 2;
   protected const PHD  = 3;

   //scholarship statuses
   protected const REGISTERED = 1;
   protected const UNDER_REVIEW    = 2;
   protected const ACTIVE  = 3;
   protected const EXPIRED    = 4;
   protected const PENDING_RENEWAL  = 5;
   protected const SUSPENDED  = 6;

   protected $studentTable = array
   (
       "tableName"=>"student",
       "fields"=> array 
       (
        "gender",
        "birthDate",
        "maritalStatus",
        "region",
        "district",
        "contact",
        "email",
        "emergencyNo",
        "emergencyName",
        "emergencyRelation",
        "cgpaCwa",
        "scholarshipStatus",
        "institution",
        "levelOfStudy",
        "program",
        "studentId",
        "programType",
        "programStatus"
       )
   );

   protected $basicInfoFields = array
   (
    "firstName",
    "lastName",
    "gender",
    "birthDate",
    "maritalStatus",
    "region",
    "district",
    "contact",
    "email",
    "emergencyNo",
    "emergencyName",
    "emergencyRelation"
   );

   protected $optionalFields = array 
   (
       "otherName",
       "disability"
   );

   protected $academicInfoFields = array
   (
    //"cgpaCwa",
    //"scholarshipStatus",
    "institution",
    "program",
    "studentId",
    "programType",
    "programStatus"
   );


   protected $registrationFields = array
   (
        "firstName",
        "lastName",
        "email",
        "contact",
        "pwd",
        "confPwd"
   );

   protected $paymentInfoTable = array
   (
       "tableName"=>"paymentInfo",
       "fields"=>array
       (
        "bank",
        "student",
        "accountNo",
        "accountName",
        "bankBranch"
       )
   );

   protected $educationBackgroundTable = array
   (
       "tableName"=>"educationBackground",
       "fields"=>array
       (
        "student",
        "highestEducationLevel"
       )
   );


   protected $residenceTable = array
   (
       "tableName"=>"residence",
       "fields"=>array
       (
        "studyResidence",
        "ghanaResidence"
       )
   );

   protected $changePwdFields = array
   (
       "oldPwd",
       "newPwd",
       "confNewPwd"
   );
   private $updateFields = array
   (
       "contact",
       "emergencyNo",
       "bank",
       "accountNo",
       "accountName",
       "bankBranch"
   );


    private $pageThree = array 
    (
        'verifCode'
    );

    private array $blackdata = array();
    private array $whiteData = array();

    /**
     * create a new student in database
     *
     * @param array $studentDataAssoc - associative array of student data.
     * @return void
     */
   
    function __construct($data)
    {
        $this->data = $data;
        $this->files = $_FILES;
        $this->root        = $_SERVER["DOCUMENT_ROOT"];
    }
  
    /**
     * sets expected feedback
     *
     * @param string $feedbackKey
     * @param string $redirectPage
     * @return array the page to redirect user
     */
    public function getFeedback(string $feedbackKey, string $redirectPage):array
    {
        $this->setVar('feedbackKey', false, $feedbackKey);
        $result['redirect'] = $redirectPage;
        return $result;
    }

    public function registerStudent($data)
    {
        if(!$this->areSet($data, $this->registrationFields))
            return $this->getFeedback('emptyFields', $this->pages['signup']);
        $data['contact'] = $this->fixContact($data['contact']);
        if($this->userExists(array('email'=>$data['email'], 'contact'=>$data['contact'])))
           return $this->getFeedback('userExists', $this->pages['signup']);
        if($data['confPwd'] != $data['pwd'])
            return $this->getFeedback('pwdMismatch', $this->pages['signup']);
        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);
        unset($data['confPwd']);
        $data['scholarshipStatus'] = $this::REGISTERED;
        $columns = array_keys($data);
        $values  = array_values($data);

        //get all placeholders(?) of values to be parsed
        $placeholders = parent::getInsertPlaceholders($columns);
        $sql = "INSERT INTO student(".implode(',',$columns).") VALUES($placeholders)";
        try
        {
            $insertId = $this->runDml($sql, $values, true);
            $data['sid'] = $insertId;
            $data['status'] = $this::REGISTERED;
            $this->setVar('activeUser', false, $data);
            $data['redirect'] = $this->pages['dashboard'];
        }catch(PDOException $e)
        {
            //  return array('msg'=>$e->getMessage(), 'status'=>INTERNAL_SERVER_ERROR);
            return $this->getFeedback('unknownError', $this->pages['signup']);
        }
        
        //$this->killSession();
        return $data;
    }

    public function updateBasicInfo($data)
    {
        $sid = $this->getVar('activeUser', 'sid');
        if(!$this->areSet($data, $this->updateBasicInfoFields))
            return $this->getFeedback('emptyFields', $this->pages['editAccount']);
        $data['contact'] = $this->fixContact($data['contact']);
        $data['emergencyNo'] = $this->fixContact($data['emergencyNo']);
        if($this->userExists(array('contact'=>$data['contact'], 'email'=>$data['email'], 'sid'=>$sid), "AND sid<>:sid"))
            return $this->getFeedback('userExists', $this->pages['editAccount']);
        $sql = $this->getUpdateSql($this->updateBasicInfoFields, 'sid', 'student', false);
        $data['sid'] = $sid;
        if($this->runDml($sql, $data)):
            $this->updateSession();
            return $this->getFeedback('basicInfoUpdated', $this->pages['editAccount']);
        endif;
        return $this->getFeedback('unknownError', $this->pages['editAccount']);
    }


//     /**
//      * Handles scholarship application
//      *
//      * @param array $data applicant data
//      * @param int $type application type. 1 -> undergraduate, 2 -> masters, 3 -> phd
//      * @return array success or error message
//      */
//     public function apply($data, $type)
//     {
        
//         $residenceValues = array_values($this->whiteData($data, $this->residenceTable['fields']));
//         $placeholders = parent::getInsertPlaceholders($this->residenceTable['fields']);//residence table placeholders
//         $residenceSql = "INSERT INTO residence(".implode(',',$this->residenceTable['fields']).") VALUES($placeholders)";

//         $placeholders = parent::getInsertPlaceholders($this->studentTable['fields']);//student table placeholders
//         $studentSql = parent::getUpdateSql(array_keys($data), 'sid', 'student', false);
//         //echo $studentSql;die;
//        // $studentSql = "upda students(".implode(',',$this->studentTable['fields']).") VALUES($placeholders)";
//         // $data = $this->whiteData($data, $this->studentTable['fields']);
//         // $studentValues = array_values($data);

//         try {
//         switch($type)
//         {
//             case $this::UNDERGRADUATE:
//             //$undergradFields = array_merge($this->studentTable['fields']);
//             $data['sid'] = $this->getVar('activeUser', 'sid');
//             $this->checkFieldsConsistency($data, $this->studentTable['fields'], ['otherName','disability']);
//             $queries = [$studentSql=>$data];
// //echo $studentSql;print_r($data);die;
//                 break;

//             default:
//             $mastersOrPhdFields = array_merge($this->studentTable['fields'], $this->residenceTable['fields']);
//             $this->checkFieldsConsistency($data, $mastersOrPhdFields);
//             $queries = [$studentSql=>$studentValues, $residenceSql=>$residenceValues];
//         }
//     }catch (Exception $e) {
//         return [$e->getMessage()];
//     }
    

    
    public function storeBankInfo($data)
    {
       
        $sid = $this->getVar('activeUser','sid');
        $banks = $this->getVar('activeUser', 'banks');
        $piids =  $this->getVar('activeUser', 'piids');
        $cbgFields = $this->bankDbFields['cbg'];
        $rpbFields = $this->bankDbFields['rpb'];
        //$this->removeEmptyFields($data);
        
        $this->removeEmptyFields($data);
        // print_r($data);die;
        if(!$this->areSet($data, array_keys($rpbFields)) && !$this->areSet($data, array_keys($cbgFields)))
             return $this->getFeedback('emptyFields', $this->pages['editAccount']);
        if($this->areSet($data, array_keys($cbgFields))):
            $cbgData = $this->arrayReplaceKeys($data, $this->bankDbFields['cbg']);
            $cbgData['student'] = $sid;
            $cbgData['bank'] = $this::CBG_BANK;
            $cbgFields = array_keys($cbgData);
            if(in_array($this::CBG_BANK, $banks))
            {
                $cbgData['piid'] = array_pop($piids);
                $rpbSql = $this->getUpdateSql($cbgFields, 'piid', 'paymentinfo', false);
                $queriesAndParams[0][$rpbSql] = $cbgData;
                
            }else
            {
                $rpbSql = $this->getInsertIgnoreSql($cbgFields, 'paymentinfo');
                $queriesAndParams[0][$rpbSql] = array_values($cbgData);
            }
        endif;
        if($this->areSet($data, array_keys($rpbFields))):
            $rpbData = $this->arrayReplaceKeys($data, $this->bankDbFields['rpb']);
            $rpbData['student'] = $sid;
            $rpbData['bank'] = $this::REPUBLIC_BANK;
            $rpbFields = array_keys($rpbData);
            if(in_array($this::REPUBLIC_BANK, $banks))
            {
                $rpbData['piid'] = array_pop($piids);
                $rpbSql = $this->getUpdateSql($rpbFields, 'piid', 'paymentinfo', false);
                $queriesAndParams[1][$rpbSql] = $rpbData;
                
            }else
            {
                $rpbSql = $this->getInsertIgnoreSql($rpbFields, 'paymentinfo');
                $queriesAndParams[1][$rpbSql] = array_values($rpbData);
            }
        endif;
        if ($this->runTransaction($queriesAndParams)) :
            $this->updateSession();
            return $this->getFeedback('bankUpdated', $this->pages['editAccount']);
        else :
            $this->getFeedback('unknownError', $this->pages['editAccount']);
        endif;
    }

    private function updateSession()
    {
        $sid = $this->getVar('activeUser','sid');
        $sql    = "SELECT s.sid AS sid, s.firstName AS firstName, s.lastName AS lastName, s.contact AS contact, s.email AS email,
                    s.email AS email, s.pwd AS pwd, s.birthDate AS birthDate, s.gender AS gender, s.programStatus AS programStatus,
                    s.scholarshipStatus AS scholarshipStatus, s.email AS email, s.cohort AS cohort, i.name AS institution,
                    s.emergencyName AS emergencyName, s.emergencyNo AS emergencyNo, s.emergencyRelation AS emergencyRelation,
                    s.photoExtension AS photoExtention, s.program AS program, 
                    s.studentId AS studentId, rg.name AS region,
                    IF(s.photoExtension IS NULL, 'assets/images/people/50/guy-6.jpg', CONCAT('/scripts/app/uploads/images/passport_photos/',sid, '.', s.photoExtension)) AS avatar,
                    IF(s.otherName IS NULL, '', s.otherName) AS otherName,
                    IF(s.disability IS NULL, 'NONE', s.disability) AS disability,
                    IF(pt.name IS NULL, '', pt.name) AS programType,
                    IF(s.referenceId IS NULL, '', s.referenceId) AS referenceId,
                    IF(pt.name IS NULL, '', pt.name) AS programType,
                    IF(pi.piid IS NULL, '', pi.piid) AS piids,
                    IF(pi.bank IS NULL, '', pi.bank) AS banks,
                    IF(pi.accountNo IS NULL, '', pi.accountNo)     as accountNo,
                    IF(pi.accountName IS NULL, '', pi.accountName) as accountName,
                    IF(pi.bankBranch IS NULL, '', pi.bankBranch) as bankBranch
                    FROM student s 
                    LEFT JOIN region rg ON s.region = rg.rid
                    LEFT JOIN programType pt ON s.programType = pt.ptid
                    LEFT JOIN institution i ON s.institution = i.iid
                    LEFT JOIN paymentinfo pi ON pi.student = s.sid
                    WHERE s.sid=?";
        $result = $this->fetchAll($sql, [$sid]);
        if ($result) :
            $bankData = $this->getBankData($result);
            $banks = $this->uniqValues($result, 'banks');
            $piids = $this->uniqValues($result, 'piids');
            $result = array_pop($result);
            $result = array_merge($result, $bankData);
            $result['banks'] = $banks;
            $result['piids'] = $piids;
            $this->setVar('activeUser', false, $result);
            return true;
        else:
        return false;
        endif;
    }


    public function runTransaction($queriesAndParams)
    {
        // print_r($queriesAndParams);die;
        $conn  = parent::conn();
        try {
            $conn->beginTransaction();
            foreach($queriesAndParams as $data):
                $query = array_key_last($data);
                $params = array_pop($data);
                $stmt = $conn->prepare($query);
                $stmt->execute($params);
            endforeach;
            return $conn->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $conn->rollback();
            die;
            return false;
        }
    }

    /**
     * too lazy to comment
     *
     * @param array $data
     * @param array $replacements
     * @return array
     */
    public function arrayReplaceKeys(array $data, array $replacements):array
    {
    
        foreach($replacements as $oldKey=>$newKey)
            $result[$newKey] = $data[$oldKey];
        return $result;
    }
 

    public function apply($data)
    {
        unset($data['highestEduLevel']);
        $sid = $this->getVar('activeUser', 'sid');
        try {
        $data['scholarshipStatus'] = $this::UNDER_REVIEW;
        // print_r($data);print_r($this->studentTable['fields']);die;
        $this->removeEmptyFields($data);
        $this->checkFieldsConsistency($data, $this->studentTable['fields'], $this->optionalFields);
        $data['emergencyNo'] = $this->fixContact($data['emergencyNo']);
        $data['contact'] = $this->fixContact($data['contact']);
        if($this->userExists(array('contact'=>$data['contact'], 'email'=>$data['email'], 'sid'=>$sid), "AND sid<>:sid"))
            return $this->getFeedback('userExists', $this->pages['undergradApply']);
        if(!empty($this->files['passportPhoto']['name'])):
            $photoExtension = $this->getExtension($this->files['passportPhoto']['name']);
            $data['photoExtension'] = $photoExtension;
        endif;
        $columns = array_keys($data);
        $values  = array_values($data);
        }catch(Exception $e)
        {
            return $this->getFeedback('emptyFields', $this->pages['undergradApply']);
        }

        //$placeholders = parent::getInsertPlaceholders($this->basicInfoFields);//student table placeholders
        $this->removeEmptyFields($data);
        $data['cohort'] = $this->getCohort();
        $basicInfoSql = parent::getUpdateSql(array_keys($data), 'sid', 'student', false);
        $data['sid'] = $sid;
        //print_r($basicInfoSql);print_r($data);die;
        if ($this->runDml($basicInfoSql, $data)) :
            $this->updateSession();
            empty($this->files['passportPhoto']['name'])?:$photoPath = "$this->root/scripts/app/uploads/images/passport_photos/$sid.$photoExtension";
            empty($this->files['passportPhoto']['name'])?:$this->saveFile($this->files['passportPhoto'], $photoPath);
        endif;
        return $this->getFeedback('unknownError', $this->pages['undergradApply']);
    }


    public function storeAcademicInfo($data, $sid)
    {
        try {
        $this->checkFieldsConsistency($data, $this->academicInfoFields, $this->optionalFields);
        $columns = array_keys($data);
        $values  = array_values($data);
        }catch(Exception $e)
        {
            return $this->errorMessages['emptyFields'];
    
        }
        //$placeholders = parent::getInsertPlaceholders($this->basicInfoFields);//student table placeholders
        $this->removeEmptyFields($data);
        $basicInfoSql = parent::getUpdateSql(array_keys($data), 'sid', 'student', false);
        $data['sid'] = $sid;
        if($this->runDml($basicInfoSql, $data))
         return $this->success;
    }

    public function renewStudent($cgpaCwa, $sid)
    {
        //$sid = $this->getVar('activeUser', 'sid');
        $sql = "UPDATE student SET cgpaCwa = ?, scholarshipStatus = ? WHERE sid = ?";
        if(!$this->runDml($sql, [$cgpaCwa, $this::PENDING_RENEWAL, $sid]))
            return $this->getFeedback('unknownError', $this->pages['changePwd']);
        $this->setVar('activeUser', 'cwaCgpa', $cgpaCwa);
        $this->setVar('activeUser', 'scholarshipStatus', $this::PENDING_RENEWAL);
        return $this->getFeedback('renewalSubmitted', $this->pages['dashboard']);
    }


    public function getStudentInfo($sid, $status):array
    {
        if($status == $this::REGISTERED)
            $sql = "SELECT s.sid AS sid, s.firstName AS firstName, s.lastName AS lastName, s.email AS email
            FROM student s WHERE s.sid=?";
        else
        $sql = "SELECT s.sid AS sid, /*CONCAT(u.uid,'.',u.dpExtension) AS dp,*/ s.firstName AS firstName,
        s.lastName AS lastName,  s.birthDate AS birthDate,
        s.gender AS gender, s.contact AS contact, s.maritalStatus AS maritalStatus,
        s.email AS email, s.emergencyNo AS emergencyNo, s.emergencyName AS emergencyName,
        s.emergencyRelation AS emergencyRelation, s.currentCgpa AS currentCgpa, 
        ss.name AS scholarshipStatus, s.institution AS institution, s.program AS program,
        s.studentId AS studentId, s.programType AS programType, 
        s.programStatus AS programStatus,  IF(s.disability IS NULL, 'NO', s.disability) AS disability, r.name AS region
        FROM student s
        INNER JOIN scholarshipStatus ss ON ss.ssid = s.scholarshipStatus
        INNER JOIN region r ON r.rid = s.region
        WHERE s.sid=?";

        $params = array($sid);
        $result = $this->fetchAll($sql, $params);
        $data = array('msg'=>array(), 'status'=>OK);
        //$result['dp']        = $this->host.'/api/servicetomato/app/uploads/images/dp/'.$result['dp'];
        $data['msg']['data'] = $result;
        $data['status'] = OK;
        return $data;
    }


    public function gibberishName()
    {}


    //change pwd
    public function changePwd($data)
    {
        try
        {
            $this->checkFieldsConsistency($data, $this->changePwdFields);
        } catch(Exception $e)
        {
            return $this->getFeedback('emptyFields', $this->pages['changePwd']);
        }
        if($data['newPwd'] != $data['confNewPwd'])
            return $this->getFeedback('confirmIncorrect', $this->pages['changePwd']);
        $oldPwd = $data['oldPwd'];
        $newPwd = $data['newPwd'];
        $sid = $this->getVar('activeUser', 'sid');
        $oldPasswordHash = $this->getVar('activeUser', 'pwd');
        if(!password_verify($oldPwd, $oldPasswordHash))
            return $this->getFeedback('incorrectOldPwd', $this->pages['changePwd']);
        $newPasswordHash = password_hash($newPwd, PASSWORD_DEFAULT);
        $sql = "UPDATE student SET pwd = ? WHERE sid = ?";
        if($this->runDml($sql, [$newPasswordHash, $sid])):
            $this->setVar('activeUser', 'pwd', $newPasswordHash);
            return $this->getFeedback('pwdChanged', $this->pages['changePwd']);
        else:
            return $this->getFeedback('unknownError', $this->pages['changePwd']);
        endif;
    }

     /**
     * gets user info from database and authenticates them
     *
     * @param string $id can be gnpc reference id or email
     * @param string $studentPwd student password
     * @return array success message if authentication is passed else error message
     */
    public function getLogin($id, $studentPwd):array
    {

        $sql    = "SELECT s.sid AS sid, s.firstName AS firstName, s.lastName AS lastName, s.contact AS contact, s.email AS email,
                    s.email AS email, s.pwd AS pwd, s.birthDate AS birthDate, s.gender AS gender, s.programStatus AS programStatus,
                    s.scholarshipStatus AS scholarshipStatus, s.email AS email, s.cohort AS cohort, i.name AS institution,
                    s.emergencyName AS emergencyName, s.emergencyNo AS emergencyNo, s.emergencyRelation AS emergencyRelation,
                    s.photoExtension AS photoExtention, s.program AS program, 
                    s.studentId AS studentId, rg.name AS region,
                    IF(s.photoExtension IS NULL, 'assets/images/people/50/guy-6.jpg', CONCAT('/scripts/app/uploads/images/passport_photos/',sid, '.', s.photoExtension)) AS avatar,
                    IF(s.otherName IS NULL, '', s.otherName) AS otherName,
                    IF(s.disability IS NULL, 'NONE', s.disability) AS disability,
                    IF(pt.name IS NULL, '', pt.name) AS programType,
                    IF(s.referenceId IS NULL, '', s.referenceId) AS referenceId,
                    IF(pt.name IS NULL, '', pt.name) AS programType,
                    IF(pi.piid IS NULL, '', pi.piid) AS piids,
                    IF(pi.bank IS NULL, '', pi.bank) AS banks,
                    IF(pi.accountNo IS NULL, '', pi.accountNo)     as accountNo,
                    IF(pi.accountName IS NULL, '', pi.accountName) as accountName,
                    IF(pi.bankBranch IS NULL, '', pi.bankBranch) as bankBranch
                    FROM student s 
                    LEFT JOIN region rg ON s.region = rg.rid
                    LEFT JOIN programType pt ON s.programType = pt.ptid
                    LEFT JOIN institution i ON s.institution = i.iid
                    LEFT JOIN paymentinfo pi ON pi.student = s.sid
                    WHERE s.referenceId=? OR s.email=?";
        $result = $this->fetchAll($sql, [$id, $id]);
        if ($result) :
            $bankData = $this->getBankData($result);
            $banks = $this->uniqValues($result, 'banks');
            $piids = $this->uniqValues($result, 'piids');
            $result = array_pop($result);
            $result = array_merge($result, $bankData);
            $result['banks'] = $banks;
            $result['piids'] = $piids;
            // print_r($result);die;
            $hash = $result['pwd'];
            $result         = $this->authenUser($hash, $studentPwd, $result);
            $data['redirect'] = $this->pages['dashboard'];
            if($result)
                return $data;
            $data['redirect'] = $this->pages['login'];
            $this->setVar('feedbackKey', false, 'incorrectLogins');
            return $data;
        endif;
        $this->setVar('feedbackKey', false, 'incorrectLogins');
        $data['redirect'] = $this->pages['login'];
        return $data;
    }

    public function getBankData(&$data)
    {
        $result = array();
      
        foreach($data as &$datum):
            
            if(!empty($datum['banks']) && $datum['banks'] == $this::CBG_BANK)
            {
                $result['cbgAccountName'] = $datum['accountName'];
                $result['cbgAccountNo'] = $datum['accountNo'];
                $result['cbgBranch'] = $datum['bankBranch'];
                unset($datum['accountName'],$datum['accountNo'],$datum['bankBranch']);
            }elseif(!empty($datum['banks']) && $datum['banks'] == $this::REPUBLIC_BANK)
            {
                $result['rpbAccountName'] = $datum['accountName'];
                $result['rpbAccountNo'] = $datum['accountNo'];
                $result['rpbBranch'] = $datum['bankBranch'];
                unset($datum['accountName'],$datum['accountNo'],$datum['bankBranch']);
            }
        endforeach;
        return $result;
    }
    public function uniqValues($data, $key)
    {
        $result = array();
        foreach($data as $datum):
            empty($datum[$key]) || in_array($datum[$key], $result)?:array_push($result, $datum[$key]);
        endforeach;
        return $result;
    }
         /**
     * if password supplied matches database password, authentication is passed else failed. student data is stored in session on success
    *
    * @param  string $hash hashed password from database
    * @param  string $studentPwd password entered by student
    * @param  array $data associative array of data to store in session
    * @return bool true on success false if verification fails 
    */
    public function authenUser($hash, $studentPwd, $data):bool
    {
        
        if(!password_verify($studentPwd, $hash))
            return false;
        $this->setVar('activeUser', false, $data);
            return true;
    }  

    public function getCohort()
    {
        $thisYear = date('Y');
        $nextYear = $thisYear + 1;
        $cohort = $thisYear . "/" . $nextYear;
        return $cohort;
    }

    // public function handleImg($img, $sessKey)
    // {
    //     if ($this->issetSess($sessKey)) :
    //         $name = $this->getVar($sessKey);
    //     else :
    //         $name = time().'_'.uniqid() . '.' . $this->getExt($img['name']);
    //         $this->setVar('dp', $name);
    //     endif;
    //     $path = $this->tmpPath.$name;
    //     if(!$this->saveImg($img, $path))
    //         throw new Exception("Valid image types are png, jpg and gif.  Image shouldn't be greater than 2mb");
    // }
}
