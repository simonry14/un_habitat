<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
               
$app = new Slim\App(['settings' => ['displayErrorDetails' => true]]);   

define("DB_NAME", "un_habitat");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_HOST", "localhost");

require_once 'database.php';


$app->get('/projects/all', function ($request, $response, $args) {
$model = new database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
     echo $model->get_all_projects();
});

$app->get('/projects/country/[{country_name}]', function ($request, $response, $args) {
$model = new DbModel(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      echo $model->get_all_projects_from_country($args['country_name']);  
});

$app->get('/projects/Approval Status/[{status}]', function ($request, $response, $args) {
$model = new DbModel(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      echo $model->get_all_projects_for_approval_status($args['status']);	  
});


$response = $app->run(true); //Silent mode, wont send the response
$response = $response->withoutHeader("Content-Length"); //Remove the Content-Length

$app->respond($response); //Now we send the response

?>