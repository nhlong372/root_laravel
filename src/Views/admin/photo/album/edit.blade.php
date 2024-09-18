@extends('layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y container-fluid">
    <div class="app-ecommerce">
        <form class="validation-form" novalidate method="post" action="{{ url('admin',['com'=>$com,'act'=>'save','type'=>$type],['id'=>$item['id']??0]) }}" enctype="multipart/form-data">

            @component('component.buttonAdd')
            @endcomponent
            {!! Flash::getMessages('admin') !!}
            <div class="row">
                @if (!empty($configMan->images))
                <div class="col-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Hình ảnh
                                {{ $configMan->title_main }}
                            </h5>
                        </div>
                        <div class="card-body" x-data="imageUploader()">
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4">
                                    <img x-ref="uploadedPhoto" :src="imageSrc" src="{{(!empty($item['photo']))?upload('photo',$item['photo']):assets('assets/images/noimage.png')}}" alt="photoUpload" class="d-block rounded" id="uploadedphoto">
                                </div>
                            </div>
                            <div class="row mb-3 last:!mb-0">
                                <div class="col-sm-6 col-md-4 ">
                                    <div class="form-group mb-0">
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                                                <span class="d-none d-sm-block">Chọn hình ảnh</span>
                                                <i class="ti ti-upload d-block d-sm-none"></i>
                                                <input type="file" id="upload" @change="updateImage" x-ref="fileInput" class="change-file-input" name="file" hidden="" accept="image/png, image/jpeg">
                                            </label>
                                            <button type="button" @click="resetImage" class="btn btn-label-secondary change-image-reset mb-3 waves-effect">
                                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Đặt lại</span>
                                            </button>
                                            <div class="text-muted">Width:{{$configMan->width}} px - Height: {{ $configMan->height }} px ({{config('type.type_img')}})</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin {{ $configMan->title_main }}
                            </h3>
                        </div>
                        <div class="card-body card-article">
                            @if (!empty($configMan->link))
                            <div class="form-group last:!mb-0">
                                <label class="form-label" for="link">Link:</label>
                                <input type="text" class="form-control  text-sm" name="data[link]" id="name" placeholder="Link" value="{{ !empty(Flash::has('link')) ? Flash::get('link') : $item['link'] }}">
                            </div>
                            @endif
                            @if (!empty($configMan->link_video))
                            <div class="form-group last:!mb-0 mt-3">
                                <label class="form-label" for="link_video">Link video:</label>
                                <input type="text" class="form-control  text-sm" name="data[link_video]"
                                    id="name" placeholder="Link video"
                                    value="{{ !empty(Flash::has('link_video')) ? Flash::get('link_video') : $item['link_video'] }}">
                            </div>
                            @endif
                            <div class="form-group last:!mb-0">
                                @php $status_array = !empty($item['status']) ? explode(',', $item['status']) : []; @endphp
                                @if (!empty($configMan->status))
                                    @foreach ($configMan->status as $key => $value)
                                        <div class="form-group d-inline-block mb-2 me-5">
                                            <label for="{{ $key }}-checkbox" class="d-inline-block align-middle mb-0 mr-2"><?= $value ?>:</label>
                                            <label class="switch switch-success">
                                                <input type="checkbox" name="status[{{ $key }}]" class="switch-input custom-control-input show-checkbox" id="{{ $key }}-checkbox" {{ (empty($status_array) && empty($item['id']) ? 'checked' : in_array($key, $status_array)) ? 'checked' : '' }}>
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                        <i class="ti ti-check"></i>
                                                    </span>
                                                    <span class="switch-off">
                                                        <i class="ti ti-x"></i>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @if(!empty($configMan->desc) || !empty($configMan->title))
                            <div class="card">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    @foreach (config('app.langs') as $k => $v)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $k == 'vi' ? 'active' : '' }}" id="tabs-lang" data-bs-toggle="tab" data-bs-target="#tabs-lang-{{ $k }}" role="tab" aria-controls="tabs-lang-{{ $k }}" aria-selected="true">{{ $v }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    @foreach (config('app.langs') as $k => $v)
                                    <div class="tab-pane fade show {{ $k == 'vi' ? 'active' : '' }}" id="tabs-lang-{{ $k }}" role="tabpanel" aria-labelledby="tabs-lang">
                                        @if (!empty($configMan->title))
                                        <div class="form-group last:!mb-0">
                                            <label class="form-label" for="name{{ $k }}">Tiêu đề
                                                ({{ $k }})
                                                :</label>
                                            <input type="text" class="form-control for-seo text-sm" name="data[name{{ $k }}]" id="name{{ $k }}" placeholder="Tiêu đề ({{ $k }})" value="{{ !empty(Flash::has('namevi')) ? Flash::get('namevi') : $item['name' . $k] }}" required>
                                        </div>
                                        @endif
                                        @if (!empty($configMan->desc))
                                        <div class="form-group last:!mb-0">
                                            <label class="form-label" for="desc{{ $k }}">Mô tả
                                                ({{ $k }})
                                                :</label>
                                            <textarea class="form-control for-seo text-sm {{ !empty($configMan->desc_cke) ? 'form-control-ckeditor' : '' }}" name="data[desc{{ $k }}]" id="desc{{ $k }}" rows="5" placeholder="Mô tả ({{ $k }})">{{ !empty(Flash::has('desc' . $k)) ? Flash::get('desc' . $k) : @$item['desc' . $k] }}</textarea>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
            <input type="hidden" name="id" value="<?= !empty($item['id']) && $item['id'] > 0 ? $item['id'] : '' ?>">
            <input name="csrf_token" type="hidden" value="{{ csrf_token() }}">
            @component('component.buttonAdd')
            @endcomponent
        </form>
    </div>
</div>
@endsection
@pushonce('scripts')
   <script>
       function imageUploader() {
           return {
               imageSrc: '{{(!empty($item['photo']))?upload('photo',$item['photo']):assets('assets/images/noimage.png')}}',
               position_default:'{{!empty($options['position'])?$options['position']:'top-left'}}',
               noImage:'{{assets('assets/images/noimage.png')}}',
               originalSrc: '{{(!empty($item['photo']))?upload('photo',$item['photo']):assets('assets/images/noimage.png')}}',
               init() {
                   this.originalSrc = this.$refs.uploadedPhoto.src;
                   this.imageSrc = this.originalSrc;
                   this.$watch('position_default', value => {
                       this.showImageSelect(this.imageSrc);
                   });
                   if(this.imageSrc !='') this.showImageSelect(this.imageSrc);
               },
               updateImage(event) {
                   const file = event.target.files[0];
                   if (file) {
                       this.imageSrc = URL.createObjectURL(file);
                       this.showImageSelect(this.imageSrc);
                   }
               },
               resetImage() {
                   this.imageSrc = this.originalSrc;
                   this.$refs.fileInput.value = '';
                   this.showImageSelect(this.originalSrc);
               },
               validateOpacity() {
                   if (this.opacity === '') return;
                   let value = parseInt(this.opacity);
                   if (isNaN(value)) {
                       this.opacity = '';
                   } else {
                       this.opacity = Math.max(0, Math.min(100, value));
                   }
               },
               showImageSelect(img){
                   if($('#' + this.position_default).length){
                       $('input[type="radio"]').next().find('img').attr('src', this.noImage);
                       $('#' + this.position_default).next().find('img').attr('src', img);
                   }
               }
           };
       }
   </script>
@endpushonce