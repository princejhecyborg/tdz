//create new form
jQuery(document).ready(function ($) {
    $.fn.newForm = {
        //add overlay to page
        addOverlay: function(){
            $('body').append('<div id="overlay"></div>');
            var ov = $('#overlay');
            ov.css({'display':'inline','opacity':'0','filter':'(opacity=0)'});
            ov.animate({opacity:.8},200);
        },
        //remove overlay to the page
        removeOverlay: function(){
            $('#overlay').fadeOut(500,function(e){
                $(this).remove();
            });
        },
        //close the form
        removeForm: function(){
            $('#closedCustomForm').live('click',function(e){
                $('#customForm').remove();
                $('#overlay').fadeOut(200,function(e){
                    $(this).remove();
                });
            });
        },
        forceClose: function(){
            $('#customForm').remove();
            $('#overlay').fadeOut(200,function(e){
                $(this).remove();
            });
        },
        //show the form
        addNewForm: function(option){
            var defaults = {
                "isDefault": true,
                "title": "QUERY",
                "url": "",
                "elemento": "",
                "data": {},
                "setSize": false,
                "autoHide": false,
                "toFind": "",
                "customForm":{
                    "width":"400px",
                    "height":"200px",
                    "border": "#000 1px solid;"
                },
                "customFormContent": "text-align: center;",
                "customFormHeader": "background: rgb(0, 0, 0);"
            };
            // merge
            var options = $.extend({}, defaults, option);

            this.addOverlay();

            var body = $('body');
            var ele = '';
            if(options.isDefault){
                ele = '<div id="customForm">';
                ele += '<div id="customFormHeader" style="'+options.customFormHeader+'">' + options.title;
                if(options.autoHide == false){
                    ele += '<span id="closedCustomForm" title="close">x</span>';
                }
                ele += '</div>';
                ele += '<div id="customFormContent" style="'+options.customFormContent+'">';
                if(options.elemento !== ""){
                    ele += options.elemento;
                }
                ele += '</div>';
                ele += '</div>';
                body.append(ele);

                var cf = $('#customForm');
                var cfc = $('#customFormContent');
                var t = (options.customForm.height/2);
                var l = (options.customForm.width/2);
                t *= -1;
                l *= -1;
                cf
                    .css({
                        "width":options.customForm.width,
                        "height":options.customForm.height,
                        "border":options.customForm.border,
                        "top": "50%",
                        "left": "50%",
                        "marginLeft": l,
                        "marginTop": t
                    })
                    .show("scale", 300, function(e){
                        if(options.url !== ""){
                            cfc
                                .load(options.url,options.data,function(e){
                                    if(options.setSize == false){
                                        var wid = cfc.width();
                                        if(options.toFind !== ""){
                                            wid = cfc.find(options.toFind).innerWidth();
                                        }

                                        cf.animate({
                                            width :wid + 25,
                                            height:cfc.height() + 50
                                        },600,function(e){
                                            cf.centerForm();
                                        });
                                    }
                                });
                        }

                        if(options.autoHide == true){
                            cf
                                .delay(800)
                                .fadeOut(500,function(e){
                                    $('#overlay').fadeOut(500,function(e){
                                        $(this).remove();
                                        cf.remove();
                                    });
                                });
                        }
                    });

                this.removeForm();
            }else{
                ele = '<div class="myNewForm">';
                ele += '</div>';
                body.append(ele);

                var parentEl = $('.myNewForm');

                parentEl.loadingForm();
                parentEl
                    .css({
                        "z-index":'999',
                        "position":"absolute"
                    })
                    .load(options.url,function(e){
                        parentEl
                            .prepend("<div id='closeDynaAddedButton' title='close'>x</div>")
                            .centerForm();
                        var cdb = $('#closeDynaAddedButton');
                        cdb.topLeftie(parentEl);
                        cdb.live('click',function(e){
                            cdb.remove();
                            parentEl.fadeOut(300,function(e){
                                parentEl.remove();
                                var ob = $('#overlay');
                                ob.fadeOut(500,function(e){
                                    ob.remove();
                                });
                            });
                        });
                    });
            }
        },
        formSizeChange: function(option){
            var defaults = {
                "toFind": ""
            };
            // merge
            var options = $.extend({}, defaults, option);

            var cf = $('#customForm');
            var cfc = $('#customFormContent');
            var wid = cfc.width();
            if(options.toFind !== ""){
                wid = cfc.find(options.toFind).width();
            }

            cf.animate({
                width :wid + 25,
                height:cfc.height() + 50
            },600,function(e){
                cf.centerForm();
            });
        }
    }
});

jQuery.fn.loadingForm = function () {
    var parentEl = $('.myNewForm');

    var el = "";
    el += '<div id="preLoadingForm">';
    el += 'Please wait!<br />';
    el += 'Page is still Loading...<br />';
    el += '<img id="loading" src="'+baseUrl+'img/loading.gif" width="80" />';
    el += '</div>';

    parentEl.html(el);
    var thisId = $('#preLoadingForm');

    $('#loading').load(function() {
        thisId.centerForm();
    });
}

jQuery.fn.centerForm = function () {
    var top = (this.outerHeight()/2);
    var left = (this.outerWidth()/2);
    top *= -1;
    left *= -1;

    this
        .css({
            "position":"fixed",
            "z-index": 999,
            "top": "50%",
            "left": "50%"
        })
        .animate({
            "marginLeft": left,
            "marginTop": top
        },300);
}

jQuery.fn.topLeftie = function (el) {
    var top = (el.outerHeight()/2) + (this.outerHeight()/2);
    var left = (el.outerWidth()/2) + (this.outerWidth()/2);
    top *= -1;
    left *= -1;

    this.css({
        "position":"fixed",
        "margin": top + "px " + left + "px",
        "top": "50%",
        "left": "50%"
    });
}