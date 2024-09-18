<div class="newsletter">
    <div class="wrap-content">
        <div class="newsletter-wrap">
            <div class="title-company">{{$setting['namevi']}}</div>
            <div class="title-main"><h2>Đăng ký nhận tin</h2></div>
            <div class="slogan">{{$slogan['descvi']}}</div>
            <form class="form-newsletter validation-newsletter" novalidate method="POST" action="{{url('letter')}}" enctype="multipart/form-data">
                <div class="form_dknt">
                    <div class="left_form">
                        <div class="newsletter-input newsletter-input2">
                            <input type="text" class="form-control" id="ten-newsletter" name="ten-newsletter" placeholder="Họ và tên" required>
                            <input type="tel" class="form-control" id="dienthoai-newsletter" name="dienthoai-newsletter" placeholder="Số điện thoại" required>
                        </div>
                        <div class="newsletter-input newsletter-input2">
                            <input type="text" class="form-control" id="email-newsletter" name="email-newsletter" placeholder="Email" required>
                            <input type="tel" class="form-control" id="diachi-newsletter" name="diachi-newsletter" placeholder="Địa chỉ" required>
                        </div>
                    </div>
                    <div class="right_form">
                        <div class="newsletter-input">
                            <textarea class="form-control" id="noidung-newsletter" name="noidung-newsletter" placeholder="Nội dung" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="newsletter-button">
                    <input type="submit" name="submit-newsletter" value="Gửi thông tin">
                    <input type="hidden" name="csrf_token" value="{{csrf_token()}}">
                    <input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter" value="">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="footer">
    <div class="wrap-content">
        <div class="footer-wrap">
            <div class="footer__logo">
                <a class="logo-footer" href="">
                    <img src="{{ assets_photo('photo', '165x165x2', $logoPhoto->photo, 'thumbs') }}"
                        alt="{{ $setting->namevi }}">
                </a>
                <div class="mxh--ft">
                    <span>Mạng xã hội:</span>
                    <?php foreach ($social as $key => $value) { ?>
                        <a class="scale-img" href="<?= $value["link"] ?>">
                            <img src="thumbs/40x40x2/upload/photo/<?=$value['photo']?>" alt="<?= $value["name$lang"] ?>">
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="footer__info">
                <div class="footer__title">Thông tin liên hệ</div>
                <div class="footer__info-body"><?= Func::decodeHtmlChars($footer['content'.$lang]) ?></div>
            </div>
            <div class="footer__baiviet">
                <div class="footer__title">Chính sách</div>
                <ul class="p-0 m-0 list-none">
                    @foreach ($chinhsach as $v)
                    <li class="">
                        <a class="" href="{{url('slugweb',['slug'=>$v->slugvi])}}"><?=$v['name'.$lang]?></a>
                    </li>   
                    @endforeach
                </ul>
            </div>
            <div class="footer__fanpage">
                <div class="footer__title">Fanpage Facebook</div>
                <div class="fb-page" data-href="<?= $optSetting['fanpage'] ?>" data-tabs="timeline" data-width="500" data-height="190" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="<?= $optSetting['fanpage'] ?>" class="fb-xfbml-parse-ignore">
                        <a href="<?= $optSetting['fanpage'] ?>"></a>
                    </blockquote>
                </div>
            </div> 
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            Copyright © <span>{{$setting['namevi']}}</span>. All rights reserved. Designed by NiNa Co.,Ltd
        </div>
    </div>
    <div id="footer-map">
        {!! Func::decodeHtmlChars($optSetting['coords_iframe']??'') !!}
    </div>
</div>
<a class="btn-zalo btn-frame text-decoration-none" target="_blank" href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optSetting['zalo']); ?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i>
        <img src="thumbs/35x35x2/assets/images/zl.png" />
    </i>
</a>
<a class="btn-phone btn-frame text-decoration-none" href="tel:<?= preg_replace('/[^0-9]/', '', $optSetting['hotline']); ?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i>
        <img src="thumbs/35x35x2/assets/images/hl.png" />   
    </i>
</a>
<a class="cart-head cart-fixed btn-frame text-decoration-none" href="gio-hang" title="Giỏ hàng">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i class="fas fa-shopping-bag"></i>
    <span class="count-cart">{{ Cart::count() }}</span>
</a>
<a class="btn-mess btn-css btn-frame text-decoration-none" href="<?=$optSetting['fanpage']?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i class="fa-brands fa-facebook-messenger"></i>
</a>
<a class="btn-chiduong btn-css btn-frame text-decoration-none" href="<?=$optSetting['link_googlemaps']?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i class="fa-sharp fa-solid fa-location-dot"></i>
</a>
<!-- Modal cart -->
<div class="modal fade" id="popup-cart" tabindex="-1" role="dialog" aria-labelledby="popup-cart-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="popup-cart-label">Giỏ hàng</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>