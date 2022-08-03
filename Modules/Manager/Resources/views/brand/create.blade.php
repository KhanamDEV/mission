@extends('manager::layouts.app_no_sidebar')
@section('content')
    <section id="brand-new">
        <p class="text-center title-brand">@lang('manager::layer.brand.title_create')</p>
        <form method="POST" enctype="multipart/form-data" class="wrap-form" id="create-brand">
            @csrf
            <div class="box-main-new bg-white text-center">
                <div class="form-group drop-file relative">
                    <div class="active after drop-image">
                        <div class="b-drop">
                            <img src="{{asset('static/manager/images/add_image.png')}}" alt="">
                        </div>
                    </div>
                    <div class="fill"></div>
                    <input class="form-control file-upload" id="file" type="file" name="thumbnail_url">
                    <div class="preview"></div>
                </div>
                <button type="button" class="btn btn-color-main upload-image"
                        id="upload-image">@lang('manager::layer.brand.btn_upload_image')</button>
            </div>
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="inputEmail">@lang('manager::layer.auth.email')</label>
                    <input type="text"  name="email" id="inputEmail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputPassword">@lang('manager::layer.auth.password')</label>
                    <input type="text" name="password" id="inputPassword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputName">@lang('manager::layer.brand.name')</label>
                    <input type="text"  name="name" id="inputName" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputDetail">@lang('manager::layer.brand.detail')</label>
                    <textarea name="detail" id="inputDetail" class="form-control"></textarea>
                </div>
                @if($errors->has('createFailed'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('createFailed')}}
                    </div>
                @endif
                <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                    <button id="" type="submit" onclick="disabledForm('create-brand')" class="btn bg-blue center">@lang('manager::layer.brand.btn_save')</button>
                    <a href="{{ route('manager.brand_index')  }}" class="btn button-border button-edit" title="">@lang('manager::layer.brand.btn_back')</a>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\CreateBrandRequest', '#create-brand') !!}
@endsection