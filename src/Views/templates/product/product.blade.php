@extends('layout')
@section('content')
    <section>
        <div class="max-width py-5">
            <div class="title-main">
                <span>{{ $titleMain }}</span>
            </div>
            @if ($product->isNotEmpty())
                <div class="grid-product">
                    @foreach ($product as $v)
                        @component('component.itemProduct', ['product' => $v])
                        @endcomponent
                    @endforeach
                </div>
                {!! $product->appends(request()->query())->links() !!}
            @else
            <div class="alert alert-warning w-100" role="alert">
                <strong><?=__('web.chuacapnhatdulieu')?></strong>
            </div>
            @endif
        </div>
    </section>
@endsection