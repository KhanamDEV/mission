@extends('manager::layouts.app_no_sidebar')
@section('content')
    @php
        $mission = $data['mission'];
    @endphp
    <section id="misson-base-new">
        <p class="text-center title-brand">ミッションサムネイル画像</p>
        <form action="{{route('manager.mission_base.update', $mission->id)}}" method="POST" id="edit-mision" class="wrap-form" enctype="multipart/form-data">
            @csrf
            <div class="box-main-new bg-white text-center">
                <div class="form-group drop-file relative">
                    <div class="active after drop-image">
                        <div class="b-drop">
                            <img src="{{asset('static/manager/images/add_image.png')}}" alt="">
                        </div>
                    </div>
                    <div class="fill"></div>
                    <input class="form-control file-upload" id="file" type="file" name="mission_thumbnail" id="file-mission">
                    <div style="background: #eef0f8 url('{{\App\Helpers\Helpers::getUrlImg($mission->thumbnail_url ?? '')}}') no-repeat top center; background-size: contain; display: block; background-position: center" class="preview"></div>
                </div>
                <button type="button" class="btn btn-color-main upload-image">イメージをアップロード</button>
            </div>
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="mission_name" id="" class="form-control" value="{{$mission->name ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="">詳細</label>
                    <textarea name="mission_detail" id="" class="form-control"> {{$mission->detail ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Mission ターゲット</label>
                    <select class="form-control" name="mission_is_target" id="">
                        <option @if($mission->is_target == 1) selected @endif value="1">あり</option>
                        <option @if($mission->is_target == 0) selected @endif value="0">なし</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">所要時間</label>
                    <input type="text" value="{{$mission->time_required ?? ''}}" name="time_required" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">名前表示</label>
                    <select class="form-control" name="is_anonymous" id="">
                        @foreach(\App\Helpers\Helpers::statusAnonymous() as $key => $item)
                            <option @if($mission->is_anonymous == $key) selected @endif value="{{$key}}">{{$item}}</option>
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
                    <input class="form-control file-upload" id="file" type="file" name="feedback_thumbnail" id="file-feedback"  >
                    <div style="background: #eef0f8 url('{{\App\Helpers\Helpers::getUrlImg($mission->feedback_base->thumbnail_url ?? '')}}') no-repeat top center; background-size: contain; display: block; background-position: center" class="preview"></div>
                </div>
                <button type="button" class="btn btn-color-main upload-image">イメージをアップロード</button>
            </div>
            <div class="box-main-new bg-white no-border">
                <div class="form-group">
                    <label for="">フィードバックタイトル</label>
                    <input type="text" name="feedback_title" id="" class="form-control"  value="{{$mission->feedback_base->title ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="">フィードバック詳細</label>
                    <textarea name="feedback_detail" id="" class="form-control">{{$mission->feedback_base->detail ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">行動のヒント：タイトル</label>
                    <input type="text" name="feedback_hint_title" value="{{$mission->feedback_base->hint_title ?? ''}}" id="" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">行動のヒント：詳細</label>
                    <textarea name="feedback_hint_detail" id="" class="form-control">{{$mission->feedback_base->hint_detail ?? ''}}</textarea>
                </div>
            </div>
            <p class="text-center title-brand">質問 <button type="button" class="btn auto-width bg-blue add-question-btn">質問を追加する</button></p>

            <div class="question-wraper">
                @foreach ($mission->question_bases as $item)
                    <div class="box-main-new bg-white box-question mb-4">
                        <div class="form-group">
                            <label for="">質問タイトル <a href="" class="btn button-border auto-width button-absolute remove-question-btn" title=""><img src="{{asset('static/manager/images/trash.png')}}" alt=""> 削除する</a></label>
                            <input type="text" name="question[{{$item->id}}][title]" id="" value="{{$item->title}}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">質問形式</label>
                            <select class="form-control type-question" name="question[{{$item->id}}][format]" id="">
                                @foreach (\App\Helpers\Helpers::renderTypeQuestion() as $key => $value)
                                    <option value="{{$key}}" @if($item->type == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group choices">
                            <label for="">選択肢</label>
                            <input type="text" name="question[{{$item->id}}][choices]" value="{{$item->choice ?? ''}}" id="" class="form-control" placeholder="{回答１, 回答２, 回答３}" >
                        </div>
                        <div class="form-group">
                            <label for="">順番</label>
                            <select class="form-control select-serial-${id} element-serial" name="question[{{$item->id}}][order]" id="">
                                @for($i = 1; $i <= $mission->question_bases->count(); $i++)
                                    <option @if($i == $item->delivery_order_number) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
{{--                            <input type="text" name="question[{{$item->id}}][order]" value="{{$item->delivery_order_number ?? ''}}" name="{{$item->order ?? ''}}" id="" class="form-control"  >--}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center"><span class="invalid-feedback d-block">
                @error('updateFail')
                    {{$message}}
                @enderror
            </span></div>

            <div class="wrap-button text-center d-flex align-items-center justify-content-center flex-column">
                <button type="submit" class="btn bg-blue" title="">保存する </button>
                <a href="{{route('manager.mission_base.show', ['id' => request()->route('id')])}}" class="btn btn-color-main" style="max-width: 370px">保存せずに戻る</a>
                <button type="button" @if($mission->active) data-toggle="modal" data-target="#delete-confirm" @endif class="btn button-border button-edit @if(!$mission->active)button-delete @endif" title="">削除する</button>
            </div>
        </form>
    </section>
@endsection

@section('modal')
    @if(!$mission->active)
    <div class="modal fade" id="delete-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content wrap-modal">
                <div class="bg-white">
                    <h2 class="mission-title">削除しますか?</h2>
                    <div class="wrap-button">
                        <button type="button" data-dismiss="modal" class="btn button-border">戻る</button>
                        <button id="" type="submit" class="btn bg-blue center btn-remove-mission">削除する</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="modal fade" id="delete-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content margin-top-70">
                    <div class="wrap-detail-program bg-white text-center">
                        <div>
                            プログラムに利用しているため削除できません
                        </div>
                        <button type="button" class="mt-5 btn bg-blue margin-top-70" data-dismiss="modal" title="">戻る</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
@parent
{!! JsValidator::formRequest('Modules\Manager\Http\Requests\UpdateMissionBaseRequest', '#edit-mision') !!}
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

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
    function addNewQuestion()
    {
        let numberQuestion = $(".box-question").length;
        let option = '';
        for(let i =0; i <= numberQuestion; i++){
            if (!i){
                option += `<option selected value="${i+1}">${i+1}</option>`;
            } else{
                option += `<option value="${i+1}">${i+1}</option>`;
            }
        }
        $(".element-serial").append(`<option value="${numberQuestion+1}">${numberQuestion+1}</option>`);
        let id = Math.random().toString(36).substring(5);
        let html = `
            <div class="box-main-new box-question bg-white mb-4">
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
                    <input type="text" required name="question[${id}][choices]" id="" class="form-control" placeholder="{回答１, 回答２, 回答３}" >
                </div>
                <div class="form-group">
                    <label for="">順番</label>
<select class="form-control select-serial-${id} element-serial"  name="question[${id}][order]" id="">
                                ${option}
                            </select>                </div>
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
        //     let arrChoice = $(this).val().split(',');
        //     arrChoice =  arrChoice.map(function (value){
        //         return value.trim();
        //     });
        //     let toFindDuplicates = arr => arr.filter((item, index) => arr.indexOf(item) !== index)
        //     let duplicateElement = toFindDuplicates(arrChoice);
        //     if(duplicateElement.length){
        //         arrChoice = true;
        //         if(parent.find('span').length > 0){
        //             parent.find.input()
        //             parent.find('span').text('Duplicate');
        //             parent.find('span').addClass('error')
        //         } else{
        //
        //             parent.append('<span class="error">Duplicate</span>')
        //         }
        //     } else{
        //         arrChoice = false;
        //         parent.find('span').remove();
        //         parent.find('input').removeClass('has-error');
        //     }
        //     if(parent.find('span.error').length){
        //         parent.find('input').addClass('has-error');
        //     }
        // })
    }
    // $(".form-group.choices input").change(function (){
    //     let parent = $(this).parent();
    //     let arrChoice = $(this).val().split(',');
    //     arrChoice =  arrChoice.map(function (value){
    //         return value.trim();
    //     });
    //     let toFindDuplicates = arr => arr.filter((item, index) => arr.indexOf(item) !== index)
    //     let duplicateElement = toFindDuplicates(arrChoice);
    //     if(duplicateElement.length){
    //         errorChoice = true;
    //         if(parent.find('span').length > 0){
    //             parent.find.input()
    //             parent.find('span').text('答えが重複しているため、答えを変更してください');
    //             parent.find('span').addClass('error')
    //         } else{
    //             parent.append('<span class="error">答えが重複しているため、答えを変更してください</span>')
    //         }
    //     } else{
    //         errorChoice = false;
    //         parent.find('span').remove();
    //         parent.find('input').removeClass('has-error');
    //     }
    //     if(parent.find('span.error').length){
    //         parent.find('input').addClass('has-error');
    //     }
    // })
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
                }
            }else{
                parent.find('input').removeClass('has-error');
            }
        })
        return error;
    }

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

    function removeMission(){
        return $.ajax({
            url: "{{route('manager.mission_base.destroy', $mission->id)}}",
            type: "POST",
        });
    }
    $('#edit-mision').submit(function (e){
        if (!validateSerial() || validateChoice()){
            e.preventDefault();
            validateChoice();
        }
    });
    $('.button-delete').on('click', function(){
        $("#delete-confirm").modal('show');
    }); 
    $('.btn-remove-mission').on('click', function(){
        removeMission().done(function(){
            window.location.href = "{{ route('manager.mission_base.index') }}";
        });
    }); 
</script>
@endsection