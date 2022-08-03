function disabledForm(idForm){
    let form = $(`#${idForm}`);
    form.find('button[type="submit"]').attr('disabled', 'disabled');
    form.find('input').keyup(function () {
        form.find('button[type="submit"]').removeAttr('disabled');
    });
    form.find('input, select').change(function () {
        form.find('button[type="submit"]').removeAttr('disabled');
    });
    form.submit();
}
function loading(status){
    if (status){
        $("#ajax-loading").show();
    } else{
        $("#ajax-loading").hide();
    }
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function isValidDate(dateString){
    const regex = /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
    if(!regex.test(dateString)) return false;
    const parts = dateString.split("/");
    const day = parseInt(parts[2], 10);
    const month = parseInt(parts[1], 10);
    const year = parseInt(parts[0], 10);
    if(year < 1900 || year > 3000 || month == 0 || month > 12 || day == null)
        return false;
    return true;
};

$(document).ready(function(){
// choose image
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
    $("input[type='file']").change(function() {
        readURL(this);
    });
    $('button.upload-image').click(function() {
        $(this).siblings('.drop-file').children("input[type='file']").click();
    });
    $('input[type=file]').change(function(e){
        if(!e.target.files[0]){
            $(this).parent().find('div.preview').css("background","none");
        }
    });

    // menu
    $('#img_bar').click(function(){
        $('#nav-sitebar').css({"transform": "translateX(0)", 'transition': 'all .4s'});
    })
    $('#close-menu').click(function(){
        $('#nav-sitebar').css({"transform": "translateX(-100%)", 'transition': 'all .4s'});
    })
    //
    function deleteQuestion(){
        $('.delete-question').click(function(){
            $(this).parents('.box-main-new.bg-white').css('display','none');
            $(this).parents('.box-main-new.bg-white').html('');
        })
    }
    deleteQuestion();
    $('#add-question').click(function(){
        $('#tab-question').append(`
        <div class="box-main-new bg-white margin-top30">
            <div class="form-group">
               <label for="">質問タイトル <a href="" class="btn button-border auto-width button-absolute delete-question" title="">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.5625 2.5H13.125V1.875C13.125 0.839453 12.2855 0 11.25 0H8.75C7.71445 0 6.875 0.839453 6.875 1.875V2.5H3.4375C2.57457 2.5 1.875 3.19957 1.875 4.0625V5.3125C1.875 5.6577 2.1548 5.9375 2.5 5.9375H17.5C17.8452 5.9375 18.125 5.6577 18.125 5.3125V4.0625C18.125 3.19957 17.4254 2.5 16.5625 2.5ZM8.125 1.875C8.125 1.53047 8.40547 1.25 8.75 1.25H11.25C11.5945 1.25 11.875 1.53047 11.875 1.875V2.5H8.125V1.875Z" fill="#9F9F9E"/>
                        <path d="M3.0609 7.1875C2.94938 7.1875 2.86051 7.2807 2.86583 7.39211L3.38145 18.2141C3.42911 19.2156 4.25176 20 5.25411 20H14.7455C15.7479 20 16.5705 19.2156 16.6182 18.2141L17.1338 7.39211C17.1391 7.2807 17.0502 7.1875 16.9387 7.1875H3.0609ZM12.4998 8.75C12.4998 8.40469 12.7795 8.125 13.1248 8.125C13.4701 8.125 13.7498 8.40469 13.7498 8.75V16.875C13.7498 17.2203 13.4701 17.5 13.1248 17.5C12.7795 17.5 12.4998 17.2203 12.4998 16.875V8.75ZM9.37481 8.75C9.37481 8.40469 9.6545 8.125 9.99981 8.125C10.3451 8.125 10.6248 8.40469 10.6248 8.75V16.875C10.6248 17.2203 10.3451 17.5 9.99981 17.5C9.6545 17.5 9.37481 17.2203 9.37481 16.875V8.75ZM6.24981 8.75C6.24981 8.40469 6.5295 8.125 6.87481 8.125C7.22012 8.125 7.49981 8.40469 7.49981 8.75V16.875C7.49981 17.2203 7.22012 17.5 6.87481 17.5C6.5295 17.5 6.24981 17.2203 6.24981 16.875V8.75Z" fill="#9F9F9E"/>
                    </svg>
            削除する</a></label>
                <input type="text" name="" id="" class="form-control" > 
            </div>
            <div class="form-group">
                <label for="">質問形式</label>
                <input type="text" name="" id="" class="form-control" placeholder="プルダウン式" > 
            </div>
            <div class="form-group">
                <label for="">選択肢</label>
                <input type="text" name="" id="" class="form-control" placeholder="{回答１, 回答２, 回答３}" > 
            </div>
            <div class="form-group">
                <label for="">順番</label>
                <input type="text" name="" id="" class="form-control" placeholder="1" > 
            </div>
        </div>`);
        deleteQuestion();
    });

    function setWidthText(){
        let showChar = 0;
        let width = $(document).outerWidth();
        width > 520 ? showChar = 20 : (width >= 360 ? showChar = 15 : showChar = 10 );
        var ellipsestext = "...";
        var data = ['text-less'];
        data.forEach( function(value){

            $('.'+value).each(function() {
                var content = $(this).html();
                if(content.length > showChar) {
                    var c = content.substr(0, showChar);
                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp';
                    $(this).html(html);
                }

            });
        });
    }
    setWidthText();
    $(window).resize(function(){
    setWidthText();
    });
    // 
    $('input[type=file]').change(function(e){
        $(this).siblings('.get-file').text(e.target.files[0].name);
        $('.get-file').each(function(){
            let nameFile = $(this).html();
            if(nameFile.length > 20){
                let html = nameFile.substr(0,12) + '...' + nameFile.slice(-7);
                $(this).html(html);
            }
        })
    });
    //
    $("#submit-form").click(function(){
        let file = $("#file-error");
        if(typeof file != "undefined"){
            
            $("span.get-file").css("display", "none");
        }
    })
    $('input[type=file]').change(function(e){
            $("#file-error").remove();
            $("span.get-file").css("display", "block");
    })
})