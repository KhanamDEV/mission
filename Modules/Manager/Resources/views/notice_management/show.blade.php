@extends('manager::layouts.app')
@section('content')
    <section id="wrap-misson-detail">
        <div class="detail-base bg-white pt-0">
            <div class="detail-title-misson text-center">
                <h3 class="font-bold">@lang('manager::layer.notice_management.detail')</h3>
            </div>
            <div class="border"></div>
            <div class="line"></div>
            <div class="box-text">
                <p>@lang('manager::layer.notice_management.title'): <span class="font-bold">{{$data['notify']->title ?? ''}}</span> </p>
                <p>@lang('manager::layer.notice_management.description') :  <span>{{$data['notify']->description ?? ''}}</span> </p>
                <p>@lang('manager::layer.notice_management.delivery_destination') : <span class="font-bold">{{\App\Helpers\Helpers::renderDestinationNotification($data['notify']->type)}}</span> </p>
                @if(!is_null($data['notify']->option))
                    @if(isset($data['notify']->option->brand_id))
                        <p>@lang('manager::layer.notice_management.brand') : <span class="font-bold">{{$data['notify']->option->brand->name}}</span> </p>
                    @endif
                    @if(isset($data['notify']->option->team_id))
                        <p>@lang('manager::layer.notice_management.team') : <span class="font-bold">{{$data['notify']->option->team->name}}</span> </p>
                    @endif
                    @if(isset($data['notify']->option->user_id))
                        <p>@lang('manager::layer.notice_management.user') : <span class="font-bold">{{$data['notify']->option->user->name_sei.$data['notify']->option->user->name_mei}}</span> </p>
                    @endif
                @endif
                <p>@lang('manager::layer.notice_management.url') : <span class="font-bold">{{$data['notify']->url ?? ''}}</span> </p>
            </div>
            <div class="line"></div>
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <a href="{{route('manager.notice_management_edit', [ 'id' => request()->route('id')])}}" class="btn button-border button-edit" title="">@lang('manager::layer.notice_management.btn_edit')</a>
            </div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button type="button" class="btn button-border" title="" data-toggle="modal"
                data-target="#delete-notify">@lang('manager::layer.notice_management.btn_delete')</button>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <div class="modal fade" id="delete-notify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content wrap-modal">
                <div class="bg-white">
                    <h2 class="mission-title">???????????????????</h2>
                    <div class="wrap-button">
                        <button type="button" data-dismiss="modal" class="btn button-border">??????</button>
                        <button id="" type="submit" class="btn bg-blue center button-delete">????????????</button>
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
                    url: '{{route('manager.notice_management_delete')}}',
                    type: 'POST',
                    data: {_token: '{{@csrf_token()}}', id: {{request()->route('id')}}},
                    success: function (res){
                        loading()
                        if (res.meta.status == 200){
                            window.location.replace('{{route('manager.notice_management_index')}}');
                        } else{
                            window.location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection
