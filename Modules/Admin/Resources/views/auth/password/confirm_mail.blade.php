@extends('admin::layouts.auth')
@section('content')
    <section id="wrap-misson">
        <div class="wrap-misson-small bg-white">
            <div class="logo">
                <a href="" title=""><img src="{{asset('static/admin/images/logo.png')}}" alt=""></a>
                <p>@lang('admin::layer.auth.for_admin')</p>

            </div>
            <form id="forget-password" method="post" class="wrap-form">
                @csrf
                <div class="form-group">
                    <label for="email">@lang('admin::layer.auth.email')</label>
                    <input value="{{old('email')}}" type="text" name="email" id="email" class="form-control">
                </div>
                @if($errors->has('hasError'))
                    <div class="alert alert-danger" role="alert">
                        {{$errors->first('hasError')}}
                    </div>
                @endif
                <button id="" type="submit" class="btn bg-blue">@lang('admin::layer.auth.sent_confirm_mail')</button>
            </form>
        </div>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admin\Http\Requests\ConfirmMailForgetPasswordRequest', '#forget-password') !!}
@endsection