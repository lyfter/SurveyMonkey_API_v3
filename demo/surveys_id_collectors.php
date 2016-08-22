<?php

include('../src/SurveyMonkey.php');

$sm = new \Lyfter\SurveyMonkey('api_key', 'access_token');

echo '<pre>';
var_dump($sm->getCollectors([id_of_survey]));
echo '</pre>';
exit;
