<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
return [
    'dich-vu' => [
        'title_main' => " Dịch vụ",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => ' Dịch vụ'
        ],
        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => ["noibat" => "Nổi bật", "hienthi" => "Hiển thị"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '400',
                'height' => '450',
                'thumb' => '200x200x1'
            ],
            'attachment' => [
                'title' => 'File đại diện',
                'width' => '400',
                'height' => '450',
                'thumb' => '200x200x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'properties_json' => true,
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
        'categories' => [
            // 'list' => [
            //     'title_main_categories' => "Danh mục cấp 1",
            //     'copy_categories' => false,
            //     'images' => [
            //         'photo' => [
            //             'title' => 'Ảnh đại diện',
            //             'width' => '300',
            //             'height' => '300',
            //             'thumb' => '300x300x1'
            //         ],
            //         'icon' => [
            //             'title' => 'Ảnh đại diện',
            //             'width' => '40',
            //             'height' => '40',
            //             'thumb' => '40x40x2'
            //         ]
            //     ],
            //     'show_images_categories' => true,
            //     'slug_categories' => true,
            //     'status_categories' => ["hienthi" => "Hiển thị", "noibat" => "Nổi bật"],
            //     'gallery_categories' => [],
            //     'name_categories' => true,
            //     'desc_categories' => true,
            //     'desc_categories_cke' => false,
            //     'content_categories' => false,
            //     'content_categories_cke' => false,
            //     'seo_categories' => true,
            // ]
        ]
    ],
    // 'gioi-thieu' => [
    //     'title_main' => " Giới thiệu",
    //     'website' => [
    //         'type' => [
    //             'index' => 'object',
    //             'detail' => 'article'
    //         ],
    //         'title' => 'Giới thiệu'
    //     ],
    //     'dropdown' => false,
    //     'tags' => false,
    //     'view' => true,
    //     'copy' => false,
    //     'slug' => true,
    //     'status' => ["hienthi" => "Hiển thị"],
    //     'images' => [
    //         'photo' => [
    //             'title' => 'Ảnh đại diện',
    //             'width' => '400',
    //             'height' => '450',
    //             'thumb' => '200x200x1'
    //         ]
    //     ],
    //     'show_images' => true,
    //     'datePublish' => false,
    //     'name' => true,
    //     'desc' => true,
    //     'content' => true,
    //     'content_cke' => true,
    //     'seo' => true,
    //     'schema' => true,
    // ],
    'tin-tuc' => [
        'title_main' => " Tin tức",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'Tin tức'
        ],
        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => ["hienthi" => "Hiển thị", "noibat" => "Nổi bật"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '480',
                'height' => '400',
                'thumb' => '200x200x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
    ],
    // 'thu-vien' => [
    //     'title_main' => " Thư viện ảnh",
    //     'website' => [
    //         'type' => [
    //             'index' => 'object',
    //             'detail' => 'article'
    //         ],
    //         'title' => ' Thư viện ảnh'
    //     ],
    //     'dropdown' => false,
    //     'tags' => false,
    //     'view' => true,
    //     'copy' => false,
    //     'slug' => true,
    //     'status' => ["noibat" => "Nổi bật", "hienthi" => "Hiển thị"],
    //     'images' => [
    //         'photo' => [
    //             'title' => 'Ảnh đại diện',
    //             'width' => '600',
    //             'height' => '600',
    //             'thumb' => '200x200x1'
    //         ]
    //     ],
    //     'show_images' => true,
    //     'datePublish' => false,
    //     'name' => true,
    //     'desc' => false,
    //     'content' => true,
    //     'content_cke' => true,
    //     'seo' => true,
    //     'schema' => true,
    //     'gallery' => [
    //         'thu-vien' => [
    //             "title_main_photo" => "Hình ảnh liên quan",
    //             "title_sub_photo" => "Hình ảnh",
    //             "status_photo" => ["hienthi" => "Hiển thị"],
    //             "number_photo" => 3,
    //             "images_photo" => true,
    //             "avatar_photo" => true,
    //             "name_photo" => true,
    //             "width_photo" => 550,
    //             "height_photo" => 730,
    //             "thumb_photo" => '100x100x1'
    //         ],
    //     ]
    // ],
    'hinh-thuc-thanh-toan' => [
        'title_main' => "Hình thức thanh toán",
        'dropdown' => false,
        'list' => false,
        'tags' => false,
        'view' => false,
        'copy' => false,
        'datePublish' => false,
        'copy_image' => false,
        'comment' => false,
        'slug' => false,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => false,
        'icon' => false,
        'show_images' => false,
        'name' => true,
        'desc' => true,
        'content' => false,
        'content_cke' => false,
        'seo' => false,
        'schema' => false,
        'width' => 420,
        'height' => 288,
        'thumb' => '100x100x1',
    ]
];