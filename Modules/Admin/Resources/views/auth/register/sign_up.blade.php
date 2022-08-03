@extends('admin::layouts.auth')
@section('content')
    <section id="wrap-misson">
        <div class="wrap-misson-small bg-white">
            <div class="logo">
                <a href="" title=""><img src="{{asset('static/admin/images/logo.png')}}" alt=""></a>
                <p>@lang('admin::layer.auth.for_admin')</p>
            </div>
            <form method="post" class="wrap-form" id="sign-up-user">
                @csrf
                <div class="form-group">
                    <label for="email">@lang('admin::layer.auth.email')</label>
                    <input type="text" value="{{old('email')}}" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">@lang('admin::layer.auth.password')</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                @if($errors->has('error_sign_up'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('error_sign_up')}}
                    </div>
                    @endif
                <button onclick="disabledForm('sign-up-user')" type="submit" class="btn bg-blue">@lang('admin::layer.auth.button_sign_up')</button>
            </form>
        </div>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admin\Http\Requests\SignUpAdminRequest', '#sign-up-user') !!}
@endsection