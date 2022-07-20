<?php
trait Auth
{
 use Session;

 /**
  * checks if current user is authenticated
  *
  * @return boolean
  */
 public function isAuthedUser()
 {
    return $this->issetSess('activeUser');
 }

   
}

trait Session
{
    /**
    * stores a key valued pair in session
    *
    * @param string $arrayKey used when pushing data into array in a session
    * @param mixed $value value of the the key
    * @return void
    */
    public function setVar($sessKey, $arrayKey=false, $value)
    {
        return $arrayKey?$_SESSION[$sessKey][$arrayKey] = $value: $_SESSION[$sessKey] = $value;
    }

    public function mergeSession($data, $sessionKey='activeUser'):array
    {
        $newSession = array_replace($_SESSION[$sessionKey], $data);
        $_SESSION[$sessionKey] = $data;
        return $data;
    }
    public function getVar($sessKey, $key=false)
    {
         if($this->issetSess($sessKey, $key))
            return $key?$_SESSION[$sessKey][$key]:$_SESSION[$sessKey];
         return false;
    }


    public function delVar($sessKey, $key=null)
    {
        if($key && isset($_SESSION[$sessKey])) 
            unset($_SESSION[$sessKey][$key]);
        elseif(isset($_SESSION[$sessKey]))
            unset($_SESSION[$sessKey]);
    }


    public function issetSess($sessKey, $key=false)
    {
       
        return $key? isset($_SESSION[$sessKey][$key]) : isset($_SESSION[$sessKey]);
    }

  

    /**
     * destroys session.
     * used to sign a user out
     *
     * @return void
     */
    public function killSession()
    {
        return session_unset();
    }
}