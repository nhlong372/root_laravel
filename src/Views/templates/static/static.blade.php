@extends('layout')
@section('content')
    <section>
        <div class="max-width py-5">
            @if (!empty($static))
                <div class="title-main">
                    <h4>{{ $static['namevi']??'' }}</h4>
                </div>
                <div class="content-main w-clear"> {!! Func::decodeHtmlChars($static['contentvi']??'') !!}</div>
                <div class="share">
                    <b>Chia sẻ:</b>
                    <div class="social-plugin w-clear">
                        @component('component.share')
                        @endcomponent
                    </div>
                </div>
            @else
                <div class="alert alert-warning w-100" role="alert">
                    <strong><?=__('web.chuacapnhatdulieu')?></strong>
                </div>
            @endif
        </div>
    </section>
@endsection
