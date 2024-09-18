<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Controllers\Admin;

use Illuminate\Http\Request;


class SlugController
{
    public function handle($com, $act, $type, Request $request)
    {
        if ($request->is('admin/*')) {
            $path = explode('/', $request->path());
            $controllerName = '\NINA\Controllers\Admin\\' . ucfirst(explode('-', $path[1])[0]) . 'Controller';
            $controller = new ($controllerName);
            if ($act == 'add') { $act = 'edit'; }
            $man = (!empty($path[1])) ? explode('-', $path[1]) : '';
            $method = $act . (!empty($man[1]) ? ucfirst($man[1]) : '');
            
            return $controller->$method($com, $act, $type, $request);
        }
    }
}
