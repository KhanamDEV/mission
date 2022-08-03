@extends('admin::layouts.app')
@section('content')
    <section id="wrap-user">
        <div class="wrap-list-user bg-white">
            <div class="wrap-button text-center d-flex justify-content-center misson-base-title">
                <h2 class="font-bold">@lang('admin::layer.notification.list')</h2>
                <a href="{{route('admin.notification_create')}}" class="btn bg-blue btn-subcribe" title="">@lang('admin::layer.notification.create')</a>
            </div>
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($data['notifies'] as $notify)
                    <tr>
                        <td class="box-name">
                            <div class="name ml-0">
                                <a href="{{route('admin.notification_show', ['id' => $notify->id])}}" title="">{{$notify->title}}</a>
                                <p class="text-less">{{date('Y/m/d', strtotime($notify->created_at))}}</p>
                            </div>
                        </td>
                        <td>
                            <a href="{{route('admin.notification_show', ['id' => $notify->id])}}" class="control-arrow"><img src="{{asset('static/admin/images/icon-arrow.png')}}" alt=""></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$data['notifies']->links('pagination')}}
    </section>

@endsection