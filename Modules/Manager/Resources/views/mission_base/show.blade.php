@extends('manager::layouts.app')
@section('content')
    @php
        $mission = $data['mission'];
    @endphp
    <section id="wrap-misson-detail">
        <div class="detail-base bg-white">
            <div class="detail-title-misson text-center">
                <h3 class="font-bold">ミッションサムネイル画像</h3>
            </div>
            <div class="border"></div>
            <div class="line"></div>

            <div class="img-detail-misson text-center">
                <img src="{{\App\Helpers\Helpers::getUrlImg($mission->thumbnail_url ?? '')}}" alt="" class="img_detail">
            </div>
            <div class="box-text">
                <p>ID :  <span class="font-bold">{{$mission->id ?? ''}}</span> </p>
                <p>Title :  <span class="font-bold">{{$mission->name ?? ''}}</span> </p>
                <p>詳細 :  <span>{{$mission->detail ?? ''}}</span> </p>
                <p>Mission ターゲット :  <span class="font-bold">{{config('manager.mission_base.is_target.' . $mission->is_target)}}</span> </p>
                <p>所要時間 : <span></span>{{$mission->time_required ?? ''}}</p>
                <p>名前表示: {{\App\Helpers\Helpers::statusAnonymous($mission->is_anonymous)}}</p>
            </div>
            <!--  -->
            <div class="detail-title-misson text-center">
                <h3 class="font-bold">フィードバックサムネイル画像</h3>
            </div>
            <div class="border"></div>
            <div class="line"></div>

            <div class="img-detail-misson text-center">
                <img src="{{ empty($mission->feedback_base->thumbnail_url) ? asset('static/manager/images/detail-selected.png') : \App\Helpers\Helpers::getUrlImg($mission->feedback_base->thumbnail_url)}}" alt="" class="img_detail">
            </div>
            <div class="box-text">
                <p>フィードバックタイトル :  <span class="font-bold"> {{$mission->feedback_base->title ?? ''}} </span> </p>
                <p>フィードバック詳細 :  <span class="font-bold"> {{$mission->feedback_base->detail ?? ''}} </span> </p>
                <p>行動のヒントタイトル :  <span class="font-bold"> {{$mission->feedback_base->hint_title ?? ''}} </span> </p>
                <p>行動のヒント詳細 :  <span class="font-bold"> {{$mission->feedback_base->hint_detail ?? ''}} </span> </p>
            </div>
            <!--  -->
            <div class="detail-title-misson text-center">
                <h3 class="font-bold">質問</h3>
            </div>
            <div class="border"></div>
            <div class="line"></div>
            @foreach ($mission->question_bases as $question)
                <div class="box-text">
                    <p>質問タイトル :  <span class="font-bold">{{$question->title}}</span> </p>
                    <p>質問形式 :  <span class="font-bold">{{ \App\Helpers\Helpers::renderTypeQuestion($question->type) }}</span> </p>
                    <p>選択肢 :  <span class="font-bold"> {{ $question->choice}} </span> </p>
                    <p>順番 :  <span class="font-bold"> {{$question->delivery_order_number}} </span> </p>
                    <div class="border"></div>
                    <div class="line"></div>
                </div>                
            @endforeach

            <div class="line"></div>
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <a href="{{route('manager.mission_base.edit', $mission->id)}}" class="btn button-border button-edit" title="">変更する </a>
            </div>
        </div>
    </section>
    @endsection