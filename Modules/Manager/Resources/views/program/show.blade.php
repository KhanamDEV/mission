@extends('manager::layouts.app')
@section('content')
    <section id="wrap-misson-detail">
        <div class="box-detail bg-white">
            <div class="detail-base">
                <div class="detail-title-misson text-center">
                    <h3 class="font-bold">@lang('manager::layer.program.thumbnail_image_resize')</h3>
                </div>
                <div class="border"></div>
                <div class="line"></div>

                <div class="img-detail-misson text-center">
                    <img src="{{\App\Helpers\Helpers::getUrlImg($data['program']->thumbnail_url)}}" alt="" class="img_detail">
                </div>
                <div class="box-text">
                    <p>@lang('manager::layer.program.title') :  <span class="font-bold">{{$data['program']->name}} </span> </p>
                    <p>@lang('manager::layer.program.detail') :  <span>{{$data['program']->detail}}</span> </p>
                    <p>公開・非公開（新しくプログラムを選択できない) :  <span class="font-bold">{{$data['program']->status ? __('layer.active') : __('layer.not_active')}}</span> </p>
                </div>
            </div>
            <!--  -->
            <div class="detail-base">
                <div class="detail-title-misson text-center">
                    <h3 class="font-bold">@lang('manager::layer.program.mission')</h3>
                </div>
                <div class="border"></div>
            </div>
            <div class="wrap-list-user wrap-list-team">
                <div class="wrap-list">
                    <table class="table wrap-table misson-table">
                        <tbody>
                        @foreach($data['program_mission'] as $programMission)
                            <tr>
                                <td class="">
                                    <p class="font-bold">{{$programMission->name}}</p><p><span class="font-light">@lang('manager::layer.program.what_day') :</span> <b class="font-bold">{{$programMission->delivery_date_number}}</b></p>
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <form action="" class="wrap-form">
                <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                    <a href="{{route('manager.program_edit', ['id' => $data['program']->id])}}" class="btn button-border button-edit" title="">@lang('manager::layer.program.btn_edit') </a>
                </div>
            </form>
            <div class="line"></div>
        </div>
    </section>
    @endsection