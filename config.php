<?php

date_default_timezone_set('America/Los_Angeles');
define('ABSPATH', dirname(__FILE__));
define('MPDF_PATH', ABSPATH . '/frameworks/mpdf/');
define('FRAMEWORKS', ABSPATH . '/frameworks/');
define('FILES', ABSPATH . '/views/_files');
define('TEMP', ABSPATH . '/views/_files/tmp/');
define('HASH', '0e0426281a6277e1');
define('SITE_NAME', 'Roam Atvo');
define('UP_ABSPATH', ABSPATH . '/views/_uploads');
define('HOME_URI', 'https://www.roamatvo.com');
define('HOSTNAME', 'localhost');
define('DB_NAME', 'roam_system');
define('DB_USER', 'roam_webdim');
define('DB_PASSWORD', 'Zgzr19yh@');
define('DEBUG', false);
define('LOADER', false);

require_once ABSPATH . '/loader.php';
?>

