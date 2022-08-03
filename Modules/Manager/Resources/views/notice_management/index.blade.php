@extends('manager::layouts.app')
@section('content')
    <section id="wrap-user">
        <div class="wrap-list-user bg-white">
            <div class="wrap-button text-center d-flex justify-content-center misson-base-title">
                <h2 class="font-bold">@lang('manager::layer.notice_management.list')</h2>
                <a href="{{route('manager.notice_management_create')}}" class="btn bg-blue btn-subcribe" title="">@lang('manager::layer.notice_management.create')</a>
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
                                <a href="{{route('manager.notice_management_show', ['id' => $notify->id])}}" title="">{{$notify->title}}</a>
                                <p class="text-less">{{date('Y/m/d', strtotime($notify->created_at))}}</p>
                            </div>
                        </td>
                        <td>
                            <a href="{{route('manager.notice_management_show', ['id' => $notify->id])}}" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
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