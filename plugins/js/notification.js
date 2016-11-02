$(function(){
    var el, ex;

    notifyUser();
    branchCheck();

	function notifyUser(){
		$.post(bu + 'notifyUser', {}, onSuccess);
	}

    function branchCheck(){
        $.post(bu + 'branchNotify', {}, onBranch);
    }

	function onSuccess(data) {
        var notification = $('.notification');
        var nEle = $('#noty');

		if(Object.keys(data).length > 0){
			if(current_page == 'trackinglog'){
                notification.remove();
                $.each(data, function(tdz_id, count){
                    el = '<div class="notification" id="notification_' + tdz_id + '">' + count + '</div>';
                    var appendToEle = $('#td_'+ tdz_id +' > td:first-child');
                    if(appendToEle.length != 0){
                        appendToEle.prepend(el);
                        var ne = $('#notification_' + tdz_id);
                        var mLeft = ne.innerWidth() + 7;
                        ne.css({
                            'margin-left':'-' + mLeft + 'px',
                            'margin-top':'-5px'
                        });
                    }
                });
			}
		}
        else{
			if(notification.length != 0){
                notification.remove();
			}
			
			if(nEle.length != 0){
                nEle.remove();
			}
		}
	}
	
	function onBranch(data) {
        var branch_notify = $('#branch_notify');
		if(data!=''){
            branch_notify.remove();
			el = '<div id="branch_notify">New Branch(es): &nbsp;<span style="color:#F00">'+data+'</span> &nbsp;</div>';
			$('#account_info').append(el);
            branch_notify.css({'font-size':'12px'});
		}else{			
			if(branch_notify.length != 0){
                branch_notify.remove();
			}
		}
	}
});