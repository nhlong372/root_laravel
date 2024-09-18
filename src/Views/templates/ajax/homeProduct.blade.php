@if (!empty($productAjax))
    <div class="grid-product">
        @foreach ($productAjax as $v)
            @component('component.itemProduct', ['product' => $v])
            @endcomponent
        @endforeach
    </div>
@endif
{!! $productAjax->appends(request()->query())->links('pagination.pagin-ajax') !!}