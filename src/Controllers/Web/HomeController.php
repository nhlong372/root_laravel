<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
namespace NINA\Controllers\Web;
use Carbon\Carbon;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\NewsModel;
use NINA\Models\ProductModel;
use NINA\Models\ProductListModel;
use NINA\Models\SettingModel;
use NINA\Models\StaticModel;
use NINA\Models\ProductCatModel;
use NINA\Models\TagsModel;
use NINA\Models\NewslettersModel;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $com = '';
        $slider = PhotoModel::select('namevi', 'photo', 'link')
            ->where('type', 'slide')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->get();
        $chungnhan = PhotoModel::select('namevi', 'photo', 'link')
            ->where('type', 'chung-nhan')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->get();
        $thuviennb = PhotoModel::select('namevi', 'photo', 'link')
            ->where('type', 'thu-vien')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->limit(6)
            ->get();
        $bannerSale = PhotoModel::select('photo', 'namevi', 'link', 'type')
            ->whereIn('type', ['banner-visao'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->first();
        $bannerNB = PhotoModel::select('photo', 'namevi', 'link', 'type')
            ->whereIn('type', ['banner-noi-bat'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->first();
        $Visao = NewsModel::select('namevi', 'photo', 'descvi', 'slugvi', 'descvi')
            ->where('type', 'vi-sao')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'desc')
            ->limit(4)
            ->get();
        $Quytrinh = NewsModel::select('namevi', 'photo', 'descvi', 'slugvi', 'descvi')
            ->where('type', 'quy-trinh')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'desc')
            ->limit(6)
            ->get();
        $GocBepNB = NewsModel::select('namevi', 'photo', 'descvi', 'slugvi', 'descvi','created_at')
            ->where('type', 'tin-tuc')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
            ->orderBy('numb', 'desc')
            ->limit(16)
            ->get();
        $productNB = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'sale_price', 'discount', 'id')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
            ->orderBy('id', 'desc')
            ->get();
        $productSale = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'sale_price', 'discount', 'id')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['flashsale'])
            ->orderBy('id', 'desc')
            ->get();
        $productWeek = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'sale_price', 'discount', 'id')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['weeks'])
            ->orderBy('id', 'desc')
            ->get();
        $listProductNB = ProductListModel::select('namevi', 'photo', 'id', 'slugvi')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
            ->orderBy('id', 'desc')
            ->get();
        $catNB = ProductCatModel::select('namevi', 'photo', 'slugvi', 'type', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
            ->orderBy('numb', 'asc')
            ->get();
        $gioithieu = StaticModel::select('namevi', 'nameen', 'descvi', 'descen','photo')
            ->where('type', 'gioi-thieu')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();
        $slogan = StaticModel::select('namevi', 'descvi')
            ->where('type', 'slogan')
            ->first();
        /* SEO */
        $titleMain = SettingModel::pluck('namevi')->first();
        $this->seoPage($titleMain);
        return view('home.index', compact('com','slider','productNB', 'productSale', 'listProductNB', 'Visao', 'bannerSale', 'bannerNB', 'gioithieu', 'productWeek', 'catNB', 'GocBepNB','slogan','Quytrinh','chungnhan','thuviennb'));
    }
    public function ajaxProduct(Request $request)
    {
        $id = $request->get('id') ?? 0;
        $type = $request->get('type') ?? 0;
        $query = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price', 'sale_price', 'discount', 'id')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat']);
        if (!empty($type) && $type == 'cat')  {
            $query->where('id_cat', $id);
            $productAjax = $query->orderBy('id', 'desc')->get();
        }
        if (!empty($type) && $type == 'goi-y-hom-nay')  {
            $rows = TagsModel::select('namevi', 'descvi', 'type', 'id')
            ->where('id', $id)
            ->first();
            $productAjax = $rows->products()->get();
        }
        return view('ajax.homeProduct', ['productAjax' => $productAjax]);
    }
    public function letter(Request $request) {
        $error = array();
        //$data = $request->all();
        $data['fullname'] = $request->input('ten-newsletter')??'';
        $data['address'] = $request->input('diachi-newsletter')??'';
        $data['email'] = $request->input('email-newsletter')??'';
        $data['phone'] = $request->input('dienthoai-newsletter')??'';
        $data['content'] = $request->input('noidung-newsletter')??'';
        $data['date_created'] = Carbon::now()->timestamp;
        $data['confirm_status'] = 1;
        $data['type'] = 'dang-ky-nhan-tin';
        $data['subject'] = "Đăng ký nhận tin";
        if(NewslettersModel::create($data)){
            transfer('Đăng ký nhận tin thành công !',1,PeceeRequest()->getHeader('http_referer'));
        }else{
            transfer('Đăng ký nhận tin thất bại !',0,PeceeRequest()->getHeader('http_referer'));
        }
    }
    public function ajaxProductNoibat(Request $request)
    {
        $per_page = $request->get('per_page')??4;
        $query = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price','sale_price','discount','id')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat']);  
        $productAjax = $query->orderBy('id', 'desc')->paginate($per_page);
        return view('ajax.homeProduct', ['productAjax' => $productAjax]);
    }
    public function ajaxProductListTab($id_list,Request $request)
    {        
        $ShowViewMore = false;
        $idlist = $id_list??0;
        $per_page = $request->get('per_page')??4;
        if($idlist) {
            $productAjax = ProductModel::select('namevi', 'nameen', 'descen', 'photo', 'descvi', 'slugvi', 'regular_price','sale_price','discount','id')
                ->where('type','san-pham')
                ->where('id_list',$idlist)           
                ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
                ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
                ->orderBy('numb', 'asc')
                ->paginate($per_page);
        }
        else {
            $productAjax = ProductModel::select('namevi', 'nameen', 'descen', 'photo', 'descvi', 'slugvi', 'regular_price','sale_price','discount','id')
                ->where('type','san-pham')
                ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
                ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
                ->orderBy('numb', 'asc')
                ->paginate($per_page);
        }
        return view('ajax.homeProduct', ['productAjax' => $productAjax]);
    }
    public function ajaxProductList($id_list,Request $request)
    {        
        $ShowViewMore = false;
        $idlist = $id_list??0;
        $per_page = $request->get('per_page')??4;
        $productAjax = ProductModel::select('namevi', 'nameen', 'descen', 'photo', 'descvi', 'slugvi', 'regular_price','sale_price','discount','id')
                ->where('type','san-pham')
                ->where('id_list',$idlist)            
                ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
                ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
                ->orderBy('numb', 'asc')
                ->paginate($per_page);
        return view('ajax.homeProduct', ['productAjax' => $productAjax]);
    }
    public function ajaxProductListCat($id_list,Request $request)
    {        
        $ShowViewMore = false;
        $idlist = $id_list??0;
        $per_page = $request->get('per_page')??4;
        $id_cat = $request->get('id_cat')??0;
        $query = ProductModel::select('namevi', 'photo', 'descvi', 'slugvi', 'regular_price','sale_price','discount','id')
                ->where('type','san-pham')
                ->where('id_list',$idlist)            
                ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
                ->whereRaw("FIND_IN_SET(?,status)", ['noibat']);
        if($id_cat!=0) $query->where('id_cat',$id_cat);
        $productAjax = $query->orderBy('numb', 'asc')->orderBy('id', 'desc')->paginate($per_page);
        // $query->orderBy('numb', 'asc')->orderBy('id', 'desc')->toSql();
        // echo "<pre>";
        // print_r($query->toSql());
        // print_r($query->getBindings());
        // echo "</pre>";
        return view('ajax.homeProduct', ['productAjax' => $productAjax]);
    }
    public function ajaxProductTab($id_tab,Request $request)
    {        
        $ShowViewMore = false;
        $id_tab = $id_tab??0;
        if($id_tab==0) return false;
        $per_page = $request->get('per_page')??4;
        $productAjax = ProductModel::select('namevi', 'nameen', 'descen', 'photo', 'descvi', 'slugvi', 'regular_price','sale_price','discount','id')
                ->where('type','san-pham')
                ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
                ->whereRaw("FIND_IN_SET(?,status)", [$id_tab])
                ->orderBy('numb', 'asc')
                ->paginate($per_page);
        // $query = ProductModel::select('namevi', 'nameen', 'descen', 'photo', 'descvi', 'slugvi', 'regular_price','sale_price','discount','id')
        //         ->where('type','san-pham')
        //         ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
        //         ->whereRaw("FIND_IN_SET(?,status)", [$id_tab])
        //         ->orderBy('numb', 'asc');
        // echo "<pre>";
        // print_r($query->toSql());
        // print_r($query->getBindings());
        // echo "</pre>";
        return view('ajax.homeProduct', ['productAjax' => $productAjax]);
    }
}