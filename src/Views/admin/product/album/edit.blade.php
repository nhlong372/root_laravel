@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y container-fluid">
        <div class="app-ecommerce">
            <form class="validation-form" novalidate method="post" action="{{ url('admin',['com'=>$com,'act'=>'save','type'=>$type]) }}" enctype="multipart/form-data">

                @component('component.buttonAdd',['params'=>['gallery'=>$gallery,'id_parent'=>$id_parent]])
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
                                            <img x-ref="uploadedPhoto" :src="imageSrc"
                                                src="{{ !empty($item['photo']) ? upload('product', $item['photo']) : assets('assets/images/noimage.png') }}"
                                                alt="photoUpload" class="d-block rounded" id="uploadedphoto">
                                        </div>
                                    </div>
                                    <div class="row mb-3 last:!mb-0">
                                        <div class="col-sm-6 col-md-4 ">
                                            <div class="form-group mb-0">
                                                <div class="button-wrapper">
                                                    <label for="upload"
                                                        class="btn btn-primary me-2 mb-3 waves-effect waves-light"
                                                        tabindex="0">
                                                        <span class="d-none d-sm-block">Upload photo</span>
                                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                                        <input type="file" id="upload" @change="updateImage"
                                                            x-ref="fileInput" class="change-file-input" name="file"
                                                            hidden="" accept="image/png, image/jpeg">
                                                    </label>
                                                    <button type="button" @click="resetImage"
                                                        class="btn btn-label-secondary change-image-reset mb-3 waves-effect">
                                                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Reset</span>
                                                    </button>
                                                    <div class="text-muted">Width:{{ $configMan->width }} px - Height:
                                                        {{ $configMan->height }} px ({{ config('type.type_img') }})</div>
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
                                <h3 class="card-title">Thông tin
                                </h3>
                            </div>
                            <div class="card-body card-article">

                                <div class="form-group last:!mb-0">
                                    @php $status_array = !empty($item['status']) ? explode(',', $item['status']) : []; @endphp
                                    @if (!empty($configMan->status))
                                        @foreach ($configMan->gallery->$gallery->status_photo as $key => $value)
                                            <div class="form-group d-inline-block last:!mb-0 mb-2 me-5">
                                                <label for="{{ $key }}-checkbox"
                                                    class="d-inline-block align-middle mb-0 mr-2"><?= $value ?>:</label>
                                                <label class="switch switch-success">
                                                    <input type="checkbox" name="status[{{ $key }}]"
                                                        class="switch-input custom-control-input show-checkbox"
                                                        id="{{ $key }}-checkbox"
                                                        {{ (empty($status_array) && empty($item['id']) ? 'checked' : in_array($key, $status_array)) ? 'checked' : '' }}>
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

                                    <div class="form-group last:!mb-0">
                                        <label for="numb" class="d-inline-block align-middle mb-0 mr-2 form-label">Số thứ tự:</label>
                                        <input type="number" class="form-control form-control-mini w-25 text-left d-inline-block align-middle text-sm" min="0" name="dataMultiTemp[{{ $i }}][numb]" id="numb" placeholder="Số thứ tự" value="{{ !empty($item['numb']) ? $item['numb'] : 1 }}">
                                    </div>
                                </div>
                                @if (!empty($configMan->desc) || !empty($configMan->title))
                                    <div class="card">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tabs-lang" data-bs-toggle="tab" data-bs-target="#tabs-lang" role="tab" aria-controls="tabs-lang" aria-selected="true">Nội dung</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                            <div class="tab-pane fade show active" id="tabs-lang" role="tabpanel" aria-labelledby="tabs-lang">
                                                <div class="form-group last:!mb-0">
                                                    <label class="form-label" for="name">Tiêu đề:</label>
                                                    <input type="text" class="form-control for-seo text-sm" name="data[name]" id="name" placeholder="Tiêu đề" value="{{ !empty(Flash::has('name')) ? Flash::get('name') : $item['name'] }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= !empty($item['id']) && $item['id'] > 0 ? $item['id'] : 0 ?>">
                <input type="hidden" name="gallery" value="<?= !empty($gallery) && $gallery > 0 ? $gallery : '' ?>">
                <input type="hidden" name="id_parent" value="<?= !empty($id_parent) && $id_parent > 0 ? $id_parent : '' ?>">
                <input name="csrf_token" type="hidden" value="{{ csrf_token() }}">
                @component('component.buttonAdd',['params'=>['gallery'=>$gallery,'id_parent'=>$id_parent]]) @endcomponent
            </form>
        </div>
    </div>
@endsection


@pushonce('scripts')
    <script>
        function imageUploader() {
            return {
                imageSrc: '{{ !empty($item['photo']) ? upload('photo', $item['photo']) : assets('assets/images/noimage.png') }}',
                position_default: '{{ !empty($options['position']) ? $options['position'] : 'top-left' }}',
                noImage: '{{ assets('assets/images/noimage.png') }}',
                originalSrc: '{{ !empty($item['photo']) ? upload('photo', $item['photo']) : assets('assets/images/noimage.png') }}',
                init() {
                    this.originalSrc = this.$refs.uploadedPhoto.src;
                    this.imageSrc = this.originalSrc;
                    this.$watch('position_default', value => {
                        this.showImageSelect(this.imageSrc);
                    });
                    if (this.imageSrc != '') this.showImageSelect(this.imageSrc);
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
                showImageSelect(img) {
                    if ($('#' + this.position_default).length) {
                        $('input[type="radio"]').next().find('img').attr('src', this.noImage);
                        $('#' + this.position_default).next().find('img').attr('src', img);
                    }
                }
            };
        }
    </script>
@endpushonce
