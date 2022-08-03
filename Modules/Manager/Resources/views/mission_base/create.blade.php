@extends('manager::layouts.app_no_sidebar')
@section('content')
    <section id="misson-base-new">
        <p class="text-center title-brand">ミッションサムネイル画像</p>
        <form action="{{route('manager.mission_base.store')}}" method="POST" id="createMissionBase" class="wrap-form" enctype="multipart/form-data">
            @csrf
            <div class="box-main-new bg-white text-center">
                <div class="form-group drop-file relative">
                    <div class="active after drop-image">
                        <div class="b-drop">
                            <img src="{{asset('static/manager/images/add_image.png')}}" alt="">
                        </div>
                    </div>
                    <div class="fill"></div>
                    <input class="form-control file-upload" id="file-mission" type="file" name="mission_thumbnail" >
                    <div class="preview"></div>
                </div>
                <button type="button" class="btn btn-color-main upload-image">イメージをアップロード</button>
            </div>
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="mission_name" id="" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">詳細</label>
                    <textarea name="mission_detail" id="" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Mission ターゲット</label>
                    <select class="form-control" name="mission_is_target" id="">
                        <option  value="1">あり</option>
                        <option  value="0">なし</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">所要時間</label>
                    <input type="text" name="time_required" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">名前表示</label>
                    <select class="form-control" name="is_anonymous" id="">
                        @foreach(\App\Helpers\Helpers::statusAnonymous() as $key => $item)
                            <option value="{{$key}}" {{ $key == 0 ? 'selected' : '' }} >{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <p class="text-center title-brand">フィードバックサムネイル画像</p>
            <div class="box-main-new bg-white text-center">
                <div class="form-group drop-file relative">
                    <div class="active after drop-image">
                        <div class="b-drop">
                            <img src="{{asset('static/manager/images/add_image.png')}}" alt="">
                        </div>
                    </div>
                    <div class="fill"></div>
                    <input class="form-control file-upload" id="file-feedback" type="file" name="feedback_thumbnail" >
                    <div class="preview"></div>
                </div>
                <button type="button" class="btn btn-color-main upload-image">イメージをアップロード</button>
            </div>
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">フィードバックタイトル</label>
                    <input type="text" name="feedback_title" id="" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">フィードバック詳細</label>
                    <textarea name="feedback_detail" id="" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">行動のヒント：タイトル</label>
                    <input type="text" name="feedback_hint_title" id="" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">行動のヒント：詳細</label>
                    <textarea name="feedback_hint_detail" id="" class="form-control"></textarea>
                </div>
            </div>
            <p class="text-center title-brand">質問 <button type="button" class="btn auto-width bg-blue add-question-btn">質問を追加する</button></p>
        
            <div class="question-wraper">
                
            </div>

            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button type="submit" class="btn bg-blue store-mission" title="">保存する </button>
                <a href="{{route('manager.mission_base.index')}}" class="btn button-border button-edit" >保存せずに戻る</a>
            </div>
        </form>
    </section>
    @endsection

    @section('script')
    @parent
    {!! JsValidator::formRequest('Modules\Manager\Http\Requests\MissionBaseRequest', '#createMissionBase') !!}
        <script>
        function readURL(input) {
                if (input.files && input.files[0]) {
                    var url = URL.createObjectURL(event.target.files[0]);
                    $(input).parent().find('span.invalid-feedback').text('');
                    $(input).parent().find('div.preview').show();
                    $(input).parent().find('div.preview').attr("style", "background: #eef0f8 url('" + url + "') no-repeat top center; background-size: contain; display: block; background-position: center");
                    $(input).parent().find('div.fill').addClass('active');
                    $(input).parent().find('.b-drop').addClass('active');
                }
            }

            $('.file-upload').on('change', function(){
                readURL(this);
            })
            let errorSerial = true;
            let arrSelect = [];
            let errorChoice = false;
            function addNewQuestion()
            {
                let numberQuestion = $(".box-question").length;
                let option = '';
                for(let i =0; i <= numberQuestion; i++){
                    if (!i){
                        option += `<option value="${i+1}">${i+1}</option>`;
                    } else{
                        option += `<option value="${i+1}">${i+1}</option>`;
                    }
                }
                $(".element-serial").each(function (index, value){
                    $(value).append(`<option value="${numberQuestion + 1}">${numberQuestion + 1}</option>`);
                });
                let id = Math.random().toString(36).substring(5);
                let html = `
                    <div class="box-main-new bg-white box-question mb-4">
                        <div class="form-group">
                            <label for="">質問タイトル <a href="" class="btn button-border auto-width button-absolute remove-question-btn" title=""><img src="{{asset('static/manager/images/trash.png')}}" alt=""> 削除する</a></label>
                            <input type="text" required name="question[${id}][title]" id="" class="form-control question-title" >
                        </div>
                        <div class="form-group">
                            <label for="">質問形式</label>
                            <select class="form-control type-question" name="question[${id}][format]" id="">
                                <option value="1" selected>チェックリスト</option>
                                <option value="2">ラジオボタン</option>
                                <option value="3">テキスト</option>
                                <option value="4">画像</option>
                            </select>
                        </div>
                        <div class="form-group choices">
                            <label for="">選択肢</label>
                            <input type="text" required name="question[${id}][choices]" id="" class="form-control " placeholder="{回答１, 回答２, 回答３}" >
                        </div>
                        <div class="form-group">
                            <label for="">順番</label>
                            <select class="form-control select-serial-${id} element-serial"  name="question[${id}][order]" id="">
                                <option value=""></option>
                                ${option}
                            </select>
                        </div>
                    </div>
                `;

                $('.question-wraper').append(html);
                $(".element-serial").change(function (){
                    $(this).parent().find('span').remove();
                });
                $('input.question-title').change(function (){
                    $(this).parent().find('span').remove();
                });
                // $(".form-group.choices input").change(function (){
                //     let parent = $(this).parent();
                //     if(parent.parent().find('.type-question').val() == 1 || parent.parent().find('.type-question').val() == 2) {
                //
                //         let arrChoice = $(this).val().split(',');
                //         arrChoice = arrChoice.map(function (value) {
                //             return value.trim();
                //         });
                //         let toFindDuplicates = arr => arr.filter((item, index) => arr.indexOf(item) !== index)
                //         let duplicateElement = toFindDuplicates(arrChoice);
                //         if (duplicateElement.length) {
                //             errorChoice = true;
                //             if (parent.find('span').length > 0) {
                //                 parent.find.input()
                //                 parent.find('span').text('答えが重複しているため、答えを変更してください');
                //                 parent.find('span').addClass('error')
                //             } else {
                //                 parent.append('<span class="error">答えが重複しているため、答えを変更してください</span>')
                //             }
                //         } else {
                //             errorChoice = false;
                //             parent.find('span').remove();
                //             parent.find('input').removeClass('has-error');
                //         }
                //         if (parent.find('span.error').length) {
                //             parent.find('input').addClass('has-error');
                //         }
                //     }else{
                //         errorChoice = false;
                //         parent.find('span').remove();
                //         parent.find('input').removeClass('has-error')
                //     }
                // })
            }
            
            $('.add-question-btn').click(function(){
                addNewQuestion();

            }); 

            $(document).on('click', '.remove-question-btn', function(e){
                e.preventDefault();
                $(this).closest('.box-main-new').remove();
                $(".element-serial").each(function (index, item){
                    let option = $(item).find('option');
                    option[option.length - 1].remove();
                });
            })


            function validateSerial(){
                let status = true;
                let arrValue = [];
                let messageDuplicate = '順番はすでに存在しています';
                let messageRequired = '入力してください';
                $('.element-serial').each(function (index, value){
                    arrValue.push($(value).val());
                });
                $(".element-serial").each(function (index, value){
                    let count = arrValue.filter(function (e) {
                        return e == $(value).val();
                    }).length;
                    if(count > 1){
                        status = false;
                        if($(value).parent().find('span').length <= 0){
                            $(value).parent().append('<span class="error"></span>');
                            $(value).parent().find('span').text(messageDuplicate);
                            $(value).removeClass('is-valid');
                            $(value).addClass('is-invalid');
                        }
                    } else{
                        if($(value).parent().find('span').length > 0){
                            $(value).parent().find('span').remove();
                            $(value).addClass('is-valid');
                            $(value).removeClass('is-invalid');
                        }
                    }
                });
                $('input.question-title').each(function (index,value){
                    if($(value).val().replace(/ /g,'') == ''){
                        status = false;
                        if($(value).parent().find('span').length <= 0){
                            $(value).parent().append('<span class="error"></span>');
                            $(value).parent().find('span').text(messageRequired);
                            $(value).removeClass('is-valid');
                            $(value).addClass('is-invalid');
                        }
                    } else{
                        if($(value).parent().find('span').length > 0){
                            $(value).parent().find('span').remove();
                            $(value).addClass('is-valid');
                            $(value).removeClass('is-invalid');
                        }
                    }
                });
                $("select.type-question").each(function (index, value){
                   let parent = $(this).parent().parent();
                    let choices = parent.find('.choices input').first();
                    if($(value).val() == 1 || $(value).val() == 2){
                       if(choices.val().replace(/ /g,'') == ''){
                           status = false;
                           if(parent.find('.choices span').length <= 0){
                               parent.find('.choices').append('<span class="error"></span>');
                               parent.find('.choices').find('span').text(messageRequired);
                               choices.removeClass('is-valid');
                               choices.addClass('is-invalid');
                           }
                       } else{
                           if(parent.find('.choices span').length > 0){
                               parent.find('.choices').find('span').remove();
                               choices.addClass('is-valid');
                               choices.removeClass('is-invalid');
                           }
                       }
                   } else{
                        if(parent.find('.choices span').length > 0){
                            parent.find('.choices').find('span').remove();
                            choices.addClass('is-valid');
                            choices.removeClass('is-invalid');
                        }
                    }
                });
                return status;
            }
        function validateChoice(){
            let error = false;
            $(".form-group.choices input").each(function (index, value){
                let parent = $(value).parent();
                if(parent.parent().find('.type-question').val() == 1 || parent.parent().find('.type-question').val() == 2){
                    let arrChoice = $(value).val().split(',');
                    arrChoice =  arrChoice.map(function (value){
                        return value.trim();
                    });
                    let toFindDuplicates = arr => arr.filter((item, index) => arr.indexOf(item) !== index)
                    let duplicateElement = toFindDuplicates(arrChoice);
                    if(duplicateElement.length){
                        error = true;
                        if(parent.find('span').length > 0){
                            parent.find('span').text('答えが重複しているため、答えを変更してください');
                            parent.find('span').addClass('error')
                        } else{
                            parent.append('<span class="error">答えが重複しているため、答えを変更してください</span>')
                        }
                    } else{
                        parent.find('span').remove();
                        parent.find('input').removeClass('has-error');
                    }
                    if(parent.find('span.error').length){
                        parent.find('input').addClass('has-error');
                    } else{
                        parent.find('input').removeClass('has-error');
                    }
                } else{
                    parent.find('input').removeClass('has-error');
                }
            })
            return error;
        }
            $("#createMissionBase").submit(function (e){
                if(!validateSerial() || errorChoice || validateChoice()){
                    e.preventDefault();
                    validateChoice();
                }

            });
        </script>
    @endsection