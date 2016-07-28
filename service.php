<?php
  use Goutte\Client;
  class palabradeldia extends Service {
    public function _main(Request $request)
    {
      $response = new Response();
      $response->setResponseSubject("Palabra en Inglés del día");
      $response->createFromTemplate("basic.tpl", $this->getWord());
      return $response;
    }

    /**
     * Get the English Word of the Day from
     * Transparent
     * @link http://www.transparent.com/word-of-the-day/today/english.html
     * @return Array
     */

    private function getWord()
    {
      // create a new Client
      $client = new Client();
      $guzzle = $client->getClient();
      $client->setClient($guzzle);

      // create a Crawler
      $crawler = $client->request('GET', 'http://feeds.feedblitz.com/english-word-of-the-day-for-spanish&x=1');  
      $word = array();
      $title = $crawler->filter('item title')->text();
      $description = $crawler->filter('item description')->text();

      return array(
        'title' => $title,
        'description' => $description
      );
    }
  } 
