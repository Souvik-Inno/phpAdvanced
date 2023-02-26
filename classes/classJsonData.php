<?php

  /**
   *  @file contains class JsonData.
   *  GuzzleHttp package is loaded for fetching data from url. 
   */
  require 'vendor/autoload.php';
  use GuzzleHttp\Client;

  /**
   *  Class JsonData for fetching and storing content from url.
   */
  class JsonData {

    /**
     *  @var array $dataArray
     *    Stores data retrieved from Json in form of array elements.
     */
    public $dataArray = array();

    /**
     *  Function fetches data from the url.
     * 
     *  @param string $url
     *    Url required to fetch data.
     * 
     *  @return object
     *    Returns Object fetched from decoded Json.
     */
    public function fetchData ($url) {
      $client = new Client();
      $response = $client->get($url);
      $data = json_decode($response->getBody(), true);
      return $data;
    }

    /**
     *  Function sets $dataArray of the class.
     * 
     *  @param object $data
     *    Json decoded object required to fetch and store data.
     */
    public function fetchContentData ($data) {
      for ($i = 0; $i < 16; $i++) {
        $field_services = $data['data'][$i]['attributes']['field_services'];
        if ($field_services != NULL) {
          $title = $data['data'][$i]['attributes']['title'];
          
          $image_url = $data['data'][$i]['relationships']['field_image']['links']['related']['href'];
          $image_data = $this->fetchData($image_url);
          $img_src = 'https://ir-dev-d9.innoraft-sites.com' . $image_data['data']['attributes']['uri']['url'];
          
          $field_services_processed = $data['data'][$i]['attributes']['field_services']['processed'];
          
          $explore_url = $data['data'][$i]['attributes']['path']['alias'];
          
          $this->dataArray += array($i => [$title, $img_src, $field_services_processed, $explore_url]);
        }
      }
    }

  }
?>
