@extends('manager::layouts.auth')
@section('content')
    <section id="wrap-misson">
        <div class="wrap-misson-small bg-white">
            <div class="logo">
                <a href="" title=""><img src="{{asset('static/manager/images/logo.png')}}" alt=""></a>
            </div>
            <form  method="post" class="wrap-form" id="sign-in">
                @csrf
                <div class="form-group">
                    <label for="inputEmail">@lang('manager::layer.auth.email')</label>
                    <input type="text" name="email" id=inputEmail"" class="form-control input-login" placeholder="mission@example.com">
                </div>
                <div class="form-group">
                    <label for="inputPassword">@lang('manager::layer.auth.password')</label>
                    <input type="password" name="password" id="inputPassword" class="form-control input-login">
                </div>
                @if($errors->has('signInFailed'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('signInFailed')}}
                    </div>
                @endif
                <button id="" type="submit" class="btn bg-blue">@lang('manager::layer.auth.button_login')</button>
            </form>
        </div>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\SignInRequest', '#sign-in') !!}
@endsection