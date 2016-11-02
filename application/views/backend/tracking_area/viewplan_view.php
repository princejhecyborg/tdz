<head>
	<style>
		.viewtable{position: relative;top:-20px;}
		.viewtable .info{text-align: right}
/*		.statusBtn{background-color:#221F1F;color:#FFF;}
		.statusBtn:focus{background-color:#221F1F;color:#FFF;}
*/		thead th{text-align: center;}
		#draftprog {text-align: center;}
		/* Tooltip */
        .tip + .tooltip > .tooltip-inner {
            background-color: #181818 ;
            color: #FFFFFF;
            padding: 5px;
            font-size: 15px;
        }
        .badge{background-color: #e60000;color:white;position: relative;top:-10px;left:-5px;}
        /* Tooltip on right */
        .tip + .tooltip.right > .tooltip-arrow {
            border-right: 5px solid black;
        }
        /*for jquery ui dialog*/
        .ui-dialog-osx {
		    -moz-border-radius: 0 0 8px 8px;
		    -webkit-border-radius: 0 0 8px 8px;
		    border-radius: 0 0 8px 8px; border-width: 0 8px 8px 8px;
		    position: absolute;
		    top:30%;
		    left:40%;
		}
		.ui-dialog-titlebar {
		  background-color: #428BCA;
		  background-image: none;
		  color: white;
		}
		.tbl + th, td {
		    padding: 5px;
		    font-size: 15px;
		}
		.ellipsis {
	       max-width: 500px;
		   padding: 5px;
		   text-align: left;
		   table-layout:fixed;
		   word-wrap: break-word;
		}
		/*for smaller screens*/
		@media only screen and (max-width: 1500px) {
		    table {font-size: 12px}
		}
	</style>
</head>
<?php
	$display = ($this->session->userdata('sessionid')==1) ? '' : 'none';
?>
<ul class="nav nav-tabs">
	<li><a data-toggle="tab" href="#jobdetails">Job Details</a></li>
	<li class="active"><a data-toggle="tab" href="#assigndetails">Assign Details</a></li>
	<li><a data-toggle="tab" href="#comments">Comments Area</a></li>
	<li style="display: <?=$displayDP = ($this->session->userdata('sessionid')==2) ? '' : 'none';?>"><a data-toggle="tab" href="#daily">Daily Accomplishments</a></li>
</ul>
<div class="tab-content">
<br>

<!-- JOB DETAILS REGION -->

  <div id="jobdetails" class="tab-pane fade">
  	<div class="col-sm-12 row">
  		<a href="<?=base_url().'jobedit/'.$this->uri->segment(2);?>"><button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Edit</button></a>
  	</div>
  	<hr>
  	<br>
    <div class="col-sm-12 row">
    	<div class="col-sm-4 row">
	    	<div class="panel panel-default">
			  <div class="panel-heading" style="color:#4e7a97;"><span class="glyphicon glyphicon-info-sign"></span> Client Details</div>
			</div>
    		<table class="customTable table table-bordered table-hover table-condensed table-striped viewtable">
		  		<tr><td width="150" class="info">Clients Name: </td><td><?=$trackingResult->house_owner;?></td></tr>
		  		<tr><td width="150" class="info">Street Address: </td><td><?=$trackingResult->street_address;?></td></tr>
		  		<tr><td width="150" class="info">Postal Code: </td><td><?=$trackingResult->postal_code;?></td></tr>
		  		<tr><td width="150" class="info">Mailing Address: </td><td><?=$trackingResult->mailing_address;?></td></tr>
		  		<tr><td width="150" class="info">Email: </td><td><?=$trackingResult->email;?></td></tr>
		  		<tr><td width="150" class="info">Telephone #: </td><td><?=$trackingResult->tnum;?></td></tr>
    		</table>
    	</div>
    	<div class="col-sm-8">
    		<div class="panel panel-default">
			  <div class="panel-heading" style="color:#4e7a97;"><span class="glyphicon glyphicon-info-sign"></span> Plan Details</div>
			</div>
			<table class="customTable table table-bordered table-hover table-condensed table-striped viewtable">
		  		<tr>
		  			<td width="200" class="info">Job Name: </td><td width="350"><?=$trackingResult->job_name;?></td>
		  			<td width="200" class="info">Corrosion: </td><td width="350"><?=$trackingResult->corrosion;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">DP #: </td><td width="350"><?=$trackingResult->dp_num;?></td>
		  			<td width="200" class="info">Climate Zone: </td><td><?=$trackingResult->climate_zone;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">Lot #: </td><td width="350"><?=$trackingResult->lot_number;?></td>
		  			<td width="200" class="info">Snow Loading: </td><td width="350"><?=$trackingResult->snow_loading;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">City: </td><td width="350"><?=$trackingResult->city;?></td>
		  			<td width="200" class="info">Building/House Area: </td><td width="350"><?=$trackingResult->bh_area;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">Suburb: </td><td width="350"><?=$trackingResult->suburb;?></td>
		  			<td width="200" class="info">Net Site Area: </td><td width="350"><?=$trackingResult->net_site_area;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">TDZ Ref: </td><td width="350"><?=$trackingResult->job_code;?></td>
		  			<td width="200" class="info">Percentage: </td><td width="350"><?=$trackingResult->percentage;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">Client Ref: </td><td width="350"><?=$trackingResult->reference;?></td>
		  			<td width="200" class="info">Wind Zone: </td><td width="350"><?=$trackingResult->windzones;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">Date In: </td><td width="350"><?=$trackingResult->date;?></td>
		  			<td width="200" class="info">Ground Roughness: </td><td width="350"><?=$trackingResult->groundroughness;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">Type: </td><td width="350"><?=$trackingResult->plan_detailed_status;?></td>
		  			<td width="200" class="info">Topography: </td><td width="350"><?=$trackingResult->topography;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">Territorial Authority: </td><td width="350"><?=$trackingResult->council_area;?></td>
		  			<td width="200" class="info">Site Exposure: </td><td width="350"><?=$trackingResult->site_exposure;?></td>
		  		</tr>
		  		<tr>
		  			<td width="200" class="info">Earthquake: </td><td width="350"><?=$trackingResult->earthquake;?></td>
		  			<td width="200" class="info">Notes: </td><td width="350"><?=$trackingResult->notes;?></td>
		  		</tr>
    		</table>
    	</div>
    </div>
  </div>

  <!-- ASSIGN DETAILS REGION -->

  <div id="assigndetails" class="tab-pane fade in active">
  	<div class="col-sm-12 row">
  	<div class="col-sm-12 row">
  		<div class="panel panel-default">
		  <div class="panel-heading" style="color:#4e7a97;"><span class="glyphicon glyphicon-info-sign"></span> Plan Details</div>
		</div>
		<table class="customTable table table-bordered table-hover table-condensed table-striped viewtable">
		  	<tr>
		  		<td width="200" class="info">Job Name:</td>
		  		<td><?=$trackingResult->job_name;?></td>
		  	</tr>
		  	<tr>
		  		<td width="200" class="info">Client:</td>
		  		<td><?=$trackingResult->company_name;?></td>
		  	</tr>
		  	<tr>
		  		<td width="200" class="info">Status:</td>
		  		<td><?=$trackingResult->plan_detailed_status;?></td>
		  	</tr>
		  	<?php
		  		echo form_open('');
		  	?>
		  	<tr style="display: <?=$display;?>">
		  		<td width="200" class="info">TDZ Priority:</td>
		  		<td>
		  			<input type="hidden" name="id" value="<?=$this->uri->segment(2);?>">
		  			<select class="input-sm" name="is_urgent">
		  				<?=$selected = ($trackingResult->is_urgent==1) ? "selected" : "";?>
		  				<option value="0">No</option>
		  				<option value="1" <?=$selected = ($trackingResult->tdz_priority==1) ? "selected" : "";?> >Yes</option>
		  			</select>
		  			<button type="submit" name="changeinfo" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving your changes">Change</button>
		  		</td>
		  	</tr>
		  	<?php
		  		echo form_close();
		  	?>
		</table>
		<hr/>
		<br/>
  	<div class="panel panel-default">
		<div class="panel-heading" style="color:#4e7a97;">
			<span class="glyphicon glyphicon-info-sign"></span> 
			Drafting Progress
		</div>
	</div>
  	</div>
  	</div>
  	<div class="col-sm-12 row">
  	<div class="col-sm-12 row">
  		<table class="customTable table table-bordered table-hover table-condensed table-striped viewtable">
  			<thead>
  				<th width="280"></th>
  				<th width="250">Draft<br/>Person</th>
  				<th width="130">Date<br/>Assign</th>
  				<th width="130">Delivery<br/>Date</th>
  				<th width="130">Actual<br/>Delivery</th>
  				<th width="90">Time</th>
  				<th width="90">Checker</th>
  				<th width="90">Time</th>
  			</thead>
  			<tbody>
  				<?php
  					foreach ($draft_progress->result() as $i =>  $draftValue)
  					{
  						?>
  							<tr>
  								<td width="280">
  									<?=$draftValue->title;?>
  									<a href=""><?=$remove = ($draftValue->dp_id!=0 && $i==$key && $draftValue->actual_delivery=='0000-00-00') ? "(remove)" : "";?></a>
								</td>
  								<td align="center" width="250">
  									<?php
  										if ($draftValue->dp_id==0)
  										{
  											echo form_open('');
  											?>
  											<input type="hidden" name="assign_id" value="<?=$draftValue->phase_id;?>">
  											<select class="input-sm" name="dp_id">
  												<?php
  													foreach($staff->result() as $staffValue)
  													{
  														?>
  														<option value="<?=$staffValue->id?>"><?=$staffValue->name?></option>
  														<?php
  													}
  												?>
  											</select>
  											<input type="submit" name="assignDP" value="Assign" class="statusBtn btn btn-primary btn-sm">
  											<?php
  											echo form_close();
  										}
  										else
  										{
  											?>
  											<span class="tip" data-toggle="tooltip" data-placement="right" title="<?=$draftValue->name;?>"> <?=$draftValue->code;?> </span>
  											<?php
  										}
  									?>
  								</td>
  								<td align="center" width="130">
  									<?=$date_assigned = (!empty($draftValue->dp_id)) ? $draftValue->date_assigned : "N/A";?>
  								</td>
  								<td align="center" width="130">
  									<?=$Delivery = (!empty($draftValue->dp_id)) ? $draftValue->date_delivery : "N/A";?>
  								</td>
  								<td align="center" width="130">
  									<?=$actual = ($draftValue->actual_delivery!="0000-00-00") ? $draftValue->actual_delivery : "N/A";?>
  								</td>
  								<td align="center" width="90">
  									<?=$actual = ($draftValue->time_up!="0.00000") ? $draftValue->time_up : "N/A";?>
  								</td>
  								<td align="center" width="90">
  									<?php
  										$checker_id = $this->db->where('id', $draftValue->checker_id)->get('tbl_user')->result();
  										foreach ($checker_id as $checker)
  										{
  											?>
  											<span class="tip" data-toggle="tooltip" data-placement="right" title="<?=$checker->name;?>">
  												<?=$actual = ($draftValue->checker_id!=0) ? $checker->code : 'N/A';?>
  											</span>
  											<?php
  										}
  									?>
  								</td>
  								<td align="center" width="90">
  									<?=$actual = ($draftValue->time_up_check!="0.00000") ? $draftValue->time_up_check : "N/A";?>
  								</td>
  							</tr>
  						<?php
  					}
  				?>
  			</tbody>
  		</table>
  		<div style="position: relative;top:-20px;float:right;display:<?=$display;?>">
  			<?php
		  		$row = $draft_progress->result();
		  		if(count($row)>0)
		  		{
			        end($row);        
			        $lastkey = key($row);
			        foreach ($row as $lastkey => $value);
			        $disabled = ($value->actual_delivery=="0000-00-00") ? "disabled" : "";
			        $force = ($value->actual_delivery!="0000-00-00") ? "disabled" : "";
			        $skip = ($value->has_skip==0 || $value->actual_delivery=="0000-00-00") ? "disabled" : "";
		    	}
  			?>
  			<!-- for skip form -->
  			<form action="" id="skipForm" method="POST">
  				<input type="hidden" name="skip_status" value="<?=$stat = (isset($value->skip_status)) ? $value->skip_status : '';?>">
  			</form>
		  	<button class="statusBtn btn btn-primary" id="addphase" <?=$disabled = (isset($disabled)) ? $disabled : '';?>><span class="glyphicon glyphicon-plus"></span> Add Phase</button>
		  	<button type="submit" class="statusBtn btn btn-primary" id="skip" <?=$skip = (isset($skip)) ? $skip : '';?>><span class="glyphicon glyphicon-forward"></span> Skip</button>
			<button class="statusBtn btn btn-primary"><span class="glyphicon glyphicon-pause"></span> Hold</button>
			<button class="statusBtn btn btn-primary" id="force_finish" <?=$force = (isset($force)) ? $force : '';?>><span class="glyphicon glyphicon-stop"></span> Force Finish</button>
			<button class="statusBtn btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Invoice</button>
			<button class="statusBtn btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Pay Invoice</button>
			<button class="statusBtn btn btn-primary"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
		</div>
  	</div>
  	</div>
  </div>

<!-- Add phase dialog area -->
<?php
	if (!empty($nextTitle) || !empty($staffValue) || !empty($value))
	{
	?>
	<div id="dialog-message" title="Add Phase" class="col-sm-12" style="display: none;">
	    <p>
	    	Continue to <strong><?=$nextTitle->title;?></strong> and assign draftsperson?
	    </p>
	    <form method="POST" action="">
	    <input type="hidden" name="skip_status" value="<?=$planstatus = (isset($value->plan_status)) ? $value->plan_status : '';?>">
	    <input type="hidden" name="phase_id" value="<?=$nextID = (isset($nextTitle)) ? $nextTitle->id : '';?>">
	    <select class="input-sm" name="dp_id" required>
	    	<option>-</option>
			<?php
				foreach($staff->result() as $staffValue)
				{
					?>
					<option value="<?=$staffID = (isset($staffValue->id)) ? $staffValue->id : ''?>"><?=$staffname = (isset($staffValue->name)) ? $staffValue->name : '';?></option>
					<?php
				}
			?>
		</select>
		<br>
		<input type="submit" class="btn btn-primary" name="nextphase" value="Assign" />
		<button type="button" class="btn btn-danger" id="dialogClose">Close</button>
		</form>		
	</div>
	<?php
	}
?>
<!-- Force Finish dialog area -->

<?php
	echo form_open('');
	if (isset($staffValue) || isset($value))
	{
		?>
		<div id="dialog-force" title="Force Finish" style="display: none;font-size: 12px">
		<table cellpadding="3" cellspacing="3" class="tbl">
			<tr>
				<td align="right"><label>ETA:</label></td>
				<td><input type="text" name="actual_delivery" class="date" readonly value="<?=date('Y-m-d');?>" required></td>
			</tr>
			<tr>
				<td align="right"><label>ERS:</label></td>
				<td><input type="number" step="0.01" name="time_up" required=""></td>
			</tr>
			<tr>
				<td align="right"><label>Checker:</label></td>
				<td>
					<select name="checker_id" required="">
						<option value="0">N/A</option>
						<?php
							foreach($staff->result() as $staffValue)
							{
								?>
								<option value="<?=$staffValue->id?>"><?=$staffValue->name?></option>
								<?php
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><label>Checking ERS:</label></td>
				<td><input type="number" step="0.01" name="time_up_check" required></td>
			</tr>
		</table>
		<input type="hidden" name="skip_status" value="<?=$value->skip_status?>">
		<input type="hidden" name="id" value="<?=$value->job_id."-".$value->phase_id;?>">
		<input type="submit" class="btn btn-primary" name="finish" value="Finish">
		<button type="button" class="btn btn-danger" id="forceClose">Close</button>
		</div>
		<?php
	}
	echo form_close();
?>


  <!-- COMMENTS AREA -->

  <div id="comments" class="tab-pane fade in"><br/>
    <div class="col-sm-12 row responsive">
    <div class="col-sm-12 row">
    	<table class="customTable table table-bordered table-hover table-condensed table-striped viewtable" id="commentTable">
    		<thead>
    			<th>Sender</th>
    			<th>Comments</th>
    			<th>Date</th>
    		</thead>
    		<tbody>
    		<?php
    			if (count($comments_view) > 0)
    			{
    				foreach ($comments_view->result() as $comments_value)
    				{
	    				?>
		    			<tr>
		    				<td width="250"><?=$sender = ($comments_value->user_id==1) ? "Admin" : $comments_value->name;?></td>
		    				<td align="left" class="ellipsis"><?=$comments_value->comments;?></td>
		    				<td width="250"><?=$comments_value->what_date;?></td>
		    			</tr>
	    				<?php
    				}
    			}
    			else
    			{
    				?>
	    			<tr>
	    				<td colspan="6" align="center">No Comment</td>
	    			</tr>
	    			<?php
	    		}
	    	?>
    		</tbody>
    	</table>
    </div>
    </div>
    <?php
    	echo form_open('');
    ?>
    <div class="col-sm-12 row">
    <div class="col-sm-12 row form-group">
    	<label>Comments:</label>
    	<input type="hidden" name="tdz_id" id="tdz_id" value="<?=$this->uri->segment(2);?>">
    	<textarea class="form-control" style="resize:vertical;height: 150px" name="comment" id="comment"></textarea>
    </div>
    </div>
    <div class="col-sm-12 row">
    <div class="col-sm-12 row">
		<div class="form-group form-inline" >
			<input type="submit" name="submitComment" value="Comment" class="btn btn-primary" style="float:right" id="commentbtn">
		</div>
    </div>
    </div>
    <?php
    	echo form_close();
   ?>
  </div>

<!-- DRAFTSPERSON VIEW FOR DAILY ACCOMPLISHMENTS -->
 <div id="daily" class="tab-pane fade"><br/>
 	<table class="customTable table table-striped table-condensed table-hover table-bordered table-responsive">
 		<thead>
 			<th>Date</th>
 			<th>Time Started</th>
 			<th>Time End</th>
 			<th>Work Code</th>
 			<th>Job Code</th>
 			<th>Job Name</th>
 			<th>Status</th>
 			<th>Total</th>
 		</thead>
 		<tbody style="text-align: center;">
 			<?php
 				foreach ($dailyaccomplishment->result() as $dValue)
 				{
 					$date = explode(' ',$dValue->time_start);
 					$time_end = explode(' ',$dValue->time_end);
	 				?>
		 			<tr>
		 				<td><?=$date[0];?></td>
		 				<td><?=$date[1];?></td>
		 				<td><?=$end = (isset($time_end[1])) ? $time_end[1] : '';?></td>
		 				<td><?=$dValue->work;?></td>
		 				<td><?=$dValue->job_code;?></td>
		 				<td><?=$dValue->job_name;?></td>
		 				<td><?=$dValue->status;?></td>
		 				<td><?=$dValue->hour_total.":".$dValue->min_total;?></td>
		 			</tr>
		 			<?php
	 			}
	 		?>
	 		<tr>
	 			<td colspan="7" align="right"><strong>Total:</strong></td>
	 			<td><?=$total;?></td>
	 		</tr>
 		</tbody>
 	</table>
 </div>
</div>
<script>
var bu = "<?php echo base_url();?>";
// add Phase dialog script
$('#addphase').click(function(){
	$("#dialog-message").dialog({
	    modal: true,
	    draggable: true,
	    resizable: false,
	    position: ['center'],
	    show: 'explode',
	    hide: 'explode',
	    width: 420,
	    dialogClass: 'ui-dialog-osx',
	    buttons: {
	    }
	});
});
$('#dialogClose').click(function(){
	$('#dialog-message').dialog('close');
});

// Force Finish Dialog Script
$('#force_finish').click(function(){
	$("#dialog-force").dialog({
	    modal: true,
	    draggable: true,
	    resizable: false,
	    position: ['center'],
	    show: 'explode',
	    hide: 'explode',
	    width: 420,
	    dialogClass: 'ui-dialog-osx',
	    buttons: {
	    }
	});
});
$('#forceClose').click(function(){
	$('#dialog-force').dialog('close');
});
// button loading
$('#load').on('click', function() {
    var $this = $(this);
  	$this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 8000);
});

// for datepicker script
$(function() {
    $( ".date" ).datepicker({
      dateFormat : 'yy-mm-dd',
	  showOn: "button",
      buttonImage: bu + "img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
    }); 
}); 
$("#skip").click(function() {
  $('#skipForm').submit();
});

// for comment
$('#commentbtn').click(function() {
	var bu = "<?php echo base_url();?>";
	var comment = $("#comment").val();
	var tdz_id = $("#tdz_id").val();
	var dataString='comment=' + comment + '&tdz_id=' + tdz_id;
	if(comment=='')
	{
		alert('Empty Input');
	}
	else
	{
	$.ajax({
	type: "POST",
	url: bu + 'draftingzone_backend/addcomment',
	data: dataString,
	success: function(data){
	var commentinsert = $.parseJSON(data);
	if (commentinsert[0].user_id==1)
	{
		var name = 'Admin';
	}
	else
	{
		var name = commentinsert[0].name;
	}
	$('#commentTable tr:last').after('<tr id="appended"><td>'+ name +'</td><td>'+ commentinsert[0].comments +'</td><td>'+ commentinsert[0].what_date +'</td></tr>');
	$("#appended").hide().fadeIn();
	$('#comment').val('');
	}
	});
	}
	return false;
});


</script>