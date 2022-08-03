@extends('admin::layouts.auth')
@section('content')
    <!-- sign  -->
    <section id="wrap-misson">
        <div class="wrap-misson-small bg-white">
            <div class="logo">
                <a href="" title=""><img src="{{asset('static/admin/images/logo.png')}}" alt=""></a>
                <p>@lang('admin::layer.auth.for_admin')</p>

            </div>
            <form  method="post" class="wrap-form" id="sign-in">
                @csrf
                <div class="form-group">
                    <label for="email">@lang('admin::layer.auth.email')</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">@lang('admin::layer.auth.password')</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                @if($errors->has('loginFailed'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('loginFailed')}}
                    </div>
                @endif
                <button id="" type="submit" class="btn bg-blue">@lang('admin::layer.auth.button_login')</button>
                <a href="{{route('admin.forget_password')}}" title="" class="forget-password text-center">@lang('admin::layer.auth.forget_password')</a>
            </form>
        </div>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admin\Http\Requests\SignInRequest', '#sign-in') !!}
@endsection