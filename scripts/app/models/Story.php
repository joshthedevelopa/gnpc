<?php
class Story extends Model
{
    protected $table = 'stories';
    private $pk = 'sid';
    public function __construct($sid)
    {
        $this->sid = $sid;
    }
    private $pageOne = array
    (
        'cid',
        'title',
        'chapters'
    );
    use Validation;
    public function getStories($sinceId=null)
    {
        $limit = 10;
        $status = 3;
        $lastId     = $sinceId;        
        $sinceId = $sinceId ? "AND st.sid > ?":null;    
        $sql = "SELECT  st.sid AS sid, st.uid AS uid, st.title AS title,  c.category AS genre, st.uid AS uid,
        CONCAT(u.lname, ' ', u.fname) AS postedBy, CONCAT(l.region, ', ', l.city) AS location
        FROM stories st INNER JOIN users u ON st.uid=u.uid 
        INNER JOIN categories c ON c.cid=st.cid INNER JOIN locations l ON u.lid=l.lid WHERE u.status>=?
        $sinceId ORDER BY st.sid DESC LIMIT ?";

        $params = $sinceId ? array($status, $lastId, $limit) : array($status, $limit);    
        $results  = $this->fetchAll($sql, $params);
        $data = array('msg' => array(), 'status' => OK);

        if ($results) 
        {
            foreach ($results as $result) 
            {
                $this->sanitizeBulk('htmlspecialchars',$result);
                $result['profile']     = '/stories/'.$result['sid'].'profile';
            }
            $next               = "/stories/?sinceId=".$results[0]['sid'];
            $pagination['next'] = $next;
            $data['msg']['extras']['pagination'] = $pagination;
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
        $sinceId = $sinceId ? "AND st.sid <:sid":null;
        $filter  = $filters ?$this->parseFilter($filters, 'st', array('lid'=>NULL)):null;

        $sql = "SELECT  st.sid AS sid, st.uid AS uid, st.title AS title,  c.category AS genre, st.uid AS uid,
        CONCAT(u.lname, ' ', u.fname) AS postedBy, CONCAT(l.region, ', ', l.city) AS location
        FROM stories st INNER JOIN users u ON st.uid=u.uid 
        INNER JOIN categories c ON c.cid=st.cid INNER JOIN locations l ON u.lid=l.lid WHERE u.status>= :status
         $filter $sinceId AND MATCH(st.title) AGAINST(:query IN BOOLEAN MODE) ORDER BY st.sid DESC LIMIT :limit";

        $params  = $sinceId ? array('status'=>$status, 'sid'=>$lastId, 'query'=>$query, 'limit'=>$limit) : array('status'=>$status, 'query'=>$query, 'limit'=>$limit);
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

    public function getStoryProfile($sid)
    {
        $status = 3;
        $sql = "SELECT  st.sid AS sid, st.uid AS uid, st.title AS title,  st.postedOn AS postedOn,
        c.category AS genre, st.uid AS uid,
        CONCAT(u.lname, ' ', u.fname) AS postedBy, CONCAT(l.region, ', ', l.city) AS location
        FROM stories st 
        INNER JOIN users u ON st.uid=u.uid 
        INNER JOIN categories c ON 
        c.cid=st.cid INNER JOIN locations l ON u.lid=l.lid WHERE u.status>=? AND st.sid=?";
     
        $params = array($status, $sid);
        $result = $this->fetch($sql, $params);
        $data = array('msg' => array(), 'status' => OK);
        if ($result) 
        {
            $this->sanitizeBulk('htmlspecialchars', $result);
            $timestamp           = strtotime($result['postedOn']);
            $result['postedOn']  = date('jS F, Y',$timestamp);
            $data['msg'] = $result;
            $data['status'] = OK;
        }
        return $data;
    }

    public function storeImg($img, $sessKey): array
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


    public function getChapter($chapName, $sinceId)
    {
        $file = file("app/uploads/stories/$chapName");
        $paraCount = 0;
        $paragraphs = ''; 
        $sinceId = $sinceId < count($file) ? $sinceId : 0;
        for ($i = $sinceId; $i < count($file); $i++) :
            $paragraphs .= $file[$i];
            if (("\n" == $file[$i]) || ("\r\n" == $file[$i])) :
                $paragraphs .= "<br><br>";
                if ((++$paraCount == 3))
                break;
            endif;
        endfor;
        ++$i;
        $data['msg']['story'] = $paragraphs;
        $data['status']       = OK;
        $data['msg']['extras']['pagination']['next'] = "/stories/1/$chapName?sinceId=$i";
        return $data;
    }

    public function createStory($data)
    {
        
        if(count($data)!=count($this->pageOne) || !$this->allIn($data, $this->pageOne))
            return $this->getResponse('invalidData');//res
        $data['uid']        = $this->getVar('activeUser','uid');
        $data['postedOn']   = date('Y-m-d');
        $columns = array_keys($data);
        $values = array_values($data);
        if(empty($chapters = $this->getVar('chapters')))
            return $this->getResponse('emptyFields');
        //get all placeholders(?) of values to be parsed
        $placeholders = parent::getInsertPlaceholders($columns);
        $sql = "INSERT INTO stories(".implode(',',$columns).") VALUES($placeholders)";
        try
        {
            $id = $this->runDml($sql, $values, true);
            $i  = 0;
            foreach($chapters as $chapter)
            {
                $oldName = "app/uploads/tmp/$chapter";
                $newName = 'app/uploads/stories/'.++$i.'mchapm'.$id.'.'.$this->getExt($chapter);
                rename($oldName, $newName);
            }
            if(!empty($cover = $this->getVar('cover')))
            {
                $oldName = "app/uploads/tmp/$cover";
                $newName = 'app/uploads/images/stories/'.'coverm'.$id.'.'.$this->getExt($cover);
                rename($oldName, $newName);
            }
        }catch(PDOException $e)
        {
             return array('msg'=>$e->getMessage(), 'status'=>200);
        }

        $this->delVar('cover');
        $this->delVar('chapters');
        return $this->getResponse('codeSent');//res
    }
   
    
   
    public function handleBook()
    {
        
    }
    
}
