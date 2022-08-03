@extends('manager::layouts.app_no_sidebar')
@section('content')
    <section id="brand-new">
        <p class="text-center title-brand">@lang('manager::layer.notice_management.title_edit')</p>
        <form method="post" class="wrap-form" id="edit-notify">
            @csrf()
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">@lang('manager::layer.notice_management.title')</label>
                    <input type="text" value="{{$data['notify']->title ?? ''}}" name="title" id="" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notice_management.description')</label>
                    <textarea name="description" id="" class="form-control">{{$data['notify']->description ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notice_management.delivery_destination')</label>
                    <select name="type" class="form-control" id="">
                        @foreach(App\Helpers\Helpers::renderDestinationNotification() as $key => $destination)
                            <option @if($data['notify']->type == $key) selected @endif value="{{$key}}">{{$destination}}</option>
                        @endforeach
                    </select>
                </div>
                @php
                    $option = $data['notify']->option;
                @endphp
                
                <div class="form-group select-brand" @if(!isset($option->brand_id)) style="display:none;" @endif >
                    <label for="">@lang('manager::layer.notice_management.brand')</label>
                    <select name="brand_id" class="form-control" id="">
                        @foreach($data['brands'] as $brand)
                            <option @if(isset($option->brand_id)) @if($option->brand_id == $brand->id) selected @endif @endif value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group select-team" @if(!isset($option->team_id)) style="display: none" @endif>
                    <label for="">@lang('manager::layer.notice_management.team')</label>
                    <select name="team_id" class="form-control" id="">
                    </select>
                </div>

                <div class="form-group select-user" @if(!isset($option->user_id)) style="display:none;" @endif>
                    <label for="">@lang('manager::layer.notice_management.user')</label>
                    <select name="user_id" class="form-control" id="">
                    </select>
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.notice_management.url')</label>
                    <input type="text" value="{{$data['notify']->url}}" name="url" id="" class="form-control" >
                </div>
            </div>
            @if($errors->has('updateFailed'))
                <div class="alert alert-danger wrap-misson-small mt-5" role="alert">
                    {{$errors->first('updateFailed')}}
                </div>
            @endif
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button id="" type="submit" class="btn bg-blue center">@lang('manager::layer.notice_management.btn_save')</button>
                <a href="{{route('manager.notice_management_show', ['id' => $data['notify']->id])}}" class="btn button-border button-edit" title="">@lang('manager::layer.notice_management.btn_back') </a>
            </div>
        </form>
    </section>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\EditSystemNotifyRequest', '#edit-notify') !!}
@endsection
@section('script')
    <script>
        $(function (){
            @php
                $option = $data['notify']->option;
            @endphp
            let type = '{{$data['notify']->type ?? ''}}';
            if (type == 'team'){
                loading(1)
                    let brand_id = '{{$option->brand_id ?? ''}}';
                    let team_id = '{{$option->team_id ?? ''}}';
                    $.ajax({
                        url: `{{route('manager.team_get_list')}}?brand_id=${brand_id}`,
                        type: 'GET',
                        success: function (res){
                            console.log(res);
                            let html = '';
                            if (res.meta.status == 200){
                                res.response.forEach(function (element) {
                                    html += `<option ${element.id == team_id ? 'selected' : '' }  value="${element.id}">${element.name}</option>`
                                });
                            }
                            $(".select-team select").html(html);
                            loading();
                        }
                    });
            }
            if (type == 'user'){
                loading(1);
                let brand_id = '{{$option->brand_id ?? ''}}';
                let user_id = '{{$option->user_id ?? ''}}';
                    $.ajax({
                        url: `{{route('manager.user_get_list')}}?brand_id=${brand_id}`,
                        type: 'GET',
                        success: function (res){
                            console.log(res);
                            let html = '';
                            if (res.meta.status == 200){
                                res.response.forEach(function (element) {
                                    html += `<option ${element.id == user_id ? 'selected' : '' } value="${element.id}">${element.name_sei + element.name_mei}</option>`
                                });
                            }
                            $(".select-user select").html(html);
                            loading();
                        }
                    });
            }
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