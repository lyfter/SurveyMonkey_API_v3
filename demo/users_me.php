<?php

include('../src/SurveyMonkey.php');

$sm = new \Lyfter\SurveyMonkey('kdxf5cfdrgngk3h5ava3jjy3', 'ar99uGQ4bylFvAE1HJGlEx0ft8QDtw.qKJgNLSI4jpEk.IOKpbNe2LgPfkJhdc98kBP.ajFIJ4d296hn27aqFFfbzFfptDKgTsri2E7zvbri4qpsDwwm56V-3Pv0QtMcoLpjQ8owfqcSpMNfKzlhdfhz87EUEAfxzNahpnnuMe-YMBkA5hfFCsNGLEXlPacIfAEyekUO.Vz2gyUrQV62aajGtX7ar1Tzt1vNz5FtVRI=');

echo '<pre>';
var_dump($sm->getMe());
echo '</pre>';
exit;
