// JavaScript Document
$(function(){
	$('#tableTitle').click(function(e){
		if(e.target.id!=''){
			window.location.replace(bu + 'functionSorting/' + e.target.id + '/' + uri3);
		}
	});
	
	$('#' + whatToSort + '_sort')
        .css({
            'background-color':'#9C0'
        })
        .append('<center><div '+ style + '></div></center>')
        .addClass('currentSort');
});