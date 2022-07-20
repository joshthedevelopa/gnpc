<?php
session_start();

require_once 'app/controllers/constants.php';
header("Content-Type: application/json");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0", false);
header("Pragma: no-cache");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Origin: X-API-KEY, origin, X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method, Access-Control-Requested-Headers, Authorization");
header("Content-Type: application/json");
// Setting internal encoding for string functions;

// $file = "/scripts/app/uploads/docs/behavorial_assessments/behavorial_assessment.pdf";

// header("Content-Type: application/octet-stream");
// header("Content-Disposition: attachment: filename= " . urlencode($file));
// header("Content-Type: application/download");
// header("Content-Description: File Transfer");
// header("Content-Length: ".filesize($file));

// flush();
// $fp = fopen($file, "w");
// while(!feof($fp))
// {
//     echo fread($fp, 65536);
//     flush();
// }
// fclose($fp);
// die;
mb_internal_encoding("UTF-8");
/**
 * Callback for autoloading controllers and models
 *
 * @param  $class
 * @return void
 */

//  print_r($_SESSION);die;
// session_unset();die;

date_default_timezone_set('Africa/Accra');
function autoloadClass(string $class)
{
	//match class name that Ends with the string "Ctrlr" 
    if (preg_match('/Ctrlr$/', $class))	
        require("app/controllers/" . $class . ".php");
    else
        require("app/models/" . $class . ".php");
}

spl_autoload_register("autoloadClass");
$requestBody = $_POST ? $_POST : json_decode(file_get_contents("php://input"), true);
//$requestBody = json_decode(file_get_contents("php://input"), true);
$requestBody = $requestBody?$requestBody:array();
$url = !empty($_GET['url'])?array_shift($_GET):null;
//print_r($_FILES);die;

//($_SERVER['REQUEST_METHOD'] != 'GET') && (empty($requestBody)) ? Response::render(INVALID_REQUEST_BODY):false;
$data = array('queryParams'=>$_GET, 'requestBody'=>$requestBody,'url'=>$url, 'requestMethod'=>$_SERVER['REQUEST_METHOD'], 'files'=>$_FILES);
$router = new RouterCtrlr($data);
$router->processUrl();

