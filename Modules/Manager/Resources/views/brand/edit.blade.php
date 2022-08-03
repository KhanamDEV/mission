@extends('manager::layouts.app_no_sidebar')
@section('content')
    <section id="brand-new">
        <p class="text-center title-brand">@lang('manager::layer.brand.title_edit')</p>
        <form method="POST" id="edit-brand" class="wrap-form" enctype="multipart/form-data">
            <div class="box-main-new bg-white text-center">
                <div class="form-group drop-file relative">
                    <div class="active after drop-image">
                        <div class="b-drop">
                            <img src="{{asset('static/manager/images/add_image.png')}}" alt="">
                        </div>
                    </div>
                    <div class="fill"></div>
                    <input class="form-control file-upload" id="file" type="file" name="thumbnail_url">
                    <div style="background: #eef0f8 url('{{ empty($data['brand']->thumbnail_url) ? asset('static/manager/images/add_image.png') : \App\Helpers\Helpers::getUrlImg($data['brand']->thumbnail_url)}}') no-repeat top center; background-size: contain; display: block; background-position: center" class="preview"></div>
                </div>
                <button type="button" class="btn btn-color-main upload-image"
                        id="upload-image">@lang('manager::layer.brand.btn_upload_image')</button>
            </div>
            @csrf
            <div class="box-main-new bg-white">
                <div class="form-group">
                    <label for="inputName">@lang('manager::layer.brand.name')</label>
                    <input type="text" name="name" value="{{$data['brand']->name}}" id="inputName" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="inputEmail">@lang('manager::layer.auth.email')</label>
                    <input type="text" value="{{$data['brand']->email}}"  name="email" id="inputEmail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputDetail">@lang('manager::layer.brand.detail')</label>
                    <textarea name="detail" id="inputDetail" class="form-control">{{$data['brand']->detail}}</textarea>
                </div>
                @if($errors->has('editFailed'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('editFailed')}}
                    </div>
                @endif
                <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                    <button id="" type="submit" onclick="disabledForm('edit-brand')" class="btn bg-blue center">@lang('manager::layer.brand.btn_save')</button>
                    <a href="{{ route('manager.brand_show', ['id' => request()->route('id')]) }}" class="btn button-border button-edit" title="">@lang('manager::layer.brand.btn_back')</a>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\EditBrandRequest', '#edit-brand') !!}
@endsection