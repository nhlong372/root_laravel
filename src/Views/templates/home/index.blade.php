@extends('layout')
@section('content')
    <!-- <div class="page-home">
    @if(!empty($gioithieu))
    <div class="wap_gioithieu">
        <div class="wrap-content">
        <div class="main_gioithieu">
            <div class="left_gthieu scale-img">
                <img class="" onerror="this.src='{{ thumbs('thumbs/60x60x1/assets/images/noimage.png') }}';" src="{{ assets_photo('news', '585x470x1', $gioithieu['photo'], 'thumbs') }}" alt="{{ $gioithieu['namevi'] }}">
            </div>
            <div class="right_gthieu">
                <div class="time-mxh">
                    <div class="time">
                        <p>Thời gian làm việc:</p> <span>{{$optSetting['worktime']}}</span>
                    </div>
                    <div class="mxh">
                        <?php foreach ($social as $key => $value) { ?>
                            <a class="scale-img" href="<?= $value["link"] ?>">
                                <img src="thumbs/40x40x1/upload/photo/<?=$value['photo']?>" alt="<?= $value["name$lang"] ?>">
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="noidung_gthieu">
                    <div class="tde-gt">Câu chuyện về chúng tôi</div>
                    <div class="name-gt">{{$gioithieu['namevi']}}</div>
                    <div class="desc-gt">{!! Func::decodeHtmlChars($gioithieu->descvi) !!}</div>
                    <a class="xtatca" href="gioi-thieu">xem tất cả <i class="fa-regular fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        </div>
    </div>
    @endif -->
    <!-- @if ($productNB->isNotEmpty())
        <div class="wrap-product-nb">
            <div class="wrap-content">
                <div class="title-company">{{$setting['namevi']}}</div>
                <div class="title-main"><h2>Sản phẩm tại cơ sở hùng hồng</h2></div>
                <div class="slogan">{{$slogan['descvi']??''}}</div>
                <div class="grid-product">
                    @foreach ($productNB as $v)
                        @component('component.itemProduct', ['product' => $v])
                        @endcomponent
                    @endforeach
                </div>
            </div>
        </div>
    @endif -->
    <!-- </div> -->
    <!-- Sản phẩm nổi bật -->
    <div class="wrap-product-nb">
        <div class="wrap-content">
            <div class="title-main"><h2><?=__('web.sanphamnoibat')?></h2></div>
            <div class="paging-noibat" data-url="load-product-noibat"></div>
        </div>
    </div>
    <!-- Sản phẩm theo tab cấp 1 -->
    <div class="wrap-product-nb">
        <div class="wrap-content">
            <div class="title-main"><h2>Sản phẩm theo tab cấp 1</h2></div>
            <?php if($listProductMenu) { ?>
            <div class="listProductMenuTab">
                <div class="listProductMenuTab_i">
                    <a data-list="0" class="">Tất cả</a>
                </div>
                <?php foreach ($listProductMenu as $k2 => $v2) { ?>
                <div class="listProductMenuTab_i">
                    <a data-list="<?=$v2->id?>" class=""><?=$v2->namevi?></a>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="paging-tab-list" data-url="paging-tab-list"></div>
        </div>
    </div>
    <!-- Phân trang danh mục cấp 1 -->
    <?php foreach ($listProductMenu as $key => $value) { if(!$value->getItems->isNotEmpty()) continue; ?>
    <div class="wrap-product-nb">
        <div class="wrap-content">
            <div class="title-main"><h2><?=$value->namevi?></h2></div>
            <div class="paging-list-init paging-list<?=$value['id']?>" data-list="<?=$value['id']?>" data-url="load-product-list/<?=$value['id']?>"></div>
        </div>
    </div>
    <?php } ?>
    <!-- Phân trang danh mục cấp 1 và 2 -->
    <?php foreach ($listProductMenu as $key => $value) { if(!$value->getItems->isNotEmpty()) continue;
        $catProduct = \NINA\Models\ProductCatModel::select('namevi', 'photo', 'slugvi', 'type', 'id')
            ->where('type', 'san-pham')
            ->where('id_list', $value->id)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();
    ?>
    <div class="wrap-product-nb">
        <div class="wrap-content">
            <div class="title-main"><h2><?=$value->namevi?></h2></div>
            <?php if($catProduct) { ?>
            <div class="catProduct catProduct<?=$value['id']?>">
                <?php foreach ($catProduct as $k2 => $v2) { ?>
                <div class="catProduct_i">
                    <a data-list="<?=$value['id']?>" data-cat="<?=$v2['id']?>" class=""><?=$v2->namevi?></a>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="paging-listcat-init paging-listcat<?=$value['id']?>" data-list="<?=$value['id']?>" data-url="load-product-list-cat/<?=$value['id']?>"></div>
        </div>
    </div>
    <?php } ?>
    <!-- Sản phẩm nhiều tab status -->
    <div class="wrap-product-nb">
        <div class="wrap-content">
            <div class="title-main"><h2>Sản phẩm nhiều tab</h2></div>
            <div class="tabProduct">
                <a data-tab="banchay" class="">Bán chạy</a>
                <a data-tab="noibat" class="">Nổi bật</a>
            </div>
            <div class="paging-tab" data-url="load-product-tab"></div>
        </div>
    </div>
    <?php /*
    @if ($Visao->isNotEmpty())
        <div class="wrap-visao">
            <div class="wrap-content">
                <div class="title-company">{{$setting['namevi']}}</div>
                <div class="title-main"><h2>Vì sao chọn cá khô hùng hồng</h2></div>
                <div class="slogan">{{$slogan['descvi']??''}}</div>
                <div class="p-relative w-clear">
                    @foreach ($Visao as $v)
                        <div class="box-visao">
                            <div class="pic-visao scale-img">
                                <img class=""
                                    onerror="this.src='{{ thumbs('thumbs/100x100x1/assets/images/noimage.png') }}';"
                                    src="{{ assets_photo('news', '100x100x1', $v['photo'], 'thumbs') }}"
                                    alt="{{ $v['namevi'] }}">
                            </div>
                            <h3 class="name-vsao">{{ $v['namevi'] }}</h3>
                            <div class="desc-vsao">{{ $v['descvi'] }}</div>
                        </div>
                    @endforeach
                    @if(!empty($bannerSale))
                    <a class="banner-sale" href="{{ $bannerSale['link'] }}">
                        <img src="{{ assets_photo('photo', '560x590x2', $bannerSale['photo']) }}"
                            alt="{{ $bannerSale['namevi'] }}">
                    </a>
                    @endif
                </div>
            </div>
        </div>
    @endif
    */ ?>
    <?php /*
    @if ($Quytrinh->isNotEmpty())
        <div class="wrap-quytrinh">
            <div class="wrap-content">
                <div class="title-company text-white">{{$setting['namevi']}}</div>
                <div class="title-main"><h2>quy trình làm việc</h2></div>
                <div class="slogan text-white">{{$slogan['descvi']??''}}</div>
                <div class="owl-page owl-carousel owl-theme"
                    data-items="screen:0|items:2|margin:10,screen:425|items:2|margin:10,screen:575|items:2|margin:10,screen:767|items:3|margin:10,screen:991|items:4|margin:20,screen:1024|items:5|margin:20,screen:1200|items:6|margin:20"
                    data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="0"
                    data-touchdrag="0" data-smartspeed="800" data-autoplayspeed="800" data-autoplaytimeout="5000"
                    data-dots="0"
                    data-animations="animate__fadeInDown, animate__backInUp, animate__rollIn, animate__backInRight, animate__zoomInUp, animate__backInLeft, animate__rotateInDownLeft, animate__backInDown, animate__zoomInDown, animate__fadeInUp, animate__zoomIn"
                    data-nav="1" data-navcontainer=".control-xh">
                    @foreach ($Quytrinh as $k => $v)
                    <div class="quytrinh-item">
                        <div class="box-quytrinh">
                            <div class="item-quytrinh">
                                <div class="pic-quytrinh scale-img">
                                    <img class=""
                                        onerror="this.src='{{ thumbs('thumbs/55x55x1/assets/images/noimage.png') }}';"
                                        src="{{ assets_photo('news', '55x55x2', $v['photo'], 'thumbs') }}"
                                        alt="{{ $v['namevi'] }}">
                                </div>
                                <h3 class="name-quytrinh">{{ $v['namevi'] }}</h3>
                            </div>
                        </div>
                        <div class="stt-qtr">0<?=$k+1?></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    */ ?>
    <!-- @if ($chungnhan->isNotEmpty())
    <div class="wap_chungnhan">
        <div class="wrap-content">
            <div class="title-company">{{$setting['namevi']}}</div>
            <div class="title-main"><h2>Chứng nhận OCOP</h2></div>
            <div class="slogan">{{$slogan['descvi']??''}}</div>
            <div class="owl-page owl-carousel owl-theme"
                data-items="screen:0|items:2|margin:10,screen:425|items:2|margin:10,screen:575|items:2|margin:10,screen:767|items:3|margin:10,screen:991|items:3|margin:20,screen:1024|items:3|margin:30,screen:1200|items:4|margin:30"
                data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="0"
                data-touchdrag="0" data-smartspeed="800" data-autoplayspeed="800" data-autoplaytimeout="5000"
                data-dots="0"
                data-animations="animate__fadeInDown, animate__backInUp, animate__rollIn, animate__backInRight, animate__zoomInUp, animate__backInLeft, animate__rotateInDownLeft, animate__backInDown, animate__zoomInDown, animate__fadeInUp, animate__zoomIn"
                data-nav="1" data-navcontainer=".control-xh">
                @foreach ($chungnhan as $k => $v)
                <div class="chungnhan-item">
                    <a class="pic-chungnhan scale-img" href="upload/photo/<?=$v['photo']?>" data-fancybox="gallery" data-caption="<?=$v['namevi']?>"><img class="" onerror="this.src='{{ thumbs('thumbs/380x500x1/assets/images/noimage.png') }}';" src="{{ assets_photo('photo', '380x500x1', $v['photo'], 'thumbs') }}" alt="{{ $v['namevi'] }}"></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif -->
    <?php /*
    @if ($thuviennb->isNotEmpty())
    <div class="wap_thuviennb">
        <div class="wrap-content">
            <div class="title-company">{{$setting['namevi']}}</div>
            <div class="title-main"><h2>Thư viện ảnh</h2></div>
            <div class="slogan">{{$slogan['descvi']??''}}</div>
            <div class="grid-container">
                @foreach ($thuviennb as $k => $v)
                <div class="thuviennb-item lt<?=$k?>">
                    <a class="pic-thuviennb scale-img" href="upload/photo/<?=$v['photo']?>" data-fancybox="gallery-1<?=$k?>" data-caption="<?=$v['namevi']?>"><img class="" onerror="this.src='{{ thumbs('thumbs/500x280x1/assets/images/noimage.png') }}';" src="{{ assets_photo('photo', '500x280x1', $v['photo'], 'thumbs') }}" alt="{{ $v['namevi'] }}"></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    */ ?>
    @if ($GocBepNB->isNotEmpty())
        <div class="wrap-xh">
            <div class="wrap-content">
                <div class="title-company">{{$setting['namevi']}}</div>
                <div class="title-main"><h2><?=__('web.tintuc')?></h2></div>
                <div class="slogan">{{$slogan['descvi']??''}}</div>
                <div class="p-relative">
                    <div class="owl-page owl-carousel owl-theme"
                        data-items="screen:0|items:2|margin:10,screen:425|items:2|margin:10,screen:575|items:3|margin:10,screen:767|items:3|margin:10,screen:991|items:4|margin:20,screen:1199|items:3|margin:30"
                        data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="0"
                        data-touchdrag="0" data-smartspeed="800" data-autoplayspeed="800" data-autoplaytimeout="5000"
                        data-dots="0"
                        data-animations="animate__fadeInDown, animate__backInUp, animate__rollIn, animate__backInRight, animate__zoomInUp, animate__backInLeft, animate__rotateInDownLeft, animate__backInDown, animate__zoomInDown, animate__fadeInUp, animate__zoomIn"
                        data-nav="1" data-navcontainer=".control-xh">
                        @foreach ($GocBepNB as $k => $v)
                            @component('component.itemNews', ['news' => $v])
                                <div class="desc-news line-clamp-3 mt-1">{{ $v->descvi }}</div>
                            @endcomponent
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection