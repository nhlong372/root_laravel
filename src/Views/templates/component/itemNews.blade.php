<div class="item_tt">
    <a class="img card-image block overflow-hidden group rounded-[15px] aspect-[390/290]" href="{{url('slugweb',['slug'=>$news->slugvi])}}" title="{{$news->namevi}}">
        <img class="w-full rounded-[15px] transition-all group-hover:scale-[1.1]" onerror="this.src='{{thumbs('thumbs/480x400x1/assets/images/noimage.png')}}';" src="{{assets_photo('news','480x400x1',$news->photo,'thumbs')}}" alt="{{$news->namevi}}">
    </a>
    <div class="tttt">
        <span class="time-news">{{\Carbon\Carbon::parse($news->created_at)->format('d/m/Y')}} / <b>Tin tức</b></span>
        <h3 class="ten"><a class="text-decoration-none hover:!text-[#5172fd]" href="{{url('slugweb',['slug'=>$news->slugvi])}}" title="{{$news->namevi}}">{{$news->namevi}}</a></h3> 
        {!! $slot !!}
    </div>
</div>