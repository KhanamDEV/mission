@extends('user::layouts.auth')
@section('content')
    <!-- sign  -->
    <section id="wrap-misson">
        <div class="wrap-misson-small bg-white">
            <div class="logo">
                <a href="" title=""><img src="{{asset('static/user/images/logo.png')}}" alt=""></a>
            </div>
            <form method="post" class="wrap-form" id="sign-in-user">
                @csrf
                <div class="form-group">
                    <label for="email">@lang('user::layer.auth.email')</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">@lang('user::layer.auth.password')</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                @if($errors->has('sign_in_false'))
                    <div class="alert alert-danger" role="alert">
                       {{$errors->first('sign_in_false')}}
                    </div>
                @endif
                <button id="" type="submit" class="btn bg-blue">@lang('user::layer.auth.button_login')</button>
                <a href="{{route('user.forget_password')}}" title="" class="forget-password text-center">@lang('user::layer.auth.forget_password')</a>
            </form>
        </div>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\User\Http\Requests\SignInRequest', '#sign-in-user') !!}

@endsection
