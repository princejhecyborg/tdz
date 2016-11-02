jQuery.countUpTimer = function(element, option){
    var defaults = {
        interval: 1000,
        txtInitial: "",
        txtEnd: "",
        callBack: function(e){

        }
    };
    // merge
    var options = $.extend({}, defaults, option);

    var countdownInterval = setInterval(function(e){
        var time = new Date();
        var hours = time.getHours() > 12 ? (time.getHours() - 12) : time.getHours();
        var minutes = time.getMinutes();
        var seconds = time.getSeconds();
        var type = time.getHours() > 12 ? 'pm' : 'am';

        var timerStr =
            options.txtInitial +
                $.strPad(hours, 2) + ':' +
                $.strPad(minutes, 2) + ':' +
                $.strPad(seconds, 2) + ' ' +
                type +
            options.txtEnd;
        if(element[0].value !== undefined) {
            element.val(timerStr);
        }
        else{
            element.html(timerStr);
        }
    }, options.interval);
};

jQuery.secondsToString = function(seconds){
    var years = Math.floor(seconds / 31536000);
    var days = Math.floor((seconds % 31536000) / 86400);
    var hours = Math.floor(((seconds % 31536000) % 86400) / 3600);
    var minutes = Math.floor((((seconds % 31536000) % 86400) % 3600) / 60);
    var new_seconds = (((seconds % 31536000) % 86400) % 3600) % 60;

    hours = hours > 12 ? (hours - 12) : hours;

    return $.strPad(hours, 2) + ':' +
        $.strPad(minutes, 2) + ':' +
        $.strPad(new_seconds, 2) + ' ' +
        (hours > 12 ? 'am' : 'pm');
};

jQuery.strPad = function(i, l, s) {
    var o = i.toString();
    if (!s) {
        s = '0';
    }

    while (o.length < l) {
        o = s + o;
    }

    return o;
};