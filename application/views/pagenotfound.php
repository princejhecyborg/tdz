<head>
	<style>
		.error-template {padding: 40px 15px;text-align: center;}
		.error-actions {margin-top:15px;margin-bottom:15px;}
		.error-actions .btn { margin-right:10px; }
	</style>
</head>
<div class="container">
    <div class="row">
    <div class="error-template">
	    <h1>Oops!</h1>
	    <h2>404 Not Found</h2>
	    <div class="error-details">
		Sorry, an error has occured, Requested page not found or under maintenance!<br>
		<a href="<?=base_url();?>">Proceed to Homepage</a>
	    </div>
	    <div class="error-actions">
		<a href="<?php echo Yii::app()->request->baseUrl; ?>" class="btn btn-primary">
		    <i class="icon-home icon-white"></i> Take Me Home </a>
		<a href="mailto:me@null-byte.info" class="btn btn-default">
		    <i class="icon-envelope"></i> Contact Support </a>
	    </div>
	</div>
    </div>
</div>