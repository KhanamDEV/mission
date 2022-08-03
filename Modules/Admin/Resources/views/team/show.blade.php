@extends('admin::layouts.app')
@section('content')
    <section id="wrap-user-detail">
        <div class="box-detail bg-white">
            <div class="detail-user-item text-center">
                <img src="{{ !empty($data['team']->thumbnail_url) ? App\Helpers\Helpers::getUrlImg($data['team']->thumbnail_url) : asset('static/manager/images/team.png')}}" alt="" class="img_detail">
                <p class="name_user">{{$data['team']->name}}</p>
                <p>{{$data['team']->detail}}</p>
                <p>@lang('admin::layer.team.time_create')：{{\App\Helpers\Helpers::formatDateTime($data['team']->created_at, 'Y/m/d')}}</p>
            </div>
            <div class="wrap-list-user wrap-list-team">
                <div class="wrap-list">
                    <h2 class="title-team">@lang('admin::layer.team.selected_program')</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        <tr>
                            <td class="box-name">
                                <a href="" title=""><img src="{{empty($data['program']->thumbnail_url) ? asset('static/admin/images/team.png') : \App\Helpers\Helpers::getUrlImg($data['program']->thumbnail_url)}}" alt="" class="image-team"></a>
                                <div class="name">
                                    <a href="{{ route('admin.program_show',['id' => $data['program']->id]) }}" title="">{{$data['program']->name ?? ''}}</a>
                                    <p class="text-less">{{$data['program']->detail ?? ''}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.program_show',['id' => $data['program']->id]) }}" class="control-arrow" title=""><img src="{{asset('static/admin/images/icon-arrow.png')}}" alt=""></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="wrap-list">
                    <h2 class="title-team">@lang('admin::layer.team.program_history')</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        <tr>
                            <td class="box-name list-image">
                                @foreach($data['program_history'] as $programHistory)
                                    <a href="{{route('admin.program_show',['id' => $programHistory->id])}}" title=""><img src="@if(empty($programHistory->thumbnail_url)) {{asset('static/admin/images/team.png')}} @else {{\App\Helpers\Helpers::getUrlImg($programHistory->thumbnail_url)}} @endif" alt="" class="image-team"></a>
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="wrap-list">
                    <h2 class="title-team">@lang('admin::layer.team.members')  </h2>
                    <div class="wrap-table-team">
                        <table class="table wrap-table misson-table team-show">
                            <tbody>
                            @foreach($data['users'] as $user)
                                <tr>
                                    <td class="box-name">
                                        <a href="{{route('admin.user_show', ['id' => $user->id])}}" title=""><img src="{{empty($user->thumbnail_url) ? asset('static/user/images/user_detail.png') : \App\Helpers\Helpers::getUrlImg($user->thumbnail_url) }}" alt=""></a>
                                        <div class="name">
                                            <a href="{{route('admin.user_show', ['id' => $user->id])}}" title="">{{$user->name_sei.$user->name_mei."/".$user->name_sei_kana.$user->name_mei_kana}}</a>
                                            <p class="text-less">{{$user->detail}}</p>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="name">
                                            <a href="{{route('admin.user_show', ['id' => $user->id])}}" title="">{{$user->department}}</a>
                                            <p>ミッション進捗  {{$user->answered}} / {{$user->quantity}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.user_show', ['id' => $user->id])}}" class="control-arrow" title=""><img src="{{asset('static/admin/images/icon-arrow.png')}}" alt=""></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
