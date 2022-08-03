@extends('admin::layouts.app')
@section('content')
    <section id="wrap-user">
        <div class="wrap-list-user bg-white">
            <div class="wrap-button text-center padding-table">
                @if(!empty($data['users']->count()))
                    <a href="{{route('admin.user_edit')}}" class="btn button-border auto-width" title="">@lang('admin::layer.user.update')</a>
                @else
                    <a href="{{route('admin.user_create')}}" class="btn bg-blue auto-width" title="">@lang('admin::layer.user.new') </a>
                @endif
            </div>
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($data['users'] as $user)
                        <tr>
                            <td class="box-name">
                                <a href="{{route('admin.user_show', ['id' => $user->id])}}" title=""><img
                                            src="{{empty($user->thumbnail_url) ? asset('static/user/images/user_detail.png') : \App\Helpers\Helpers::getUrlImg($user->thumbnail_url) }}" alt=""></a>
                                <div class="name">
                                    <a href="{{route('admin.user_show', ['id' => $user->id])}}" title="">{{$user->name_sei.$user->name_mei."/".$user->name_sei_kana.$user->name_mei_kana}}</a>
                                    <p class="text-less">{{$user->detail}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('admin.user_show', ['id' => $user->id])}}" class="control-arrow"><img
                                            src="{{asset('static/admin/images/icon-arrow.png')}}" alt=""></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$data['users']->links('pagination')}}

    </section>
@endsection
