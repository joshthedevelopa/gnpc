<?php
class TeamsCtrlr extends Team
{
    private $requestBody;
    private $queryParams;
    use Response;
    function __construct($data)
    {
        $this->requestBody = $data['requestBody'];
        $this->queryParams = $data['queryParams'];
    }

    public function processPost($id = null)
    {
        switch ($id) 
        {
            case null:
                $this->createTeam($this->requestBody);die;
        }
    }

    public function processGet($id = null)
    {
       
        if (filter_var($id, FILTER_VALIDATE_INT)) 
        {
            $result = $this->getTeam($id);
            $this->render($result);
        } 
        elseif (empty($id))
        {
            if(!empty($this->queryParams['limit']) && filter_var($this->queryParams['limit'], FILTER_VALIDATE_INT)):
                $result = $this->getTeams($this->queryParams['limit']);
                $this->render($result);
            else:
                $results = $this->getTeams();
                $this->render($results);
            endif;
        }
    }

    public function processPatch($id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT)) 
        {
               $this->render(array("pending review"), OK);
        } 
    }

    public function process($id = false)
    {
        
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        switch ($requestMethod):
            case 'POST':
                $this->processPost($id);
                break;
            case 'GET':
                $this->processGet($id);
                break;
            case 'PATCH':
                $this->processPatch($id);
                break;
        endswitch;
    }
}
