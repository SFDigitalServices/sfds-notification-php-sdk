<?php
namespace SFDSNotification;

class SFDSNotification{

  protected $apikey;
  protected $ch;
  protected $host = 'https://10.250.40.22';
  protected $debug = true;
  protected $version = '0.0.1';

  protected $mail_endpoint = 'api/v2/notify/email';


  public function __construct($apikey='', $options = array()){

    if(!$apikey) $apikey = getenv('SFDS_APIKEY');
    if(!$apikey) throw new Exception('You must provide an API key');
    $this->apikey = $apikey;

    $this->host = isset($options['host']) ? $options['host'] : $this->host;

    $curlOptions = isset($options['curl']) ? $options['curl'] : null;

    $this->ch = curl_init();
    curl_setopt($this->ch, CURLOPT_USERAGENT, 'SFDS-Notification-PHP/'.$this->version);
    curl_setopt($this->ch, CURLOPT_POST, true);
    curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($this->ch, CURLOPT_HEADER, false);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($this->ch, CURLOPT_TIMEOUT, 600);
    if($this->debug){
      curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    $this->host = rtrim($this->host, '/') . '/';
  }

  public function __destruct() {
    curl_close($this->ch);
  }

  public function mail($message, $endpoint=''){

    if(empty($endpoint)) $endpoint = $this->mail_endpoint;

    $ch = $this->ch;

    curl_setopt($ch, CURLOPT_URL, $this->host . $endpoint);
    curl_setopt($ch, CURLOPT_HTTPHEADER, 
      array(
        'Content-Type: application/json',
        'Accept: application/json',
        'X-DreamFactory-Api-Key: '.$this->apikey
      )
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);

    $response_body = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($this->debug){
      if($response_body === false){
        echo 'Curl error: ' . curl_error($ch);
      }else{
        if($http_status > 299 && !empty($response_body)){
          echo $response_body;
        }else{
          echo 'Operation completed without any errors';
        }    
      }
    }

    return ($http_status > 199 && $http_status < 300);
    
  }

  
}