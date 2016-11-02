//add error div
jQuery.fn.displayError = function (opt){
    var defaults = {
        "msg": "",
        "type": "error"
    };
    var options = $.extend({}, defaults, opt);

    var el = "";
    var curId = $(this).parent().children().attr('id');

    if($(this).parent().find("#error_pop_out").length == 0){
        $(this).parent().append('<div id="error_pop_out" style="font-size: 12px;">'+options.msg+'</div>');

        el = $(this).parent().find('#error_pop_out');
        var elWid = parseInt(el.innerWidth()) + (parseInt(el.css('paddingLeft')) * 2);
        var wid = (parseInt($(this).css('width')) + (parseInt($(this).css('paddingLeft')) * 2) / 2);
        var top = $(this).position().top - 4;
        var posLeft = (parseInt($(this).position().left) + (parseInt($(this).css('paddingLeft')) * 2));
        var left = parseInt(posLeft + wid);

        el
            .css({
                top: top,
                left: left
            })
            .fadeIn(300);
    }else{
        el = $(this).parent().find('#error_pop_out');
        el.html(options.msg);
    }

    if(el!==""){
        el.removeClass('success_pop_out');
        if(options.type !== "error"){
            el.addClass('success_pop_out');
        }
    }

    var classSubmit = $('.submit');
    if(classSubmit.length != 0){
        classSubmit.attr('disabled','disabled');
    }
}
//remove error div
jQuery.fn.hideError = function (){
    $(this).removeClass('hasError');

    var el = $(this).parent().find('#error_pop_out');
    el
        .delay(2000)
        .fadeOut(800,function(e){
            $(this).remove();
            var classSubmit = $('.submit');
            if(classSubmit.length != 0){
                classSubmit.removeAttr('disabled');
            }
        });
}

//for checking
jQuery.fn.checkIfExist = function (option) {
    var defaults = {
        "url": "",
        "table": "",
        "what": "",
        "errorMsg": "already exist!",
        "hasToDisable": false,
        "disableWhat": "",
        "except": []
    };
    var options = $.extend({}, defaults, option);
    var el = $(this);

    var excempted = $.inArray($(this).val(), options.except);
    if($(this).val() == ""){
        el.hideError();
    }else{
        $.post(options.url,{
            check: true,
            table: options.table,
            search: $(this).val(),
            what: options.what
        },function(result){
            if(result == "true"){
                if(excempted == -1){
                    el
                        .addClass('hasError')
                        .displayError({
                            msg: ConvertFirstCharacterToUpperCase(options.what) + " " + options.errorMsg
                        });
                }
            }else{
                el.hideError();
            }
        });
    }
}

jQuery.fn.minLength = function () {
    var el = $(this);
    var minLength = el.attr('hasMinLength');
    if(minLength !== undefined && minLength !== false){
        if(el.val().length < minLength && el.val().length !== 0){
            el
                .addClass('hasError')
                .displayError({
                    msg: 'Minimum length is '+minLength
                });
        }else{
            el
                .hideError();
        }
    }
}

jQuery.fn.checkEmailIfValid = function (option) {
    var defaults = {
        "url": bu+"checkDatabase",
        "table": "tbl_user",
        "what": "email",
        "checkDatabase": true,
        "except": []
    };
    var options = $.extend({}, defaults, option);

    if($(this).hasClass('emailCheck')){
        var hasError = false;

        if($(this).val().length > 0){
            hasError = checkThisMail($(this));
            if(hasError){
                $(this)
                    .addClass('hasError')
                    .displayError({
                        msg: 'Invalid email!'
                    });
            }else{
                if(options.checkDatabase){
                    $(this).checkIfExist(options);
                }else{
                    $(this).hideError();
                }
            }
        }else{
            $(this).hideError();
        }
    }
}

function checkThisMail(el){
    var hasError = false;
    var emailReg = /^([\w\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var emailblockReg = /^([\w\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)([\w-]+\.)+[\w-]{2,4})?$/;

    var emailaddressVal = el.val();
    if(emailaddressVal == '') {
        hasError = true;
    }else if(!emailReg.test(emailaddressVal)) {
        hasError = true;
    }else if(!emailblockReg.test(emailaddressVal)) {
        //
    }else{
        //
    }

    return hasError;
}

function ConvertFirstCharacterToUpperCase(text) {
    var upperCase = text.substr(0, 1).toUpperCase();
    upperCase += text.substr(1);
    return upperCase;
}
