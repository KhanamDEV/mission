@extends('admin::layouts.app_no_sidebar')
@section('content')
    <section id="wrap-user-new">
        <form method="POST" enctype="multipart/form-data" id="upload-user" class="wrap-form">
            @csrf
            <div class="wrap-misson-small bg-white padding-top0">
                <div class="form-group mb-0">
                    <div class="form-group drop-file relative mb-0">
                        <div class="active after drop-image">
                            <img src="{{asset('static/admin//images/choose-file.png')}}" class="text-center" alt="">
                            <div class="b-drop">
                                {!! __('admin::layer.user.input_import') !!}
                            </div>
                        </div>
                        <div class="fill"></div>
                        <input class="form-control file-upload" id="file" type="file" name="file_data" >
                        <span class="get-file"></span>
                    </div>
                </div>
            </div>
            <div class="alert mt-5 alert-danger wrap-misson-small file-correct" style="display: none" role="alert">
                @lang('message.file_content_not_correct')
            </div>
            <div class="alert mt-5 alert-danger wrap-misson-small required_file" style="display: none" role="alert">
                @lang('message.required_file')
            </div>
            <div class="wrap-button-new text-center">
                <button type="button" id="submit-form" class="btn bg-blue">@lang('admin::layer.user.button_upload')</button>
            </div>
        </form>
        <div class="list-file bg-white">
            <table class="table wrap-table">
                <thead>
                </thead>
                <tbody>
                @foreach($data['log_update'] as $log)
                    <tr>
                        <td>{{\App\Helpers\Helpers::formatDateTime($log->created_at, 'Y/m/d/H:i')}}</td>
                        <td>{{$log->file_name}}</td>
                        <td class="text-right"><a href="{{\App\Helpers\Helpers::getUrlImg($log->file_url)}}" title="" class="control-arrow down-file">@lang('admin::layer.user.download')</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('validation')
    {!! JsValidator::formRequest('Modules\Admin\Http\Requests\AdminUploadDataUserRequest', '#upload-user') !!}
@endsection
@section('scripts')
    <script src="{{asset('js/jszip.js')}}"></script>
    <script src="{{asset('js/xlsx.js')}}"></script>
    <script>
        $(function () {

            const arrTypeFileCSV = ["application/vnd.ms-excel", "text/csv"];
            const arrTypeFileExcel = ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
            let dataUser = [];
            let error = false;
            let fileUser;
            $("input#file").change(function () {
                $(".alert-danger").hide();
                $(this).parent().find('span.error-js').remove();
                $("#submit-form").attr('disabled', 'disabled');
                let file = this.files[0];
                if (file !== undefined) {
                    loading(1);
                    if ([...arrTypeFileCSV,...arrTypeFileExcel].includes(file.type)) {
                        error = false;
                        fileUser = file;
                        if (arrTypeFileCSV.includes(file.type)) {
                            let data;
                            const readFileUser = file => {
                                let reader = new FileReader();
                                reader.onload = () => {
                                    data = reader.result.split("\n");
                                    data = data.filter(value => value !== "");
                                    data = data.map(value => value.replace("\r", ""));
                                    data = data.map(value => {
                                        let user = value.split(",");
                                        if (user.length !== 13) error = true;
                                        return {
                                            sei: user[0],
                                            mei: user[1],
                                            sei_kana: user[2],
                                            mei_kana: user[3],
                                            details: user[4],
                                            mailaddress: user[5],
                                            birthday: user[6],
                                            gender: user[7],
                                            employment_status: user[8],
                                            is_active: user[9],
                                            department_name: user[10],
                                            is_admin: user[11],
                                            password: user[12]
                                        }
                                    })
                                    data.shift();
                                    dataUser = data;
                                    $("#submit-form").removeAttr('disabled');
                                    loading();
                                }
                                reader.readAsText(file);
                            }
                            readFileUser(file);

                        }
                        if (arrTypeFileExcel.includes(file.type)) {
                            const readFileUser = file => {
                                let reader = new FileReader();
                                reader.onload = e => {
                                    let dataXLSX = e.target.result;
                                    let workbook = XLSX.read(dataXLSX, {type: 'binary', cellDates: true, dateNF: 'yyyy/mm/dd'});
                                    workbook.SheetNames.forEach(function (sheetName) {
                                        let rowObj = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName], {raw: false});
                                        let jsonObj = JSON.stringify(rowObj);
                                        dataUser = JSON.parse(jsonObj);
                                    })
                                    $("#submit-form").removeAttr('disabled');
                                    loading();
                                }
                                reader.onerror = error => {
                                    console.log(error);
                                }
                                reader.readAsBinaryString(file);
                            }
                            readFileUser(file);
                        }
                    } else {
                        $("#submit-form").removeAttr('disabled');
                        error = true;
                        loading();
                    }

                }
            });
            $("#submit-form").click(function () {
                if(fileUser == undefined){
                    if($('#file-error').text() == ''){
                        $(".required_file").show();
                    }
                } else{
                    loading(1);
                    if (dataUser.length == 0){
                        error = true;
                    } else{
                        dataUser.forEach(user => {
                            if (Object.keys(user).length !== 13) error = true;
                            if (!validateEmail(user.mailaddress)) error = true;
                            if (!isValidDate(user.birthday)) error = true;
                        });
                    }
                    if (!error) {
                        let formData = new FormData();
                        formData.append('_token', "{{@csrf_token()}}");
                        formData.append('users', JSON.stringify(dataUser));
                        formData.append('file', fileUser);
                        $.ajax({
                            url: "{{route('admin.user_edit')}}",
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: (res) => {
                                if(res.meta.status === 200){
                                    window.location.replace('{{route('admin.user_index')}}');
                                } else {
                                    $(".alert-danger.file-correct").show()
                                }
                                $("input#file").val('');
                                loading();
                            }
                        })
                    } else {
                        loading();
                        $(".alert-danger.file-correct").show();
                    }

                }

            });
        })
    </script>
@endsection
