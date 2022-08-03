@extends('manager::layouts.app_no_sidebar')
@section('content')
    <section id="brand-new">
        <p class="text-center title-brand">@lang('manager::layer.program.create_title')</p>
        <form method="POST" enctype="multipart/form-data" class="wrap-form" id="form-create-program">
            @csrf
            <div class="box-main-new bg-white text-center">
                <div class="form-group drop-file relative">
                    <div class="active after drop-image">
                        <div class="b-drop">
                            <img src="{{asset('static/manager/images/add_image.png')}}" alt="">
                        </div>
                    </div>
                    <div class="fill"></div>
                    <input class="form-control file-upload" id="file" type="file" name="thumbnail_url">
                    <div class="preview"></div>
                </div>
                <button type="button" class="btn btn-color-main upload-image">@lang('manager::layer.program.upload_image')</button>
            </div>
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">@lang('manager::layer.program.title')</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">@lang('manager::layer.program.detail')</label>
                    <textarea name="detail" id="" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <select name="status" id="" class="form-control">
                        <option value="1">@lang('layer.active')</option>
                        <option value="0">@lang('layer.not_active')</option>
                    </select>
                </div>
            </div>
            <p class="text-center title-brand">@lang('manager::layer.program.mission') <a href="#" class="btn auto-width btn-white" data-toggle="modal"
                                                        data-target="#new-program">@lang('manager::layer.program.new')</a></p>
            <div class="list-file list-program bg-white">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody id="body-table-mission">

                    </tbody>
                </table>
            </div>
            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button type="submit" onclick="disabledForm('form-create-program')" id="submit-form" class="btn bg-blue" title="">@lang('manager::layer.program.btn_save')</button>
                <a href="{{route('manager.program_index')}}" class="btn button-border button-edit" title="">@lang('manager::layer.program.btn_back')</a>
            </div>
        </form>
    </section>
@endsection
@section('modal')
    <div class="modal fade" id="new-program" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content margin-top-70">
                <div class="wrap-detail-program modal-misson-base bg-white">
                    <form action="" class="wrap-form" id="form-search-mission">
                        <div class="form-group">
                            <label for="">ID</label>
                            <div class="d-flex align-items-center input-search">
                                <div><input type="text" name="mission_id" class="form-control">
                                    <span id="mission_id-error" class="invalid-feedback"> </span></div>
                                <button type="button" id="search-mission"
                                        class="btn auto-width btn-white">@lang('manager::layer.program.btn_search')</button>
                            </div>
                        </div>
                        <p class="name-modal"></p>
                        <div class="form-group">
                            <label for="">配信日 </label>
                            <div class="d-flex align-items-center input-search justify-content-between">
                                <div class="number"><input type="text" class="form-control" name="day"></div>
                                <span>日目</span>
                            </div>
                        </div>
                        <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                            <button type="submit"  id="add-mission" class="btn bg-blue"
                                    title="">@lang('manager::layer.program.btn_add')</button>
                            <button data-dismiss="modal" id="close-modal" type="button"
                                    class="btn button-border button-edit"
                                    title="">@lang('manager::layer.program.btn_close_modal')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\SearchMissionRequest', '#form-search-mission') !!}
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\CreateProgramRequest', '#form-create-program') !!}
@endsection
@section('script')
    <script>
        $(function () {
            const clearModal = () => {
                let modal = $("#new-program");
                modal.find("input").removeClass("is-invalid");
                modal.find("input").removeClass("is-valid");
                modal.find("input").val("");
                modal.find("p.name-modal").text('');
                modal.find('span#mission_id-error').text('');
                $("#add-mission").attr('disabled', 'disabled');
            };
            $("input[name='mission_id']").change(function (){
                $(this).parent().find('span').remove();
            })
            $("#close-modal").click(function () {
                clearModal();
            });

            let arrIdMission = [];
            let mission;
            let day;

            $("#search-mission").click(function (){
                loading(1);
                let id = $(this).parent().find('input[name="mission_id"]').val();
                let modal = $("#new-program");
                if(modal.find('span#mission_id-error').length > 0){
                    modal.find('span#mission_id-error').text('');
                }
                if (id === ''){
                    loading();
                    modal.find("input[name='mission_id']").addClass("is-invalid");
                    modal.find('span#mission_id-error').text('入力してください');
                    $("#add-mission").attr('disabled', 'disabled');
                } else {
                    console.log(arrIdMission);
                    console.log(id);
                    if (arrIdMission.includes(parseInt(id))) {
                        loading();
                        $("#add-mission").attr('disabled', 'disabled');
                        modal.find("input[name='mission_id']").addClass("is-invalid");
                        modal.find('span#mission_id-error').text(message.error_mission_has_select);
                    } else {
                        if ($(this).find('span#mission_id-error').text() == '') {
                            $.ajax({
                                url: `{{route('manager.mission_base.search')}}`,
                                type: 'GET',
                                data: {id: id},
                                success: function (res) {
                                    loading();
                                    if (res.response.length == 0) {
                                        $("#add-mission").attr('disabled', 'disabled');
                                        modal.find("input[name='mission_id']").addClass("is-invalid");
                                        modal.find('span#mission_id-error').text('こちらのIDは存在していないません');
                                        $("#new-program").find("p.name-modal").text('');

                                    }else {
                                        mission = res.response;
                                        $("#form-search-mission p.name-modal").text(res.response.name);
                                        $("#add-mission").removeAttr('disabled');
                                    }
                                }
                            })
                        } else {
                            loading();
                            $("#add-mission").attr('disabled', 'disabled');
                        }
                        loading();
                    }
                }

            });
            $('input[name="mission_id"]').keyup(function (){
               $(".name-modal").text('');
            });
            $("#form-search-mission").submit(function (e) {
                e.preventDefault();
                if($("p.name-modal").text() == '' && $("input[name='mission_id']").val() != ''){
                    $("#mission_id-error").text('検索ボタンを押して下さい');
                } else{
                    $("#mission_id-error").text('');
                    let day = $(this).parent().find('input[name="day"]').val();
                    let modal = $("#new-program");
                    if (day > 0 && parseInt(day, 10)) {
                        let template = '';
                        template += "<tr>";
                        template += `<td>${mission.name}</td>`;
                        template += `<td class="input-date"><span>${day}日目</span><input type="hidden" value="${day}" name="mission[${mission.id}]" class="form-control sub-mission"></td>`;
                        template += `<td class="text-right">`;
                        template += `<button class="btn button-border auto-width remove-mission" type="button">`;
                        template += `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">`;
                        template += `<path d="M16.5625 2.5H13.125V1.875C13.125 0.839453 12.2855 0 11.25 0H8.75C7.71445 0 6.875 0.839453 6.875 1.875V2.5H3.4375C2.57457 2.5 1.875 3.19957 1.875 4.0625V5.3125C1.875 5.6577 2.1548 5.9375 2.5 5.9375H17.5C17.8452 5.9375 18.125 5.6577 18.125 5.3125V4.0625C18.125 3.19957 17.4254 2.5 16.5625 2.5ZM8.125 1.875C8.125 1.53047 8.40547 1.25 8.75 1.25H11.25C11.5945 1.25 11.875 1.53047 11.875 1.875V2.5H8.125V1.875Z" fill="#9F9F9E"/>`;
                        template += `<path d="M3.06094 7.1875C2.94941 7.1875 2.86054 7.2807 2.86586 7.39211L3.38148 18.2141C3.42914 19.2156 4.25179 20 5.25414 20H14.7455C15.7479 20 16.5705 19.2156 16.6182 18.2141L17.1338 7.39211C17.1391 7.2807 17.0503 7.1875 16.9387 7.1875H3.06094ZM12.4998 8.75C12.4998 8.40469 12.7795 8.125 13.1248 8.125C13.4702 8.125 13.7498 8.40469 13.7498 8.75V16.875C13.7498 17.2203 13.4702 17.5 13.1248 17.5C12.7795 17.5 12.4998 17.2203 12.4998 16.875V8.75ZM9.37484 8.75C9.37484 8.40469 9.65453 8.125 9.99984 8.125C10.3452 8.125 10.6248 8.40469 10.6248 8.75V16.875C10.6248 17.2203 10.3452 17.5 9.99984 17.5C9.65453 17.5 9.37484 17.2203 9.37484 16.875V8.75ZM6.24984 8.75C6.24984 8.40469 6.52953 8.125 6.87484 8.125C7.22015 8.125 7.49984 8.40469 7.49984 8.75V16.875C7.49984 17.2203 7.22015 17.5 6.87484 17.5C6.52953 17.5 6.24984 17.2203 6.24984 16.875V8.75Z" fill="#9F9F9E"/>`;
                        template += `</svg>`;
                        template += '削除 </button>';
                        template += '</td>';
                        template += '</tr>';
                        $("#body-table-mission").append(template);
                        clearModal();
                        $("#new-program").modal('hide');
                        $("button.remove-mission").click(function () {
                            $(this).parent().parent().remove();
                        });
                        arrIdMission.push(mission.id);
                    }
                }

            });
        });
    </script>
@endsection