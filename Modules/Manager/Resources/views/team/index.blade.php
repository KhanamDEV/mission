@extends('manager::layouts.app')
@section('content')
    <section id="wrap-team">
        @if(!empty($data['teams']->items()))
        <div class="wrap-list-user bg-white">
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($data['teams'] as $team)
                        <tr>
                            <td class="box-name">
                                <a href="{{route('manager.team_show', ['brand_id' => $team->brand_id, 'id' => $team->id])}}" title=""><img src="{{!empty($team->thumbnail_url) ? \App\Helpers\Helpers::getUrlImg($team->thumbnail_url) : asset('static/manager/images/team.png')}}" alt="" class="image-team"></a>
                                <div class="name">
                                    <a href="{{route('manager.team_show', ['brand_id' => $team->brand_id, 'id' => $team->id])}}" title="">{{$team->name}}</a>
                                    <p class="text-less">{{$team->detail}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('manager.team_show', ['brand_id' => $team->brand_id, 'id' => $team->id])}}" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$data['teams']->links('pagination')}}
            @endif
    </section>
    @endsection