<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

ini_set('memory_limit', -1);
const ROOT_PATH = __DIR__;
include_once( __DIR__ . '/vendor/autoload.php' );
$app = require __DIR__ . '/bootstrap/app.php';
$response = $app->make(NINA\Core\App::class);
$response->run();