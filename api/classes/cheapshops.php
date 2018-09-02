<?php
  require_once 'generic.php';
  require_once 'database.php';


  class CS {
    use GENERIC;
    use DATABASE;

    public static function AUTHdoLogin( $details ){
      if( $details && $details['id'] ){
        $facebook_user_id = $name = $image = "";
        $facebook_user_id = $details['userID'];
        $name = $details['name'];
        $facebook_accessToken = $details['accessToken'];
        $checkUserExists = self::AUTHcheckUserExists( $facebook_user_id );
        if( $checkUserExists === false ){
          // add new user
          self::AUTHaddNewUser( $facebook_user_id, $name, $image );
          // get user facebook pages
          // echo '<pre>';
          // print_r($details);
          $userFacebookPages = self::AUTHgetUserFacebookPages( $facebook_accessToken );


          if( $userFacebookPages !== false ){
            foreach($userFacebookPages as $fbPage ){

              $fbPage_id = $fbPage['id'];
              $fbPage_name = $fbPage['name'];
              $fbPage_category = $fbPage['category'];

              $checkFacebookPageExists = self::AUTHcheckFacebookPageExists( $fbPage_id );
              // if( $checkFacebookPageExists === false ){
                self::AUTHaddNewFacebookPage( $facebook_user_id, $fbPage_id, $fbPage_name, $fbPage_category );
              // }

              $instagramAccount = self::AUTHgetFacebookPageInstagramAccount( $fbPage );
              if( $instagramAccount != false && isset($instagramAccount['instagram_accounts']) && isset($instagramAccount['instagram_accounts']['data']) ){
                $account = $instagramAccount['instagram_accounts']['data'][0];

                // print_r($account);

                $instagramAccount_id = $account['id'];
                $instagramAccount_username = $account['username'];

                $count_posts = $account['media_count'];
                $count_following = $account['follow_count'];
                $count_followers = $account['followed_by_count'];

                $checkInstagramPageExists = self::AUTHcheckInstagramPageExists( $instagramAccount_id );
                if( $checkInstagramPageExists === false ){
                  self::AUTHaddNewInstagramPage( $facebook_user_id, $instagramAccount_id, $instagramAccount_username );

                  self::addInstagramPageDailyStats( $instagramAccount_id, $count_posts, $count_followers, $count_following );
                }
              }

              // print_r($instagramAccount);
            }
          }
        } else {
        }


        // return user all instagram pages in
        $loggedUserData = self::getLoggedUserData( $facebook_user_id );


        // print_r($lo)

        $return = array();
        $return['status'] = true;
        $return['data'] = $loggedUserData;
        return $return;
      }
    }

    public static function getLoggedUserData( $facebook_user_id ){
      $q = "SELECT
        users.*
        FROM
        users
        WHERE
        facebook_user_id='$facebook_user_id'";
      $run = self::DBrunQuery($q);
      $rows = self::DBfetchRows($run);

      $userFacebookPages = self::getUserFacebookPages( $facebook_user_id );
      $userInstagramPages = self::getUserInstagramPages( $facebook_user_id );

      $ret = array(
        'user' => $rows,
        'facebook_pages' => $userFacebookPages,
        'instagram_pages' => $userInstagramPages
      );

      return $ret;
    }


    public static function getUserFacebookPages ( $facebook_user_id ){
      $ret = array();
      $q = "SELECT
        user_facebook_pages.*,
        facebook_pages.*
        FROM
        user_facebook_pages
        LEFT JOIN facebook_pages ON user_facebook_pages.facebook_page_id = facebook_pages.facebook_page_id
        WHERE
        facebook_user_id='$facebook_user_id'";
      $run = self::DBrunQuery($q);
      $rows = self::DBfetchRows($run);
      return $rows;
    }

    public static function getUserInstagramPages ( $facebook_user_id ){
      $ret = array();
      $q = "SELECT
        user_instagram_pages.*,
        instagram_pages.*
        FROM
        user_instagram_pages
        LEFT JOIN instagram_pages ON user_instagram_pages.instagram_page_id = instagram_pages.instagram_page_id
        WHERE
        facebook_user_id='$facebook_user_id'";
      $run = self::DBrunQuery($q);
      $rows = self::DBfetchRows($run);
      return $rows;
    }


    // user
    public static function AUTHcheckUserExists( $facebook_user_id ){
      $query = "SELECT * FROM users WHERE facebook_user_id='$facebook_user_id'";
      $run = self::DBrunQuery($query);
      $rows = self::DBfetchRows($run);
      if( sizeof($rows) > 0 ){
        return $rows[0];
      } else {
        return false;
      }
      return false;
    }

    public static function AUTHaddNewUser( $facebook_user_id, $name, $image ){
      $query = "INSERT INTO users (facebook_user_id, name, image) VALUES ('$facebook_user_id', '$name', '$image')";
      self::DBrunQuery($query);
    }

    // facebook page
    public static function AUTHcheckFacebookPageExists( $facebook_page_id ){
      $query = "SELECT * FROM facebook_pages WHERE facebook_page_id='$facebook_page_id'";
      $run = self::DBrunQuery($query);
      $rows = self::DBfetchRows($run);
      if( sizeof($rows) > 0 ){
        return $rows[0];
      } else {
        return false;
      }
    }

    public static function AUTHaddNewFacebookPage( $facebook_user_id = false, $FB_page_id, $FB_page_name, $FB_page_category ){
      $query = "INSERT INTO facebook_pages ( facebook_page_id, name, category) VALUES ('$FB_page_id', '$FB_page_name', '$FB_page_category')";
      self::DBrunQuery($query);
      if( $facebook_user_id ){
        $q1 = "SELECT * FROM user_facebook_pages WHERE facebook_user_id='$facebook_user_id' AND facebook_page_id='$FB_page_id'";
        $run = self::DBrunQuery($q1);
        $rows = self::DBfetchRows($run);
        if( sizeof($rows) > 0 ){

        } else {
          $q2 = "INSERT INTO user_facebook_pages ( facebook_user_id, facebook_page_id) VALUES ('$facebook_user_id', '$FB_page_id')";
          self::DBrunQuery($q2);
        }
      }
    }

    // instagram page
    public static function AUTHcheckInstagramPageExists( $instagramAccount_id ){
      $query = "SELECT * FROM instagram_pages WHERE instagram_page_id ='$instagramAccount_id'";
      $run = self::DBrunQuery($query);
      $rows = self::DBfetchRows($run);
      if( sizeof($rows) > 0 ){
        return $rows[0];
      } else {
        return false;
      }
    }

    public static function AUTHaddNewInstagramPage( $facebook_user_id = false, $instagram_page_id, $instagram_username ){
      $query = "INSERT INTO instagram_pages ( instagram_page_id, username) VALUES ('$instagram_page_id', '$instagram_username')";
      self::DBrunQuery($query);
      if( $facebook_user_id ){
        $q1 = "SELECT * FROM user_instagram_pages WHERE facebook_user_id='$facebook_user_id' AND instagram_page_id='$instagram_page_id'";
        $run = self::DBrunQuery($q1);
        $rows = self::DBfetchRows($run);
        if( sizeof($rows) > 0 ){

        } else {
          $q2 = "INSERT INTO user_instagram_pages ( facebook_user_id, instagram_page_id) VALUES ('$facebook_user_id', '$instagram_page_id')";
          self::DBrunQuery($q2);
        }
      }
    }


    public static function AUTHgetUserFacebookPages( $token ){
      $return = false;
      $url = "https://graph.facebook.com/v3.1/me/accounts?access_token=$token";
      $html = self::GENERICgetHTML( $url );
      $pages = json_decode($html,true);
      if( isset($pages['data']) ){
        $return = $pages['data'];
      }
      return $return;
    }

    public static function AUTHgetFacebookPageInstagramAccount( $facebookPage ){
      $return = false;
      if( isset($facebookPage['id']) && isset($facebookPage['access_token'])){
        $id = $facebookPage['id'];
        $accessToken = $facebookPage['access_token'];
        $url = "https://graph.facebook.com/v3.1/$id?fields=instagram_business_account,instagram_accounts{media_count,username,follow_count,followed_by_count}&access_token=$accessToken";
        $html = self::GENERICgetHTML( $url );
        $return = json_decode($html,true);
      }
      return $return;
    }

    public static function addInstagramPageDailyStats( $instagram_page_id, $count_posts, $count_followers, $count_following ){
      $query = "INSERT INTO instagaram_pages_daily_stats
        ( instagram_page_id, count_posts, count_followers, count_following)
        VALUES
        ('$instagram_page_id', $count_posts, $count_followers, $count_following)";

      echo $query;

      self::DBrunQuery($query);
    }


  }

  // new CS();

?>