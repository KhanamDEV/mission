@extends('manager::layouts.app')
@section('content')
    <section id="wrap-brand">
        <div class="wrap-brand-detail bg-white">
            <div class="wrap-button text-center title-brand-detail">
                <h2 class="font-bold">{{$data['brand']->name}}</h2>
                <a href="{{route('manager.brand_edit', ['id' => $data['brand']->id])}}" class="btn button-border auto-width button-edit button-absolute" title="">@lang('manager::layer.brand.btn_edit')</a>
            </div>
            <div class="text-center">
                <img src="{{empty($data['brand']->thumbnail_url) ? asset('static/manager/images/detail-selected.png') : \App\Helpers\Helpers::getUrlImg($data['brand']->thumbnail_url)}}" alt="" class="img_detail">
            </div>
            <div class="text-detail">
                <p><span>メールアドレス: </span>{{$data['brand']->email}}</p>
                <p><span>詳細 :</span> {{$data['brand']->detail}}</p>
            </div>
        </div>
    </section>
@endsection