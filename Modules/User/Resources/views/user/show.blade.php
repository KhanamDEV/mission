@extends('user::layouts.app')
@section('content')
    <section id="wrap-user-detail">
        <div class="box-detail bg-white">
            <div class="detail-user-item text-center">
                @if($data['user']->is_admin) <p class="title">管理者</p> @endif
                <img src="@if(empty($data['user']->thumbnail_url)) {{asset('static/user/images/user_detail.png')}} @else {{\App\Helpers\Helpers::getUrlImg($data['user']->thumbnail_url)}} @endif" class="image-boder-100" alt="">
                <p class="name_user">{{$data['user']->name_sei.' '.$data['user']->name_mei}}/ {{$data['user']->name_sei_kana.$data['user']->name_mei_kana}}</p>
                    <p>{{$data['user']->department}}</p>
                <p>@lang('user::layer.user.birthday')：{{\App\Helpers\Helpers::formatDateTime($data['user']->birthday, 'Y/m/d')}}</p>
                    <p>{{$data['user']->is_active ? __('user::layer.user.active') : __('user::layer.user.not_active')}}</p>
            </div>
            <div class="wrap-list-user wrap-list-team">
                <div class="wrap-list">
                    <h2 class="title-team">@lang('user::layer.user.affiliated_team')</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['teams'] as $team)
                            @if(!$team->old)
                            <tr>
                                <td class="box-name">
                                    <a href="{{route('user.team_show', ['id' => $team->id])}}" title=""><img src=" @if(!empty($team->thumbnail_url)) {{\App\Helpers\Helpers::getUrlImg($team->thumbnail_url)}} @else {{asset('static/user/images/team.png')}} @endif" alt="" class="image-team"></a>
                                    <div class="name">
                                        <a href="{{route('user.team_show', ['id' => $team->id])}}" title="">{{$team->name}}</a>
                                        <p class="text-less">{{$team->detail}}</p>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('user.team_show', ['id' => $team->id])}}" class="control-arrow"><img src="{{asset('static/user/images/icon-arrow.png')}}" alt=""></a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="wrap-list">
                    <h2 class="title-team">@lang('user::layer.user.past_team')</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['teams'] as $team)
                            @if($team->old)
                                <tr>
                                    <td class="box-name">
                                        <a href="{{route('user.team_show', ['id' => $team->id])}}" title=""><img src=" @if(!empty($team->thumbnail_url)) {{\App\Helpers\Helpers::getUrlImg($team->thumbnail_url)}} @else {{asset('static/user/images/team.png')}} @endif" alt="" class="image-team"></a>
                                        <div class="name">
                                            <a href="{{route('user.team_show', ['id' => $team->id])}}" title="">{{$team->name}}</a>
                                            <p class="text-less">{{$team->detail}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('user.team_show', ['id' => $team->id])}}" class="control-arrow"><img src="{{asset('static/user/images/icon-arrow.png')}}" alt=""></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="wrap-list">
                    <h2 class="title-team">@lang('user::layer.user.list_answer') </h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['missions'] as $mission)
                            <tr>
                                <td class="box-name">
                                    <a href="{{route('user.mission', ['id' => $mission->id, 'user_id' => $data['user']->id])}}" title="" class="misson-title">{{$mission->name}}</a>
                                </td>
                                <td>
                                    <a href="{{route('user.mission', ['id' => $mission->id, 'user_id' => $data['user']->id])}}" class="control-arrow"><img src="{{asset('static/user/images/icon-arrow.png')}}" alt=""></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if(\Illuminate\Support\Facades\Auth::guard('user')->user()->is_admin)
            <div class="line"></div>
            <div class="line"></div>

            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button type="button" class="btn button-border"  data-toggle="modal"
                        data-target="#delete-notify" title="">@lang('manager::layer.notification.btn_delete')</button>
            </div>
        @endif
    </section>
@endsection
@section('modal')
    @if(\Illuminate\Support\Facades\Auth::guard('user')->user()->is_admin)

        <div class="modal fade" id="delete-notify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content wrap-modal">
                <div class="bg-white">
                    <h2 class="mission-title">削除しますか?</h2>
                    <div class="wrap-button">
                        <button type="button" data-dismiss="modal" class="btn button-border">戻る</button>
                        <button id="" type="button" class="btn bg-blue center button-delete">削除する</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@section('script')
    @if(\Illuminate\Support\Facades\Auth::guard('user')->user()->is_admin)

        <script>
        $(function (){
            $(".button-delete").click(function (){
                loading(1);
                $.ajax({
                    url: '{{route('user.delete', ['id' => request()->route('id')])}}',
                    type: 'POST',
                    data: {_token: '{{@csrf_token()}}', id: {{request()->route('id')}}},
                    success: function (res){
                        console.log(res);
                        loading()
                        if (res.meta.status == 200){
                            window.location.replace('{{route('user.index')}}')
                        } else{
                            window.location.reload();
                        }
                    }
                })
            });
        });
    </script>
    @endif

@endsection
