<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

return [
    'gioi-thieu' => [
        'title_main' => "Giới thiệu",
        'website' => [
            'type' => 'object',
            'title' => 'gioithieu'
        ],
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            'photo' => [
                'title' =>  'Hình ảnh',
                'width' => '585',
                'height' => '470',
                'thumb' => '300x300x1'
            ]
        ],
        'name' => true,
        'desc' => true,
        'desc_cke' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
    ],
    'lienhe' => [
        'title_main' => "Liên hệ",
        'website' => [
            'title' => 'lienhe'
        ],
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            // 'photo' => [
            //     'title' =>  'Hình ảnh',
            //     'width' => '300',
            //     'height' => '300',
            //     'thumb' => '300x300x1'
            // ]
        ],
        'name' => false,
        'content' => true,
        'content_cke' => true,
    ],
    'footer' => [
        'title_main' => "Footer",
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            // 'photo' => [
            //     'title' =>  'Hình ảnh',
            //     'width' => '300',
            //     'height' => '300',
            //     'thumb' => '300x300x1'
            // ]
        ],
        'desc' => false,
        'content' => true,
        'content_cke' => true,
    ]
    ,
    'slogan' => [
        'title_main' => "Slogan chung",
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'desc' => true,
        'desc_cke' => false,
    ]
];
