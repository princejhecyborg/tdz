// JavaScript Document
var el;
var city;

$(function(){
    //to tell the user what are the search option
    $('#searchInput').click(function(e){
        var thisArea = $(this).parent();
        el = '';
        el += '<div id="searchSuggestion" style="min-width: 130px;">';
            el += "<strong>Search Options:";
                el += "<span id='closeSearch' style='float: right;cursor: pointer;margin: -8px -5px;'>x</span> ";
            el += "</strong>\n";
            el += "<table style='margin: 0 0 0 -20px;'>";
                el += "<tr style='vertical-align: top;'>";
                    el += "<td>";
                        el += "<ul style='list-style: circle;margin: 0 0 0 5px;'>";
                            el += "<li>Plan Name</li>";
                            el += "<li>Client Ref</li>";
                            el += "<li>TDZ Ref</li>";
                        el += "</ul>";
                    el += "</td>";
                    if($(this).attr('class')== "forAdmin"){
                        el += "<td>";
                            el += "<ul style='list-style: circle;margin: 0 0 0 5px;'>";
                                el += "<li>Area (m<sup>2</sup>)</li>";
                                el += "<li>Type</li>";
                                el += "<li>Client</li>";
                            el += "</ul>";
                        el += "</td>";
                    }
                el += "</tr>";
            el += "</table>";
        el += '</div>';

        if(thisArea.find('#searchSuggestion').length == 0){
            thisArea.append(el);
            var ss = $('#searchSuggestion');
            $('#closeSearch').on('click',function(e){
                ss.remove();
            });
        }
    });

    $('.viewComments').click(function(e){
        var thisId = this.id;
        $.post(bu + 'setViewPlanActive/commentsLink', function(e){
            location.replace(bu + 'viewPlan/' + thisId);
        });
    });

    $('.job_description').click(function(e){
        var thisid = this.id;

        $(this).newForm.addNewForm({
            isDefault: false,
            url: bu + 'planDescriptionView/' + thisid
        });
    });

    $('.view_eta').click(function(e){
        e.preventDefault();

        var thisid = this.id;
        $(this).newForm.addNewForm({
            isDefault: false,
            url: bu + 'etaInfo/' + thisid
        });
    });

	$('.unit').keyup(function(){
		var val = $(this).val();
        var el = $('#total_'+this.id);
		if(val!=''){
            el.html(parseFloat(val).toFixed(2));
		}else{
            el.html('');
		}
		
		var subtotal = 0;
        var unit = $('.unit');
        unit.each(function(e) {
			subtotal += Number($(this).val());
		});
		
		$('#subtotal').html('$'+parseFloat(subtotal).toFixed(2));
		var gst = subtotal * 0.15;
		$('#gst').html('$'+parseFloat(gst).toFixed(2));
		var total = parseFloat(subtotal) + parseFloat(gst);
		$('#total').html('$'+parseFloat(total).toFixed(2));
		
		
		var ifSomeNotEmpty = 0;
        unit.each(function(e) {
			if($(this).val()!=''){
				ifSomeNotEmpty += 1;
			}
		});

        var sub = $('input[type=submit]');
		if(ifSomeNotEmpty!=0){
            sub.css('display','inherit');
		}else{
            sub.css('display','none');
		}
	});

    var ctry = $('.country');
    var cty = $('.city');
	var prevel = '';
	$('.addcountry, .editcountry, .deletecountry').click(function(e){
		if($(this).attr('class') == 'editcountry'){
            var thisid = this.id;

            $(this).newForm.addNewForm({
                title: 'Edit Country',
                url: bu + 'country/editCountry/' + thisid,
                toFind: '#inputCountry'
            });
		}else if($(this).attr('class') == 'deletecountry'){
			var id = this.id;
			var el = '<div style="padding:5px 10px;text-align:center;">';
			el += 'Are you sure you want to delete this?<br />';
			el += '<input type="button" value="yes" class="query mybutton"/>';
			el += '<input type="button" value="no" class="query mybutton"/>';
			el += '</div>';


            $(this).newForm.addNewForm({
                title: 'Delete Country',
                elemento: el,
                "customForm":{
                    "width":"300px",
                    "height":"120px",
                    "border": "#000 1px solid;"
                }
            });

			$('html').delegate('.query','click',function(e){
				if($(this).val() == 'yes'){
					window.location.replace(bu+'deletecountry/'+id);
				}else{
                    $(this).newForm.forceClose();
				}
			});
		}else{
            $(this).newForm.addNewForm({
                title: 'Add Country',
                url: bu + 'country/addCountry',
                toFind: '#inputCountry'
            });
		}

        $('#submitcountry').on('click', function(e){
            if(ctry.val() == ''){
                ctry.css({'border':'#F00 1px solid'});
                return false;
            }
        });
	});
	
	var prevell = '';
	$('.addcity, .editcity, .deletecity').click(function(e){
		if($(this).attr('class') == 'editcity'){
            var thisid = this.id;

            $(this).newForm.addNewForm({
                title: 'Edit City',
                url: bu + 'country/editCity/' + thisid,
                toFind: '#addCity'
            });
        }else if($(this).attr('class') == 'deletecity'){
            var id = this.id;
            var el = '<div style="padding:5px 10px;text-align:center;">';
            el += 'Are you sure you want to delete this?<br />';
            el += '<input type="button" value="yes" class="query mybutton"/>';
            el += '<input type="button" value="no" class="query mybutton"/>';
            el += '</div>';


            $(this).newForm.addNewForm({
                title: 'Delete Country',
                elemento: el,
                "customForm":{
                    "width":"300px",
                    "height":"120px",
                    "border": "#000 1px solid;"
                }
            });

            $('html').delegate('.query','click',function(e){
                if($(this).val() == 'yes'){
                    window.location.replace(bu+'deletecity/'+id);
                }else{
                    $(this).newForm.forceClose();
                }
            });
		}else{
            $(this).newForm.addNewForm({
                title: 'Add City',
                url: bu + 'country/addCity',
                toFind: '#addCity'
            });
		}
	});
	
	$('#addcustomer, .editcustomer, .deletecustomer').click(function(e){
		if($(this).attr('class') == 'editcustomer'){
			var id = this.id;
            $(this).newForm.addNewForm({
                title: "Update Customer",
                url: bu+'inputcustomer/'+id,
                customFormContent: ""
            });
		}else if($(this).attr('class') == 'deletecustomer'){
			var id = this.id;
			var el = '<div style="padding:5px 10px;text-align:center;">';
			el += 'Are you sure you want to delete this?<br />';
			el += '<input type="button" value="yes" class="query mybutton" style="margin-right: 10px;"/>';
			el += '<input type="button" value="no" class="query mybutton"/>';
			el += '</div>';
			
			//$('#customerinput').html(el);
            $(this).newForm.addNewForm({
                title: "Delete Customer",
                elemento: el,
                "setSize": true,
                "customForm":{
                    "width":"320px",
                    "height":"120px",
                    "border": "#000 1px solid;"
                },
                customFormContent: ""
            });

			$('.query').live('click',function(e){
				if($(this).val() == 'yes'){
					window.location.replace(bu+'deletecustomer/'+id);
				}else{
                    $(this).newForm.forceClose();
				}
			});
		}else{
            $(this).newForm.addNewForm({
                title: "Add Customer",
                url: bu + 'inputcustomer',
                customFormContent: ""
            });
		}
	});

	$('#addstaff, .editstaff, .deletestaff').click(function(e){
        if($(this).attr('class') == 'editstaff'){
            var curId = this.id;
            $(this).newForm.addNewForm({
                title: "Update Staff",
                url: bu+'inputstaff/'+curId,
                customFormContent: ""
            });
        }else if($(this).attr('class') == 'deletestaff'){
            var id = this.id;
            var el = '<div style="padding:5px 10px;text-align:center;">';
            el += 'Are you sure you want to delete this?<br />';
            el += '<input type="button" value="yes" class="query mybutton" style="margin-right: 10px;"/>';
            el += '<input type="button" value="no" class="query mybutton"/>';
            el += '</div>';

            //$('#customerinput').html(el);
            $(this).newForm.addNewForm({
                title: "Delete Staff",
                elemento: el,
                "setSize": true,
                "customForm":{
                    "width":"320px",
                    "height":"120px",
                    "border": "#000 1px solid;"
                },
                customFormContent: ""
            });

            $('.query').live('click',function(e){
                if($(this).val() == 'yes'){
                    window.location.replace(bu+'deletestaff/'+id);
                }else{
                    $(this).newForm.forceClose();
                }
            });
        }else{
            $(this).newForm.addNewForm({
                title: "Add Staff",
                url: bu+'inputstaff',
                customFormContent: ""
            });
        }
	});
	
	$('#addbranch, .editbranch, .deletebranch').click(function(e){
        if($(this).attr('class') == 'editbranch'){
            var curId = this.id;
            $(this).newForm.addNewForm({
                title: "Update Branch",
                url: bu + 'inputbranch/' + curId,
                customFormContent: ""
            });
        }else if($(this).attr('class') == 'deletebranch'){
            var id = this.id;
            var el = '<div style="padding:5px 10px;text-align:center;">';
            el += 'Are you sure you want to delete this?<br />';
            el += '<input type="button" value="yes" class="query mybutton" style="margin-right: 10px;"/>';
            el += '<input type="button" value="no" class="query mybutton"/>';
            el += '</div>';

            //$('#customerinput').html(el);
            $(this).newForm.addNewForm({
                title: "Delete Branch",
                elemento: el,
                "setSize": true,
                "customForm":{
                    "width":"320px",
                    "height":"120px",
                    "border": "#000 1px solid;"
                },
                customFormContent: ""
            });

            $('.query').live('click',function(e){
                if($(this).val() == 'yes'){
                    window.location.replace(bu+'deletebranch/'+id);
                }else{
                    $(this).newForm.forceClose();
                }
            });
        }else{
            $(this).newForm.addNewForm({
                title: "Add Branch",
                url: bu + 'inputbranch',
                customFormContent: ""
            });
        }
	});
	
	$('#submitcustomer, #submitstaff, #submitbranch, #addjob, #updateaccount').click(function(e){
		return submitValid();
	});

	if(ctry.length != 0){
		selectcities();
        ctry.change(function(){
			selectcities();
		});
	}
	
	if($('#roof_cladding').length != 0){
		var temproofval = '';
		$('#roof_cladding').change(function(){
			if($('#other_floor_type_value').val() !== ''){
				temproofval = $('#other_floor_type_value').val();
			}
		
			if($(this).val() == 'Other'){
				$('#other_floor_type_value').removeAttr('disabled').val(temproofval);
			}else{
				$('#other_floor_type_value').attr('disabled','disabled').val('');
			}
		});
	}
	
	if($('#other_roof_radio').length != 0){
		var temproofother = '';
		$('#other_roof_radio').click(function(){
			if($('#other_roof_type').val() !== ''){
				temproofother = $('#other_roof_type').val();
			}
			
			if($(this).attr('checked')){
				$('#other_roof_type').removeAttr('disabled').val(temproofother);
			}else{
				$('#other_roof_type').attr('disabled','disabled').val('');
			}
		});
	}	
	
	if($('#datein').length != 0){
		$('#datein').datepicker({
			dateFormat: "yy-mm-dd",
			showOn: "button",
			buttonImage: baseUrl+"img/calendar.gif",
			buttonImageOnly: true,
			onSelect: function() {
				var date = $('#datein').val();
				var dt = date.split('-');
				var dtstr = dt[2]+'-'+dt[1]+'-'+dt[0];
				$('#datetext').html(String(dtstr));
				
				var neweta = addBusinessDays(new Date($('#datein').val()),6);
				var month = neweta.getMonth()+1;
				month = (paddie(month,2));
				$('#eta').val(neweta.getFullYear()+'-'+month+'-'+neweta.getDate());
				$('#etatext').html(neweta.getDate()+'-'+month+'-'+neweta.getFullYear());
				
				var origdate = new Date($('#datein').val());
				var comdate = new Date($('#complete_date').val());
				$('#complete_date').val(dateFormat(origdate, 'ddd, dd mmm yyyy '+paddie(comdate.getHours(),2)+':'+paddie(comdate.getMinutes(),2)+':'+paddie(comdate.getSeconds(),2)+' o'));
			}
		});
	}

	if($('#birthdate').length != 0){
		var date = new Date();
		$('#birthdate').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			yearRange: "1900:"+date.getFullYear(),
			showOn: "button",
			buttonImage: baseUrl+"img/calendar.gif",
			buttonImageOnly: true,
			onSelect: function() {
				var date = $('#birthdate').val();
				var dt = date.split('-');
				var dtstr = dt[2]+'-'+dt[1]+'-'+dt[0];
				$('#datetext').html(String(dtstr));
			}
		});
		
		$('#employeeddate').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			yearRange: "1900:"+date.getFullYear(),
			showOn: "button",
			buttonImage: baseUrl+"img/calendar.gif",
			buttonImageOnly: true,
			onSelect: function() {
				var date = $('#employeeddate').val();
				var dt = date.split('-');
				var dtstr = dt[2]+'-'+dt[1]+'-'+dt[0];
				$('#employeeddatetext').html(String(dtstr));
			}
		});
	}
	
	if($('#eta').length != 0){
		$('#eta').datepicker({
			dateFormat: "yy-mm-dd",
			showOn: "button",
			buttonImage: baseUrl+"img/calendar.gif",
			buttonImageOnly: true,
			onSelect: function() {
				var date = $('#eta').val();
				var dt = date.split('-');
				var dtstr = dt[2]+'-'+dt[1]+'-'+dt[0];
				$('#etatext').html(String(dtstr));
			}
		});
	}
	
	var othervaltemp = '';
	$('#other').click(function(e){
		if($('#other_value').val() !== 'Other here (separated by comma)' && $('#other_value').val() !== ''){
			othervaltemp = $('#other_value').val();
		}
		
		if($(this).attr('checked')){
			$('#other_value').removeAttr('disabled').val(othervaltemp).attr('class','required');
		}else{
			$('#other_value').attr('disabled','disabled').val('').removeAttr('class');
		}
	});
	
	if($('#attachmentarea').length != 0){
		$('#attachmentarea').load(bu + 'upload');
	}

    var ln = $('.long_notes');
	if(ln.length != 0){
		var str = [];
		var ref = 0;
        var maxLen = 25;
        if(ln.attr('maxlength')){
            maxLen = ln.attr('maxlength');
        }
        ln.each(function(e) {
            var contentHtml = $(this).html();

            if(contentHtml){
                var tmpStr = contentHtml.split('~*_*~');
                var len1 = tmpStr[0].length;
                var thisLen = Number(len1);

                if(tmpStr.length == 2){
                    str[ref] = tmpStr[0] + ' - <strong>' + tmpStr[1] + '</strong>';
                }else{
                    str[ref] = tmpStr[0];
                }

                var tmp = '';
                if(thisLen>maxLen){
                    tmp = str[ref].substr(0,maxLen);
                    tmp += '...<a href="#" id="'+ref+'" class="view_more">more</a>';

                }else{
                    tmp = str[ref];
                }
                $(this).html(tmp);
                ref++;
            }
        });

        var vm = $('.view_more');
        vm.live({
			mouseenter:
				function(e){
                    $(this).parent().prepend('<span id="tmp_note">' + str[this.id] +'</span>');
                    var tn = $('#tmp_note');
                    var mL = $(this).offset().left - (tn.innerWidth() + 10);
                    tn
                        .fadeIn(300)
                        .css({
                            'marginLeft': mL + 'px'
                        });
				},
			mouseleave:
				function(e){
					$('#tmp_note').remove();
				}
		});
	}

    var radio = $('input[type=radio]:not(.radio_xcld)');
	if(radio.length != 0){
        radio.each(function(e){
            var check;
            $(this).click(function(e){
                if(check){
                    $(this).prop('checked', false);
                }
                check = this.checked;
            });
        });
	}

    var draft_person_info = $('.draft_person_info');
	if(draft_person_info.length != 0){
        draft_person_info.hover(
            function(e){
                $(this).append('<div id="draft_info_display"></div>');
                var wid = $(this).width() + 5;
                $('#draft_info_display')
                    .css({'margin-left':wid+'px'})
                    .load(bu + 'draftpersonInformation/' + this.id)
                    .fadeIn(300);
            },
            function(e){
			$('#draft_info_display').remove();
		}
        );
	}
	
	if($('.progressinfo').length != 0){
		var temp = '';
		$('.progressinfo').css('cursor','pointer').hover(function(e){
			temp = $(this).html();
			$(this).html($(this).attr('alt'));
		},function(e){
			$(this).html(temp);
		});
	}

    $('#tracking_table tr, .no_bg tr, .draftTable tr').hover(
        function(){
            $(this).addClass('hoverTr');
        },
        function(){
            $(this).removeClass('hoverTr');
        }
    );
    remainThisColor();

    var rejected_job = $('.rejected_job');
	if(rejected_job.length != 0){
        rejected_job
            .parent()
            .children('td')
            .each(function(e) {
                $(this)
                    .css({
                        'background-color':'#a89f9f',
                        'color':'#666'
                    })
                    .unbind('mouseenter mouseleave');
            });
	}
});

function remainThisColor(){
	$('.warning td').css({'background-color':'#FF9966'});
	$('.alert td').css({'background-color':'#FF3333'});
	$('.color_no_change').each(function(e) {
        var id = $(this).attr('id');
		$(this).css({'background-color': color_option[id]});
    });
}

function submitValid(){
	var hasEmpty = false;
	$('.required').each(function() {
		if($(this).val()==""){
			$(this).css({'border':'#F00 1px solid'});
			hasEmpty = true;

            var ermsg = $('#error_msg');
			if(ermsg.length != 0){
                ermsg.html('Don\'t leave empty field(s)!');
			}
		}else{
			$(this).css('border','#CCC 1px solid');
		}
	});

    var pass = $('.pass1');
	if(pass.length != 0){
		if(pass.val() !== $('.pass2').val()){
			$('#error_msg').html('Password doesn\'t match!');
			hasEmpty = true;
		}
	}

	if(hasEmpty == true){return false;}
}

function selectcities(){
    var ic = $('#initialcity');
    var ct = $('#city');
    var ctry = $('#country');
	if(ic.length != 0){
		city = ic.val();
	}

    ct.html('');
	for (x in cities){
		if(cities[x] == ctry.val()){
			if(city!='' && city == x){
                ct.append('<option selected="selected">'+x+'</option>');
			}else{
                ct.append('<option>'+x+'</option>');
			}
		}
	}
}

function checkMail(id){
	var hasError = false;
	var emailReg = /^([\w\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var emailblockReg = /^([\w\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)([\w-]+\.)+[\w-]{2,4})?$/;

    var el = $("#"+id+"");
	var emailaddressVal = el.val();
	if(emailaddressVal == '') {
		hasError = true;
	}
 
	else if(!emailReg.test(emailaddressVal)) {
		hasError = true;
	}
 
	else if(!emailblockReg.test(emailaddressVal)) {
	}
	else{
	}

	if(hasError == true) {
        el.css('border','#FF0000 1px solid');
		return false;
	}
	else{
        el.css('border','#CCC 1px solid');
        return true;
    }
}

function calcBusinessDays(dDate1, dDate2) { // input given as Date objects
	var iWeeks, iDateDiff, iAdjust = 0;
	var validWorkingDays = 5;
	if (dDate2 < dDate1) return -1; // error code if dates transposed
	var iWeekday1 = dDate1.getDay(); // day of week
	var iWeekday2 = dDate2.getDay();
	iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
	iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
	if ((iWeekday1 > validWorkingDays) && (iWeekday2 > validWorkingDays)) iAdjust = 1; // adjustment if both days on weekend
	iWeekday1 = (iWeekday1 > validWorkingDays) ? validWorkingDays : iWeekday1; // only count weekdays
	iWeekday2 = (iWeekday2 > validWorkingDays) ? validWorkingDays : iWeekday2;

	// calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
	iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000);

	if (iWeekday1 <= iWeekday2) {
	  iDateDiff = (iWeeks * validWorkingDays) + (iWeekday2 - iWeekday1);
	} else {
	  iDateDiff = ((iWeeks + 1) * validWorkingDays) - (iWeekday1 - iWeekday2);
	}

	iDateDiff -= iAdjust; // take into account both days on weekend
	
	var finalTurn = iDateDiff + 1;
	if(completeHour >= 12){
		//alert('aw');
        finalTurn -= 1;
	}else{
		//if(final > 3 && final < 4){
			//final = final + 1;
		//}
	}
	
	return (finalTurn); // add 1 because dates are inclusive
}

function addBusinessDays(d,n) {
    d = new Date(d.getTime());
    var day = d.getDay();
    d.setDate(d.getDate() + n +(day === 6 ? 2 : +!day) + (Math.floor((n - 1 + (day % 6 || 1)) / 5) * 2));
    return d;
}

function pad (str, max) {
  return str.length < max ? pad("0" + str, max) : str;
}

function paddie(val, len){
	val = String(val);
	len = len || 2;
	while (val.length < len) val = "0" + val;
	return val;
}