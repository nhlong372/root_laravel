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
use NINA\Cart\Model\CartModel;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Auth;
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\Email;
use NINA\Facade\Cart;
use NINA\Models\NewsModel;
use NINA\Models\Place\CityModel;
use NINA\Models\Place\DistrictModel;
use NINA\Models\Place\WardModel;
use NINA\Models\ProductModel;
use NINA\Models\ProductPropertiesModel;
use Validator;
use Flash;
class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        \Seo::set('title', 'Giỏ hàng');
        \Seo::set('meta', 'noindex,nofollow');
    }
    public function handle($action, Request $request): void
    {
        match ($action) {
            'popup-cart' => $this->popupCart($request),
            'add-to-cart' => $this->addCart($request),
            'update-to-number' => $this->updateCart($request),
            'delete-to-cart' => $this->deleteCart($request),
            'delete-all-cart' => $this->deleteAllCart(),
            'get-district' => $this->getDistrict($request),
            'get-ward' => $this->getWard($request),
            'send-to-cart' => $this->saveCart($request),
            'show-price' => $this->showPrice($request),
            default => 'unknown',
        };
    }
    protected function popupCart($request): void { ?>
        <?php if(Cart::count() > 0) { ?>
        <div class="top-cart">
            <?php /*
            <p class="title-cart">Giỏ hàng của bạn:</p>
            */ ?>
            <div class="list-procart form-cart">
                <div class="procart procart-label d-flex align-items-start justify-content-between">
                    <div class="pic-procart ">Hình ảnh</div>
                    <div class="info-procart ">Tên sản phẩm</div>
                    <div class="quantity-procart ">
                        <p>Số lượng</p>
                        <p>Thành tiền</p>
                    </div>
                    <div class="price-procart">Tổng tiền</div>
                </div>
                <?php foreach(Cart::content() as $k => $v) {
                        $color = $v->options->color ?? '';
                        $size = $v->options->size ?? '';
                        $code = $v->options->code ?? '';
                        $proInfo = $v->options->itemProduct;
                        $pro_price =$proInfo->regular_price;
                        $pro_price_new =$proInfo->sale_price;
                        $pro_price_qty = $pro_price * $v->qty;
                        $pro_price_new_qty = $pro_price_new * $v->qty; ?>
                    <div class="procart flex items-start justify-between procart-<?= $v->rowId ?>">
                        <div class="pic-procart">
                            <a class="text-decoration-none" href="<?= url('slugweb',['slug'=>$proInfo->slugvi]) ?>" target="_blank" title="<?= $proInfo->namevi ?>">
                                <img src="<?= assets_photo('product','100x100x1',$proInfo->photo,'thumbs') ?>" alt="<?= $proInfo->namevi ?>" />
                            </a>
                            <a class="del-procart text-decoration-none" data-rowId="<?=$v->rowId?>">
                                <i class="fa fa-times-circle"></i>
                                <span>Xóa</span>
                            </a>
                        </div>
                        <div class="info-procart">
                            <h3 class="name-procart"><a class="text-decoration-none" href="<?= url('slugweb',['slug'=>$proInfo->slugvi]) ?>" target="_blank" title="<?= $proInfo->namevi ?>"><?= $proInfo->namevi ?></a></h3>
                            <?php if(!empty($v->options->properties->toArray())) { ?>
                                <div class="properties-procart">
                                    <?php foreach($v->options->properties as $kp => $vp) { ?>
                                    <p><?=$vp->namevi?></p> <br/>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="quantity-procart">
                            <div class="price-procart price-procart-rp">
                                <?php if(!empty($proInfo->sale_price)) { ?>
                                    <p class="price-new-cart load-price-new-<?= $v->rowId ?>"><?= Func::formatMoney((float)$pro_price_new_qty) ?></p>
                                    <p class="price-old-cart load-price-<?= $v->rowId ?>"><?= Func::formatMoney((float)$pro_price_qty) ?></p>
                                <?php } else { ?>
                                    <p class="price-new-cart load-price-<?= $v->rowId ?>"><?= Func::formatMoney((float)$pro_price_qty) ?></p>
                                <?php } ?>
                            </div>
                            <div class="quantity-counter-procart quantity-counter-procart-<?= $v->rowId ?> flex items-stretch justify-between">
                                <span class="counter-procart-minus counter-procart">-</span>
                                <input type="text" readonly class="quantity-procat" min="1" value="<?= $v->qty ?>"  data-pid="<?= $v->id ?>" data-rowId="<?= $v->rowId ?>" />
                                <span  class="counter-procart-plus counter-procart">+</span>
                            </div>
                        </div>
                        <div class="price-procart">
                            <?php if(!empty($proInfo->sale_price)) { ?>
                                <p class="price-new-cart load-price-new-<?= $v->rowId ?>"><?= Func::formatMoney((float)$pro_price_new_qty) ?></p>
                                <p class="price-old-cart load-price-<?= $v->rowId ?>"><?= Func::formatMoney((float)$pro_price_qty) ?></p>
                            <?php } else { ?>
                                <p class="price-new-cart load-price-<?= $v->rowId ?>"><?= Func::formatMoney((float)$pro_price_qty) ?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="money-procart">
                <div class="total-procart flex items-center justify-between">
                    <p>Tổng tiền:</p>
                    <p class="total-price load-price-total"><?= Func::formatMoney(Cart::subtotalFloat()) ?></p>
                </div>
            </div>
        </div>
        <?php }
    }
    protected function deleteAllCart()
    {
        Cart::destroy();
        transfer('Giỏ hàng của bạn đã được xóa thành công !', 1, url('home'));
    }
    protected function showPrice($request): void
    {   
        $id_product = $request->id_product;
        $id_properties = $request->id_properties;
        $row = ProductPropertiesModel::select(['regular_price', 'sale_price'])->where('id_parent', $id_product)->where('id_properties', $id_properties)->first();
        response()->json(['priceNew' => Func::formatMoney($row['sale_price']),'priceOld' => Func::formatMoney($row['regular_price'])]);
    }
    protected function getDistrict($request): void
    {
        $districts = DistrictModel::select(['id', 'name'])->where('id_city', $request->id)->get()->toArray();
        response()->json(['districts' => $districts]);
    }
    protected function getWard($request): void
    {
        $wards = WardModel::select(['id', 'name'])->where('id_district', $request->id)->get()->toArray();
        response()->json(['wards' => $wards]);
    }
    public function showcart(Request $request)
    {
        $httt = NewsModel::where('type', 'hinh-thuc-thanh-toan')->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])->orderBy('id', 'desc')->get();
        $city = CityModel::all();
        $com='gio-hang';
        return view('giohang.index', compact('httt', 'city','com'));
    }
    public function getPaymentName($cols = '', $table = '', $id = 0)
    {
        $row = array();
        if (!empty($cols) && !empty($table) && !empty($id)) {
            $row = \NINA\Models\NewsModel::select('namevi')
            ->where('id', $id)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();
        }
        return $row;
    }
    public function getProductInfo($pid = 0)
    {
        $row = null;
        if ($pid) {
            $row = \NINA\Models\ProductModel::select('*')
            ->where('id', $pid)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();
        }
        return $row;
    }
    public function saveCart(Request $request)
    {
        $isMemberCheck = 0;
        if ($isMemberCheck) $idMember = Auth::guard('web')->user()->id;
        if (empty($request->get('dataOrder'))) return url('home');
        $dataOrder = $request->get('dataOrder');
        $info_user['fullname'] = $dataOrder['fullname'];
        $info_user['phone'] = $dataOrder['phone'];
        $info_user['email'] = $dataOrder['email'];
        $info_user['city'] = $dataOrder['city'];
        $info_user['district'] = $dataOrder['district'];
        $info_user['ward'] = $dataOrder['ward'];
        $info_user['address'] = $dataOrder['address'];
        $dataOrderSave['info_user'] = $info_user;
        $dataOrderSave['id_user'] = $idMember ?? 0;
        $dataOrderSave['order_payment'] = $dataOrder['payments'];
        $dataOrderSave['requirements'] = $dataOrder['requirements'];
        $dataOrderSave['numb'] = 1;
        $dataOrderSave['order_status'] = 1;
        $dataOrderSave['ship_price'] = 0;
        $dataOrderSave['temp_price'] = Cart::subtotalFloat();
        $dataOrderSave['total_price'] = Cart::priceTotalFloat();
        $dataOrderSave['code'] =  strtoupper(Func::stringRandom(10));
        $dataOrderSave['order_detail'] = Cart::content();
        // dd(Cart::content());
        // START - Config send mail order //
        $optCompany = json_decode(Func::setting('options'), true);
        $dataSendMail['emailCompanyWebsite'] = $optCompany['website'];
        $dataSendMail['emailOrderCode'] = $dataOrderSave['code'];
        $dataSendMail['emailColor'] = "#000000";
        $dataSendMail['emailDateSend'] = date("d/m/Y");
        $dataSendMail['emailOrderInfoFullname'] = $dataOrder['fullname'];
        $dataSendMail['emailOrderInfoEmail'] = $dataOrder['email'];
        $dataSendMail['emailOrderInfoPhone'] = $dataOrder['phone'];
        $dataSendMail['emailOrderInfoAddress'] = $dataOrder['address'];
        $order_payment_data = $this->getPaymentName('namevi', 'news', $dataOrder['payments']);
        $order_payment_text = $order_payment_data['namevi'];
        $dataSendMail['emailOrderPayment'] = $order_payment_text;
        $dataSendMail['emailOrderShipPrice'] = '';
        $dataSendMail['emailOrderInfoRequirements'] = $dataOrder['requirements'];
        $dataSendMail['emailHome'] = $optCompany['email'];
        $order_detail = '';
        $order_detail .= '<tbody bgcolor="#f7f7f7" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">';
        foreach (Cart::content() as $key => $value) {
            // dd($value);
            $pid = $value->id;
            $quantity = $value->qty;
            $color = ($value->color) ? $value->color : "";
            $size = ($value->size) ? $value->size : "";
            $code = ($value->rowId) ? $value->rowId : '';
            $gia = ($value->price)?$value->price:0;
            $giamoi = ($value->giamoi)?$value->giamoi:0;
            $proinfo = $this->getProductInfo($pid);
            $photo = ($value->photo)?$value->photo:0;
            if($photo>0) {
                $proinfo['photo'] = $photo;
            }
            if($gia>0) {
                $proinfo['regular_price'] = $gia;
            }
            if($giamoi>0) {
                $proinfo['sale_price'] = $giamoi;
            }
            $text_size = "";
            if($size!="") {
                $text_size .= "<strong style='display: block'>Kích cỡ: ".$size."</strong>";
            }
            if($color!="") {
                $text_size .= "<strong style='display: block'>Màu sắc: ".$color."</strong>";
            }
            $pro_price = $proinfo['regular_price'];
            $pro_price_new = $proinfo['sale_price'];
            $pro_price_qty = $pro_price * $quantity;
            $pro_price_new_qty = $pro_price_new * $quantity;
            $order_detail .= '<tr>
                <td align="left" style="padding:3px 9px" valign="top">
                    <span style="display:block;font-weight:bold">'.$proinfo['namevi'].'</span>
                    <strong>'.$text_size.'</strong>
                </td>';
                if (!empty($pro_price_new)) {
                    $order_detail .= '<td align="left" style="padding:3px 9px" valign="top">
                        <span style="display:block;color:#ff0000;">'.number_format($pro_price_new,0,'.','.').' VNĐ</span>
                        <span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">'.number_format($pro_price,0,'.','.').' VNĐ</span>
                    </td>';
                } else {
                    $order_detail .= '<td align="left" style="padding:3px 9px" valign="top"><span style="color:#ff0000;">'.number_format($pro_price,0,'.','.').' VNĐ</span></td>';
                }
                $order_detail .= '<td align="center" style="padding:3px 9px" valign="top">'.$quantity.'</td>';
                if (!empty($pro_price_new_qty)) {
                $order_detail .= '<td align="right" style="padding:3px 9px" valign="top">
                        <span style="display:block;color:#ff0000;">'.number_format($pro_price_new_qty,0,'.','.').' VNĐ</span>
                        <span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">'.number_format($pro_price_qty,0,'.','.').' VNĐ</span>
                    </td>';
                } else {
                $order_detail .= '<td align="right" style="padding:3px 9px" valign="top"><span style="color:#ff0000;">'.number_format($pro_price_qty,0,'.','.').' VNĐ</span></td>';
                }
            $order_detail .= '</tr>';
        }
        $order_detail .= '<tr style="font-size: 12px;">
                    <td colspan="3" align="left" style="padding:3px 9px; text-align: right; font-weight: bold;" valign="top">Tổng tiền</td>
                    <td align="left" style="padding:3px 9px; text-align: right; color: red; font-size: 12px; font-weight: bold;" valign="top">'. number_format(Cart::priceTotalFloat(),0,'.','.') .'VNĐ</td>
                </tr>';
        $order_detail .= '</tbody>';
        $dataSendMail['emailOrderDetails'] = $order_detail;
        // END - Config send mail order //
        // dd($dataSendMail);
        // dd($order_detail);
        $company = Func::setting();
        $arrayEmail = null;
        $subject = "Thông tin đơn hàng từ " . $company['namevi'];
        $message = Email::markdown('giohang.send', $dataSendMail);
        $file = 'file';
        if (Email::send("admin", $arrayEmail, $subject, $message, $file, $optCompany, $company)) {
            $arrayEmail = array(
                "dataEmail" => array(
                    "name" => $dataOrder['fullname'],
                    "email" => $dataOrder['email']
                )
            );
            Email::send("customer", $arrayEmail, $subject, $message, $file, $optCompany, $company);
            CartModel::create($dataOrderSave);
            Cart::destroy();
            return transfer('Thông tin đơn hàng đã được gửi thành công. Vui lòng kiểm tra email của bạn.',2,url('home'));
        } else {
            return transfer('Gửi đơn hàng không thành công. Xin vui lòng thử lại sau.',0,url('gio-hang'));
        }
        // CartModel::create($dataOrderSave);
        // Cart::destroy();
        // transfer('Thông tin đơn hàng đã được gửi thành công.', 2, url('home'));
    }
    protected function updateCart($request): void
    {
        $rowId = $request->rowId;
        $quantity = $request->quantity;
        $item = Cart::get($rowId);
        Cart::update($rowId, $quantity);
        $regular_price = Func::formatMoney($item->options->itemProduct->regular_price * $item->qty);
        $sale_price = Func::formatMoney($item->options->itemProduct->sale_price * $item->qty);
        $temp = Cart::subtotalFloat();
        $tempText = Func::formatMoney($temp);
        $total = Cart::priceTotalFloat();
        if (!empty($ship)) $total += $ship;
        $totalText = Func::formatMoney($total);
        response()->json(['max' => Cart::count(), 'regularPrice' => $regular_price, 'salePrice' => $sale_price, 'tempText' => $tempText, 'totalText' => $totalText]);
    }
    protected function deleteCart($request): void
    {
        $rowId = $request->input('rowId');
        Cart::remove($rowId);
        $tempText = Func::formatMoney(Cart::subtotalFloat());
        $total = Cart::priceTotalFloat();
        if (!empty($ship)) $total += $ship;
        $totalText = Func::formatMoney($total);
        response()->json(['max' => Cart::count(), 'tempText' => $tempText, 'totalText' => $totalText]);
    }
    protected function addCart($request): void
    {
        $idProduct = $request->id;
        $qty = (!empty($request->quantity)) ? (int)$request->quantity : 1;
        $properties = json_decode($request->properties,true) ?? [];
        $itemProduct = ProductModel::find($idProduct);
        $code = md5(vsprintf('%s.%s.%s', [$idProduct, $itemProduct->namevi, json_encode($properties)]));
        if (!empty($properties)) {
            $getProperties = \NINA\Models\PropertiesModel::whereIn('id', $properties)->with('getListProperties')->get();
            $query = \NINA\Models\ProductPropertiesModel::select('regular_price', 'sale_price');
            foreach (array_values($properties) as $v) $query->whereRaw("FIND_IN_SET(?, id_properties)", [$v]);
            $getPrice = $query->first();
            if (!empty($getPrice)) {
                $itemProduct->regular_price = $getPrice->regular_price;
                $itemProduct->sale_price = $getPrice->sale_price;
            }
        }
        $data = [
            'id' => $itemProduct->id,
            'name' => $itemProduct->namevi,
            'price' => (!empty($itemProduct->sale_price)) ? $itemProduct->sale_price : $itemProduct->regular_price,
            'qty' => $qty,
            'weight' => 0,
            'options' => [
                'properties' => $getProperties ?? collect(),
                'code' => $code,
                'itemProduct' => $itemProduct
            ]
        ];
        if ($this->findProductInCart($code)->isNotEmpty()) {
            $rowId = $this->findProductInCart($code)->first()->rowId;
            $qtyOld = $this->findProductInCart($code)->first()->qty;
            Cart::update($rowId, ($qtyOld + $qty));
        } else {
            Cart::add($data);
        }
        response()->json(['max' => Cart::count()]);
    }
    protected function findProductInCart($id): \Illuminate\Support\Collection
    {
        return Cart::search(function ($cartItem) use ($id) {
            return $cartItem->options->code === (string)$id;
        });
    }
}