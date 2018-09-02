<?php

  trait GENERIC {

    public static function GENERICgetHTML( $url ){
      $timeout = 10;
      $ch = curl_init($url); // initialize curl with given url
      curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
      curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
      $html = @curl_exec($ch);
      return $html;
    }

  }

?>