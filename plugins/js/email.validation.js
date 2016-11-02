jQuery.fn.checkingMail = function (option) {
    var defaults = {
        submit: '',
        isMail: true,
        checkOption:{},
        callBack: function(e){

        }
    };
    // merge
    var options = $.extend({}, defaults, option);

    var el = $(this);
    var errType = '';
    var o;
    el
        .live('focusout', function(e) {
            var fn = $.parseJSON('{"' + $(this).attr('name') + '": "' + $(this).val() + '"}');
            $.extend(true, options, options, { checkOption: { field: fn }});
            errType = $(this).validateMail(options);
        });
};

jQuery.fn.validateMail = function(options){
    var errType = '';
    var emailReg = /^([\w\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    var emailAddressVal = this.val();

    if(emailAddressVal == '') {

    }else if(!emailReg.test(emailAddressVal) && options.isMail) {
        errType = 'invalid';
    }else{
        if(Object.keys(options.checkOption).length != 0){
            var res = $(this).checkIfExist(options.checkOption);
            errType = res ? 'exist' : '';
        }
    }

    if(errType){
        $(this).addClass('hasError');
        options.submit.controlSubmit({isDisable: true});
        var msg = '';

        switch(errType){
            case 'invalid':
                msg = 'Invalid Email!';
                break;
            case 'exist':
                msg = 'Already exist!';
                break;
        }

        this.displayError({
            msg: msg
        });
    }else{
        this.hideError();
        $(this).removeClass('hasError');
        options.submit.controlSubmit();
    }

    return errType;
};

jQuery.fn.controlSubmit = function(opt){
    var defaults = {
        isDisable: false
    };
    var options = $.extend({}, defaults, opt);

    if(options.isDisable){
        $(this)
            .attr('disabled','disable')
            .addClass('disabled');
    }else{
        if($('.hasError').length == 0){
            $(this)
                .removeAttr('disabled')
                .removeClass('disabled');
        }
    }
};

jQuery.fn.checkIfExist = function(opt){
    var defaults = {
        dbname: '',
        url: '',
        field: {},
        except: {}
    };
    var options = $.extend({}, defaults, opt);

    var res = false;
    //console.log(options.dbname + "\r\n" + options.url + "\r\n" + Object.keys(options.field).length);
    if(options.dbname && options.url && Object.keys(options.field).length != 0){
        $.ajax({
            url:  options.url,
            type: "POST",
            data: {
                dbname: options.dbname,
                field: options.field,
                except: options.except
            },
            async:false,
            success: function(re){
                res = re == "true";
            }
        });
    }

    return res;
};

jQuery.fn.displayError = function (opt){
    var defaults = {
        "msg": "",
        "type": "error"
    };
    var options = $.extend({}, defaults, opt);

    var el = "";

    var thisEl = $(this).parent();
    var epo = $(".error_" + $(this).attr('name'));
    if(epo.length == 0){
        thisEl.append('<div class="error_pop_out error_' + $(this).attr('name') + '" style="font-size: 12px;">'+options.msg+'</div>');

        var wid = (parseInt($(this).css('width')) + (parseInt($(this).css('paddingLeft')) * 2) / 2);
        var top = $(this).position().top - 4;
        var posLeft = (parseInt($(this).position().left) + (parseInt($(this).css('paddingLeft')) * 2));
        var left = parseInt(posLeft + wid);
        var marginLeft = wid + 10;
        var marginTop = (parseInt($(this).css('height')) * 2) + (parseInt($(this).css('paddingTop'))/2);
        marginTop *= -1;

        $('.error_' + $(this).attr('name'))
            .css({
                marginTop: marginTop + "px",
                marginLeft: marginLeft + "px"
            })
            .fadeIn(300);
    }else{
        epo.html(options.msg);
    }
};

jQuery.fn.hideError = function (){
    var epo = $(".error_" + $(this).attr('name'));

    epo.fadeOut(800,function(e){
        $(this).remove();
    });
};