@extends('manager::layouts.app')
@section('content')
    <section id="wrap-misson-detail">
        <div class="detail-base bg-white pt-0">
            <div class="detail-title-misson text-center">
                <h3 class="font-bold">@lang('manager::layer.notice_management.detail')</h3>
            </div>
            <div class="border"></div>
            <div class="line"></div>
            <div class="box-text">
                <p>@lang('manager::layer.notice_management.title'): <span class="font-bold">{{$data['notify']->title ?? ''}}</span> </p>
                <p>@lang('manager::layer.notice_management.description') :  <span>{{$data['notify']->description ?? ''}}</span> </p>
                <p>@lang('manager::layer.notice_management.delivery_destination') : <span class="font-bold">{{\App\Helpers\Helpers::renderDestinationNotification($data['notify']->type)}}</span> </p>
                @if(!is_null($data['notify']->option))
                    @if(isset($data['notify']->option->brand_id))
                        <p>@lang('manager::layer.notice_management.brand') : <span class="font-bold">{{$data['notify']->option->brand->name}}</span> </p>
                    @endif
                    @if(isset($data['notify']->option->team_id))
                        <p>@lang('manager::layer.notice_management.team') : <span class="font-bold">{{$data['notify']->option->team->name}}</span> </p>
                    @endif
                    @if(isset($data['notify']->option->user_id))
                        <p>@lang('manager::layer.notice_management.user') : <span class="font-bold">{{$data['notify']->option->user->name_sei.$data['notify']->option->user->name_mei}}</span> </p>
                    @endif
                @endif
                <p>@lang('manager::layer.notice_management.url') : <span class="font-bold">{{$data['notify']->url ?? ''}}</span> </p>
            </div>
        </div>
    </section>
@endsection
