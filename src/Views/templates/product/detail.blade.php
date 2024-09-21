@extends('layout')
@section('content')
    <section x-data>
        <div class="wrap-main my-[20px] mx-auto max-w-[1200px] w-[calc(100%_-_20px)] py-5">
            <h2 class="title-pro-detail capitalize text-[25px] py-[10px] block">{{ $rowDetail['namevi'] }}</h2>
            <div class="grid-pro-detail">
                <div class="left-pro-detail">
                    <div class="slick_photo1  overflow-hidden">
                        <a id="Zoom-1" class="MagicZoom"
                            data-options="zoomMode: true; hint: off; rightClick: true; selectorTrigger: click; expandCaption: false; history: false;"
                            href="{{ assets_photo('product', '', $rowDetail['photo']) }}" title="{{ $rowDetail['namevi'] }}">
                            <img class=""
                                onerror="this.src='{{ thumbs('thumbs/600x600x1/assets/images/noimage.png') }}';"
                                src="{{ assets_photo('product', '600x600x1', $rowDetail['photo'], 'thumbs') }}"
                                alt="{{ $rowDetail['namevi'] }}">
                        </a>
                    </div>
                    <div class="album-product my-2 mt-3">
                        <div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='0'
                            data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1'
                            data-xs-items="4:1" data-vertical="0">
                            <a class="thumb-pro-detail border-[1px]  mx-2" data-zoom-id="Zoom-1"
                                href="{{ assets_photo('product', '', $rowDetail['photo']) }}"
                                title="{{ $rowDetail['namevi'] }}"
                                data-image="{{ assets_photo('product', '600x600x1', $rowDetail['photo'], 'thumbs') }}"><img
                                    class=" !mb-0 !pb-0 !border-0"
                                    onerror="this.src='{{ thumbs('thumbs/600x600x1/assets/images/noimage.png') }}';"
                                    src="{{ assets_photo('product', '600x600x1', $rowDetail['photo'], 'thumbs') }}"
                                    alt="{{ $rowDetail['namevi'] }}"></a>
                            @foreach ($rowDetailPhoto??[] as $v)
                                <a class="thumb-pro-detail border-[1px] mx-2" data-zoom-id="Zoom-1"
                                    href="{{ assets_photo('product', '', $v['photo']) }}"
                                    title="{{ $rowDetail['namevi'] }}"
                                    data-image="{{ assets_photo('product', '600x600x1', $v['photo'], 'thumbs') }}"><img
                                        class=" !mb-0 !pb-0 !border-0"
                                        onerror="this.src='{{ thumbs('thumbs/600x600x1/assets/images/noimage.png') }}';"
                                        src="{{ assets_photo('product', '600x600x1', $v['photo'], 'thumbs') }}"
                                        alt="{{ $rowDetail['namevi'] }}"></a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="right-pro-detail">
                    <ul class="attr-pro-detail">
                        <?php if($rowDetail['code']!='') { ?>
                        <li class="flex mb-2 items-baseline">
                            <label class="attr-label-pro-detail font-medium mr-[5px]"><?=__('web.masp')?>:</label>
                            <div class="attr-content-pro-detail inline-block mb-0 font-bold">{{ $rowDetail['code'] }}</div>
                        </li>
                        <?php } ?>
                        <li class="flex mb-2 items-baseline">
                            <label class="attr-label-pro-detail font-medium mr-[5px]"><?=__('web.luotxem')?>:</label>
                            <div class="attr-content-pro-detail inline-block mb-0">{{ $rowDetail['view'] }}</div>
                        </li>
                        <li class="flex mb-2 items-baseline">
                            <label class="attr-label-pro-detail font-medium mr-[5px]"><?=__('web.gia')?>:</label>
                            <div class="attr-content-pro-detail">
                                <?php if ($rowDetail['sale_price']) { ?>
                                <span class="price-new-pro-detail">
                                    <?=Func::formatMoney($rowDetail['sale_price'])?>
                                </span>
                                <span class="price-old-pro-detail">
                                    <?=Func::formatMoney($rowDetail['regular_price'])?>
                                </span>
                                <?php } else { ?>
                                <span class="price-new-pro-detail">
                                    <?php if($rowDetail['regular_price']) {
                                        echo Func::formatMoney($rowDetail['regular_price']);
                                    } else {
                                        echo __('web.lienhe');
                                    } ?>
                                </span>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="desc-pro-detail baonoidung">
                                {!! Func::decodeHtmlChars($rowDetail['descvi']) !!}
                            </div>
                        </li>
                    </ul>
                    @if (!empty($configType->order))
                        <div class="cart-pro-detail">
                            <div class="attr-content-pro-detail d-block">
                                <div class="quantity-pro-detail">
                                    <span class="quantity-minus-pro-detail">-</span>
                                    <input type="text" class="qty-pro !outline-none !shadow-none !ring-0" min="1"
                                        value="1" readonly="">
                                    <span class="quantity-plus-pro-detail">+</span>
                                </div>
                            </div>
                            <a class="transition addcart text-decoration-none addnow" data-id="{{ $rowDetail['id'] }}" data-action="addnow"><?=__('web.themvaogiohang')?></a>
                        </div>
                    @endif
                    <?php /*
                    <div class="cart-pro-detail">
                        <a class="transition flex-1 addcart text-decoration-none buynow" data-id="{{ $rowDetail['id'] }}"
                            data-action="buynow">
                            <span>Mua ngay</span>
                            <span>Gọi điện xác nhận và giao hàng tận nơi</span>
                        </a>
                    </div>
                    */ ?>
                    <?php /*
                    <div class="descvi-pro">{!! Func::decodeHtmlChars($rowDetail['descvi']??'') !!}</div>
                    */ ?>
                    <div class="share">
                        <b>Chia sẻ:</b>
                        <div class="social-plugin w-clear">
                            @component('component.share')
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-pro-detail">
                <ul class="ul-tabs-pro-detail w-clear">
                    <li class="active transition" data-tabs="info-pro-detail"><?= __('web.thongtinsanpham') ?></li>
                    <li class="transition" data-tabs="commentfb-pro-detail"><?= __('web.binhluan') ?></li>
                </ul>
                <button type="button" id="ftwp-trigger" class="ftwp-shape-round ftwp-border-medium ftwp-transform-right-center ftwp-fade-trigger" title="click To Maximize The Table Of Contents"><span class="ftwp-trigger-icon ftwp-icon-number"><i class="fas fa-list-ol"></i></span></button>
                <div class="meta-toc">
                    <div class="box-readmore">
                        <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
                    </div>
                </div>
                <div class="content-tabs-pro-detail info-pro-detail active">
                    <div class="baonoidung chitietsanpham" x-data="{ expanded: false }">
                        <div class="info_nd content_down" x-show="expanded" x-collapse.min.200px>
                            <div class="autoHeight" id="toc-content">
                                {!! Func::decodeHtmlChars($rowDetail['contentvi']) !!}
                            </div>
                        </div>
                        <button type="button" @click="expanded = ! expanded" class="mx-auto block mt-2 !border-[1px] border-solid border-gray-400 bg-white text-black !shadow-none !ring-0 !outline-none rounded-[50px] px-[15px] py-[7px]">
                            <span x-text="(!expanded)?'<?=__('web.xemthem')?>':'<?=__('web.thugon')?>'" class="font-medium"><?=__('web.xemthem')?></span>
                        </button>
                    </div>
                </div>
                <div class="content-tabs-pro-detail commentfb-pro-detail">
                    <div class="fb-comments" data-href="<?= Func::getCurrentPageURL() ?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div>
                </div>
            </div>
            <!-- @if ($rowDetail['contentvi'])
            <div class="title-main mt-[40px]"><span>Thông tin chi tiết</span></div>
            <div class="baonoidung chitietsanpham mt-2">
                <div class="info_nd content_down">
                    {!! Func::decodeHtmlChars($rowDetail['contentvi']??'') !!}
                </div>
            </div>
            @endif -->
            <!-- @if (!empty($product))
                <div class="title-main mt-[40px]"><span><?=__('web.sanphamcungloai')?></span></div>
                <div class="owl-page owl-carousel owl-theme"
                    data-items="screen:0|items:2|margin:5,screen:425|items:2|margin:5,screen:575|items:2|margin:10,screen:767|items:3|margin:10,screen:991|items:3|margin:20,screen:1024|items:3|margin:30,screen:1200|items:4|margin:30"
                    data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="0"
                    data-touchdrag="0" data-smartspeed="800" data-autoplayspeed="800" data-autoplaytimeout="5000"
                    data-dots="0"
                    data-animations="animate__fadeInDown, animate__backInUp, animate__rollIn, animate__backInRight, animate__zoomInUp, animate__backInLeft, animate__rotateInDownLeft, animate__backInDown, animate__zoomInDown, animate__fadeInUp, animate__zoomIn"
                    data-nav="1" data-navcontainer=".control-xh">
                    @foreach ($product as $v)
                        <div class="col-slick px-[5px]">
                            @component('component.itemProduct', ['product' => $v])
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            @endif -->
            @if ($product->isNotEmpty())
                <div class="title-main">
                    <span><?=__('web.sanphamcungloai')?></span>
                </div>
                <?php /*
                <h2 class="title-main mt-[40px]"><span><?=__('web.sanphamcungloai')?></span></h2>
                */ ?>
                <div class="grid-product">
                    @foreach ($product as $v)
                        @component('component.itemProduct', ['product' => $v])
                        @endcomponent
                    @endforeach
                </div>
            @endif
            {!! $product->links() !!}
        </div>
    </section>
    <?php /*
    @component('component.detailProduct', [
        'rowDetail' => $rowDetail ?? [],
        'rowDetailPhoto' => $rowDetailPhoto ?? []
    ])
    @endcomponent
    */ ?>
@endsection
@push('styles')
    <link rel="stylesheet" href="@asset('assets/magiczoomplus/magiczoomplus.css')">
@endpush
@push('scripts')
    <script src="@asset('assets/magiczoomplus/magiczoomplus.js')"></script>
    <script>
        if($(".ul-tabs-pro-detail").exists())
        {
            $(".ul-tabs-pro-detail li").click(function(){
                var tabs = $(this).data("tabs");
                $(".content-tabs-pro-detail, .ul-tabs-pro-detail li").removeClass("active");
                $(this).addClass("active");
                $("."+tabs).addClass("active");
            });
        }
    </script>
    <script src="@asset('assets/toc/toc.js')"></script>
    <script>
        if (isExist($('.toc-list'))) {
            $('.toc-list').toc({
                content: 'div#toc-content',
                headings: 'h2,h3,h4'
            });
            if (!$('.toc-list li').length) $('.meta-toc').hide();
            if (!$('.toc-list li').length) $('.meta-toc .mucluc-dropdown-list_button').hide();
            if (!$('.toc-list li').length) $('#ftwp-trigger').remove();
            $('.toc-list')
                .find('a')
                .click(function () {
                    var x = $(this).attr('data-rel');
                    goToByScroll(x);
                });
            $('body').on('click', '.mucluc-dropdown-list_button', function () {
                $('.box-readmore').slideToggle(200);
            });
            $('.box-readmore').prepend('<h4 id="ftwp-header-title">MỤC LỤC<i class="fas fa-angle-down"></i></h4>');
            $(document).scroll(function () {
                var y = $(this).scrollTop();
                var rmTop = $('.box-readmore').offset().top + $('.box-readmore').height();
                // console.log(rmTop);
                if (y > 300) {
                    $('.meta-toc').addClass('fiedx');
                } else {
                    $('.meta-toc').removeClass('fiedx');
                }
                if(y > rmTop) {
                    $("#ftwp-trigger").fadeIn();
                }
                else {
                    $("#ftwp-trigger").fadeOut();
                    $('.box-readmore').removeClass('fixed');
                }
            });
            $(document).on('click', '#ftwp-trigger', function(event) {
                event.preventDefault();
                $(".box-readmore").addClass('fixed');
            });
            $(document).on('click', '#ftwp-header-title', function(event) {
                event.preventDefault();
                var ele = $(this);
                if(ele.hasClass('act')) {
                    ele.removeClass('act');
                    $('.toc-list').show();
                }
                else {
                    ele.addClass('act');
                    $('.toc-list').hide();
                }
            });
        }
    </script>
@endpush