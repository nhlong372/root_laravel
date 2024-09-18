<div class="product">
    <div class="pic-product">
        <a class="scale-img img block aspect-[300/200]" href="{{ url('slugweb', ['slug' => $product['slugvi']]) }}"
            title="{{ $product['namevi'] }}">
            <img onerror="this.src='{{ thumbs('thumbs/480x450x1/assets/images/noimage.png') }}';"
                src="{{ assets_photo('product', '480x450x1', $product['photo'], 'thumbs') }}" alt="{{ $product['namevi'] }}">
        </a>
    </div>
    <div class="info-product">
        <h3 class="name-product">
            <a class="text-split text-decoration-none" href="{{ url('slugweb', ['slug' => $product['slugvi']]) }}"
                title="{{ $product['namevi'] }}">{{ $product['namevi'] }}</a>
        </h3>
        <p class="price-product">
            @if (empty($product->sale_price))
                @if (empty($product->regular_price))
                    <span class="price-new">Liên hệ</span>
                @else
                    <b>Giá: </b><span class="price-new">{{ Func::formatMoney($product->regular_price) }}</span>
                @endif
            @else
                <span class="price-old">{{ Func::formatMoney($product->regular_price) }}</span>
                <span class="price-new">{{ Func::formatMoney($product->sale_price) }}</span>
            @endif
        </p>
        <?php /*
        <p class="price-product">Giá Sỉ: <a href="tel:<?= preg_replace('/[^0-9]/', '', $optSetting['hotline']); ?>">{{$optSetting['hotline']}}</a></p>
        */ ?>
        <span class="cart-add addcart2 addnow" data-id="<?=$product['id']?>" data-action="addnow"><i class="fa-sharp fa-solid fa-cart-shopping"></i><?=__('web.themvaogiohang')?></span>
    </div>
</div>