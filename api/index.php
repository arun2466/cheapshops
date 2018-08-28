<?php
  $SHOW_ERROR = false;
  if( $SHOW_ERROR ){
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
  } else{
      error_reporting(0);
      ini_set('display_errors', 0);
  }

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

  echo '<pre>';
  print_r( $PARAMS );

  $API_ACTION = false;

  if( isset($PARAMS['action']) ){
    $API_ACTION = $PARAMS['action'];
  }

  echo $API_ACTION;

  die;

?>