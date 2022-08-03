@extends('admin::layouts.auth')
@section('content')
    <section id="wrap-send-mail">
        <div class="wrap-misson-small bg-white text-center">
            <div class="image_send"><img src="{{asset('static/admin/images/confirm_register.png')}}" alt=""></div>
            <form action="" class="wrap-form">
                <a class="btn btn-white margin-bottom-button" href="{{route('admin.sign_in')}}">@lang('admin::layer.auth.redirect_login')</a>
            </form>
        </div>
    </section>
@endsection