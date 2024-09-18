<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


return [
    'default' => env('DB_CONNECTION','mysql'),
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST','localhost'),
            'port' => env('DB_PORT','3306'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME','root1'),
            'password' => env('DB_PASSWORD',''),
            'charset' => 'utf8mb4',
            'prefix' => env('DB_PREFIX','table_')
        ]
    ],
];