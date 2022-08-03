@extends('manager::layouts.app')
@section('content')
    <section id="wrap-user">
        <div class="wrap-list-user bg-white">
            <div class="wrap-button text-center padding-table">
                @if(!empty($data['users']->count()))
                    <a href="{{route('manager.user_edit', ['brand_id' => request()->route('brand_id')])}}" class="btn button-border auto-width button-absolute" title="">@lang('manager::layer.user.update')</a>
                @else
                    <a href="{{route('manager.user_create', ['brand_id' => request()->route('brand_id')])}}" class="btn bg-blue auto-width" title="">@lang('manager::layer.user.new')</a>
                @endif
            </div>
            <div class="border"></div>
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($data['users'] as $user)
                        <tr>
                            <td class="box-name">
                                <a href="{{route('manager.user_show', ['brand_id' => request()->route('brand_id'), 'id' => $user->id ])}}" title=""><img src="{{empty($user->thumbnail_url) ? asset('static/user/images/user_detail.png') : \App\Helpers\Helpers::getUrlImg($user->thumbnail_url)}}" alt=""></a>
                                <div class="name">
                                    <a href="{{route('manager.user_show', ['brand_id' => request()->route('brand_id'), 'id' => $user->id ])}}" title="">{{$user->name_sei.$user->name_mei."/".$user->name_sei_kana.$user->name_mei_kana}}</a>
                                    <p class="text-less">{{$user->detail}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('manager.user_show', ['brand_id' => request()->route('brand_id'), 'id' => $user->id ])}}" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
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