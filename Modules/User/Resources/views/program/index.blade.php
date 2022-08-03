@extends('user::layouts.app')
@section('content')
    <section id="wrap-user">
        @if(!empty($data['programs']->items()))
        <div class="wrap-list-user bg-white">
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach ($data['programs'] as $program)
                        <tr>
                            <td class="box-name">
                                <a href="{{route('user.program_show', ['id' => $program->id])}}" title=""><img class="image-team"
                                                                                                                src="{{\App\Helpers\Helpers::getUrlImg($program->thumbnail_url)}}" alt=""></a>
                                <div class="name">
                                    <a href="{{route('user.program_show', ['id' => $program->id])}}" title="">{{$program->name}}</a>
                                    <p class="text-less">{{$program->detail}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('user.program_show', ['id' => $program->id])}}" class="control-arrow"><img
                                            src="{{asset('static/user/images/icon-arrow.png')}}" alt=""></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{$data['programs']->links('pagination')}}
            @endif
    </section>
@endsection
