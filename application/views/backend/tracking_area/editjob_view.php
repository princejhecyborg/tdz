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
			if($('#dp').val() === '-')
			{
				$('#prelim').attr('value', 1);
				$('#consent').attr('value', 7);
				$('#eq').attr('value', 41);
			}
			else
			{
				$('#prelim').attr('value', 2);
				$('#consent').attr('value', 8);
				$('#eq').attr('value', 42);
			}
			$('#dp').change(function(){
			if($('#dp').val() === '-')
			{
				console.log('new');
				$('#prelim').attr('value', 1);
				$('#consent').attr('value', 7);
				$('#eq').attr('value', 41);
			}
			else
			{
				console.log('not new');
				$('#prelim').attr('value', 2);
				$('#consent').attr('value', 8);
				$('#eq').attr('value', 42);
			}
			});
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
		  <label for="client">Client list:</label>
		  <select class="form-control" id="client" name="client_id">
		    <option>-</option>
		    <?php
		    	foreach ($client as  $clientVal) {
		    		?>
		    		<option value="<?=$clientVal->id;?>" <?=$sel = ($trackingResult->client_id==$clientVal->id) ? "selected" : ""?>><?=$clientVal->company_name;?></option>
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
				    		<option value="<?=$staffVal->id;?>" <?=$sel = ($trackingResult->dp_id==$staffVal->id) ? "selected" : ""?>><?=$staffVal->name;?></option>
				    		<?php
				    	}
				    ?>
				  </select>
				</div>
				<div class="form-group">
				  <label for="ref">Your reference:</label>
				  <input type="text" class="form-control input-sm" id="ref" name="reference" value="<?=$trackingResult->reference;?>">
				</div>
				<div class="form-group">
				  <label for="ins">Instruction received from:</label>
				  <input type="text" class="form-control input-sm" id="ins" name="irf" value="<?=$trackingResult->irf;?>">
				</div>
				<div class="form-group">
				  <label for="cont">Contact Person:</label>
				  <input type="text" class="form-control input-sm" id="cont" name="contact_person" value="<?=$trackingResult->contact_person;?>">
				</div>
				<div class="form-group">
				  <label for="pname">Plan Name:</label>
				  <input type="text" class="form-control input-sm" id="pname" name="plan_name" value="<?=$trackingResult->plan_name;?>">
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="planopt">Plan Option</label>
						<select class="form-control input-sm" id="planopt" name="plan_option">
							<option id="prelim">Prelim</option>
							<option id="consent">Consent</option>
							<option id="eq">EQ Work</option>
						</select>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="planopt">Type</label>
						<select class="form-control input-sm" id="planopt" name="plan_type">
							<option value=""></option>
							<?php
								foreach ($jobtype as $jobval) {
								?>
								<option value="<?=$jobval->id;?>" <?=$ptype = ($jobval->id == $trackingResult->plan_type) ? "selected" : "";?>><?=$jobval->value;?></option>
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
				  <input type="text" class="form-control input-sm" id="dpnum" name="dp_num" value="<?=$trackingResult->dp_num;?>">
				</div>
				<div class="form-group col-xs-6 row">
				  <label for="lotnum">Lot Number:</label>
				  <input type="text" class="form-control input-sm" id="lotnum" name="lot_num" value="<?=$trackingResult->lot_num?>">
				</div>
				<div class="form-group col-xs-6">
				  <label for="stnum">Street Number:</label>
				  <input type="text" class="form-control input-sm" id="stnum" name="street_num" value="<?=$trackingResult->street_num;?>">
				</div>
				<div class="form-group">
				  <label for="stname">Street Name:</label>
				  <input type="text" class="form-control input-sm" id="stname" name="street_name" value="<?=$trackingResult->street_name;?>">
				</div>
				<div class="form-group">
				  <label for="city">City:</label>
				  <input type="text" class="form-control input-sm" id="city" name="city" value="<?=$trackingResult->city;?>">
				</div>
				<div class="form-group">
				  <label for="sub">Suburb:</label>
				  <input type="text" class="form-control input-sm" id="sub" name="suburb" value="<?=$trackingResult->suburb;?>">
				</div>
				<div class="form-group">
				  <label for="ter">Territorial Authority:</label>
				  <input type="text" class="form-control input-sm" id="ter" name="territorial" value="<?=$trackingResult->territorial;?>">
				</div>
			</div>
			<div class="col-sm-4 well">
				<div class="form-group">
				  <label for="sl">Snow Loading:</label>
				  <input type="text" class="form-control input-sm" id="sl" name="snow" value="<?=$trackingResult->snow;?>">
				</div>
				<div class="form-group">
				  <label for="bharea">Building/House Area:</label>
				  <input type="text" class="form-control input-sm" id="bharea" name="bh_area" value="<?=$trackingResult->bh_area?>">
				</div>
				<div class="form-group">
				  <label for="nsarea">Net Site Area:</label>
				  <input type="text" class="form-control input-sm" id="nsarea" name="ns_area" value="<?=$trackingResult->ns_area;?>">
				</div>
				<div class="form-group">
				  <label for="per">Percentage:</label>
				  <input type="text" class="form-control input-sm" id="per" name="percentage" value="<?=$trackingResult->percentage;?>">
				</div>
				<div class="col-sm-12 row">
					<div class="form-group col-sm-6">
					  <label for="wz" class="sm-label control-label">Wind Zone:</label>
					  <select class="form-control input-sm" id="wz" name="wind_zone">
					    <option>-</option>
					    <option value="Low" <?=$wind_zone - ($trackingResult->windzone=="Low") ? "selected" : "";?>>Low</option>
					    <option value="Mediium" <?=$wind_zone - ($trackingResult->windzone=="Mediium") ? "selected" : "";?>>Medium</option>
					    <option value="High" <?=$wind_zone - ($trackingResult->windzone=="High") ? "selected" : "";?>>High</option>
					    <option value="Very High" <?=$wind_zone - ($trackingResult->windzone=="Very High") ? "selected" : "";?>>Very High</option>
					  </select>
					</div>
					<div class="form-group col-sm-6">
					  <label for="gr" class="sm-label control-label">Ground:</label>
					  <select class="form-control input-sm" id="gr" name="ground">
					    <option value="0">-</option>
					    <option value="Urban" <?=$ground = ($trackingResult->ground=="Urban") ? "selected" : "";?>>Urban</option>
					    <option value="Open" <?=$ground = ($trackingResult->ground=="Open") ? "selected" : "";?>>Open</option>
					  </select>
					</div>
				</div>
				<div class="col-sm-12 row">
					<div class="form-group col-sm-6">
					  <label for="topo" class="sm-label control-label">Topography:</label>
					  <select class="form-control input-sm" id="topo" name="topography">
					    <option value="0">-</option>
					    <option value="T1" <?=$topography = ($trackingResult->topography=="T1") ? "selected" : "";?>>T1</option>
					    <option value="T2" <?=$topography = ($trackingResult->topography=="T2") ? "selected" : "";?>>T2</option>
					    <option value="T3" <?=$topography = ($trackingResult->topography=="T3") ? "selected" : "";?>>T3</option>
					    <option value="T4" <?=$topography = ($trackingResult->topography=="T4") ? "selected" : "";?>>T4</option>
					  </select>
					</div>
					<div class="form-group col-sm-6">
					  <label for="se" class="sm-label control-label">Site Exposure:</label>
					  <select class="form-control input-sm" id="se" name="site_ex">
					    <option value="0">-</option>
					    <option value="Sheltered" <?=$site_ex = ($trackingResult->site_ex=="Sheltered") ? "selected" : "";?>>Sheltered</option>
					    <option value="Exposed" <?=$site_ex = ($trackingResult->site_ex=="Exposed") ? "selected" : "";?>>Exposed</option>
					  </select>
					</div>
				</div>
			</div>
			<div class="col-sm-8 well">
				<div class="form-group col-sm-4">
				  <label for="eq">Earthquake:</label>
				  <select class="form-control input-sm" id="eq" name="earthquake">
				    <option value="0">-</option>
				    <option value="1" <?=$eq = ($trackingResult->earthquake==1) ? "selected" : "";?>>1</option>
				    <option value="2" <?=$eq = ($trackingResult->earthquake==2) ? "selected" : "";?>>2</option>
				    <option value="3" <?=$eq = ($trackingResult->earthquake==3) ? "selected" : "";?>>3</option>
				  </select>
				</div>
				<div class="form-group col-sm-4 ">
				  <label for="co">Corrosion:</label>
				  <select class="form-control input-sm" id="co" name="corrosion">
				    <option value="-">-</option>
				    <option value="B" <?=$co = ($trackingResult->corrosion=='B') ? "selected" : "";?>>B</option>
				    <option value="C" <?=$co = ($trackingResult->corrosion=='C') ? "selected" : "";?>>C</option>
				    <option value="D" <?=$co = ($trackingResult->corrosion=='D') ? "selected" : "";?>>D</option>
				  </select>
				</div>
				<div class="form-group col-sm-4">
				  <label for="cz">Climate:</label>
				  <select class="form-control input-sm" id="cz" name="climate_zone">
				    <option value="0">-</option>
				    <option value="1" <?=$cz = ($trackingResult->climate_zone==1) ? "selected" : "";?>>1</option>
				    <option value="2" <?=$cz = ($trackingResult->climate_zone==2) ? "selected" : "";?>>2</option>
				    <option value="3" <?=$cz = ($trackingResult->climate_zone==3) ? "selected" : "";?>>3</option>
				  </select>
				</div>
			</div>
			<div class="col-sm-4 well">
				<div class="form-group col-sm-12">
					<label for="notes">Notes:</label>
					<textarea class="form-control input-sm" id="notes" name="notes"><?=$trackingResult->notes;?></textarea>
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
				  <input type="text" class="form-control input-sm" id="cname" name="client_name" value="<?=$trackingResult->client_name?>">
				</div>
				<div class="form-group">
				  <label for="sadd">Street Address:</label>
				  <input type="text" class="form-control input-sm" id="sadd" name="street_add" value="<?=$trackingResult->street_add;?>">
				</div>
				<div class="form-group">
				  <label for="pcode">Postal Code:</label>
				  <input type="text" class="form-control input-sm" id="pcode" name="pcode" value="<?=$trackingResult->pcode;?>">
				</div>
				<div class="form-group">
				  <label for="madd">Mailing Address:</label>
				  <input type="text" class="form-control input-sm" id="madd" name="madd" value="<?=$trackingResult->madd;?>">
				</div>
				<div class="form-group">
				  <label for="email">Email:</label>
				  <input type="text" class="form-control input-sm" id="email" name="client_email" value="<?=$trackingResult->client_email;?>">
				</div>
				<div class="form-group">
				  <label for="tnum">Telephone Number:</label>
				  <input type="text" class="form-control input-sm" id="tnum" name="tnum" value="<?=$trackingResult->tnum;?>">
				</div>
			</div>
			<div class="col-sm-12 row" style="position: relative;top:40px">
				<div class="form-group"> 
				  <!-- <input type="submit" class="btn btn-success btn-md" value="Save" name="submit"> -->
				  <button type="submit" name="submit" class="btn btn-primary btn-md" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Your Job">Save</button>
				  <a href="<?=base_url();?>trackinglog""><button type="button" class="btn btn-danger btn-md">Back</button></a>
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
   }, 10000);
});
</script>