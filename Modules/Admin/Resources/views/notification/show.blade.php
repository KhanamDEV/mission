@extends('admin::layouts.app')
@section('content')
    <section id="wrap-misson-detail">
        <div class="detail-base bg-white pt-0">
            <div class="detail-title-misson text-center">
                <h3 class="font-bold">@lang('admin::layer.notification.detail_brand')</h3>
            </div>
            <div class="border"></div>
            <div class="line"></div>
            <div class="box-text">
                <p>@lang('admin::layer.notification.title'): <span class="font-bold">{{$data['notify']->title ?? ''}}</span> </p>
                <p>@lang('admin::layer.notification.description') :  <span>{{$data['notify']->description ?? ''}}</span> </p>
                <p>@lang('admin::layer.notification.delivery_destination') : <span class="font-bold">{{\App\Helpers\Helpers::renderDestinationNotification($data['notify']->type)}}</span> </p>
                @if(!is_null($data['notify']->option))
                    @if(isset($data['notify']->option->team_id))
                        <p>@lang('manager::layer.notification.team') : <span class="font-bold">{{$data['notify']->option->team->name}}</span> </p>
                    @endif
                    @if(isset($data['notify']->option->user_id))
                        <p>@lang('manager::layer.notification.user') : <span class="font-bold">{{$data['notify']->option->user->name_sei.$data['notify']->option->user->name_mei}}</span> </p>
                    @endif
                @endif
                <p>@lang('admin::layer.notification.url') : <span class="font-bold">{{$data['notify']->url ?? ''}}</span> </p>
            </div>
            <div class="line"></div>
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <a href="{{route('admin.notification_edit', ['id' => $data['notify']->id])}}" class="btn button-border button-edit" title="">@lang('admin::layer.notification.btn_edit')</a>
            </div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button type="button" class="btn button-border" data-toggle="modal"
                        data-target="#delete-notify" title="">@lang('admin::layer.notification.btn_delete')</button>
            </div>
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
                        <button id="" type="submit" class="btn bg-blue center button-delete">削除する</button>
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
                    url: '{{route('admin.notification_delete', ['id' => request()->route('id')])}}',
                    type: 'POST',
                    data: {_token: '{{@csrf_token()}}', id: {{request()->route('id')}}},
                    success: function (res){
                        loading()
                        if (res.meta.status == 200){
                            window.location.replace('{{route('admin.notification_index')}}')
                        } else{
                            window.location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection


