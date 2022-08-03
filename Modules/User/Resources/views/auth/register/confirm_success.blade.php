@extends('user::layouts.auth')
@section('content')
    <section id="wrap-send-mail">
        <div class="wrap-misson-small bg-white text-center">
            <div class="image_send"><img src="{{asset('static/user/images/Frame.png')}}" alt=""></div>
            <p class="text-send-mail ">@lang('user::layer.auth.confirmed_mail')</p>
            <form action="" class="wrap-form">
                <a class="btn btn-white margin-bottom-button" href="">@lang('user::layer.auth.redirect_login')</a>
            </form>
        </div>
    </section>
@endsection