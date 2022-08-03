@extends('manager::layouts.app_no_sidebar')
@section('content')
    <section id="brand-new">
        <p class="text-center title-brand">@lang('manager::layer.notification.title_create')</p>
        <form method="POST" class="wrap-form" id="create-brand-notify">
            @csrf()
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">@lang('manager::layer.notification.title')</label>
                    <input type="text" name="title" id="" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notification.description')</label>
                    <textarea name="description" id="" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notification.delivery_destination')</label>
                    <select name="type" class="form-control" id="">
                        @foreach(App\Helpers\Helpers::renderDestinationNotification() as $key => $destination)
                            <option value="{{$key}}">{{$destination}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group select-team" style="display: none">
                    <label for="">@lang('manager::layer.notification.team')</label>
                    <select name="team_id" class="form-control" id="">
                        @foreach($data['teams'] as $team)
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group select-user" style="display: none">
                    <label for="">@lang('manager::layer.notification.user')</label>
                    <select name="user_id" class="form-control" id="">
                        @foreach($data['users'] as $user)
                            <option value="{{$user->id}}">{{$user->name_sei.$user->name_mei.'/'.$user->name_sei_kana.$user->name_mei_kana}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notification.url')</label>
                    <input type="text" name="url" id="" class="form-control" >
                </div>
            </div>
            @if($errors->has('createFailed'))
                <div class="alert alert-danger wrap-misson-small mt-5" role="alert">
                    {{$errors->first('createFailed')}}
                </div>
            @endif
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button id="" type="submit" class="btn bg-blue center">@lang('manager::layer.notification.btn_save')</button>
                <a href="{{route('manager.notification_index', ['brand_id' => request()->route('brand_id')])}}" class="btn button-border button-edit" title="">@lang('manager::layer.notification.btn_back') </a>
            </div>
        </form>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\CreateBrandNotifyRequest', '#create-brand-notify') !!}
@endsection
@section('script')
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