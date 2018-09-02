<?php
  $SHOW_ERROR = true;

    $DB_host = "localhost";
    $DB_username = "root";
    $DB_password = "arun";
    $DB_database = "cheapshops";


  if( $SHOW_ERROR ){
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
  } else{
      error_reporting(0);
      ini_set('display_errors', 0);
  }

  require_once './classes/cheapshops.php';

  header("Access-Control-Allow-Origin: *");
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])){
      header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
    exit(0);
  }

  $request_body = file_get_contents('php://input');
  $PARAMS = json_decode($request_body, true);

  // echo '<pre>';
  // print_r( $PARAMS );

  $API_ACTION = false;

  if( isset($PARAMS['action']) ){
    $API_ACTION = $PARAMS['action'];
  }

  // echo '<pre>';

  // echo $API_ACTION;

  if( $API_ACTION === 'login' ){
    $response = CS::AUTHdoLogin($PARAMS['payload']);
  }

  echo json_encode($response);

?>