@extends('admin::layouts.app_no_sidebar')
@section('content')
    <section id="brand-new">
        <p class="text-center title-brand">@lang('admin::layer.notification.title_edit')</p>
        <form method="POST" class="wrap-form" id="edit-brand-notify">
            @csrf()
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">@lang('admin::layer.notification.title')</label>
                    <input type="text" name="title" id="" value="{{$data['notify']->title ?? ''}}" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">@lang('admin::layer.notification.description')</label>
                    <textarea name="description" id="" class="form-control">{{$data['notify']->description ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">@lang('admin::layer.notification.delivery_destination')</label>
                    <select name="type" class="form-control" id="">
                        @foreach(App\Helpers\Helpers::renderDestinationNotification() as $key => $destination)
                            <option @if($data['notify']->type == $key) selected @endif value="{{$key}}">{{$destination}}</option>
                        @endforeach
                    </select>
                </div>
                @php
                    $option = isset($data['notify']->option) ? @json_decode($data['notify']->option) : [];
                    $user_id_selected = !empty($option) ? ($option->user_id ?? null) : null;
                    $team_id_selected = !empty($option) ? ($option->team_id ?? null) : null;
                @endphp
                <div class="form-group select-team" @if($data['notify']->type != 'team') style="display: none" @endif>
                    <label for="">@lang('admin::layer.notification.delivery_destination')</label>
                    <select name="team_id" class="form-control" id="">
                        @foreach($data['teams'] as $team)
                            <option @if(isset($team_id_selected)) @if((int) $team_id_selected == $team->id) selected  @endif @endif  value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group select-user" @if($data['notify']->type != 'user') style="display: none" @endif>
                    <label for="">@lang('admin::layer.notification.delivery_destination')</label>
                    <select name="user_id" class="form-control" id="">
                        @foreach($data['users'] as $user)
                            <option @if(isset($user_id_selected)) @if((int)$user_id_selected == $user->id) selected  @endif @endif  value="{{$user->id}}">{{$user->name_sei.$user->name_mei.'/'.$user->name_sei_kana.$user->name_mei_kana}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">@lang('admin::layer.notification.url')</label>
                    <input type="text" name="url" id="" value="{{$data['notify']->url}}" class="form-control" placeholder="URL">
                </div>
            </div>
            @if($errors->has('updateFailed'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('updateFailed')}}
                </div>
            @endif
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button id="" type="submit" class="btn bg-blue center">@lang('admin::layer.notification.btn_save')</button>
                <a href="{{route('admin.notification_show', ['id' => $data['notify']->id])}}" class="btn button-border button-edit" title="">@lang('admin::layer.notification.btn_back') </a>
            </div>
        </form>
    </section>
@endsection
@section('validation')
    {!! JsValidator::formRequest('Modules\Admin\Http\Requests\UpdateNotificationRequest', '#edit-brand-notify') !!}
@endsection
@section('scripts')
    <script>
        $(function (){
            $("select[name='type']").change(function (){
                console.log($(this).val());
                if($(this).val() == 'team'){
                    $(".select-team").show();
                    $(".select-user").hide();
                } else if($(this).val() == 'user'){
                    $(".select-team").hide();
                    $(".select-user").show();
                } else{
                    $(".select-team").hide();
                    $(".select-user").hide();
                }
            })
        });
    </script>
@endsection