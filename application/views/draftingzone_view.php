<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8">
    <title>The Drafting Zone Ltd ||  The Drafting Services Company</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>img/officialIcon.png?v=1" />
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap/css/bootstrap.min.css" />
    <script language="javascript" src="<?php echo base_url();?>plugins/bootstrap/js/jquery.min.js"></script>
    <script language="javascript" src="<?php echo base_url();?>plugins/js/jquery-1.11.1.min.js"></script>
    <script language="javascript" src="<?php echo base_url();?>plugins/bootstrap/js/bootstrap.js"></script>
    <script language="javascript" src="<?php echo base_url();?>plugins/bootstrap/js/bootstrap.min.js"></script>
</head>
  <script>
    $(document).ready(function(){
        $('#contacts').attr('class','active');
        
    });
  </script>

  <style type="text/css">
    html,body{height:100%;background: #f5f5f5;padding:10px;}
    .fill{ width:100%;height:100%;min-height:100%;color:#efefef;}
    .header{height: 50px;}
    .brand{margin-left: 5px !important;}
    /*.active{background: red;}*/
    .container{padding: 10px;}
    .for_login_con{padding:0px;background: white;height: 502px;box-shadow: 0 0 3px #ccc}
    .page_changer{padding: 0px;padding-right: 10px;}
    .content_images{background: white;box-shadow: 0 0 3px #ccc;}
  </style>
<body>
        <div class="header">
        <nav class="navbar navbar_login navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand brand" href="<?=base_url();?>">The Drafting Zone Ltd.</a>
            </div>
            <div>
              <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav navbar-right">
                      <li id="about"><a href="<?=base_url();?>about">ABOUT US</a></li>
                      <li id="why"><a href="<?=base_url();?>why">WHY US</a></li>
                      <li id="contacts"><a href="<?=base_url();?>contact">CONTACT US</a></li> 
                      <li id="services"><a href="<?=base_url();?>services">SERVICES</a></li> 
                      <li id=""><a href="<?=base_url();?>">PROJECT</a></li> 
                  </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
      <div class="container well">
          <div class="col-sm-8 page_changer">
             <div class="contact_view">
               <?php
                  if($load_page == 'login_view'){
                    $this->load->view('content_view');
                  }
                  else
                  {
                    $this->load->view($load_page);
                  }    
                ?>
             </div>
          </div>
           <div class="col-sm-4 for_login_con">
            <div  style="height: 90%;">
             <?php
               $this->load->view('login_view');
             ?>
            </div>
          </div>
          <div class="col-sm-12 content_images">
            fsdfd
          </div>
      </div>
      </div>
        <div class="col-sm-12 footer">
          <div class="footer_content">
             &copy; 2016 The DraftingZone LTD. All Rights Reserved.
          </div>
        </div>

</body>
</html>
