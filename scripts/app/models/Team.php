<?php
class Team extends Model
{
    protected $table = 'teams';
    private $sid;
    public function __construct($sid)
    {
        $this->sid = $sid;
    }

    use Validation;
    public function getTeams($limit=20)
    {

        $sql = "SELECT  t.tid AS  tid, t.title AS title, c.category AS category, t.info AS info, 
        t.minFee AS minFee, t.maxFee AS maxFee, t.payMethod AS payMethod
        FROM teams t INNER JOIN categories c ON t.cid=c.cid";
        $params = array();
        $results  = $this->fetchAll($sql, $params);
        $data = array('msg' => array(), 'status' => OK);
        if ($results) 
        {
            foreach ($results as $result) 
            {
                $this->sanitizeBulk('htmlspecialchars',$result);
                array_push($data['msg'], $result);
            }
        }
        return $data;
    }

    public function getTeam($id)
    {
        $sql = "SELECT  t.tid AS  tid, t.title AS title, c.category AS category, t.info AS info
        FROM teams t INNER JOIN categories c ON t.cid=c.cid WHERE t.tid=?";

        $params = array($id);
        $result = $this->fetch($sql, $params);
        $data = array('msg' => array(), 'status' => OK);
        if ($result) 
        {
            $this->sanitizeBulk('htmlspecialchars', $result);
            $data['msg'] = $result;
            $data['status'] = OK;
        }
        return $data;
    }

    public function createTeam($data)
    {
        $this->create($data);
    }
}
