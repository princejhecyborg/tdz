    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=8">
        <title>The Drafting Zone Ltd ||  The Drafting Services Company</title>
        <link rel="shortcut icon" href="<?php echo base_url();?>img/officialIcon.png?v=1" />
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/css/main.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/css/simple-sidebar.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap/css/bootstrap.min.css" />
        <script language="javascript" src="<?php echo base_url();?>plugins/bootstrap/js/jquery.min.js"></script>
        <script language="javascript" src="<?php echo base_url();?>plugins/js/jquery-1.11.1.min.js"></script>
        <script language="javascript" src="<?php echo base_url();?>plugins/jquery-ui/jquery-ui.min.js"></script>
        <script language="javascript" src="<?php echo base_url();?>plugins/bootstrap/js/bootstrap.min.js"></script>
        <script language="javascript" src="<?php echo base_url();?>plugins/js/bandClock.min.js"></script>

    <style>
        body{background-color:#F0F0F0 !important;}
        #acc_name{color:#808080;text-decoration:none;font-weight: bold}
        #sidebar-wrapper{width: 235px}
        /* Tooltip */
        .tip + .tooltip > .tooltip-inner {
            background-color: #181818 ;
            color: #FFFFFF;
            padding: 15px;
            font-size: 20px;
        }
        @media only screen and (max-width: 1500px) {
            /*#sidebar-wrapper{width:160px;}*/
            #sidebar-wrapper li{font-size: 12px}
            /*#page-content-wrapper{position:absolute;left: 140px;width: 1300px}*/
        }
    </style>
    </head>
    <body>
        <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        The DraftingZone LTD.
                    </a>
                </li>
                <!-- <hr/>     -->
                <?php
                    foreach($headerLinks as $value)
                    {
                ?>
                <li class="dropdown">
                    <a href="<?php echo $link = ($value->has_child==1) ? '#' : base_url().$value->link;?>" class="dropdown-toggle" data-toggle="collapse" data-target=".<?=$value->page;?>">
                        <?php
                            if($value->is_parent ==1)
                            {
                                ?>
                                <?="<span class='".$value->icons."' style='color:#A8A8A8;position:relative;left:'></span>"." ".ucwords($value->page);?>
                                <?php                                
                                if ($value->has_child==1){
                                    echo "<i class='fa fa-fw fa-caret-down'></i>";
                                }
                                $this->db->where('tbl_pages.parent_id', $value->id);
                                $this->db->join('tbl_page_per_account', 'tbl_page_per_account.page_id = tbl_pages.id', 'LEFT OUTER');
                                $this->db->where('tbl_page_per_account.account_type', $this->session->userdata('sessionid'));
                                $this->db->join('tbl_page_titles', 'tbl_page_titles.id = tbl_pages.page_title_id', 'LEFT OUTER');
                                $this->db->order_by('tbl_page_per_account.order_in', 'ASC');
                                $subLinks = $this->db->get('tbl_pages')->result();
                                foreach($subLinks as $sublink)
                                {
                                    ?>
                                    <ul class='<?=$value->page;?> '>
                                         <li style="list-style: none;">
                                            <a href="<?=base_url().$sublink->link;?>">
                                                <?php echo ucwords($sublink->page);?>
                                            </a>
                                        </li>
                                    </ul>
                                    <?php
                                }
                            }
                        ?>
                    </a>
                </li>
                <?php               
                    }
                ?> 
                <li class="dropdown">
                    <a href="<?=base_url();?>logout"><span class="glyphicon glyphicon-log-out" style="color:#A8A8A8"></span> Logout</a>
                </li> 
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Navigation bar -->
                <nav class="navbar navbar-default" style="color: #A8A8A8">
                  <div  class="container-fluid">
                    <div class="navbar-header">
                      <span class="glyphicon glyphicon-menu-hamburger" style="font-size:1.2em;position: relative;top:15px;left:"></span>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li style="position: relative;top:-5px">
                            <a href="#">
                                <span class="glyphicon glyphicon-user" style="color: #A8A8A8 "></span> 
                                Welcome, <span id="acc_name"><?php echo $this->session->userdata('sessionLog'); ?></span>&nbsp;&nbsp;<br>
                                <span style="float: right;font-size: 12px">(<?=$this->session->userdata('session_acc');?>)&nbsp;&nbsp;</span>
                            </a>
                        </li>
                    </ul>
                  </div>
                </nav>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 row container">
                        <h3 class="row">
                            <?php
                                foreach($pageTitle as $value)
                                {
                                    echo "<span style='font-size:0.7em'>TDZ / </span>".$value->name;
                                }
                                if (!empty($headerview))
                                {
                                    echo $headerview;
                                }
                            ?>
                        </h3>
                            <div class="container-fluid row" id="pagecontainer">
                                <?php
                                    $this->load->view($load_page);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="push"></div>
            <!-- /#page-content-wrapper -->
            <!-- Footer -->
            <span id="footer">&copy;<?=date('Y')?> The DraftingZone LTD. All Rights Reserved.</span>
    </div>
</body>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });
});
</script>
