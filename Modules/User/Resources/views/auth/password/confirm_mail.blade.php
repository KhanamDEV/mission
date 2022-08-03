@extends('user::layouts.auth')
@section('content')
    <section id="wrap-misson">
        <div class="wrap-misson-small bg-white">
            <div class="logo">
                <a href="" title=""><img src="{{asset('static/user/images/logo.png')}}" alt=""></a>
            </div>
            <form id="confirm-mail" method="post" class="wrap-form">
                @csrf
                <div class="form-group">
                    <label for="email">@lang('user::layer.auth.email')</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                @if($errors->has('hasError'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('hasError')}}
                    </div>
                @endif
                <button id="" type="submit" class="btn bg-blue">@lang('user::layer.auth.sent_confirm_mail')</button>
            </form>
        </div>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\User\Http\Requests\ConfirmMailForgetPasswordRequest', '#confirm-mail') !!}
@endsection
