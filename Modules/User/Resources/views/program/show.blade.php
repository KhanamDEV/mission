@extends('user::layouts.app')
@section('content')
    @php
        $program = $data['program']['info'];
        $missions = $data['program']['mission_base'];
    @endphp
    <section id="wrap-user-detail">
        <div class="box-detail bg-white">
            <div class="detail-user-item text-center">
                <img src="{{\App\Helpers\Helpers::getUrlImg($program->thumbnail_url)}}" alt="" class="img_detail">
                <p class="name_user">{{$program->name}}</p>
                <p>{{$program->detail}}</p>
            </div>
            <div class="wrap-list-user wrap-list-team">
                <div class="wrap-list">
                    <h2 class="title-team">@lang('admin::layer.program.list')</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach ($missions as $mission)
                            <tr>
                                <td class="box-name">
                                    <a data-mission-id="{{$mission->id}}" href="" title="" data-toggle="modal" data-target="#programDetail" class="misson-title mission-show">{{$mission->name}}</a>
                                </td>
                                <td>
                                    <a data-mission-id="{{$mission->id}}" href="" data-toggle="modal" data-target="#programDetail" class="control-arrow mission-show">
                                        <img src="{{asset('static/user/images/icon-arrow.png')}}" alt="">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <div class="modal fade" id="programDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content margin-top-70">
                <div class="bg-white">
                    <div class="wrap-detail-program text-center">
                        <img class="mission-thumb mb-3 img_detail" src="" alt="" >
                        <h2 class="mission-title"></h2>
                        <p class="mission-detail"></p>
                    </div>
                    <div class="wrap-list-user wrap-list-team user-detail-mission">
                        <div class="wrap-list">
                            <h2 class="title-team target-mission"></h2>
                            <table class="table wrap-table misson-table">
                                <tbody id="list-question">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let missions = @json($missions);
        $('.mission-show').on('click', function(){
            let id = $(this).data('mission-id');
            let mission = missions.find(item => item.id  === id);
            let textTarget = mission.is_target ? 'ターゲット: あり' : 'ターゲット: なし';
            let templateQuestion = '';
            $('.target-mission').text(textTarget);
            mission.answers.forEach((value, index) =>{
                templateQuestion += '<tr>';
                templateQuestion += '<td class="box-name">';
                templateQuestion += '<div class="name">';
                templateQuestion += `<p class="title-question"> Q.${index + 1} : ${value.title} </p>`;
                templateQuestion += '</div>';
                templateQuestion += '</td>';
                templateQuestion += '</tr>';
            });
            $("tbody#list-question").html(templateQuestion);
            $('#programDetail .mission-thumb').attr('src','{{env('AWS_URL')}}' + mission.thumbnail_url);
            $('#programDetail .mission-title').html(mission.name);
            $('#programDetail .mission-detail').html(mission.detail);
            $("#programDetail").modal('show');
        });
    </script>
@endsection