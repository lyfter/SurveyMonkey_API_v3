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

    /**
     * SurveyMonkey constructor.
     *
     * @param $apiKey
     * @param $accessToken
     */
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

    /**
     * Handles the call to Survey Monkey
     *
     * @param $endPoint
     * @param bool $cache
     * @param bool $page
     * @param bool $perPage
     * @return array
     */
    public function call($endPoint, $cache = true, $page = false, $perPage = false)
    {
        $cacheKey = $endPoint . $page . $perPage;

        $pagination = '';
        if($page !== false && $perPage !== false) {
            $pagination = '&page=' . $page . '&per_page=' . $perPage;
        }


        if($cache && !empty($this->cache[$cacheKey])) {
            return $this->cache[$cacheKey];
        }

        try {
            $url = $this->url . $endPoint . '?api_key=' . $this->apiKey . $pagination;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getRequestHeaders());
            $result = curl_exec($ch);

            curl_close($ch);
            $result = $this->parseJson($result);
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }

        if($cache) {
            $this->cache[$cacheKey] = $result;
        }

        return $result;
    }

    /**
     * Parses json to a PHP array
     *
     * @param $json
     * @return array
     */
    private function parseJson($json)
    {
        return json_decode($json);
    }

    /**
     * Calls /v3/users/me. By default caches the call
     *
     * @param bool $cache
     * @return array
     */
    public function getMe($cache = true)
    {
        $endPoint = 'users/me';

        return $this->call($endPoint, $cache);
    }


    /**
     * Calls /v3/surveys. A list of all your surveys. By default caches the call.
     *
     * @param int $page
     * @param int $perPage
     * @param bool $cache
     * @return array
     */
    public function getAllSurveys($page = 1, $perPage = 50, $cache = true)
    {
        $endPoint = 'surveys';

        return $this->call($endPoint, $cache, $page, $perPage);
    }

    /**
     * Calls /v3/surveys/[id]/collectors. A list of all the collectors related to the given survey.
     *
     * @param int $surveyId
     * @param int $page
     * @param int $perPage
     * @param bool $cache
     * @return array
     */
    public function getCollectors($surveyId, $page = 1, $perPage = 50, $cache = true)
    {
        $endPoint = 'surveys/' . (string) $surveyId . '/collectors';

        return $this->call($endPoint, $cache, $page, $perPage);
    }


    /**
     * Calls /v3/collectors/[id]/response/bulk. A list of all responses to a survey linked to one collector.
     *
     * @param int $collectorId
     * @param int $page
     * @param int $perPage
     * @param bool $cache
     * @return array
     */
    public function getSurveyResponses($collectorId, $page = 1, $perPage = 50, $cache = true)
    {
        $endPoint = 'collectors/' . (string) $collectorId . '/responses/bulk';

        return $this->call($endPoint, $cache, $page, $perPage);
    }


    /**
     * Calls /v3/collectors/[id]/responses/[id]/details. All details of a response.
     *
     * @param int $collectorId
     * @param int $responseId
     * @param bool $cache
     * @return array
     */
    public function getResponseDetails($collectorId, $responseId, $cache = true)
    {
        $endPoint = 'collectors/' . (string) $collectorId . '/responses/' . (string) $responseId . '/details';

        return $this->call($endPoint, $cache);
    }
}
