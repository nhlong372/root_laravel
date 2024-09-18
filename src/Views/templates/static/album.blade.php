@extends('layout')
@section('content')
    <section>
        <div class="max-width py-5">
            @if($com=='thu-vien')
            <div class="title-main">
                <h4>Thư viện</h4>
            </div>
            @endif
            @if($com=='chung-nhan')
            <div class="title-main">
                <h4>Chứng nhận</h4>
            </div>
            @endif

            <div class="grid-product">
            @foreach ($rowDetail??[] as $k => $v)
                <div class="thuvien-item">
                    <a class="pic-thuvien scale-img" href="upload/photo/<?=$v['photo']?>" data-fancybox="gallery" data-caption="<?=$v['namevi']?>"><img class="w-100" onerror="this.src='{{ thumbs('thumbs/380x500x1/assets/images/noimage.png') }}';" src="{{ assets_photo('photo', '380x500x1', $v['photo'], 'thumbs') }}" alt="{{ $v['namevi'] }}"></a>
                </div>
            @endforeach   
            </div>
            
        </div>
    </section>
@endsection