@extends('layout')
@section('content')
    <section>
        @if ($news->isNotEmpty())
            <div class="max-width py-5">
                <div class="title-main">
                    <span><?= $titleMain?></span>
                </div>
                <div class="grid-news">
                    @foreach ($news as $k => $v)
                        @component('component.itemNews', ['news' => $v])
                            <div class="desc-news line-clamp-3 mt-1">{{ $v->descvi }}</div>
                        @endcomponent
                    @endforeach
                </div>
                {!! $news->links() !!}
            </div>
        @else
        <div class="alert alert-warning w-100" role="alert">
            <strong><?=__('web.chuacapnhatdulieu')?></strong>
        </div>
        @endif
    </section>
@endsection