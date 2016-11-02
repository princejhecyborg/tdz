<head>
	<style>
		textarea{height:110px;resize: vertical;}
		@media only screen and (max-width: 1500px) {
		    .sm-label	{font-size:9px;}
		    label{font-size:9px;}
		}
		@media only screen and (min-width: 1900px) {
		    .sm-label{font-size:14px;}
		}
	</style>
	<script>
		$(document).ready(function(){
			if($('#client').val() === '-')
			{
				$('.input-sm').attr('disabled', 'disabled');
				$('.btn-md').attr('disabled', 'disabled');
			}
			else
			{
				$('.input-sm').removeAttr('disabled');
				$('.btn-md').removeAttr('disabled');
			}
			$( "#client" ).change(function(){
				if($('#client').val() === '-')
				{
					$('.input-sm').attr('disabled', 'disabled');
					$('.btn-md').attr('disabled', 'disabled');
				}
				else
				{
					$('.input-sm').removeAttr('disabled');
					$('.btn-md').removeAttr('disabled');
				}
			});
			$("#load").click(function(){
		    $(".form-control").each(function() {
		    var element = $(this);
		    if (element.val() == "")
		    {
	        	$(this).css('border', '1px solid red');
	        	$('.warn').fadeIn();
	        }
	        else
	        {

		       $(this).css('background', 'none').css('border', '1px solid lightgray');
		       $('.warn').hide();
		    }
		    });
		  });
		});
	</script>
	<script>
	  $.validate({
	    lang: 'es'
	  });
	</script>
</head>
<div class="col-lg-12 row responsive container">
	<!-- Plan details region -->
<?php
	$sessionMsg = $this->session->userdata('successmsg');
	$display = (empty($sessionMsg)) ? "none" : "";
?>
<div class="alert alert-success" style="display:<?=$display;?>">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <span class="glyphicon glyphicon-ok"></span><strong>Success!</strong> <?=$sessionMsg;?>
  <?=$this->session->unset_userdata('successmsg');?>
</div>
<?php
	echo form_open('');
	?>
	<div class="col-sm-12 row">
		<div class="form-group">
		  <label for="client">Client list:</label> <span style="color:red"> &#42Select client first</span>
		  <select class="form-control" id="client" name="client_id">
		    <option>-</option>
		    <?php
		    	foreach ($client as  $clientVal) {
		    		?>
		    		<option value="<?=$clientVal->id;?>"><?=$clientVal->company_name;?></option>
		    		<?php
		    	}
		    ?>
		  </select>
		</div>
	</div>
		<div class="col-lg-9 row">
			<div class="panel panel-primary">
			  <div class="panel-heading"><span>Plan Details</span></div>
			</div>
			<div class="col-sm-4 well">
				<div class="form-group">
				  <label for="dp">DP Assign:</label>
				  <select class="form-control input-sm" id="dp" name="dp_id">
				    <option>-</option>
				    <?php
				    	foreach ($staff as  $staffVal) {
				    		?>
				    		<option value="<?=$staffVal->id;?>"><?=$staffVal->name;?></option>
				    		<?php
				    	}
				    ?>
				  </select>
				</div>
				<div class="form-group">
				  <label for="ref">Your reference:</label>
				  <input type="text" class="form-control input-sm" id="ref" name="reference" data-validation-length="min1" required>
				</div>
				<div class="form-group">
				  <label for="ins">Instruction received from:</label>
				  <input type="text" class="form-control input-sm" id="ins" name="irf" required>
				</div>
				<div class="form-group">
				  <label for="cont">Contact Person:</label>
				  <input type="text" class="form-control input-sm" id="cont" name="contact_person" required>
				</div>
				<div class="form-group">
				  <label for="pname">Plan Name:</label>
				  <input type="text" class="form-control input-sm" id="pname" name="plan_name" required>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="planopt">Plan Option</label>
						<select class="form-control input-sm" id="planopt" name="plan_option" required>
							<?php
								foreach ($planType as $typeval) {
								?>
								<option value="<?=$typeval->id;?>"><?=$typeval->type;?></option>
								<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="planopt">Type</label
>						<select class="form-control input-sm" id="planopt" name="plan_type">
							<option value="0"></option>
							<?php
								foreach ($jobtype as $jobval) {
								?>
								<option value="<?=$jobval->id;?>"><?=$jobval->value;?></option>
								<?php
								}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-4 well">
				<div class="form-group">
				  <label for="dpnum">DP Number:</label>
				  <input type="text" class="form-control input-sm" id="dpnum" name="dp_num" required>
				</div>
				<div class="form-group col-xs-6 row">
				  <label for="lotnum">Lot Number:</label>
				  <input type="text" class="form-control input-sm" id="lotnum" name="lot_num" required>
				</div>
				<div class="form-group col-xs-6">
				  <label for="stnum">Street Number:</label>
				  <input type="text" class="form-control input-sm" id="stnum" name="street_num" required>
				</div>
				<div class="form-group">
				  <label for="stname">Street Name:</label>
				  <input type="text" class="form-control input-sm" id="stname" name="street_name" required>
				</div>
				<div class="form-group">
				  <label for="city">City:</label>
				  <input type="text" class="form-control input-sm" id="city" name="city" required>
				</div>
				<div class="form-group">
				  <label for="sub">Suburb:</label>
				  <input type="text" class="form-control input-sm" id="sub" name="suburb" required>
				</div>
				<div class="form-group">
				  <label for="ter">Territorial Authority:</label>
				  <input type="text" class="form-control input-sm" id="ter" name="territorial" required>
				</div>
			</div>
			<div class="col-sm-4 well">
				<div class="form-group">
				  <label for="sl">Snow Loading:</label>
				  <input type="text" class="form-control input-sm" id="sl" name="snow" required>
				</div>
				<div class="form-group">
				  <label for="bharea">Building/House Area:</label>
				  <input type="text" class="form-control input-sm" id="bharea" name="bh_area" required>
				</div>
				<div class="form-group">
				  <label for="nsarea">Net Site Area:</label>
				  <input type="text" class="form-control input-sm" id="nsarea" name="ns_area" required>
				</div>
				<div class="form-group">
				  <label for="per">Percentage:</label>
				  <input type="text" class="form-control input-sm" id="per" name="percentage" required>
				</div>
				<div class="col-sm-12 row">
					<div class="form-group col-sm-6">
					  <label for="wz" class="sm-label control-label">Wind Zone:</label>
					  <select class="form-control input-sm" id="wz" name="wind_zone" required>
					    <option>-</option>
					    <option>Low</option>
					    <option>Medium</option>
					    <option>High</option>
					    <option>Very High</option>
					  </select>
					</div>
					<div class="form-group col-sm-6">
					  <label for="gr" class="sm-label control-label">Ground:</label>
					  <select class="form-control input-sm" id="gr" name="ground" required>
					    <option value="0">-</option>
					    <option value="Urban">Urban</option>
					    <option value="Open">Open</option>
					  </select>
					</div>
				</div>
				<div class="col-sm-12 row">
					<div class="form-group col-sm-6">
					  <label for="topo" class="sm-label control-label">Topography:</label>
					  <select class="form-control input-sm" id="topo" name="topography" required>
					    <option value="0">-</option>
					    <option value="T1">T1</option>
					    <option value="T2">T2</option>
					    <option value="T3">T3</option>
					    <option value="T4">T4</option>
					  </select>
					</div>
					<div class="form-group col-sm-6">
					  <label for="se" class="sm-label control-label">Site Exposure:</label>
					  <select class="form-control input-sm" id="se" name="site_ex" required>
					    <option value="0">-</option>
					    <option value="Sheltered">Sheltered</option>
					    <option value="Exposed">Exposed</option>
					  </select>
					</div>
				</div>
			</div>
			<div class="col-sm-8 well">
				<div class="form-group col-sm-4">
				  <label for="eq">Earthquake:</label>
				  <select class="form-control input-sm" id="eq" name="earthquake" required>
				    <option value="0">-</option>
				    <option value="1">1</option>
				    <option value="2">2</option>
				    <option value="3">3</option>
				  </select>
				</div>
				<div class="form-group col-sm-4 ">
				  <label for="co">Corrosion:</label>
				  <select class="form-control input-sm" id="co" name="corrosion" required>
				    <option value="-">-</option>
				    <option value="B">B</option>
				    <option value="C">C</option>
				    <option value="D">D</option>
				  </select>
				</div>
				<div class="form-group col-sm-4">
				  <label for="cz">Climate:</label>
				  <select class="form-control input-sm" id="cz" name="climate_zone" required>
				    <option value="0">-</option>
				    <option value="1">1</option>
				    <option value="2">2</option>
				    <option value="3">3</option>
				  </select>
				</div>
			</div>
			<div class="col-sm-4 well">
				<div class="form-group col-sm-12">
					<label for="notes">Notes:</label>
					<textarea class="form-control input-sm" id="notes" name="notes"></textarea>
				</div>
			</div>
		</div>
	<!-- end plan details region -->
	<!-- region client details -->
		<div class="col-lg-3">
			<div class="panel panel-primary">
				<div class="panel-heading"><span>Client Details</span></div>
			</div>
			<div class="col-sm-12 well">
				<div class="form-group">
				  <label for="cname">Client's Name:</label>
				  <input type="text" class="form-control input-sm" id="cname" name="client_name" required>
				</div>
				<div class="form-group">
				  <label for="sadd">Street Address:</label>
				  <input type="text" class="form-control input-sm" id="sadd" name="street_add" required>
				</div>
				<div class="form-group">
				  <label for="pcode">Postal Code:</label>
				  <input type="text" class="form-control input-sm" id="pcode" name="pcode" required>
				</div>
				<div class="form-group">
				  <label for="madd">Mailing Address:</label>
				  <input type="text" class="form-control input-sm" id="madd" name="madd" required>
				</div>
				<div class="form-group">
				  <label for="email">Email:</label>
				  <input type="text" class="form-control input-sm" id="email" name="client_email" required>
				</div>
				<div class="form-group">
				  <label for="tnum">Telephone Number:</label>
				  <input type="text" class="form-control input-sm" id="tnum" name="tnum" required>
				</div>
			</div>
			<div class="col-sm-12 row" style="position: relative;top:40px">
				<div class="form-group"> 
				  <!-- <input type="submit" class="btn btn-success btn-md" value="Submit" name="submit"> -->
				  <button type="submit" name="submit" class="btn btn-primary btn-md" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Your Job">Submit</button>
				  <input type="reset" class="btn btn-danger btn-md" value="Reset">
				</div>
			</div>
		</div>
	<?php
	echo form_close();
?>
				
	<!-- region end client details -->
</div>
<script>
$('.btn').on('click', function() {
    var $this = $(this);
  	$this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 8000);
});
</script>