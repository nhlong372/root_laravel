@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y container-fluid">
        <div class="app-ecommerce">
            <form class="validation-form" novalidate method="post" action="{{ url('admin',['com'=>$com,'act'=>'save','type'=>$type]) }}" enctype="multipart/form-data">

                @component('component.buttonAdd')
                @endcomponent
                {!! Flash::getMessages('admin') !!}
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin {{ $configMan->title_main }}
                                </h3>
                            </div>

                            @for ($i = 0; $i < $configMan->number??5; $i++)
                                <div class="card-body card-article">
                                    <div class="card">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                            @foreach (config('app.langs') as $k => $v)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $k == 'vi' ? 'active' : '' }}" id="tabs-lang-{{$i}}"
                                                        data-bs-toggle="tab" data-bs-target="#tabs-lang-{{$i}}-{{ $k }}"
                                                        role="tab" aria-controls="tabs-lang-{{ $k }}"
                                                        aria-selected="true">{{ $v }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                            @foreach (config('app.langs') as $k => $v)
                                                <div class="tab-pane fade show {{ $k == 'vi' ? 'active' : '' }}"
                                                    id="tabs-lang-{{$i}}-{{ $k }}" role="tabpanel"
                                                    aria-labelledby="tabs-lang">
                                                    <div class="form-group last:!mb-0">
                                                        <label class="form-label" for="name{{$i}}{{ $k }}">Tiêu đề
                                                            ({{ $k }})
                                                            :</label>
                                                        <input type="text" class="form-control for-seo text-sm"
                                                            name="dataMultiTemp[{{$i}}][name{{ $k }}]"
                                                            id="name{{ $i }}{{ $k }}"
                                                            placeholder="Tiêu đề ({{ $k }})"
                                                            value="{{ !empty(Flash::has('namevi')) ? Flash::get('namevi') : $item['name' . $k] }}"
                                                            >
                                                    </div>

                                                    @if (!empty($configMan->desc))
                                                        <div class="form-group last:!mb-0">
                                                            <label class="form-label" for="desc{{ $k }}">Mô tả
                                                                ({{ $k }})
                                                                :</label>
                                                            <textarea class="form-control for-seo text-sm {{ !empty($configMan->desc_cke) ? 'form-control-ckeditor' : '' }}"
                                                                name="dataMultiTemp[{{$i}}][desc{{ $k }}]" id="desc{{ $k }}" rows="5"
                                                                placeholder="Mô tả ({{ $k }})">{{ !empty(Flash::has('desc' . $k)) ? Flash::get('desc' . $k) : @$item['desc' . $k] }}</textarea>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                            @if (!empty($configMan->link))
                                            <div class="form-group last:!mb-0 mt-4">
                                                <label class="form-label" for="link">Link:</label>
                                                <input type="text" class="form-control  text-sm" name="dataMultiTemp[{{$i}}][link]"
                                                    id="name" placeholder="Link"
                                                    value="{{ !empty(Flash::has('link')) ? Flash::get('link') : $item['link'] }}">
                                            </div>
                                            @endif
                                            @if (!empty($configMan->link_video))
                                            <div class="form-group last:!mb-0 mt-3">
                                                <label class="form-label" for="link_video">Link video:</label>
                                                <input type="text" class="form-control  text-sm" name="dataMultiTemp[{{$i}}][link_video]"
                                                    id="name" placeholder="Link video"
                                                    value="{{ !empty(Flash::has('link_video')) ? Flash::get('link_video') : $item['link_video'] }}">
                                            </div>
                                            @endif
                                            @if (!empty($configMan->images))
                                            <div class="form-group last:!mb-0">
                                                <label class="form-label" for="images">Hình ảnh:</label>
                                                <input type="file" class="form-control text-sm mb-2" name="file{{$i}}" id="images" />
                                                <b>Width: {{$configMan->width}}px - Height: {{ $configMan->height }}px ({{config('type.type_img')}})</b>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id"
                    value="<?= !empty($item['id']) && $item['id'] > 0 ? $item['id'] : '' ?>">
                <input name="csrf_token" type="hidden" value="{{ csrf_token() }}">

                @component('component.buttonAdd') @endcomponent

            </form>
        </div>
    </div>
@endsection
