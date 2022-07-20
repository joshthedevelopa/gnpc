<?php
class Service extends Model
{
   
   protected $pk = 'sid';
   protected $table  = 'services';
   private $fields = array
   (
    "name"  =>array()
   );
  
   private $imgsPath = 'app/uploads/images/services/';
   
   private array $errMsgs = array
    (
        'emptyImg'      => array('title'=>'error', 'text'=>'Please upload a service Image'),
        'emptyPg1'      => array('title'=>'error', 'text'=>'Please Fill in all required fields on the first page'),
        'resendMaxedOut'=> array('title'=>'error', 'text'=>'Code Resend maxed-out')
    );

    /**
     * Get all info about services
     *
     * @param int $limit max number of services to return. Default is 20
     * @return array 
     */    
    public function getServices($sinceId=null)
    {
        $limit = 20;
        $lastId     = $sinceId;

        $sinceId = $sinceId ? "AND s.sid < ?":null;
        $sql= "SELECT s.sid AS sid, s.vid AS contact, s.name AS name, s.postedOn AS postedOn,
        s.serviceExt AS serviceExt
        FROM services s 
        WHERE true $sinceId ORDER BY s.sid DESC LIMIT ?";
        //die($sql);
         $params = $sinceId ? array($lastId, $limit) : array($limit);
         $results = $this->fetchAll($sql, $params);
         $data = array();
         if($results)
         {
            $sinceId = $results[count($results)-1]['sid'];
            $next               = "/api/zumahgo/services/?sinceId=".$sinceId;
            $pagination['next'] = $next;
            $data['msg']['extras']['pagination'] =$pagination;
            foreach($results as &$result)
            {
               $result['serviceImg'] = $this->host.'/api/zumahgo/app/uploads/images/services/'.$result['sid'].'.'.$result['serviceExt'];
               unset($result['serviceExt']);
            }
            $data['msg']['data'] = $results;
         }else 
            return $data;
        return $data;
 }

    public function getService($sid)
    {
        $sql = "SELECT s.sid AS sid, s.vid AS vid, s.name AS name, s.postedOn AS postedOn,
        s.serviceExt AS serviceExt, v.bName AS bName, v.contact AS contact
        FROM services s 
        INNER JOIN vendors v ON v.contact = s.vid
        WHERE s.sid=?";
        $params = array($sid);
        $results = $this->fetch($sql, $params);
        $data = array('msg'=>array());
        if ($results)
         {
            $results['serviceImg'] = $this->host.'/api/zumahgo/app/uploads/images/services/'.$results['sid'].'.'.$results['serviceExt'];
            unset($results['serviceExt']);
            $data['msg']['data'] = $results;
        }
        return $data;
    }

    public function getServiceProfile($uid)
    {
        $sql = "SELECT s.sid AS sid, s.profession         AS profession,
        IF(s.workingHrs  IS NULL, '', s.workingHrs)  AS workingHrs, 
        IF(s.workdays    IS NULL, '', s.workdays)    AS workdays, 
        IF(s.email       IS NULL, '', s.email)       AS email, 
        IF(s.website     IS NULL, '', s.website)     AS website, 
        IF(s.paymentType IS NULL, '', s.paymentType) AS paymentType, 
        IF(s.fee         IS NULL, '', s.fee)         AS fee,
        IF(s.bName       IS NULL, '', s.bName)       AS bName,
        IF(s.bInfo       IS NULL, '', s.bInfo)       AS bInfo, 
        IF(u.dpExtension IS NULL, '', u.dpExtension) AS dp, 
        s.sInfo AS sInfo, c.category AS category, s.contact AS contact,
        IF(sp.pid = 1, 'true', 'false') As hotshot, s.postedOn AS postedOn,
        CONCAT(l.region,', ', l.city) AS location, 
        CONCAT(u.fname, ' ', u.lname) AS spName, u.uid AS uid, si.name AS imgLinks
        FROM services s 
        INNER JOIN users u ON u.uid = s.uid
        INNER JOIN service_imgs si ON si.sid=s.sid
        INNER JOIN categories c ON c.cid=s.cid
        INNER JOIN locations l ON l.lid=s.lid 
        LEFT JOIN service_packages sp ON s.sid = sp.sid
        WHERE  s.uid=?";

        $params = array($uid);
        $results = $this->fetchAll($sql, $params);
        $data = array('msg'=>array(), 'status'=>OK);
        if ($results)
         {
            $i = 0;
            $j = 0;
            $k = 0;
            foreach ($results as $result):
                $imgLinks[$i++]  = $this->host . '/api/servicetomato/app/uploads/images/services/' .$result['sid'].'_'. $result['imgLinks'];
                if($results[$k]['sid']  != @$results[++$k]['sid'])
                {
                    $result['dp']        = empty($result['dp'])?$result['dp']:$this->host.'/api/servicetomato/app/uploads/images/dp/'.$result['uid'].'.'.$result['dp'];
                    $timestamp           = strtotime($result['postedOn']);
                    $result['postedOn']  = date('jS F, Y',$timestamp);
                    $result['imgLinks']  = $imgLinks;
                    $data['msg']['data'][$j++] = $result;
                    $imgLinks = array();
                    $i=0;
                    continue;
                }
            endforeach;
            $data['status'] = OK;
        }
       
        return $data;
    }

    public function createService($data)
    {
        
        try {
            $this->checkFieldsConsistency($data, array_keys($this->fields));
            if (!($img = $this->getVar('serviceImg')))
                return $this->errMsgs['emptyImg'];
            $data['vid']        = $this->getVar('activeUser', 'contact');
            $data['postedOn']   = date('Y-m-d');
            $data['serviceExt'] = $this->getExt($img);
            $sql  = $this->getInsQuery(array_keys($data));
            $lastId = $this->runDml($sql, array_values($data), true);
            $oldName = "app/uploads/tmp/$img";
            $newName = 'app/uploads/images/services/' . $lastId . '.' . $this->getExt($img);
            rename($oldName, $newName);
            $this->delVar('serviceImg');

        } catch (CustomException $e) {
            return $e->getCustomMessage();
        } catch (Exception $e) {
            return $this->unknwnErr;;
        }
        return $this->success;
    }



    public function getContacts($sid)
    {
        $limit   = 2;
        $sql     = 'SELECT * FROM b_contacts WHERE sid=? LIMIT ?';
        $params  = array($sid, $limit);
        $results = $this->fetchAll($sql, $params);
        $results['contacts'] = $results?$results:'false';
        $data['msg']          = $results;
        $data['status']      = OK;
        return $data;
    }

    public function storePg1($data)
    {
        $this->trimAll($data);
        $pageOneFields   = $this->getFieldsByKey($this->fields,  'page', PARENT::PAGE_ONE);
        $optionalFields  = $this->getFieldsByKey($pageOneFields, 'flag', PARENT::OPTIONAL);
        $mandatoryFields = $this->getFieldsByKey($pageOneFields, 'flag', PARENT::MANDATORY);
        $this->unsetOptionalFields($data, array_keys($optionalFields));
        try{
            $this->checkFieldsConsistency($data, array_keys($mandatoryFields), array_keys($optionalFields));
        }catch(CustomException $e){
            return $e->getCustomMessage();
        }
        $this->setVar('pg1', $data);
        return $this->success;
    }

    public function search($query, $filters=null, $sinceId=null)
    {
        $limit = 10;
        $status = 3;
        $query     .= '*';
        $lastId     = $sinceId;
        $sinceId = $sinceId ? "AND s.sid <:sid":null;
        $filter = $filters ?$this->parseFilter($filters, 's', array('lid'=>NULL, 'cid'=>NULL)):null;
        $sql = "SELECT s.sid AS sid, c.category AS category, s.profession AS profession, 
        s.sInfo AS info, CONCAT(l.region,', ', l.city) AS location,s.bName AS bName
        FROM services s 
        INNER JOIN users u ON u.uid = s.uid
        INNER JOIN service_imgs si ON si.sid=s.sid
        INNER JOIN categories c ON c.cid=s.cid
        INNER JOIN locations l ON l.lid=s.lid 
        LEFT JOIN service_packages sp ON s.sid = s.sid
        WHERE u.status>=:status $filter $sinceId AND MATCH(s.sInfo,s.profession,s.bName) AGAINST(:query IN BOOLEAN MODE) GROUP BY si.sid ORDER BY s.sid DESC LIMIT :limit ";
        $params = $sinceId ? array('status'=>$status, 'sid'=>$lastId, 'query'=>$query, 'limit'=>$limit) : array('status'=>$status, 'query'=>$query, 'limit'=>$limit);
        $filter  ? $params = array_merge($params, $filters):NULL;
        $results = $this->fetchAll($sql, $params);
        $data = array();
        if($results)
         {
         
            $data['msg']['data'] = $results;
        }else
        return $data;
        return $data;
    }

    public function sanitize(array &$data, array $fields)
    {
        foreach($fields as $field)
            htmlspecialchars($data[$field]);
    }

    public function storeServiceImg($img, $sessKey): array
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


    public function deleteImg($imgId)
    {
        if(unlink($this->imgsPath.$imgId))
            return $this->success;
        else 
            return $this->unknwnErr;
    }

    public function delTmpImg($imgKey, $sessKey='serviceImg')
    {
        $name = $this->getVar($sessKey, $imgKey);
        if(unlink($this->tmpPath.$name))
            $this->delvar($sessKey, $imgKey);
        else
            return $this->unknwnErr;
        return $this->success;
    }

    public function update($data, $sid)
    {
        $this->trimAll($data);
        $this->fixData($data, $this->fields);
        try {
            $this->checkFieldsConsistency($data, array(), array_keys($this->fields));
            $this->filterFieldArray($data, $this->fields);
            $sql = $this->getUpdateSql(array_keys($data), $this->pk, $this->table);
            $data[$this->pk] = $sid;
            $params = $data;
            $params['uid'] = $this->getVar('activeUser', 'uid');
            $this->runDml($sql, $params);
        }catch(CustomException $e){
            return $e->getCustomMessage();
        }catch(Exception $e)
        {
            return $this->unknwnErr;
        }
        return $this->success;
    }

    public function deleteSessImg()
    {

    }
    public function deleteServiceImg()
    {

    }
    
    public function updateServiceImg($sid, $img, $sinceId)
    {
        try {
            $this->validateImg($img);
            $sql = "INSERT INTO service_imgs VALUES(?, ?)";
            $imgName = ++$sinceId . '.' . $this->getExt($img['name']);
            $this->runDml($sql, [$sid, $imgName]);
            move_uploaded_file($img['tmp_name'], $this->imgsPath. $sid. '_'. $imgName);
            return $this->success;
        } catch (CustomException $e) {
            return $e->getCustomMessage();
        }catch(Exception $e)
        {
            return $this->unknwnErr;
        }
        
    }
}