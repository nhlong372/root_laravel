<div class="menu">
    <div class="wrap-content">
        <ul class="menu-ul flex flex-wrap items-center justify-between ulmn gap-10 menu-main">       
            <li>
                <a class="<?=($com == '') ? 'active' : ''?>" href="" title="<?=__('web.trangchu')?>">
                    <?=__('web.trangchu')?>
                </a>
            </li>
            <li class="line"></li>
            <li class="">
                <a class="<?=($com == 'gioi-thieu') ? 'active' : ''?>" href="gioi-thieu" title="<?=__('web.gioithieu')?>">
                    <?=__('web.gioithieu')?>
                </a>
            </li>
            <li class="line"></li>
            <li>
                <a class="<?=($com == 'san-pham') ? 'active' : ''?>" href="san-pham" title="<?=__('web.sanpham')?>"><?=__('web.sanpham')?>
                </a>
                <ul>
                @foreach($listProductMenu??[] as $vlist)
                    <li><a class="transition {{(($idList??0)==$vlist->id)?'active':''}}" href="{{url('slugweb',['slug'=>$vlist->slugvi])}}" title="{{$vlist->namevi}}">{{$vlist->namevi}}</a></li>
                @endforeach
                </ul>
            </li>
            <li class="line"></li>
            <li class="">
                <a class="<?=($com == 'tin-tuc') ? 'active' : ''?>" href="tin-tuc" title="<?=__('web.tintuc')?>">
                    <?=__('web.tintuc')?>
                </a>
            </li>
            <li class="line"></li>
            <li class="">
                <a class="<?=($com == 'lien-he') ? 'active' : ''?>" href="lien-he" title="<?=__('web.lienhe')?>">
                    <?=__('web.lienhe')?>
                </a>
            </li>
            <div class="search">
                <input type="text" id="keyword" placeholder="<?=__('web.nhaptukhoatimkiem')?>" onkeypress="doEnter(event,'keyword');">
                <p onclick="onSearch('keyword');"><i class="fa-sharp fa-light fa-magnifying-glass"></i></p>
            </div> 
        </ul>
    </div>
</div>