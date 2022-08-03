@extends('manager::layouts.app')
@section('content')
    <section id="mission-base">
        <div class="wrap-list-user bg-white">
            <div class="wrap-button text-center d-flex justify-content-center misson-base-title">
                <h2 class="font-bold">ミッションベース一覧</h2>
                <a href="{{route('manager.mission_base.create')}}" class="btn bg-blue btn-subcribe" title="">新規登録 </a>
            </div>
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                        @foreach ($data['missions'] as $mission)
                            <tr>
                                <td class="box-name">
                                    <a href="{{route('manager.mission_base.show', $mission->id)}}" title=""><img src="{{App\Helpers\Helpers::getUrlImg($mission->thumbnail_url ?? '')}}" alt="" class="image-team"></a>
                                    <div class="name d-flex align-items-center">
                                        <a href="{{route('manager.mission_base.show', $mission->id)}}" title="">{{$mission->name}}</a>
                                    </div>
                                </td>
                                <td class="font-bold">ID: {{$mission->id}}</td>
                                <td>
                                    <a href="{{route('manager.mission_base.show', $mission->id)}}" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$data['missions']->links('pagination')}}
    </section>
@endsection