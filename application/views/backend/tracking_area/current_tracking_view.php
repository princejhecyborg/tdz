 <HEAD>
    <style>
        thead th{text-align: center}
         a span{color:#000;}
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
        .time { border-width: 0px; }
        @media only screen and (max-width: 1500px) {
            .table {font-size: 12px}
        }
        .timetable td{padding: 5px;}
        .customBtn{border:2px solid #428bca;border-radius: 2px}
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
          background-color: #d9534f;
          background-image: none;
          color: white;
        }
  </style>
 </HEAD>
 <!-- filter region -->
 <div class="col-lg-12 row">
   <div class="form-inline">
      <div class="form-group">
        <input type="text" name="" placeholder="Search" class="form-control input-sm">
      </div>
     <div class="form-group">
       <select class="form-control input-sm">
         <option>Normal</option>
       </select>
     </div>
     <div class="form-group">
       <select class="form-control input-sm">
         <option>All Clients</option>
       </select>
     </div>
     <div class="form-group">
       <select class="form-control input-sm">
         <option>Month</option>
       </select>
     </div>
     <div class="form-group">
       <select class="form-control input-sm">
         <option>year</option>
       </select>
     </div>
     <div class="form-group">
       <select class="form-control input-sm">
         <option>All Status</option>
       </select>
     </div>
     <div class="form-group">
       <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Filter</button>
     </div>
   </div>
 </div>
 <!--end filter region -->
 <div class="col-lg-12 container row">
    <?php
      if (!empty($startjob))
      {
        ?>
        <br/>
        <div class="col-lg-12 row">
          <div class="col-sm-4 row">
            <div class="panel panel-default">
              <div class="panel-heading"><i><a><?=$startjob->job_code;?></a></i> - <strong><?=$startjob->job_name?></strong></div>
              <div class="panel-body">
                <table  class="timetable customTable" style="min-width: 350px;">
                  <tr>
                    <td align="right" style="font-weight: bold">Work Code:</td>
                    <td><?=$startjob->work;?></td>
                  </tr>
                  <tr>
                    <td align="right" style="font-weight: bold">Time Started:</td>
                    <td>
                      <?php
                        $timestart = $startjob->time_start;
                        $timestart = explode(' ', $timestart);
                        echo $timestart[1];
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" style="font-weight: bold">Time End:</td>
                    <td>
                      <div class="hex-clock">
                        <span class="hours"></span>:
                        <span class="minutes"></span>.
                        <span class="seconds"></span>
                      </div>
                    </td>
                    <td>
                      <?php
                        echo form_open('');
                        ?>
                        <div class="form-inline" style="position: relative;top:10px">
                        <input type="hidden" name="d_id" value="<?=$startjob->d_id?>">
                        <input type="submit" name="action" value="Pending" class="btn btn-primary btn-xs">
                        <input type="submit" name="action" value="Finish" class="btn btn-primary btn-xs">
                        </div>
                        <?php
                        echo form_close();
                      ?>
                    </td>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      else
      {
      ?>
        <!-- for draftsperson start job view -->
        <br>
        <div class="col-sm-12 row" style="margin-bottom: 5px;">
          <?php
            if ($this->session->userdata('sessionid')==2)
            {
              echo form_open('');
              ?>
                <div class="form-inline col-lg-6 row">
                  <div class="form-group">
                    <select class="form-control input-sm" id="jobcode" name="jobcode">
                      <?php
                        foreach ($tracking as $jobCodeRow)
                        {
                          ?>
                          <option value="<?=$jobCodeRow->plan_option;?>"><?=$jobCodeRow->job_code;?></option>
                          <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="getJobID" id="getJobID">
                    <select class="form-control input-sm" id="accomplishmentCode" name="accomplishmentCode"></select>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="start" value="Start" class="btn btn-primary btn-sm" id="startBtn">
                  </div>
                </div>
                <?php
                echo form_close();
              }
            ?>
          </div>
      <?php
      }
    ?>
    <!-- for admin urgent and unassigned jobs view -->
    <div class="col-sm-12 row" style="margin-bottom: 5px;">
    <?php
      if ($this->session->userdata('sessionid')==1)
      {
        ?>
        <table style="float:right;width:200px;padding-right:20px;">
            <tr>
                <td>
                    
                </td>
                <td align="">
                    <a href="#" id="unassigned">
                        <table class="customtable">
                          <tr>
                            <td><div style="width:15px;height:15px;background-color: #cceeff;border: 1px solid gray"></div></td>
                            <td>&nbsp;Unassigned</td>
                            <td><span class="badge"><?=$ua = (!empty($unassigned)) ? $unassigned : '';?></span></td>
                          </tr>
                        </table>                        
                    </a>
                </td>
                <td align="">
                   <a href='#' id="urgent">
                        <table class="customtable">
                          <tr>
                            <td><div style="width:15px;height:15px;background-color: #ffcccc;border: 1px solid gray"></div></td>
                            <td>&nbsp;Urgent</td>
                            <td><span class="badge"><?=$ur = (!empty($urgent)) ? $urgent : '';?></span></td>
                          </tr>
                        </table>                        
                    </a>
                </td>
            </tr>
         </table>
        <?php
        }
      ?>     
    </div>
    <!-- tracking log table -->
    <div class="col-sm-12 row">
        <div class="table-responsive">
            <table class="customtable table table-bordered table-hover table-striped table-condensed">
                <thead>
                    <tr>
                        <th width="150">Manage</th>
                        <th>Date Received</th>
                        <th>Ref.</th>
                        <th>Job Code</th>
                        <th>Job Name</th>
                        <th>Status</th>
                        <th>Area(m<sup>2</sup>)</th>
                        <th>Type</th>
                        <th>Draftsperson</th>
                        <th>Delivery Date</th>
                        <th>Duration</th>
                        <th width="200">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      if (count($tracking) > 0)
                      {
                        foreach ($tracking as  $trackingRow)
                        {
                            if (empty($trackingRow->code)&&($trackingRow->tdz_priority==0))
                            {
                              $color = "info";
                            }
                            else if(empty($trackingRow->code)&&($trackingRow->tdz_priority==1))
                            {
                              $color = "warning";
                            }
                            else if(!empty($trackingRow->code)&&($trackingRow->tdz_priority==1))
                            {
                              $color = "danger";
                            }
                            else
                            {
                              $color = "";
                            }
                          ?>
                          <tr id="<?=$trackingRow->job_code;?>">
                            <td id="<?=$trackingRow->plan_name;?>" align="center" width="150">
                                <a href="<?=base_url();?>viewplan/<?=$trackingRow->tdz_id;?>">
                                  <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="View Plan">
                                    <span class="glyphicon glyphicon-expand"  style="color:white"></span>
                                  </button>
                                </a>
                                <a href="#" style="display: <?=$delete = ($this->session->userdata('sessionid')==2)? 'none' : '';?>" class="deleteBtn">
                                  <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete">
                                    <span class="glyphicon glyphicon-trash" style="color:white"></span>
                                  </button>
                                </a> 
                                <a href="<?=base_url();?>jobedit/<?=$trackingRow->tdz_id;?>">
                                  <button class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="Edit">
                                    <span class="glyphicon glyphicon-edit" style="color:white"></span>
                                  </button>
                                </a>
                            </td>                                
                            <td>
                                <?=$trackingRow->datein;?>
                            </td>
                            <td>
                                <?=$trackingRow->client_ref;?>
                            </td>
                            <td>
                                <span class="tip" data-toggle="tooltip" data-placement="right" title="<?=$trackingRow->company_name;?>"><?=$trackingRow->job_code;?></span>
                            </td>
                            <td class="<?=$color = ($this->session->userdata('sessionid')!=0) ? $color : "";?>">
                                <?=$trackingRow->plan_name;?>
                            </td>
                            <!-- <td style="background-color: #<?=$trackingRow->color;?>"> -->
                            <td>
                                <span  class="tip" data-toggle="tooltip" data-placement="right" title="<?=$trackingRow->plan_detailed_status;?>"><?=$trackingRow->plan_status?></span>
                            </td>
                            <td>
                                <?=$trackingRow->bh_area;?>
                            </td>
                            <td>
                                 <span class="tip" data-toggle="tooltip" data-placement="right" title="<?=$trackingRow->value;?>"><?=$trackingRow->abbrv;?></span>
                            </td>
                            <td>
                                <span class="tip" data-toggle="tooltip" data-placement="right" title="<?=$trackingRow->name;?>"><?php echo $trackingRow->code;?></span>
                            </td>
                            <td>
                                <?=$delDate = ($trackingRow->complete_date!='0000-00-00 00:00:00') ? $trackingRow->complete_date : "";?>
                            </td>
                            <td></td>
                            <td><?=$trackingRow->notes;?></td>
                          </tr>
                        <?php
                        }
                      }
                      else
                      {
                    ?>
                          <tr>
                            <td colspan="12" align="center" style="color:red">No data available</td>
                          </tr>
                        <?php
                      }
                    ?>
                </tbody>
            </table>
        </div>
    </div>     
</div>
<!-- Delete Dialog -->
<div class="confirmDel" title="Delete Job" class="col-sm-12" style="display: none">
    <p>
      Confirm delete this <span id="jobvalue"></span>?
    </p>
    <?php
      echo form_open('');
    ?>
    <input type="hidden" name="jobcode" id="jobcode">
  <br>
  <button type="submit" class="btn btn-danger btn-md" name="jobsubmit" value="Delete"><span class="glyphicon glyphicon-ok"></span> Delete</button>
  <button type="button" class="btn btn-default btn-md" id="dialogClose"><span class="glyphicon glyphicon-remove"></span> Close</button>
  <?php
    echo form_close();
  ?>      
</div>
<!-- end delete dialog -->
<script>
$(document).ready(function(){
    console.log("%cWarning! This console is not allowed for viewing.", "background: red; color: yellow; font-size: x-large; padding: 5px");
    var bu = "<?=base_url();?>";
    $('[data-toggle="tooltip"]').tooltip();
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });
     $('#urgent').click(function(e){
        var thisUrl = bu + "draftingzone_backend/urgentjobs";
        var myWindow = window.open(
            thisUrl,
         'PDF',
         'width=1200,height=800;toolbar=no,menubar=no,location=no,titlebar=no'
     );
    });
     $('#unassigned').click(function(e){
        var thisUrl = bu + "draftingzone_backend/unassigned";
        var myWindow = window.open(
            thisUrl,
         'PDF',
         'width=1200,height=800;toolbar=no,menubar=no,location=no,titlebar=no'
     );
    });
     var jobCodeRow = $('#jobcode[name=jobcode]').val();
      $.get(bu + "draftingzone_backend/getaccomplishments/" + jobCodeRow, function(data){
        var accomplishmentCode = $.parseJSON(data);
        var options = '';
        for (var i = 0; i < accomplishmentCode.length; i++) {
          options += '<option value="' + accomplishmentCode[i].id + '">' + accomplishmentCode[i].work + '</option>';
        }
        $("#accomplishmentCode").html(options);
      });
      var jobcodeForID = $('#jobcode option:selected') .text();
      $('#getJobID').attr('value', jobcodeForID);


    // for daily accomplishment codes
    $('#jobcode').change(function(){
      var jobCodeRow = $('#jobcode[name=jobcode]').val();
      $.get(bu + "draftingzone_backend/getaccomplishments/" + jobCodeRow, function(data){
        var accomplishmentCode = $.parseJSON(data);
        var options = '';
        for (var i = 0; i < accomplishmentCode.length; i++) {
          options += '<option value="' + accomplishmentCode[i].id + '">' + accomplishmentCode[i].work + '</option>';
        }
        $("#accomplishmentCode").html(options);
        });
      var jobcodeForID = $('#jobcode option:selected') .text();
      $('#getJobID').attr('value', jobcodeForID);
    });

    // for delete dialog
    $('.deleteBtn').click(function(){
      var jobcode = $(this).closest('tr').attr('id');
      var jobname = $(this).closest('td').attr('id');
      $('#jobcode').attr('value', jobcode);
      $('#jobvalue').append("<strong id='appendedvalue'>" + jobcode + "-" + jobname + "</strong>");
      $(".confirmDel").dialog({
          modal: true,
          draggable: true,
          resizable: false,
          position: ['center'],
          show: 'bounce',
          hide: 'drop',
          width: 420,
          dialogClass: 'ui-dialog-osx',
          buttons: {
          }
      });
    });
    $('#dialogClose').click(function(){
      $('.confirmDel').dialog('close');
      $('#appendedvalue').remove();
    });
});
// for time

$(function() {
  
  var $h = null;
  var $m = null;
  var $s = null;
  var $r, $g, $b, $rgb;

  function getTime() {
    var $time = new Date();
    $h = $time.getHours();
    $m = $time.getMinutes();
    $s = $time.getSeconds();
    $h = $h % 12;
    if ($h < 10) {$h = "0"+$h};
    if ($m < 10) {$m = "0" + $m};
    if ($s < 10) {$s = "0" + $s};
    return {
      'hours': $h,
      'minutes': $m,
      'seconds':$s
    };
  }
  function updateTime(){
    var $t = getTime();
    $('.hours').text($t.hours);
    $('.minutes').text($t.minutes);
    $('.seconds').text($t.seconds);
    $r = parseInt($t.hours, 16)
    $g = parseInt($t.minutes, 16)
    $b = parseInt($t.seconds, 16)
    $rgb = "rgb("+$r+","+$g+","+$b+")"
  }
  setInterval(function(){
    updateTime();
    $('body').css("background-color", $rgb );
  }, 1000);
});

</script>