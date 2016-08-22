<?php

include('../src/SurveyMonkey.php');

$sm = new \Lyfter\SurveyMonkey('api_key', 'access_token');

echo '<pre>';
$id = 1; // collector id here
var_dump($sm->getSurveyResponses($id)); // no paging, by default page one, with page length 50
var_dump($sm->getSurveyResponses($id, 1, 2)); // first page of pages with a length of 2
var_dump($sm->getSurveyResponses($id, 2, 2)); // second page of pages with a length of 2
var_dump($sm->getSurveyResponses($id, 2, 2, false)); // second page of pages with a length of 2, disables the cache
echo '</pre>';
exit;
