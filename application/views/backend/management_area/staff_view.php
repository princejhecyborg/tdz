 <HEAD>
    <style>
          @media only screen and (max-width: 1500px) {
              table {font-size: 12px}
          }
    </style>
   <script type="text/javascript">
       $(document).ready(function(){
          $('.modal').on('hidden.bs.modal', function(){
              $(this).find('form')[0].reset();
          });
       });
   </script>
 </HEAD>
 <div class="col-lg-12 container row">
    <div class="col-sm-12 row" >
        <button type="submit" class="btn btn-primary" id="addStaffBtn" style="float:right;margin-bottom:5px"  data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-plus"></span> Add Staff
        </button>
    </div>
    <div class="col-sm-12 row">
        <div class="table-responsive">
            <table class="customTable table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Employed</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($staff as $row)
                    {
                    ?>
                    <tr>
                        <td><?=$row->name;?></td>
                        <td><?=$row->account_type;?></td>
                        <td><?=$row->username;?></td>
                        <td><?=$row->u_email;?></td>
                        <td><?=$actvie = ($row->is_active==1) ? "Yes" : "No";?></td>
                        <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-trash"></span></td>
                    </tr>
                    <?php
                    }
                ?>                
                </tbody>
            </table>
        </div>
    </div>     
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Add Staff</h4>
      </div>
      <div class="modal-body">
      <?php
        echo form_open('');
        ?>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control input-sm" id="name" name="name" placeholder="Staff Name">
        </div>
        <div class="form-group">
          <label for="code">Code:</label>
          <input type="text" class="form-control input-sm" id="code" name="code" placeholder="Staff Code">
        </div>
        <div class="form-group">
          <label for="uname">Username:</label>
          <input type="text" class="form-control input-sm" id="uname" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
          <label for="pword">Password:</label>
          <input type="password" class="form-control input-sm" id="pword" name="password" placeholder="Enter Password">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control input-sm" id="email" name="u_email" placeholder="Staff Email">
        </div>
        <div class="form-group">
          <label for="acctype">Account Type:</label>
          <select class="form-control input-sm" id="acctype" name="account_type">
            <option value="-">-</option>
            <?php
                foreach ($accType as $value) {
                    ?>
                    <option value="<?=$value->id;?>"><?=$value->account_type;?></option>
                    <?php
                }
            ?>            
          </select>
        </div>
        <div class="form-group">
          <label for="acctype">Question:</label>
          <select class="form-control input-sm" id="acctype" name="question">
            <option value="-">-</option>
            <?php
                foreach ($question as $questVal) {
                    ?>
                    <option value="<?=$questVal->id;?>"><?=$questVal->question;?></option>
                    <?php
                }
            ?>            
          </select>
        </div>
        <div class="form-group">
          <label for="ans">Answer:</label>
          <input type="text" class="form-control input-sm" id="ans" name="answer" placeholder="Your answer">
        </div>
        <div class="form-group">
          <input type="hidden" name="is_active" value="0">
          <label class="radio-inline row" style="font-weight:bold">Is active?: <input type="checkbox" name="is_active" value="1"></label>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" value="submit" class="btn btn-success">
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
      <?php
      echo form_close();
    ?>  
    </div>

  </div>
</div>
                    