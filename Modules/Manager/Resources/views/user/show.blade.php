@extends('manager::layouts.app')
@section('content')
    <section id="wrap-user-detail">
        <div class="box-detail bg-white">
            <div class="detail-user-item text-center">
                @if($data['user']->is_admin) <p class="title">管理者</p> @endif
                <img src="{{empty($data['user']->thumbnail_url) ? asset('static/manager/images/user_detail.png') : \App\Helpers\Helpers::getUrlImg($data['user']->thumbnail_url)}}" alt="" class="img_avatar_detail">
                <p class="name_user">{{$data['user']->name_sei.' '.$data['user']->name_mei."/".$data['user']->name_sei_kana.$data['user']->name_mei_kana}}</p>
                <p>{{$data['user']->department}}</p>
                <p>@lang('manager::layer.user.birthday')：{{\App\Helpers\Helpers::formatDateTime($data['user']->birthday, 'Y/m/d')}}</p>
                @if($data['user']->is_active)<p>
                        @lang('manager::layer.user.active')</p>
                    @else
                    @lang('manager::layer.user.not_active')
                    @endif
            </div>
            <div class="wrap-list-user wrap-list-team">
                <div class="wrap-list">
                    <h2 class="title-team">@lang('manager::layer.user.affiliated_team')</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['teams'] as $team)
                            @if(!$team->old)
                                <tr>
                                    <td class="box-name">
                                        <a href="{{route('manager.team_show', ['brand_id' => request()->route('brand_id'), 'id' => $team->id])}}" title=""><img src="{{empty($team->thumbnail_url) ? asset('static/manager/images/team.png') : \App\Helpers\Helpers::getUrlImg($team->thumbnail_url)}}" alt="" class="image-team"></a>
                                        <div class="name">
                                            <a href="{{route('manager.team_show', ['brand_id' => request()->route('brand_id'), 'id' => $team->id])}}" title="">{{$team->name}}</a>
                                            <p class="text-less">{{$team->detail}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('manager.team_show', ['brand_id' => request()->route('brand_id'), 'id' => $team->id])}}" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="wrap-list">
                    <h2 class="title-team">@lang('manager::layer.user.past_team')</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['teams'] as $team)
                            @if($team->old)
                                <tr>
                                    <td class="box-name">
                                        <a href="{{route('manager.team_show', ['brand_id' => request()->route('brand_id'), 'id' => $team->id])}}" title=""><img src="{{asset('static/manager/images/team.png')}}" alt="" class="image-team"></a>
                                        <div class="name">
                                            <a href="{{route('manager.team_show', ['brand_id' => request()->route('brand_id'), 'id' => $team->id])}}" title="">{{$team->name}}</a>
                                            <p class="text-less">{{$team->detail}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('manager.team_show', ['brand_id' => request()->route('brand_id'), 'id' => $team->id])}}" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="wrap-list">
                    <h2 class="title-team">@lang('manager::layer.user.list_answer')  </h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['missions'] as $mission)
                            <tr>
                                <td class="box-name">
                                    <a href="{{route('manager.user_mission_show', ['brand_id' => request()->route('brand_id'), 'user_id' => request()->route('id'), 'id' => $mission->id])}}" title="" class="misson-title">{{$mission->name}}</a>
                                </td>
                                <td>
                                    <a href="{{ route('manager.user_mission_show', ['brand_id' => request()->route('brand_id'), 'user_id' => request()->route('id'), 'id' => $mission->id]) }}" title="" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="wrap-list">
                    <h2 class="title-team">会社からのお知らせ一覧</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['brand_notifies'] as $notify)
                        <tr>
                            <td class="box-name">
                                <div class="name ml-0">
                                    <a href="{{route('manager.notification_show', ['brand_id' => request()->route('brand_id'), 'id' => $notify->id])}}" title="">{{$notify->title ?? ''}}</a>
                                    <p class="text-less">{{date('Y/m/d', strtotime($notify->created_at))}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('manager.notification_show', ['brand_id' => request()->route('brand_id'), 'id' => $notify->id])}}" class="control-arrow"><img src="{{asset('static/user/images/icon-arrow.png')}}" alt=""></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center display-list">
                        <a href="{{route('manager.user_brand_notification', ['brand_id' => request()->route('brand_id'), 'user_id' => request()->route('id')])}}" title="" class="btn btn-color-main auto-width">一覧を表示</a>
                    </div>
                </div>
                <div class="wrap-list">
                    <h2 class="title-team">アプリ運営からのお知らせ一覧 </h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['system_notifies'] as $notify)
                        <tr>
                            <td class="box-name">
                                <div class="name ml-0">
                                    <a href="{{route('manager.notice_management_show', ['id' => $notify->id])}}" title="">{{$notify->title ?? ''}}</a>
                                    <p class="text-less">{{date('Y/m/d', strtotime($notify->created_at))}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('manager.notice_management_show', ['id' => $notify->id])}}" class="control-arrow"><img src="{{asset('static/user/images/icon-arrow.png')}}" alt=""></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center display-list">
                        <a href="{{route('manager.user_system_notification', ['brand_id' => request()->route('brand_id'), 'user_id' => request()->route('id')])}}" title="" class="btn btn-color-main auto-width">一覧を表示</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="line"></div>
        <div class="line"></div>

        <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
            <button type="button" class="btn button-border"  data-toggle="modal"
                    data-target="#delete-notify" title="">@lang('manager::layer.notification.btn_delete')</button>
        </div>
    </section>
    @endsection
@section('modal')
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
@endsection
@section('script')
    <script>
        $(function (){
            $(".button-delete").click(function (){
                loading(1);
                $.ajax({
                    url: '{{route('manager.user_delete', ['brand_id' => request()->route('brand_id'), 'user_id' => request()->route('id')])}}',
                    type: 'POST',
                    data: {_token: '{{@csrf_token()}}', id: {{request()->route('id')}}},
                    success: function (res){
                        console.log(res);
                        loading()
                        if (res.meta.status == 200){
                            window.location.replace('{{route('manager.user_index', ['brand_id' => request()->route('brand_id')])}}')
                        } else{
                            window.location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection