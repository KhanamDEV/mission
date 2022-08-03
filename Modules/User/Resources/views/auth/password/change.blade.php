@extends('user::layouts.auth')
@section('content')
    <section id="wrap-misson">
        <div class="wrap-misson-small bg-white">
            <div class="logo">
                <a href="" title=""><img src="{{asset('static/user/images/logo.png')}}" alt=""></a>
            </div>
            <form id="confirm-mail" autocomplete="off" method="post" class="wrap-form">
                @csrf
                <div class="form-group">
                    <label for="">@lang('user::layer.auth.password')</label>
                    <input type="password" name="password" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">@lang('user::layer.auth.password_confirm')</label>
                    <input type="password" name="password_confirmation" id="" class="form-control">
                </div>
                <button id="" type="submit" class="btn bg-blue">@lang('user::layer.auth.button_change')</button>
            </form>
        </div>
    </section>

@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\User\Http\Requests\ForgetPasswordRequest', '#confirm-mail') !!}
@endsection
