<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Controllers\Web;

use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\SettingModel;
use NINA\Models\NewsModel;
use NINA\Models\StaticModel;
use NINA\Models\ExtensionsModel;
use NINA\Models\ProductListModel;
use NINA\Core\Container;

class ApiController
{
    public function token(Request $request){
        $token = csrf_token();
        echo $token;
    }
}
