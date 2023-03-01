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
    public $dataArray = [];

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
      $data = json_decode($response->getBody(), TRUE);
      return $data;
    }

    /**
     *  Function sets $dataArray of the class.
     * 
     *  @param object $data
     *    Json decoded object required to fetch and store data.
     */
    public function fetchContentData ($data) {
      foreach ($data['data'] as $dataEle) {
        $field_services = $dataEle['attributes']['field_services'];
        if ($field_services != NULL) {
          $title = $dataEle['attributes']['title'];
          $image_url = $dataEle['relationships']['field_image']['links']['related']['href'];
          $image_data = $this->fetchData($image_url);
          $img_src = 'https://ir-dev-d9.innoraft-sites.com' . $image_data['data']['attributes']['uri']['url'];
          $field_services_processed = $dataEle['attributes']['field_services']['processed'];
          // Add base url to href from fetched data. 
          $field_services_processed = preg_replace('/href="([^"]*)"/i', 'href="'.'https://ir-dev-d9.innoraft-sites.com'.'$1"', $field_services_processed);
          $explore_url = 'https://ir-dev-d9.innoraft-sites.com' . $dataEle['attributes']['path']['alias'];
          array_push($this->dataArray, ["title" => $title, "img_src" => $img_src,
          "field_services_processed" => $field_services_processed, "explore_url" => $explore_url]);
        }
      }
    }

  }
?>
