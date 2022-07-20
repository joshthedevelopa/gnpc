<?php
trait Validation
{
    // private $allowedFormats;
    // private $attr = [
    //    VALIDATE_PDF,
    //  VALIDATE_IMG,
    //  VALIDATE_DOC,
    //   VALIDATE_STRING,
    //    VALIDATE_INT,
    // ];

    // /**
    //  * checks if an array of variables are set
    //  * 
    //  * @param array $keys - checks all the existence of keys supplied
    //  * @param array $vars  
    //  * @return bool
    //  */
    // public function areSet($keys = array(), $vars = $_POST)
    // {
    //      foreach($keys as $key)
    //      {
    //             if(empty($vars[$key]))
    //                 return false;
    //      } 
    //      return true;
    }

    /**
     * checks if parsed array of columns exists in a table
     * black columns are columns that do not exist in table
     * 
     * @param array $cols - parsed array of columns
     * @return int used as boolean. It can be zero or > zero
     */
    public  function columnsExist($cols = array())
    {
        $blackColumns = array();
        foreach($cols as $col)
            in_array($col, $this->cols) ? null:array_unshift($blackColumns, $col);
        $this->blackColumns = $blackColumns;
        return count($blackColumns);
    }


}