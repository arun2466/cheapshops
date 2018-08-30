<?php

  trait AUTH {

    public static function doLogin( $details ){
      if( $details && $details['id'] ){
        $facebook_user_id = $name = $image = "";
        $facebook_user_id = $details['userID'];
        $name = $details['name'];

        $checkUserExists = self::checkUserExists( $facebook_user_id );

        if( $checkUserExists === false ){
          echo "new user";
          self::addNewUser( $facebook_user_id, $name, $image );


        } else {
          echo "existin user";
        }







      }
    }

    public static function checkUserExists( $facebook_user_id ){
      $query = "SELECT * FROM users WHERE facebook_user_id='$facebook_user_id'";

      $run = self::DBrunQuery($query);
      $rows = self::DBfetchRows($run);
      if( sizeof($rows) > 0 ){
        return $rows[0];
      } else {
        return false;
      }
    }

    public static function addNewUser( $facebook_user_id, $name, $image ){
      $query = "INSERT INTO users (facebook_user_id, name, image) VALUES ('$facebook_user_id', '$name', '$image')";
      self::DBrunQuery($query);
    }

  }

?>