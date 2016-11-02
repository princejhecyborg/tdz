<head>
	<style>
		#profimg{max-width: 100%;height: auto;}
		@media only screen and (max-width: 1500px) {
            .accinfo {font-size:10px;}
        }
	</style>
</head>
<div class="col-lg-12 row responsive">
	<div class="col-lg-2 row">
		<div class="panel panel-primary">
	        <div class="panel-heading">
	            <div class="row responsive">
	                <div class="col-sm-12"> 
	                    <img src="<?php echo base_url();?>img/profilepic/default.gif" id="profimg" width="200" height="250">
	                </div>
	            </div>
	        </div>                
	    </div>
       	<div class="panel panel-primary" class="accinfo">
		<div class="panel-heading" class="accinfo">
			<span><span class="glyphicon glyphicon-info-sign" ></span> Account Info</span>
		</div>
		<div class="panel-body">
            <span class="pull-left"><b><?php echo $this->session->userdata('sessionLog'); ?></b></span>
            <br>
            <span class="pull-left" style="font-size: 12px"><?php echo $this->session->userdata('session_acc'); ?></span>
            <div class="clearfix"></div>
        </div>
     </div>
	</div>
	<!-- region workload -->
	<div class="col-lg-10" id="workload-container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				The Drafting Zone Services Workload
			</div>
			<div class="panel-body">
				<div class="well" >
					<center><img src="<?=base_url();?>img/logo.png"></center>
				 </div>
			</div>
		</div>
	</div>
	<!-- region end workload -->
</div>