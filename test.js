$("#createMissionBase").each(function() {
    $(this).validate({
        errorElement: 'span',
        errorClass: 'invalid-feedback',

        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length ||
                element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                error.insertAfter(element.parent());
                // else just place the validation message immediately after the input
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element) {
            $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid'); // add the Bootstrap error class to the control group
        },

        
        ignore: ":hidden, [contenteditable='true']",
        

        unhighlight: function(element) {
            $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
        },

        success: function (element) {
            $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid'); // remove the Boostrap error class from the control group
        },

        focusInvalid: true,
        
        rules: {"mission_name":{"laravelValidation":[["Required",[],"\u5165\u529b\u3057\u3066\u304f\u3060\u3055\u3044",true,"mission_name"],["String",[],"mission name \u6587\u5b57\u3092\u6307\u5b9a\u3057\u3066\u304f\u3060\u3055\u3044",false,"mission_name"],["Max",["255"],"mission name 255\u6587\u5b57\u4ee5\u4e0b\u306b\u3057\u3066\u304f\u3060\u3055\u3044",false,"mission_name"]]},"mission_detail":{"laravelValidation":[["Required",[],"\u5165\u529b\u3057\u3066\u304f\u3060\u3055\u3044",true,"mission_detail"]]},"mission_thumbnail_url":{"laravelValidation":[["Image",[],"mission thumbnail url \u753b\u50cf\u3092\u6307\u5b9a\u3057\u3066\u304f\u3060\u3055\u3044",false,"mission_thumbnail_url"],["Max",["2048"],"mission thumbnail url 2048 KB\u4ee5\u4e0b\u306e\u30d5\u30a1\u30a4\u30eb\u3092\u6307\u5b9a\u3057\u3066\u304f\u3060\u3055\u3044",false,"mission_thumbnail_url"]]},"feedback_title":{"laravelValidation":[["Required",[],"\u5165\u529b\u3057\u3066\u304f\u3060\u3055\u3044",true,"feedback_title"],["String",[],"feedback title \u6587\u5b57\u3092\u6307\u5b9a\u3057\u3066\u304f\u3060\u3055\u3044",false,"feedback_title"],["Max",["255"],"feedback title 255\u6587\u5b57\u4ee5\u4e0b\u306b\u3057\u3066\u304f\u3060\u3055\u3044",false,"feedback_title"]]},"feedback_detail":{"laravelValidation":[["Required",[],"\u5165\u529b\u3057\u3066\u304f\u3060\u3055\u3044",true,"feedback_detail"]]},"feedback_thumbnail_url":{"laravelValidation":[["Image",[],"feedback thumbnail url \u753b\u50cf\u3092\u6307\u5b9a\u3057\u3066\u304f\u3060\u3055\u3044",false,"feedback_thumbnail_url"],["Max",["2048"],"feedback thumbnail url 2048 KB\u4ee5\u4e0b\u306e\u30d5\u30a1\u30a4\u30eb\u3092\u6307\u5b9a\u3057\u3066\u304f\u3060\u3055\u3044",false,"feedback_thumbnail_url"]]}}            });
});