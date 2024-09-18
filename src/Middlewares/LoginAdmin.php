<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Middlewares;

use NINA\Core\Support\Facades\Auth;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class LoginAdmin implements IMiddleware
{
    public function handle(Request $request): void
    {
    	
        if($request->getUrl()->getPath() !='/ver2/admin/user/logout/' && Auth::guard('admin')->checkRemember()) return;
        if (!Auth::guard('admin')->check() && $request->getUrl()->getPath() != substr(config('app.site_path'), 0, -1).'/admin/user/login/' && (Auth::guard('admin')->checkRemember() == false)) {
            response()->redirect(url('loginAdmin'));
        }
    }
}