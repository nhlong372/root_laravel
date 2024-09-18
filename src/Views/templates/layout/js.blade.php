<script type="text/javascript">
    var NN_FRAMEWORK = NN_FRAMEWORK || {};
    var ASSET = '{{ assets('assets/') }}';
    var BASE = '{{ assets() }}';
    var CSRF_TOKEN = '{{ url('token') }}';
    var JS_AUTOPLAY = <?= ($_SERVER["SERVER_NAME"]!="localhost")?'true':'false' ?>;
    var WEBSITE_NAME = '{{ !empty($setting['name' . $lang]) ? addslashes($setting['name' . $lang]) : '' }}';
    var RECAPTCHA_ACTIVE = {{ !empty(config('app.recaptcha.active')) ? 'true' : 'false' }};
    var RECAPTCHA_SITEKEY = '{{ config('app.recaptcha.sitekey') }}';
    var GOTOP = ASSET + 'images/top.png';
    var CART_URL = {
        'ADD_CART' : '{{ url('cart', ['action' => 'add-to-cart']) }}',
        'UPDATE_CART' : '{{ url('cart', ['action' => 'update-cart']) }}',
        'DELETE_CART' : '{{ url('cart', ['action' => 'delete-cart']) }}',
        'DELETE_ALL_CART' : '{{ url('cart', ['action' => 'delete-all-cart']) }}',
        'PAGE_CART':'{{ url('giohang') }}',
    };
    var LANG = {
        'no_keywords': '<?= __('web.chuanhaptukhoatimkiem') ?>',
        'delete_product_from_cart': '<?= __('web.banmuonxoasanphamnay') ?>',
        'no_products_in_cart': '<?= __('web.khongtontaisanphamtronggiohang') ?>',
        'ward': '<?= __('web.phuongxa') ?>',
        'back_to_home': '<?= __('web.vetrangchu') ?>',
        'dongy': '<?= __('web.vetrangchu') ?>',
        'thongbao': '<?= __('web.thongbao') ?>',
    };
</script>
@php
    jsminify()->set('js/jquery.min.js');
    jsminify()->set('bootstrap/bootstrap.js');
    jsminify()->set('js/lazyload.min.js');
    jsminify()->set('owlcarousel2/owl.carousel.js');
    jsminify()->set('holdon/HoldOn.js');
    jsminify()->set('confirm/confirm.js');
    jsminify()->set('simplenotify/simple-notify.js');
    jsminify()->set('fancybox5/fancybox.umd.js');
    jsminify()->set('fotorama/fotorama.js');
    jsminify()->set('admin/toastify/toastify.js');
    jsminify()->set('mmenu/mmenu.js');
    jsminify()->set('slick/slick.js');
    jsminify()->set('slick/slick.js');
    jsminify()->set('js/placeholderTypewriter.js');
    jsminify()->set('js/functions.js');
    jsminify()->set('js/cart.js');
    jsminify()->set('js/apps.js');
    echo jsminify()->get();
@endphp
@stack('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script src="@asset('assets/js/alpinejs.js')" defer></script>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@if (!empty(config('app.recaptcha.active')))
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha.sitekey') }}"></script>
@endif
{!!Func::decodeHtmlChars($setting['analytics'])!!}
{!!Func::decodeHtmlChars($setting['bodyjs'])!!}