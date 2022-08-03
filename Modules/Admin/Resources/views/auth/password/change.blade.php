@extends('admin::layouts.auth')
@section('content')
    <section id="wrap-misson">
        <div class="wrap-misson-small bg-white">
            <div class="logo">
                <a href="" title=""><img src="{{asset('static/admin/images/logo.png')}}" alt=""></a>
                <p>@lang('admin::layer.auth.for_admin')</p>
            </div>
            <form id="form-change-password" autocomplete="off" method="post" class="wrap-form">
                @csrf
                <div class="form-group">
                    <label for="">@lang('admin::layer.auth.password')</label>
                    <input type="password"  autocomplete="false" name="password" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">@lang('admin::layer.auth.password_confirm')</label>
                    <input type="password" autocomplete="false" name="password_confirmation" id="" class="form-control">
                </div>
                @if($errors->has('hasError'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('hasError')}}
                    </div>
                @endif
                <button id="" type="submit" class="btn bg-blue">@lang('admin::layer.auth.button_change')</button>
            </form>
        </div>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admin\Http\Requests\ForgetPasswordRequest', '#form-change-password') !!}
@endsection