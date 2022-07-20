<?php

abstract class Model extends DbWrapper
{
    use Auth;
    use Validation;
    use Response;
    protected const FILTER_VALIDATE_DOB        = 1;
    protected const FILTER_VALIDATE_CONTACT    = 2;
    protected const FILTER_VALIDATE_NAME       = 3;
    protected const FIX_CONTACT                = 1;
    protected const FIX_GENDER                 = 2;
    protected const PAGE_ONE                   = 1;
    protected const PAGE_TWO                   = 2;
    protected const UPDATABLE                  = 6;
    protected array $success                   = array('title' => 'success');
    protected array $unknownError              = array('title' => 'error', 'text' => 'Sorry, something went wrong');
    public array $pages = array
    (
        "dashboard"=>"/dashboard.php",
        "login"=>"/",
        "signup"=>"/signup.php",
        "changePwd"=>"/change_password.php",
        "renewal"=>"/renewal.php",
        "editAccount"=>"/student-account-edit.php",
        "undergradApply"=>"/undergraduate.php"
    );
    /**
     * field is mandatory for insert
     */
    const MANDATORY        = 1;
    /**
     * field is optional for insert
     */
    const OPTIONAL         = 2;
    /**
     * field can be updated
     */
    const CAN_UPDATE       = 3;

    protected $lastInsertIds = array();
    //transaction queries
    protected $tQueries      = array();
    //transaction values
    protected $tValues       = array();
    //boolean array whether query should return insert id or not
    protected $insertIdflags = array();
    public $tmpPath = "app/uploads/tmp/";
    
    public $host = 'http://localhost';
    //public $host = 'https://zumah.net';


    /**
     * Gets the mysql update query with positional parameters
     *
     * @param array $fields fields to be updated
     * @param string $uniqField the id or unique field used in the where clause of the query
     * @param string $table table involved. 
     * @param string $uid field of the user doing the update. It's usually 'uid'
     * @return string mysql prepared query
     */
    public function getUpdateSql(array $fields, string $uniqField, $table, $uidField='uid')
    {
        $firstField = array_shift($fields);
        $sql  = "UPDATE $table SET $firstField = :$firstField";
        foreach ($fields as $field) :
            $sql .= ", $field =:$field";
        endforeach;
        $sql .= $uidField ? " WHERE $uniqField= :$uniqField AND $uidField = :$uidField":" WHERE $uniqField= :$uniqField"; 
        return $sql;
    }

    /**
     * returns contact in the right format(GHANA). 
     * an example of a fixed contact is 233544190406 - my number -:)
     * 
     * @param string $contact 
     * @return string returns fixed contact.
     */
    public function fixContact($contact)
    {
        $contact = str_replace(['-', ' '], '', $contact);
        if (preg_match('/^\+233/', $contact))
            $contact = preg_replace('/^\+233/', '233', $contact);
        elseif (preg_match('/^233/', $contact))
            $contact = $contact;
        elseif (preg_match('/^0/', $contact))
            $contact = preg_replace('/^0/', '233', $contact);
        else
            $contact = '233' . $contact;
        return $contact;
    }


    /**
     * Fix user data to prevent validation problems
     *
     * @param array $data An array with string keys(the database field names) containing the data(values of each field) to fix.Eg. array("contact"=>"458962","fName"=>"45Bisky").
     * @param array $definition An array defining the arguments. A valid key is a string containing the field name and a valid value is a key value array with key 'fix' and value of a fix type. 
     *              valid fix types are, FIX_CONTACT, FIX_NAME, FIX_DESCRIPTION and FIX_NAME from the 'Model' Class. Eg.array("contact"=>array("fix"=>FIX_CONTACT),"fName"=>FIX_NAME)
     * @return void throws a CustomException if field is invalid
     */
    public function fixData(array &$data, array $definition)
    {
        foreach ($data as $key => $value) {

            if (!empty($definition[$key]['fix'])) {
                switch ($definition[$key]['fix']):
                    case SELF::FIX_CONTACT:
                        $data[$key] = $this->fixContact($value);
                        break;
                    case SELF::FIX_GENDER:
                        $data[$key] = $this->fixGender($value);
                        break;
                endswitch;
            }
        }
    }

    /**
     * removes empty optional fields from user supplied data
     *
     * @param array $data 
     * @param array $optionalFields
     * @return void
     */
    public function unsetOptionalFields(array &$data, array $optionalFields):void
    {
        foreach($optionalFields AS  $optionalField)
        {
            if(array_key_exists($optionalField, $data) && empty($data[$optionalField]))
                unset($data[$optionalField]);
        }
    }
    public function fixGender(string $gender)
    {
        if ($gender != 'M' && $gender != 'F')
            return 'M';
        return $gender;
    }

    /**
     * clears white space characters from the end of each string
     *
     * @param  array $data key value array containing data to trim
     * @return array trimmed data
     */
    public function trimAll(array &$data = array())
    {
        foreach ($data as $key => $value)
            $data[$key] = trim($value);
    }


    /**
     * adds queries to be executed later in a transaction
     *
     * @param string $sql query to be executed in transaction (contains positional parameters)
     * @param  array $values values assign to the sql
     * @param boolean $returnInsertID decides whether query should return insert id or not
     * @return void
     */
    public function addQuery($sql, $values, $returnInsertID = false)
    {
        array_push($this->tQueries, $sql);
        array_push($this->tValues, $values);
        array_push($this->insertIdflags, $returnInsertID);
    }

    // /**
    //  * runs queries in the transaction table
    //  *
    //  * @return boolean 
    //  */
    // public function runTransaction()
    // {
    //     $conn  = parent::conn();
    //     $sqlNo = count($this->tQueries);
    //     try {
    //         $conn->beginTransaction();
    //         for ($i = 0; $i < $sqlNo; $i++) :
    //             $stmt = $conn->prepare($this->tQueries[$i]);
    //             $stmt->execute($this->tValues[$i]);
    //             $this->insertIdflags[$i] ? $this->lastInsertIds['query' . $i] = $conn->lastInsertId() : null;
    //         endfor;
    //         $conn->commit();
    //         unset($this->tQueries, $this->tValues, $this->insertIdflags);
    //         return true;
    //     } catch (Exception $e) {
    //         echo $e->getMessage();
    //         $conn->rollback();
    //         return false;
    //     }
    // }

    public function delete($idValue)
    {
        $sql = "DELETE FROM $this->table WHERE $this->idName=?";
        return $this->runDml($sql, $idValue);
    }

    public function create(array $data = array())
    {
        $cols = array_keys($data);
        $vals = array_values($data);
        $sql = $this->getInsQuery($cols, $this->table);
        return $this->runDml($sql, $vals);
    }

    public function userExists($data, $where=null)
    {
       
        $sql = "SELECT COUNT(*) AS total FROM student WHERE (email=:email OR contact=:contact) $where";
        return $this->fetch($sql, $data)['total'];
    }

    
    public function canUpdate($fields)
    {
    }

    /**
     * Gets an insert query based on supplied fields
     *
     * @param array $fields fields involved in the insertion
     * @param string $table NULL means to use the table of the class which called it
     * @param array $numRows the number rows to insert
     * @return string The sql insert query
     */
    public function getInsQuery($fields, $numRows = 1, $table = null)
    {
        $table = $table ? $table : $this->table;
        $placeholders = '?' . str_repeat(',?', count($fields) - 1);
        $sql = "INSERT INTO $table(" . implode(',', $fields) . ") VALUES($placeholders)" . str_repeat(",($placeholders)", $numRows - 1);
        return $sql;
    }


    /**
     * Gets an insert ignore query based on supplied fields
     *
     * @param array $fields fields involved in the insertion
     * @param string $table NULL means to use the table of the class which called it
     * @param array $numRows the number rows to insert
     * @return string The sql insert query
     */
    public function getInsertIgnoreSql($fields, $table = null, $numRows = 1)
    {
        $table = $table ? $table : $this->table;
        $placeholders = '?' . str_repeat(',?', count($fields) - 1);
        $sql = "INSERT IGNORE INTO $table(" . implode(',', $fields) . ") VALUES($placeholders)" . str_repeat(",($placeholders)", $numRows - 1);
        return $sql;
    }

    public function getExtension($str)
    {
        $ext = explode('.', $str);
        return end($ext);
    }


    /**
     * saves uploaded file to a specific location
     *
     * @param array $file - the uploaded file and its attributes in the $_FILES array
     * @param string $fullpath - full path to the new location of the file (must include filename)
     * @return boolean
     */
    public function saveFile($file, $fullpath)
    {
        $tmpLoc = $file['tmp_name'];
        print_r(move_uploaded_file($tmpLoc, $fullpath));
    }

    public function validateImg($img, $mb = 2)
    {
        if(!(($type = exif_imagetype($img['tmp_name'])) &&
            in_array($type, ['1', '2', '3']) &&  //some comment
            $img['size'] <= $mb * pow(10, 6)))
            return false;
        return true;
    }


    function isPdf($pdfFile)
    {
        return $pdfFile["type"] == "application/pdf"?true:false;
          
    }

    public function parseFilter(&$queryParams, $table, $expectedFilters)
    {
        $params = array_intersect_key($queryParams, $expectedFilters);
        $snippet  = '';
        $paramsCopy = array();
        foreach ($params as $key => $value) {
            $snippet .= ' AND ' . $table . '.' . $key . '=:' . $table . '_' . $key;
            $paramsCopy[$table . '_' . $key] = $value;
        }

        $minFee      = $table . '_' . 'minFee';
        $maxFee      = $table . '_' . 'maxFee';
        $feeColumn   = $table . '.' . 'fee';
        if (!empty($queryParams['minFee'])) {
            $snippet   .= " AND $feeColumn>= :$minFee";
            $paramsCopy[$minFee] = $queryParams['minFee'];
        }
        if (!empty($queryParams['maxFee'])) {
            $snippet   .= " AND $feeColumn<= :$maxFee";
            $paramsCopy[$maxFee] = $queryParams['maxFee'];
        }
        $queryParams = $paramsCopy;
        return $snippet;
    }


    public function parseFee($queryParams)
    {
        
    }
}
