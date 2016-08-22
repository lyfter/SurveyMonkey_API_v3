<?php

include('../src/SurveyMonkey.php');

$sm = new \Lyfter\SurveyMonkey('api_key', 'access_token');

echo '<pre>';
$collectodId = 1; // the id of the collector
$responseId = 1; // the id of the response
var_dump($sm->getResponseDetails($collectodId, $responseId)); // details of response
var_dump($sm->getResponseDetails($collectodId, $responseId, false)); // details of response, not cached
echo '</pre>';
exit;
