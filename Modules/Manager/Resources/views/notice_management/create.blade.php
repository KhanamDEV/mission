@extends('manager::layouts.app_no_sidebar')
@section('content')
    <section id="brand-new">
        <p class="text-center title-brand">@lang('manager::layer.notice_management.title_create')</p>
        <form method="post" class="wrap-form" id="create-notify">
            @csrf()
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">@lang('manager::layer.notice_management.title')</label>
                    <input type="text" name="title" id="" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notice_management.description')</label>
                    <textarea name="description" id="" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notice_management.delivery_destination')</label>
                    <select name="type" class="form-control" id="">
                        @foreach(App\Helpers\Helpers::renderDestinationNotification() as $key => $destination)
                            <option value="{{$key}}">{{$destination}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group select-brand" style="display: none">
                    <label for="">@lang('manager::layer.notice_management.brand')</label>
                    <select name="brand_id" class="form-control" id="">
                        @foreach($data['brands'] as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group select-team" style="display: none">
                    <label for="">@lang('manager::layer.notice_management.team')</label>
                    <select name="team_id" class="form-control" id="">
                    </select>
                </div>
                <div class="form-group select-user" style="display: none">
                    <label for="">@lang('manager::layer.notice_management.user')</label>
                    <select name="user_id" class="form-control" id="">
                    </select>
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notice_management.url')</label>
                    <input type="text" name="url" id="" class="form-control" >
                </div>
            </div>
            @if($errors->has('createFailed'))
                <div class="alert alert-danger wrap-misson-small mt-5" role="alert">
                    {{$errors->first('createFailed')}}
                </div>
            @endif
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button id="" type="submit" class="btn bg-blue center">@lang('manager::layer.notice_management.btn_save')</button>
                <a href="{{route('manager.notice_management_index')}}" class="btn button-border button-edit" title="">@lang('manager::layer.notice_management.btn_back') </a>
            </div>
        </form>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\CreateSystemNotifyRequest', '#create-notify') !!}
@endsection
@section('script')
    <script>
        $(function (){
            $("select[name='brand_id']").change(function (){
                loading(1);
                let id = $(this).val();
                if($("select[name='type']").val() == 'team'){
                    $.ajax({
                        url: `{{route('manager.team_get_list')}}?brand_id=${id}`,
                        type: 'GET',
                        success: function (res){
                            console.log(res);
                            let html = '';
                            if (res.meta.status == 200){
                                res.response.forEach(function (element) {
                                    html += `<option value="${element.id}">${element.name}</option>`
                                });
                            }
                            $(".select-team select").html(html);
                            loading();
                        }
                    });
                }
                if($("select[name='type']").val() == 'user') {
                    $.ajax({
                        url: `{{route('manager.user_get_list')}}?brand_id=${id}`,
                        type: 'GET',
                        success: function (res){
                            console.log(res);
                            let html = '';
                            if (res.meta.status == 200){
                                res.response.forEach(function (element) {
                                    html += `<option value="${element.id}">${element.name_sei + element.name_mei}</option>`
                                });
                            }
                            $(".select-user select").html(html);
                            loading();
                        }
                    });
                }
            });

            $("select[name='type']").change(function (){
                console.log($(this).val());
                if($(this).val() == 'team'){
                    $(".select-team").show();
                    $(".select-brand").show();
                    $(".select-user").hide();
                    loading(1);
                    $.ajax({
                        url: '{{route('manager.team_get_list', ['brand_id' => $data['brands'][0]->id ] )}}',
                        type: 'GET',
                        success: function (res){
                            console.log(res);
                            let html = '';
                            if (res.meta.status == 200){
                                res.response.forEach(function (element) {
                                    html += `<option value="${element.id}">${element.name}</option>`
                                });
                            }
                            $(".select-team select").html(html);
                            loading();
                        }
                    })
                } else if($(this).val() == 'user'){
                    $(".select-team").hide();
                    $(".select-brand").show();
                    $(".select-user").show();
                    loading(1);
                    $.ajax({
                        url: `{{route('manager.user_get_list', ['brand_id' => $data['brands'][0]->id ])}}`,
                        type: 'GET',
                        success: function (res){
                            console.log(res);
                            let html = '';
                            if (res.meta.status == 200){
                                res.response.forEach(function (element) {
                                    html += `<option value="${element.id}">${element.name_sei + element.name_mei}</option>`
                                });
                            }
                            $(".select-user select").html(html);
                            loading();
                        }
                    });
                } else{
                    $(".select-brand").hide();
                    $(".select-team").hide();
                    $(".select-user").hide();
                }
            })
        });
    </script>
@endsection