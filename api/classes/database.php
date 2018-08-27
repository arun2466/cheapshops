<?php
  require_once '../../../connection.php';
  class Database {
    private $_connection;
    public static $_instance; //The single instance
    private $_host = "";
    private $_username = "";
    private $_password = "";
    private $_database = "";
    public $tdb = '';

    public static function getInstance() {
      if(!self::$_instance) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    public function __construct() {
      global $host;
      global $user;
      global $pass;
      global $db;
      $this->_host = $host;
      $this->_username = $user;
      $this->_password = $pass;
      $this->_database = $db;
      $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

      if(mysqli_connect_error()) {
        trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),E_USER_ERROR);
      }
    }

    public function getConnection() {
      return $this->_connection;
    }

    public static function DBescapeString( $string ){
      $db = self::getInstance();
      $mysqli = $db->getConnection();
      return mysqli_real_escape_string($mysqli, $string );
    }
    public static function DBrunQuery($query){
      $db = self::getInstance();
      $mysqli = $db->getConnection();
      return $mysqli->query($query);
    }
    public static function DBnumRows($result){  return mysqli_num_rows($result); }
    public static function DBfetchRow($result){ return mysqli_fetch_assoc($result);  }
    public static function DBfetchRows($result){
      $row_s = array();
      while($row=mysqli_fetch_assoc($result)){
          $row_s[]=$row;
      }
      return  $row_s;
    }
  }
  new Database();
?>