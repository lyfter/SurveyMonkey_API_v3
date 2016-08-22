<?php

include('../src/SurveyMonkey.php');

$sm = new \Lyfter\SurveyMonkey('api_key', 'access_token');

echo '<pre>';
var_dump($sm->call('collectors/[id]/responses/[id]/details')); // does a call to an endpoint
echo '</pre>';
exit;