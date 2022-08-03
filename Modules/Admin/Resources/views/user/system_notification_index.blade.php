@extends('admin::layouts.app')
@section('content')
    <section id="wrap-user">
        <div class="wrap-list-user bg-white">
            <div class="wrap-button text-center d-flex justify-content-center misson-base-title">
                <h2 class="font-bold">@lang('admin::layer.notification.system')</h2>
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
                                    <a href="{{route('admin.user_system_notification', ['id' => $notify->id, 'user_id' => request()->route('user_id')])}}" title="">{{$notify->title}}</a>
                                    <p class="text-less">{{date('Y/m/d', strtotime($notify->created_at))}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('admin.user_system_notification', ['id' => $notify->id, 'user_id' => request()->route('user_id')])}}" class="control-arrow"><img src="{{asset('static/admin/images/icon-arrow.png')}}" alt=""></a>
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