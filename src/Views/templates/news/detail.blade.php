@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3 mt-4">
            @if (!empty($rowDetail))
                <div class="title-main">
                    <span><?= $rowDetail->namevi ?></span>
                </div>
                <button type="button" id="ftwp-trigger" class="ftwp-shape-round ftwp-border-medium ftwp-transform-right-center ftwp-fade-trigger" title="click To Maximize The Table Of Contents"><span class="ftwp-trigger-icon ftwp-icon-number"><i class="fas fa-list-ol"></i></span></button>
                <div class="meta-toc">
                    <div class="box-readmore">
                        <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
                    </div>
                </div>
                <div class="content-main baonoidung w-clear" id="toc-content"> {!! Func::decodeHtmlChars($rowDetail['contentvi']) !!}</div>
                <div class="share">
                    <b>Chia sẻ:</b>
                    <div class="social-plugin w-clear">
                        @component('component.share')
                        @endcomponent
                    </div>
                </div>
            @else
                <div class="alert alert-warning w-100" role="alert">
                    <strong>Đang cập nhật dữ liệu</strong>
                </div>
            @endif
        </div>
    </section>
    @if ($news->isNotEmpty())
    <section>
        <div class="max-width py-3">
            <div class="title-main">
                <span><?=__('web.baivietkhac')?></span>
            </div>
            <ul class="grid-news-details">
                @foreach ($news as $v)
                    <li class="item_details">
                        <a class="d-block" href="{{url('slugweb',['slug'=>$v->slugvi])}}" title="{{$v->namevi}}">
                            {{$v->namevi}} - <span>{{\Carbon\Carbon::parse($v->created_at)->format('d/m/Y')}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <!-- @if (!empty($news))
                <div class="grid-news">
                    @foreach ($news as $v)
                        @component('component.itemNews', ['news' => $v])
                        @endcomponent
                    @endforeach
                </div>
            @endif -->
        </div>
    </section>
    @endif
@endsection
@pushOnce('scripts')
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
@endPushOnce