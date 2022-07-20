<?php

class DbWrapper
{
    private static $hostname = 'j5zntocs2dn6c3fj.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
    // private static $hostname = 'localhost:3306';
   
    private static $dbName = 'vsewzt0a7974sz0s';
   
    private static $username = 'ydy4xi7cs6phl07s';
    // private static $username = 'bisky';
    
    private static $pwd = 'sv5304xgz4y43rmi';
    // private static $pwd = 'Zumah$erver2!3!2018$@lpha';
    private static $charset = 'utf8mb4';
    private static $settings = 
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    /**
     * starts a PDO database connection
     *
     * @return object 
     */
    public  static function conn()
    {
        try {
            $dsn = "mysql:host=" . self::$hostname . ";dbname=" . self::$dbName . ";charset=" . self::$charset;
            $pdo = new PDO($dsn, self::$username, self::$pwd, self::$settings);
            return $pdo;
        } catch (\PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }


    /**
     * fetches multiple rows from database
     *
     * @param string $query prepared db query made of positional placeholders
     * @param array $params positional parameters to pass to the query
     * @return array associative array of rows in database. This can be changed in PDO settings
     */
    protected function fetchAll(string $query, array $params = array())
    {
        $conn  = self::conn();
        $stmt = $conn->prepare($query);
        return $stmt->execute($params) ? $stmt->fetchAll() : false;
    }

    /**
     * fetches single row from database
     *
     * @param string $query prepared db query made of positional placeholders
     * @param array $params positional parameters to pass to the query
     * @return array associative array of the row fetched. This can be changed in PDO settings
     */
    public static function fetch(string $query, array $params = array())
    {
        $conn = self::conn();
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch();
    }
    
    /**
     * Gets the placeholders for an INSERT operation
     *
     * @param array $vars  index array of values to be passed to the INSERT query
     * @return string returns a string of placeholders eg ?,?,? if count(@param $vars) == 3
     */
    public static function getInsertPlaceholders(array $vars = array())
    {
        return "?" . str_repeat(",?", count($vars) - 1);
    }


    /**
     * fetches single value from database
     * usually used to run single aggregate queries
     *   
     * 
     * @param string $query prepared db query made of positional placeholders
     * @param array $params positional parameters to pass to the query
     * @return bool true if count is > 0  else false
     */
    protected function getValue(string $query, array $params = array())
    {
        return $this->fetch($query, $params) ? $this->fetch($query, $params) : false;
    }

    /**
     * used to run DML commands ie INSERT, UPDATE AND DELETE. Staments should always be prepared
     *
     * @param string $query the query to pass to db made up of positional placeholders (?). It can be INSERT, UPDATE or DELETE.
     * @param array $params the positional parameters to pass to query. It should match the placeholders in the query.
     * @param bool $returnId used in insert statements.
     * @return mixed - bool or the last insert id.
     */
    protected function runDml($query, $params = array(), $returnId=false)
    {
        $conn = self::conn();
        $stmt = $conn->prepare($query);
        $result = $stmt->execute($params);
        if($result && $returnId)
            return $conn->lastInsertId();
        return $result;
    }


    /**
     * used to run DML commands ie INSERT, UPDATE AND DELETE. Staments should always be prepared
     *
     * @param string $query the query to pass to db made up of positional placeholders (?). It can be INSERT, UPDATE or DELETE.
     * @param array $params the positional parameters to pass to query. It should match the placeholders in the query.
     * @return int - number of affected rows.
     */
    protected function dmlRowCount($query, $params = array()):int
    {
        $conn = self::conn();
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount();
    }


}




























/**
 * NOUNS
 *  service
 *  job
 *  story
 *  team
 *  hot shot
 *  user
 *  rate
 *  flag
 *  logout
 *  login
 * VERBS

 * view services GET /services/id
 "SELECT s.sid, s.category, s.profession, s.info, CONCAT(s.city,', ', s.town) AS location,
  s.rating, s.clients, s.fee, IF(s.negotiable, 'true', 'false'), s.work_starts, s.work_ends,
  b.name as bName, CONCAT(u.lname, ', ', u.fname) as posted_by, u.uid, t.sid, COUNT(*) AS tomatoes, si.name, 
  IF((h.hid IS NULL), 'no', 'yes') AS hot_shot, tm.uid 
  FROM services s INNER JOIN businesses b ON s.sid  = b.sid 
  INNER JOIN users u ON b.uid  = u.uid  
  LEFT JOIN tomatoes t t.sid = s.sid 
  INNER JOIN service_images si ON si.sid  = u.uid
  INNER JOIN hot_shots h ON h.sid  = s.sid
  INNER JOIN t_members tm ON tm.uid  = u.uid
  WHERE s.status = ? AND sid=?";

 *  update a service  PUT /services/id
  "update $this->table SET $column = ?, [, $anotherColumn = ?..] 
 WHERE $id=?"
 *  view jobs GET /jobs/
 "SELECT j.jid, j.category, j.title, j.info, j.fee, j.duration, IF(j.negotiable, 'true', 'false'),
  j.posted_on, j.work_type, u.uid, u.dpName, CONCAT(u.lname, ', ', u.fname) AS posted_by, CONCAT(u.city, ', ', u.town) AS location
  FROM jobs j INNER JOIN 
  users u USING(uid) WHERE u.status=?";

 *  update a job PUT /jobs/id
  "update $this->table SET $column = ?, [, $anotherColumn = ?..] 
 WHERE $id=?"
 *  view stories GET /stories/
 "SELECT  st.sid, st.title, st.genre, st.posted_on, st.uid, st.chapters, 
  st.posted by, ROUND(AVG(rt.rate), 1) AS rate,
  CONCAT(u.lname, ', ', u.fname) AS posted_by, CONCAT(u.city, ', ', u.town) AS location
  FROM stories 
  ";
 *  update stories PUT /stories/id
  "update $this->table SET $column = ?, [, $anotherColumn = ?..] 
 WHERE $id=?"
 *  view teams GET /teams/
 
"SELECT t.tid, t.category, CONCAT(t.city, ', ', t.town) AS location t.title,
 t.pay_method, t.rating, IF(tm.admin, 'true', 'false'), u.uid, u.dpName, 
 CONCAT(u.lname, ', ', u.fname") AS member_name FROM teams t INNER JOIN 
 t_members tm ON t.tid = tm.tid INNER JOIN users u ON u.uid = tm.uid";

 *  update teams PUT /teams/id
 "update $this->table SET $column = ?, [, $anotherColumn = ?..] 
 WHERE $id=?"
 *  view hot shots GET /hotshots/
 
 *  pay to marked as hot shot POST /hotshots/
 *  delete team DELETE /teams/id
 DELETE FROM $this->table WHERE id = ?
 *  add members to teams POST /teams/
 *  post a service  POST /services/
 *  delete a service  DELETE /services/id
DELETE FROM $this->table WHERE id = ?
 *  rate a service POST /services/id//**rates
 *  search for a services GET /services?s=?
 * 
 *  post a job POST /jobs/
 *  search for a job GET /jobs/id
 
  "SELECT j.jid, j.category, j.title, j.info, j.fee, j.duration, IF(j.negotiable, 'true', 'false'),
  j.posted_on, j.work_type, u.uid, u.dpName, CONCAT(u.lname, ', ', u.fname), CONCAT(u.city, ', ', u.town) AS location
  FROM jobs WHERE u.status=? AND u.uid=?";
 *  delete a job DELETE /jobs/id
 DELETE FROM $this->table WHERE id = ?
 *  post a story POST /stories/
 *  search for a story GET /stories/s/
 *  delete a story DELETE /stories/id
 DELETE FROM $this->table WHERE id = ?
 *  rate a story POST /story/id/rate
 *  update story rate DELETE /stories/id/rate/id
 *  register a user POST  /users/
 *  sign a user in POST /signin/
 *  sign a user out POST /signout/
 *  flag a user POST /flag/
 *  view user profile (self) GET /users/id
 *  
 */


class Services
{
}
