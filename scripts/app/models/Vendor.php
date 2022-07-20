<?php
class Vendor extends Model
{
 
    protected $table = 'vendors';
    protected $pk    = 'contact';
    private array $mandatoryFields = array(
        'bName',
        'description'
    );

   
     
    public function getServices($vid)
    {
        $limit = 10;
        $sql = "SELECT s.sid AS sid, s.vid AS vid, s.name AS name, s.postedOn AS postedOn,
        s.serviceExt AS serviceExt, v.bName AS bName, v.contact AS contact
        FROM services s 
         JOIN vendors v ON v.contact = s.vid
        WHERE s.vid=?";
        $params =  array($vid);
        $results = $this->fetchAll($sql, $params);
        $data = array('msg'=>array('data'=>array()));
        if ($results) 
        {
            foreach($results as &$result)
            {
               $result['serviceImg'] = $this->host.'/api/zumahgo/app/uploads/images/services/'.$result['sid'].'.'.$result['serviceExt'];
               unset($result['serviceExt']);
            }
            $data['msg']['data'] = $results;
        }
        return $data;
    }




    public function search($query, $filters=null, $sinceId=null)
    {
        $filters = array('maxFee'=>200);
        $limit   = 10;
        $status  = 3;
        $query  .= '*';
        $lastId  = $sinceId;
        $sinceId = $sinceId ? "AND j.jid <:jid":null;
        $filter  = $filters ?$this->parseFilter($filters, 'j', array('lid'=>NULL)):null;
        $sql     = "SELECT j.jid AS jid, c.category AS category, j.jobName AS jobName, j.workType AS workType,
         CONCAT(u.fname, ' ', u.lname) AS postedBy
        FROM jobs j INNER JOIN 
        users u ON j.uid=u.uid
        INNER JOIN categories c ON j.cid=c.cid
        WHERE u.status=:status $filter $sinceId AND MATCH(j.info,j.jobName) AGAINST(:query IN BOOLEAN MODE) ORDER BY j.jid DESC LIMIT :limit ";

        $params  = $sinceId ? array('status'=>$status, 'jid'=>$lastId, 'query'=>$query, 'limit'=>$limit) : array('status'=>$status, 'query'=>$query, 'limit'=>$limit);
        $filter  ? $params = array_merge($params, $filters):NULL;
        $data    = array('msg'=>array('data'=>array()), 'status'=>OK);
        $results = $this->fetchAll($sql, $params);
        if ($results) 
        {
            $i = -1;
            foreach ($results as $result) 
            {
                ++$i;
                $result['id']          = $result['jid'];
                $result['profile']     = '/jobs/'.$result['jid'];
                array_push($data['msg']['data'], $result);
            }
            $next               = "/jobs/?sinceId=".$results[$i]['jid'];
            $pagination['next'] = $next;
            $data['msg']['extras']['pagination'] = $pagination;
        }
        return $data;
    }

    public function addVendor($data)
    {
        try {
            $this->checkFieldsConsistency($data, $this->mandatoryFields);
        } catch (CustomException $e) {
            return $e->getCustomMessage();
        }
        $data['contact'] = $this->getVar('activeUser', 'contact');
        if (($logo = $this->getVar('logo')))
            $data['logoExt'] = $this->getExt($logo);
        $columns = array_keys($data);
        $values  = array_values($data);
        $sql = $this->getInsQuery($columns);
        try
        {
          $this->runDml($sql, $values, true);
          if($logo)
          {
          $oldName = "app/uploads/tmp/$logo";
          $newName = 'app/uploads/images/logos/' . $data['contact']. '.' . $this->getExt($logo);
          rename($oldName, $newName);
          $activeUser = $this->getVar('activeUser');
          $activeUser['vendor'] = 'true';
          $this->setVar('activeUser', $activeUser);
          $this->delVar('logo');
          }
    
        }catch(PDOException $e)
        {
             return $this->unknwnErr;
        }
        return $this->success;

    }


    public function storeVendorLogo($img, $sessKey): array
    {
        try {
            $this->validateImg($img);
        } catch (CustomException $e) {
            return $e->getCustomMessage();
        }
        $name = time() . '_' . uniqid() . '.' . $this->getExt($img['name']);
        if (move_uploaded_file($img['tmp_name'], $this->tmpPath . $name)) :
            $this->setVar($sessKey, $name);
            return $this->success;
        endif;
        return $this->unknwnErr;
    }

    /**
     * Returns info about a single job from database
     * as a sanitized array of elements
     * @param int $id the id of the job to fetch from database
     * @return array an array containing information about the job
     */
    public function getJob($jid)
    {
        $status = 3;
        $sql = "SELECT j.jid AS jid, c.category AS category, j.jobName AS jobName, j.workType AS workType,
         IF(j.fee IS NULL, 'false', j.fee) AS fee, j.info AS info,
        j.postedOn AS postedOn, IF(j.negotiable, 'true', 'false') AS negotiable, CONCAT(u.fname, ' ', u.lname) AS postedBy
        FROM jobs j INNER JOIN 
        users u USING(uid)
        INNER JOIN categories c ON j.cid=c.cid WHERE u.status=? AND j.jid=?";

        $params = array($status, $jid);
        $result = $this->fetch($sql, $params);
        $data   = array('msg'=>array(), 'status'=>OK);
        if ($result)
         {
            $timestamp           = strtotime($result['postedOn']);
            $result['postedOn']  = date('jS F, Y',$timestamp);
            $data['msg']['data'] = $result;
         }
        return $data;
    }
}