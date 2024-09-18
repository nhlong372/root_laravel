<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
/* update: 1-8-2024 */
return [
    'timezone' => env('APP_TIMEZONE'),
    'site_path' => env('SITE_PATH'),
    'asset' => env('APP_URL'),
    'admin' => env('APP_URL') . "admin/",
    "token" => md5(env('MSHD')),
    "author" => env('AUTHOR'),
    "environment" =>env('ENVIRONMENT','dev'),
    "mobile"=>env('MOBILE','false'),
    'random_key' => '2220ae33712873f090ca0c27bf566e0d',
    'recaptcha' => [
        'active' => env('GG_RECAPTCHA',false),
        'urlapi' => env('GG_URLAPI'),
        'sitekey' => env('GG_SITEKEY'),
        'secretkey' => env('GG_SECRETKEY')
    ],
    'langs' => [
        "vi" => 'Tiếng Việt'
    ],
    'slugs' => [
        "vi" => 'Tiếng Việt'
    ],
    'lang_default' => env('LANG_DEFAULT','vi'),
    'seo_default' => env('LANG_SEO_DEFAULT','vi'),
    'langconfig' => env('LANG_CONFIG','session'),
    'cache_file' => env('CACHE_HTML',false),
    'cache_pages_time' => env('CACHE_HTML_TIME',10),
    'nocache' => [],
    'web_prefix'=>substr(env('SITE_PATH'), 0, -1).((env('LANG_CONFIG')=='link')?'/{language}':''),
    'admin_prefix'=>(env('SITE_PATH').'admin'),
    'aliases' => [
        "Email" => \NINA\Core\Support\Facades\Email::class,
        "Comment" => \NINA\Core\Support\Facades\Comment::class,
        "Cart" => \NINA\Facade\Cart::class
    ],
    'providers' => [
        \NINA\Providers\EmailServiceProvider::class,
        \NINA\Providers\CommentServiceProvider::class,
        \NINA\Cart\CartServiceProvider::class
    ]
];
