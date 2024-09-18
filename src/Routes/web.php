<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */
use NINA\Core\Routing\NINARouter;
NINARouter::group(['namespace' => 'Web','prefix' => config('app.web_prefix'),'middleware' => [\NINA\Middlewares\LangRequest::class,\NINA\Middlewares\CheckRedirect::class]], function ($language='vi') {
    if(!empty($language) && \Illuminate\Support\Arr::has(config('app.langs'),$language)) session()->set('locale',$language);
    NINARouter::get('/change-lang/{lang}', function ($lang) {
        if(\Illuminate\Support\Arr::has(config('app.langs'),$lang)){
            session()->set('locale',$lang);
            app()->make('config')->set('app.seo_default',$lang);
            response()->redirect(url('home',['language'=>$lang]));
        }
    });
    NINARouter::get('/', 'HomeController@index')->name('home');
    NINARouter::get('/load-product-noibat', 'HomeController@ajaxProductNoibat')->name('loadpronoibat');
    NINARouter::get('/load-product-list/{id_list}', 'HomeController@ajaxProductList')->name('loadprolist');
    NINARouter::get('/load-product-list-cat/{id_list}', 'HomeController@ajaxProductListCat')->name('loadprolistcat');
    NINARouter::get('/load-product-tab/{id_tab}', 'HomeController@ajaxProductTab')->name('loadprotab');
    NINARouter::get('/paging-tab-list/{id_list}', 'HomeController@ajaxProductListTab')->name('loadprolisttab');
    // NINARouter::get('/index', 'HomeController@index')->name('index');
    //NINARouter::post('/load-product', 'HomeController@ajaxProduct')->name('load-product');
    NINARouter::get('/load-token', 'ApiController@token')->name('token');
    NINARouter::get('/tags-san-pham', 'TagsController@index')->name('tags');
    NINARouter::get('/lien-he', 'ContactController@index')->name('lien-he');
    NINARouter::post('/lien-he', 'ContactController@submit')->name('lien-he-post');
    NINARouter::get('/san-pham', 'ProductController@index')->name('san-pham');
    NINARouter::get('/gioi-thieu', 'StaticController@index')->name('gioi-thieu');
    NINARouter::get('/tin-tuc', 'NewsController@index')->name('tin-tuc');
    NINARouter::get('/dich-vu', 'NewsController@index')->name('dich-vu');
    // NINARouter::get('/thu-vien', 'StaticController@indexthuvien')->name('thu-vien');
    // NINARouter::get('/chung-nhan', 'StaticController@indexthuvien')->name('chung-nhan');
    NINARouter::get('/chinh-sach', 'NewsController@index')->name('chinh-sach');
    NINARouter::get('/tim-kiem', 'ProductController@searchProduct')->name('tim-kiem');
    NINARouter::post('/dang-ky-nhan-tin', 'HomeController@letter')->name('letter');
    //NINARouter::get('/tim-kiem-goi-y', 'ProductController@suggestProduct')->name('tim-kiem-goi-y');
    NINARouter::post('/cart/{action}', 'CartController@handle')->name('cart');
    NINARouter::get('/gio-hang', 'CartController@showcart')->name('giohang');
    NINARouter::post('/comment/{action}', 'CommentController@handle')->name('comment');
    NINARouter::get('/{slug}', 'SlugController@handle')->name('slugweb');
});