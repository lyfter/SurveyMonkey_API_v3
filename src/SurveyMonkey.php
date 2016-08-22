<?php
/**
 * The main Survey Monkey class for Survey Monkey API v3.
 */
namespace Lyfter;

class SurveyMonkey
{
    /**
     * @var holds the api key of the app you are working with
     */
    private $apiKey;
    private $accessToken;
    private $url;
    private $cache = array();

    public function __construct($apiKey, $accessToken)
    {
        $this->apiKey = $apiKey;
        $this->accessToken = $accessToken;
        $this->url = 'https://api.surveymonkey.net/v3/';
    }

    /**
     * Returns a request header array string to be used in a API call
     *
     * @return array
     * @throws \Exception
     */
    private function getRequestHeaders()
    {
        if(empty($this->accessToken)) {
            throw new \Exception('No accessToken given, unable to create correct request header.');
        }

        return array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken,
        );
    }

    private function call($endpoint)
    {
        $url = $this->url . $endpoint . '?api_key=' . $this->apiKey;
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getRequestHeaders());
        $result = curl_exec($ch);
        curl_close($ch);
        return $this->parseJson($result);
    }

    /**
     * Parses json to a PHP array
     *
     * @param $json
     * @return mixed
     */
    private function parseJson($json)
    {
        return json_decode($json);
    }

    /**
     * Calls users/me. By default caches the call
     *
     * @param bool $cache
     * @return array
     */
    public function getMe($cache = true)
    {
        $endPoint = 'users/me';

        if($cache && !empty($this->cache[$endPoint])) {
            return $this->cache[$endPoint];
        }

        $result = $this->call($endPoint);

        if($cache) {
            $this->cache[$endPoint] = $result;
        }

        return $result;
    }
}
