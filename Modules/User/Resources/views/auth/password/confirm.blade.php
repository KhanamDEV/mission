@extends('user::layouts.auth')
@section('content')
    <section id="wrap-send-mail">
        <div class="wrap-misson-small bg-white text-center">
            <div class="image_send"><img src="{{asset('static/user/images/Frame.png')}}" alt=""></div>
            <p class="text-send-mail ">@lang('user::layer.auth.confirm_mail')</p>
        </div>
    </section>
@endsection