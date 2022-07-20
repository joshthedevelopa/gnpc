<?php

class CustomException extends Exception
{
   public function getCustomMessage()
   {
       return array('title'=>'error', 'text'=>$this->getMessage());
   }
}

trait Validation
{
    protected static $FILTER_VALIDATE_DOB     = 1;
    protected static $FILTER_VALIDATE_CONTACT = 2;
    protected static $FILTER_VALIDATE_NAME    = 3;

  
    
    /**
     * checks if contact is valid. valid contact is 233544190406
     * function tries to fix invalid contacts before validation.
     * 
     * @param mixed $contact
     * @return boolean
     */
    public function isValidContact($contact)
    {
        return (strlen($contact)==12) && ctype_digit((string)$contact);
    }


    /**
     * checks if an array of variables are set
     * 
     * @param array $data data being verified
     * @param array $permission used to select all fields with such permission  
     * @return bool
     */
    public function areSet($data=array(), $requiredFields=array()):bool
    {
     
       // print_r($data);print_r($requiredFields);die;
         $dataKeys = array_keys($data);
         foreach($requiredFields as $requiredField)
         {
            if(!in_array($requiredField, $dataKeys) || empty($data[$requiredField]))
                return false;
         } 
         return true;
    }

    /**
     * checks if all mandatory fields are present and not empty
     *
     * @param array $userData field and value pairs from user
     * @param array $mandatoryFields the required fields
     * @param array $optionalFields  fields that can be optional
     * @return void throws a CustomException if fields are inconsistent
     */
    public function checkFieldsConsistency(array $userData, array $mandatoryFields,  array $optionalFields = array()):void
    {
        $userFields = array_keys($userData);
        if(array_diff($mandatoryFields, $userFields))
            throw new CustomException("Inadequate Fields Supplied");
        if(array_diff($userFields, array_merge($mandatoryFields, $optionalFields)))
            throw new CustomException("Invalid Fields Supplied");
        foreach($userData as $field=>$value)
        {
            if(empty($value) && in_array($field, $mandatoryFields))
                throw new CustomException("Required Fields Cannot Be Empty");
        }
    }
// cat=13;
// gen=31;


    public function categoryCheck()
    {

    }

   /**
    * gets fields with specified permission
    *
    * @param integer $permission can either be any of the permission constants in Model class
    * @return array fields with specified permission
    */
    public function getFields($permission)
    {
        $result = array();
        foreach($this->fields as $key=>$value)
            in_array($permission, $value['permissions'])?array_push($result, $key):null;
        return $result;
    }

    /**
     * checks if password is valid. Valid passwords are more than 7 and equal to confPwd
     *
     * @param string $pwd password
     * @param string $confPwd confirm password
     * @return void throws a CustomException if password is invalid
     */
    public function validatePwd(string $pwd, string $confPwd)
    {
        if($pwd!==$confPwd)
            throw new CustomException('Password Mismatch');
        if(mb_strlen($pwd)<8)
            throw new CustomException('Password length should be greater than 7');
    }

    /**
     * gets invalid data from parsed data. fields that are empty and do not exist in required fields constitute invalid data
     * 
     * 
     * @param array $parsedFields - unknown associative array of data
     * @param array $requiredFields - valid field names
     * @return array associative array of data that is  empty and do not exist in @param $parsedFields
     */
    public  function blackData(array $parsedData = array(), array $validFields = array())
    {
        $blackData = array();
        foreach($parsedData as $key=>$value)
            in_array($key, $validFields) && !empty($value) ?:$blackData[$key]=$value;
        return $blackData;
    }



    /**
     * gets valid data from parsed data. fields that are not empty and exist in required fields constitute valid data
     * 
     * 
     * @param array $parsedFields - unknown associative array of data
     * @param array $validFields - valid field names
     * @return array associative array of data that is not empty and exist in @param $parsedFields
     */
    public  function whiteData(array $parsedData = array(), array $validFields = array())
    {
        $whiteData = array();
        foreach($parsedData as $key=>$value)
            in_array($key, $validFields) && !empty($value)?$whiteData[$key]=$value:null;
        return $whiteData;
    }

   
    
    /**
     * gets the fields and constraint values
     *
     * @param array $definition the fields and various constraints
     * @param string $key the name of the constraint
     * @param integer $value value of the constraint
     * @return array fields and coressponding constraints that matched the specified constraint value
     */
    public function getFieldsByKey(array $definition, string $key, int $value):array
    {
        foreach($definition as $field=>$constraints)
            if(!empty($constraints[$key]) && $constraints[$key]==$value)
                $fields[$field]  = $constraints;
        return $fields;
    }
    
    /**
     * sanitizes an array of data by reference
     *
     * @param callable $function sanitizing function to use
     * @param array $data associative array of data to sanitize
     * @return void
     */
    public function sanitizeBulk(string $function, array &$data=array())
    {  
        foreach($data as $key => $value)
            $data[$key] = call_user_func($function, $value);
    }

    //returns total number of elements removed
    public function removeEmptyFields(&$data, $exceptFields=array())
    {
        $totalRemoved = 0;
        foreach($data as $field=>$value)
            if(empty($value) && !in_array($field, $exceptFields)):
                unset($data[$field]);
                $totalRemoved++;
            endif;
        return $totalRemoved;
    }
 
    public function filterField(string $variable, int $filter = null)
    {
        switch ($filter) 
        {
            case SELF::$FILTER_VALIDATE_DOB:
                if (!$this->isValidDate($variable) || (strtotime($variable) > strtotime('5 years ago')))
                    throw new CustomException("Invalid Date of Birth Supplied");
                break;
            case SELF::$FILTER_VALIDATE_CONTACT:
                if (!((strlen($variable) == 12) && ctype_digit((string)$variable)))
                    throw new CustomException("Invalid Contact Supplied");
                break;
            case SELF::$FILTER_VALIDATE_NAME:
                if (!ctype_alpha($variable))
                    throw new CustomException("Name should contain characters from A-Z only and no spaces");
            break;
            case FILTER_VALIDATE_INT:
                 if(!filter_var($variable, FILTER_VALIDATE_INT))
                    throw new CustomException("Invalid Data Supplied");
            break;
        }
    }


    /**
     * used to validate dates and time
     *
     * @param string $date time or date to validate
     * @param string $format format of validation. format for time is 'H:i:s', format for datetime is 'Y-m-d H:i:s'
     * @return boolean
     */
    function isValidDate(string $date, string $format = 'Y-m-d'): bool
    {
        $dateObj = DateTime::createFromFormat($format, $date);
        return $dateObj && $dateObj->format($format) == $date;
    }

    /**
     * Gets multiple db fields an optionally filters them
     *
     * @param array $data An array with string keys(the database field names) containing the data(values of each field) to filter.Eg. array("contact"=>"458962","fName"=>"45Bisky","dob"=>"2020-15-16"). NB. All are invalid
     * @param array $definition An array defining the arguments. A valid key is a string containing the field name and a valid value is a key value array with key 'validation' and value of a filter type. 
     *              valid filter types are, FILTER_VALIDATE_DOB, FILTER_VALIDATE_NAME and FILTER_VALIDATE_CONTACT from the 'Model' Class. Eg.array("contact"=>array("validation"=>FILTER_VALIDATE_CONTACT),"fName"=>"FILTER_VALIDATE_NAME", "dob"=>FILTER_VALIDATE_DOB)
     * @return void throws a CustomException if field is invalid
     */
    public function filterFieldArray(array $data, array $definition)
    {
        foreach ($data as $key => $value) :
            try {
                if(!empty($definition[$key]['validation']))
                    $this->filterField($value, $definition[$key]['validation']);
            } catch (CustomException $e) {
                    throw new CustomException($e->getMessage());
            }
        endforeach;
    }

    public function filterFile(string $file, $filter)
    {
        
    }

}
