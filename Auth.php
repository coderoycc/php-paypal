<?php
require_once('config/config.php');
class Auth{
  public static $endpoint = '/oauth2/token';
  public static function accessToken(){
    $response_data = array();
    try {
      $url = PRODUCTION ? URL.self::$endpoint : URL_SANDBOX.self::$endpoint; 
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('grant_type' => 'client_credentials')));
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Basic '.base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
      ));
      $response = curl_exec($curl);
      if(curl_errno($curl)){
        throw new \Exception("Error petición", 1);
      }
      curl_close($curl);
      $response_data = json_decode($response, true);
    } catch (\Throwable $th) {
      print_r($th);
    }
    return $response_data;
  }  
}

?>