<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
namespace NINA\Controllers\Web;
use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\SettingModel;
use NINA\Models\NewsModel;
use NINA\Models\StaticModel;
use NINA\Models\ExtensionsModel;
use NINA\Models\ProductListModel;
use NINA\Models\ProductCatModel;
use NINA\Core\Container;
class AllController extends Controller
{
    function composer($view): void
    {
        $extHotline = '';
        $photos = PhotoModel::select('photo', 'namevi', 'link', 'type')
            ->whereIn('type', ['logo', 'banner', 'favicon', 'mangxahoi', 'mangxahoi1', 'social'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->get();
        $logoPhoto = $photos->where('type', 'logo')->first();
        $bannerPhoto = $photos->where('type', 'banner')->first();
        $favicon = $photos->where('type', 'favicon')->first();
        $social = $photos->where('type', 'social');
        $social1 = $photos->where('type', 'mangxahoi1');
        $bannerTop = PhotoModel::select('namevi', 'photo', 'link')
            ->where('type', 'banner-top')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->get();
        $listProductMenu = ProductListModel::select('namevi', 'photo', 'slugvi', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();
        $catProductMenu = ProductCatModel::select('namevi', 'photo', 'slugvi', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['menu'])
            ->orderBy('numb', 'asc')
            ->get();
        $footer = StaticModel::select('namevi', 'contentvi', 'descvi', 'slugvi')
            ->where('type', 'footer')
            ->first();
        $extHotline = ExtensionsModel::select('*')
            ->where('type', 'hotline')
            ->first();
        $extSocial = ExtensionsModel::select('*')
            ->where('type', 'social')
            ->first();
        $chinhsach = \NINA\Models\NewsModel::select('namevi', 'nameen', 'slugvi')
            ->where('type', 'chinh-sach')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->get();
        $setting = SettingModel::first();
        $optSetting = json_decode($setting['options'], true);
        $configType = json_decode(json_encode(config('type')));
        $upload = json_decode(json_encode(config('upload')));
        $lang = session()->get('locale');
        $view->share(compact(
            'configType',
            'upload',
            'logoPhoto',
            'bannerPhoto',
            'social1',
            'favicon',
            'setting',
            'optSetting',
            'listProductMenu',
            'catProductMenu',
            'social',
            'footer',
            'extHotline',
            'extSocial',
            'chinhsach',
            'lang',
            'bannerTop'
        ));
    }
}