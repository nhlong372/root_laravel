<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
namespace NINA\Controllers\Web;
use NINA\Core\Support\Facades\View;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Seo;
use NINA\Models\StaticModel;
use NINA\Models\PhotoModel;
use NINA\Core\Support\Facades\BreadCrumbs;
class StaticController extends Controller
{
    public function index(Request $request)
    {
        $rowDetail = StaticModel::select('namevi', 'photo', 'descvi', 'contentvi','type','id')
            ->where('type', $this->type)
            ->first();
        if($rowDetail) {
            $seoPage = $rowDetail->getSeo('static','save')->first();
            $seoPage['type'] = 'article';
            Seo::setSeoData($seoPage,'news');
        }
        switch ($this->type) {
            case 'dao-tao':
                $titleMain = "Đào tạo";
                break;
            default:
                $titleMain = __('web.gioithieu');
                break;
        }
        $this->seoPage($titleMain);
        BreadCrumbs::setBreadcrumb(type:$this->type,title: $titleMain);
        return View::share('com', $this->type)->view('static.static', ['static' => $rowDetail]);
    }
    // public function indexthuvien(Request $request)
    // {
    //     $rowDetail = PhotoModel::select('namevi', 'photo', 'link')
    //     ->where('type', $this->type)
    //     ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
    //     ->get();
    //     return View::share('com', $this->type)->view('static.album', ['rowDetail' => $rowDetail]);
    // }
}