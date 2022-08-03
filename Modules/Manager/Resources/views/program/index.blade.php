@extends('manager::layouts.app')
@section('content')
    <section id="wrap-team">
        <div class="wrap-list-user bg-white">
            <div class="wrap-button text-center padding-table">
                <a href="{{route('manager.program_create')}}" class="btn bg-blue btn-subcribe" title="">@lang('manager::layer.program.new') </a>
            </div>
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($data['programs'] as $program)
                        <tr>
                            <td class="box-name">
                                <a href="{{route('manager.program_show', ['id' => $program->id])}}" title=""><img src="{{\App\Helpers\Helpers::getUrlImg($program->thumbnail_url)}}" alt="" class="image-team"></a>
                                <div class="name">
                                    <a href="{{route('manager.program_show', ['id' => $program->id])}}" title="">{{$program->name}}</a>
                                    <p class="text-less">{{$program->detail}}</p>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('manager.program_show', ['id' => $program->id])}}" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$data['programs']->links('pagination')}}
    </section>
    @endsection