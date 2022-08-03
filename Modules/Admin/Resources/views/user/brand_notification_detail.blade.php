@extends('admin::layouts.app')
@section('content')
    <section id="wrap-misson-detail">
        <div class="detail-base bg-white pt-0">
            <div class="detail-title-misson text-center">
                <h3 class="font-bold">@lang('admin::layer.notification.detail_brand')</h3>
            </div>
            <div class="border"></div>
            <div class="line"></div>
            <div class="box-text">
                <p>@lang('admin::layer.notification.title'): <span class="font-bold">{{$data['notify']->title ?? ''}}</span> </p>
                <p>@lang('admin::layer.notification.description') :  <span>{{$data['notify']->description ?? ''}}</span> </p>
                <p>@lang('admin::layer.notification.delivery_destination') : <span class="font-bold">{{\App\Helpers\Helpers::renderDestinationNotification($data['notify']->type)}}</span> </p>
                @if(!is_null($data['notify']->option))
                    @if(isset($data['notify']->option->team_id))
                        <p>@lang('manager::layer.notification.team') : <span class="font-bold">{{$data['notify']->option->team->name}}</span> </p>
                    @endif
                    @if(isset($data['notify']->option->user_id))
                        <p>@lang('manager::layer.notification.user') : <span class="font-bold">{{$data['notify']->option->user->name_sei.$data['notify']->option->user->name_mei}}</span> </p>
                    @endif
                @endif
                <p>@lang('admin::layer.notification.url') : <span class="font-bold">{{$data['notify']->url ?? ''}}</span> </p>
            </div>

        </div>
    </section>

@endsection




