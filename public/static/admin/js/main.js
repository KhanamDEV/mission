
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
$(document).ready(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var url = URL.createObjectURL(event.target.files[0]);
            $(input).parent().find('span.invalid-feedback').text('');
            $(input).parent().find('div.preview').show();
        }
    }
    $("#file").change(function() {
        readURL(this);
    });
    $('#img_bar').click(function(){
        $('#nav-sitebar').css({"transform": "translateX(0)", 'transition': 'all .4s'});
    })
    $('#close-menu').click(function(){
        $('#nav-sitebar').css({"transform": "translateX(-100%)", 'transition': 'all .4s'});
    })
    $('input[type=file]').change(function(e){
        if(!e.target.files[0]){
            $(this).parent().find('div.preview').css("background","none");
        }
    });
// 
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
});