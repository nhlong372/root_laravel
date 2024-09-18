<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

return  [
    'product' => require "type-products.php",
    'news' => require "type-news.php",
    'photo' =>  require "type-photo.php",
    'newsletters' => require "type-newsletters.php",
    'static' => require "type-static.php",
    //'tags' => require "type-tags.php",
    'seo' => [
        'page' => [
            'trang-chu' => 'Trang chủ',
            'gioi-thieu' => 'Giới thiệu',
            // 'diem-tham-quan' => 'Điểm tham quan',
            // 'bang-gia-ve' => 'Bảng giá vé',
            'dich-vu' => 'Dịch vụ',
            'tin-tuc' => 'Tin tức',
            // 'thu-vien' => 'Thư viện',
            // 'video' => 'Video',
            'lien-he' => 'Liên hệ'
        ],
        'type' =>
        [
            'trang-chu' => 'Trang chủ',
            'gioi-thieu' => 'Giới thiệu',
            // 'diem-tham-quan' => 'Điểm tham quan',
            // 'bang-gia-ve' => 'Bảng giá vé',
            'dich-vu' => 'Dịch vụ',
            'tin-tuc' => 'Tin tức',
            // 'thu-vien' => 'Thư viện',
            // 'video' => 'Video',
            'lien-he' => 'Liên hệ'
        ],
        'width' => 300,
        'height' => 300,
        'thumb' => '300x300x1',
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '300',
                'height' => '200',
                'thumb' => '300x200x1'
            ]
        ],
    ],
    'setting' => [
        'cau-hinh' => [
            'title_main' => "Thông tin công ty",
            'address' => true,
            'phone' => true,
            'hotline' => true,
            'zalo' => true,
            'email' => true,
            'website' => true,
            'fanpage' => true,
            'coords' => true,
            'coords_iframe' => true,
            'worktime' => true,
            'link_googlemaps'  => true,
            'Firewall'  => false,
        ]//,
        // 'dieu-huong' => [
        //     'title_main' => "Điều hướng link",
        //     'old_link' => true,
        //     'new_link' => true,
        //     '302' => true
        // ]
    ],
    'extensions' => [
        'popup' => [
            'title_main' => "Popup",
            'images' => true,
            'status' => ["hienthi" => "Hiển thị", "repeat" => "Lặp lại"],
            'width' => 800,
            'height' => 500,
            'thumb' => '800x500x1',
        ],
        'hotline' => [
            'title_main' => "Điện thoại",
            'status' => ["hienthi" => "Hiển thị"],
            'images' => true,
            'width' => 35,
            'height' => 35,
            'thumb' => '35x35x1',
        ],
        'social' => [
            'title_main' => "Tiện ích",
            'status' => ["hienthi" => "Hiển thị"],
            'images' => false,
            'width' => 35,
            'height' => 35,
            'thumb' => '35x35x1',
        ],
    ],
    'users' => [
        'active' => true,
        'admin' => true,
        'member' => true,
        'permission' => true,
    ],
    'quicklink' => [
        'san-pham' => [
            'link' => ['com' => 'product', 'act' => 'add', 'type' => 'san-pham'],
            'icon' => '<i class="ti ti-package-import fs-4"></i>',
            'title' => 'Sản phẩm',
            'sub_title' => 'Thêm sản phẩm'
        ],
        'tin-tuc' => [
            'link' => ['com' => 'news', 'act' => 'add', 'type' => 'tin-tuc'],
            'icon' => '<i class="ti ti-news fs-4"></i>',
            'title' => 'Runner cần biết',
            'sub_title' => 'Thêm bài viết'
        ]
    ],
    'order' => [
        'don-hang' => [
            'title_main' => "Đơn hàng",
            'excel' => false,
            'search' => true,
        ],
    ],
    // 'comment' => [
    //     'binh-luan' => [
    //         'title_main' => "Bình luận",
    //         'status' => ["hienthi" => "Duyệt tin"],
    //     ]
    // ],
    // 'properties' => [
    //     'san-pham' => [
    //         'title_main' => "Thuộc tính",
    //         'slug' => true,
    //         'images' => true,
    //         'name' => true,
    //         'status' => ["hienthi" => "Hiển thị"],
    //         'categories' => [
    //             'list' => [
    //                 'title_main_categories' => "Danh mục cấp 1",
    //                 'slug_categories' => true,
    //                 'name_categories' => true,
    //                 'status_categories' => ["hienthi" => "Hiển thị", "search" => "Tìm kiếm", "cart" => "Giỏ hàng"],
    //             ]
    //         ]
    //     ]
    // ],
    'popupnc' => false,
    'categoriesProperties' => false, // Thêm danh mục cấp 1 cho danh mục thuộc tính
    'type_img' => 'jpg,gif,png,jpeg,gif,webp,WEBP',
    'type_file' => 'doc,docx,pdf,rar,zip,ppt,pptx,xls,xlsx',
    'type_video' => 'mp3,mp4',
];
