<?php

/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers\Admin;

use NINA\Models\SettingModel;
use NINA\Models\OrdersModel;
use NINA\Models\PhotoModel;
use NINA\Models\UserModel;
use NINA\Core\Support\Facades\Auth;

class AllController
{
    function composer($view)
    {
        $configMan = '';
        $upload = json_decode(json_encode(config('upload')));
        $configType = json_decode(json_encode(config('type')));
        $urlSegments = explode('/', preg_replace('/^admin\//', '', request()->path()));
        $com = $urlSegments[0] ?? '';
        $act = $urlSegments[1] ?? '';
        $type = $urlSegments[2] ?? '';
        $comList = $com ? explode('-', $com) : [];
        $tb = $comList[0] ?? '';
        $kind = $comList[1] ?? '';

       
        if (!empty($tb) && !empty($type)) {
            $configMan = $configType->{$tb}->{$type} ?? [];
        }
        $photos = PhotoModel::select('photo', 'namevi', 'link', 'type')
            ->whereIn('type', ['logo', 'mangxahoi'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->get();
        $logo = $photos->where('type', 'logo')->first();
        $social = $photos->where('type', 'mangxahoi');
        if (Auth::guard('admin')->check()) {
            $permissions = Auth::guard('admin')->user()->roles()->first()->permissions()->pluck('name')->toArray();
        }
        $view->share(['upload' => $upload, 'configType' => $configType, 'com' => $com, 'act' => $act, 'type' => $type, 'kind' => $kind, 'tb' => $tb, 'configMan' => $configMan, 'logo' => $logo, 'social' => $social, 'permissions' => $permissions ?? []]);
    }
}
