@extends('user::layouts.app')
@section('content')
    <section id="wrap-user">
        <div class="wrap-list-user bg-white">
            @if(\Illuminate\Support\Facades\Auth::guard('user')->user()->is_admin)
            <div class="wrap-button text-center padding-table">
                    <a href="{{route('user.edit')}}" class="btn button-border auto-width button-absolute" title="">@lang('manager::layer.user.update')</a>
            </div>
            @endif
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($data['users'] as $user)
                        <tr>
                            <td class="box-name">
                                <a href="{{route('user.show', ['id' => $user->id])}}" title=""><img
                                            src="@if(empty($user->thumbnail_url)) {{asset('static/user/images/user_detail.png')}} @else {{\App\Helpers\Helpers::getUrlImg($user->thumbnail_url)}} @endif" alt=""></a>
                                <div class="name">
                                    <a href="{{route('user.show', ['id' => $user->id])}}" title="">{{$user->name_sei.$user->name_mei."/".$user->name_sei_kana.$user->name_mei_kana}}</a>
                                    <p class="text-less">{{$user->detail}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('user.show', ['id' => $user->id])}}" class="control-arrow"><img
                                            src="{{asset('static/user/images/icon-arrow.png')}}" alt=""></a>
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
