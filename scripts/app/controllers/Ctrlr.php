<?php


abstract Class Ctrlr
{
    protected $requestBody;
    protected $queryParams;
    protected $files;
    protected $modelClass;
    protected array $success    = array('title' => 'success');
    protected array $brokenLink = array('title' => 'error', 'text' => 'Invalid link or request method');


    function __construct($data)
    {
        $this->requestBody = $data['requestBody'];
        $this->queryParams = $data['queryParams'];
        $this->files       = $data['files'];
    }


    /**
     * sends a response to client
     *
     * @param array $message response body
     * @param integer $status status code
     * @return void displays the response body
     */
    public function render(array $message, int $status=200):void
    {
        if(!empty($message['redirect'])):
            header("location: ".$message['redirect']);
            die;
        elseif (!empty($message['status'])) :
            $status = $message['status'];
            unset($message['status']);
        else :
            $status = $status;
        endif;
        $message = isset($message['msg']) ? $message['msg'] : $message;
        http_response_code($status);
        $jsonMessage = json_encode($message);
        die($jsonMessage);
    }
    // abstract function _GET($lvs);
    // abstract function _POST($lvs);
    // abstract function _PATCH();
    // abstract function _DELETE();
    
}