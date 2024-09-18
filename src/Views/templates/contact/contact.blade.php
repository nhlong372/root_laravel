@extends('layout')
@section('content')
    <section>
        <div class="max-width py-3">
            <div class="title-main">
                <h4><?=__('web.lienhe')?></h4>
            </div>
            <div class="content-main">
                <div class="contact-article row">
                    <div class="contact-text col-lg-6">{!! Func::decodeHtmlChars($contact['contentvi']??'') !!}</div>
                    <form class="contact-form validation-contact col-lg-6" novalidate method="post"
                        action="{{ url('lien-he-post') }}" enctype="multipart/form-data">
                        <?php $msg = Flash::get('message');
                        if($msg) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($msg as $key => $value) {
                                echo $value . '<br/>';    
                            } ?>
                        </div>
                        <?php } ?>
                        <div class="row-20 row">
                            <div class="contact-input col-sm-6 col-20 mb-3">
                                <div class="form-floating form-floating-cus">
                                    <input type="text" name="fullname" class="form-control text-sm"
                                        id="fullname-contact" placeholder="Họ tên" value="" required>
                                    <label for="fullname-contact">Họ tên</label>
                                </div>
                            </div>
                            <div class="contact-input col-sm-6 col-20 mb-3">
                                <div class="form-floating form-floating-cus">
                                    <input type="number" name="phone" class="form-control text-sm"
                                        id="phone-contact" placeholder="Số điện thoại" value="" required>
                                    <label for="phone-contact">Số điện thoại</label>
                                </div>
                            </div>
                            <div class="contact-input col-sm-6 col-20 mb-3">
                                <div class="form-floating form-floating-cus">
                                    <input type="text" class="form-control text-sm" id="address-contact"
                                        name="address" placeholder="Địa chỉ" value="" />
                                    <label for="address-contact">Địa chỉ</label>
                                </div>
                            </div>
                            <div class="contact-input col-sm-6 col-20 mb-3">
                                <div class="form-floating form-floating-cus">
                                    <input type="email" class="form-control text-sm" id="email-contact" name="email" placeholder="Email" value="" required />
                                    <label for="email-contact">Email</label>
                                </div>
                            </div>
                        </div>
                        <?php /*
                        <div class="contact-input mb-3">
                            <div class="form-floating form-floating-cus">
                                <input type="text" class="form-control text-sm" id="subject-contact"
                                    name="dataContact[subject]" placeholder="Tiêu đề" value="" />
                                <label for="subject-contact">Tiêu đề</label>
                            </div>
                            <div class="invalid-feedback">Vui lòng nhập tiêu đề</div>
                        </div>
                        <div class="contact-input mb-3">
                            <input type="file" class="form-control text-sm" name="file" />
                        </div>
                        */ ?>
                        <div class="contact-input mb-3">
                            <div class="form-floating form-floating-cus">
                                <textarea class="form-control text-sm" id="content-contact" name="content" rows="5" placeholder="Nội dung" /></textarea>
                                <label for="content-contact">Nội dung</label>
                            </div>
                        </div>
                        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-primary mr-2" name="submit-contact" value="Gửi ngay" />
                        <input type="reset" class="btn btn-secondary" value="Nhập lại" />
                        <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                    </form>
                </div>
                <div class="contact-map py-3">{!! Func::decodeHtmlChars($optSetting['coords_iframe']??'') !!}</div>
            </div>
        </div>
    </section>
@endsection