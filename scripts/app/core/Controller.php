<?php

abstract class Controller
{

    protected $data = array();
    protected $view = "";
	protected $head = array('title' => '', 'description' => '');
    protected $method = "";
    protected $params = "";

    private function protect($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x))
        {
            foreach($x as $k => $v)
            {
                $x[$k] = $this->protect($v);
            }
            return $x;
        }
        else
            return $x;
    }


    public function renderView()
    {
        if ($this->view)
        {

        }
    }


	public function redirect($url)
	{
		header("Location: /$url");
		header("Connection: close");
        exit;
	}


    abstract function process($params);

}
