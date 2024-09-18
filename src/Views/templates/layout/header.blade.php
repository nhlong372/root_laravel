<div class="header z-100">
    <div class="wrap-content">
        <div class="flex align-items-center justify-between">
            <a class="logo-header" href="">
                <img src="{{ assets_photo('photo', '480x76x2', $logoPhoto->photo, 'thumbs') }}"
                    alt="{{ $setting->namevi }}">
            </a>
            <?php /*
            <a class="banner-header" href="">
                <img src="{{ assets_photo('photo', '520x90x2', $bannerPhoto->photo, 'thumbs') }}"
                    alt="{{ $setting->namevi }}">
            </a>
            */ ?>
            <div class="hotline">
                Hotline tư vấn:
                <span>{{$optSetting['hotline']}}</span>
            </div>
        </div>
    </div>
</div>
<div class="wrap-menu">
    @include('layout.menu')
    @include('layout.mmenu')
</div>