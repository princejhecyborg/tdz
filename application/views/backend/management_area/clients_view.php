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
        <button type="submit" id="addClient" class="customBtn btn btn-primary" style="float:right;margin-bottom:5px"  data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-plus"></span> Add Client
        </button>
    </div>
    <div class="col-sm-12 row">
        <div class="table-responsive">
            <table class="customTable table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Customer Code</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($client as $row)
                    {
                    ?>
                    <tr>
                        <td><?=$row->company_name;?></td>
                        <td><?=$row->customer_code;?></td>
                        <td><?=$row->c_email;?></td>
                        <td><?=$row->country;?></td>
                        <td><?=$row->city;?></td>
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
        <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Add Client</h4>
      </div>
      <div class="modal-body">
      <?php
        echo form_open('');
        ?>
        <div class="form-group">
          <label for="ccode">Customer Code:</label>
          <input type="text" class="form-control input-sm" id="ccode" name="customer_code">
        </div>
        <div class="form-group">
          <label for="cname">Company Name:</label>
          <input type="text" class="form-control input-sm" id="cname" name="company_name">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" class="form-control input-sm" id="email" name="c_email">
        </div>
        <div class="form-group">
          <label for="country">Country:</label>
          <input type="text" class="form-control input-sm" id="country" name="country">
        </div>
        <div class="form-group">
          <label for="city">City:</label>
          <select class="form-control input-sm" id="city" name="city">
            <option value="-">-</option>
            <?php
                foreach ($data as $value) {
                    ?>
                    <option value="<?=$value->city;?>"><?=$value->city;?></option>
                    <?php
                }
            ?>            
          </select>
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" class="form-control input-sm" id="address" name="address">
        </div>
        <div class="form-group">
          <label for="pnum">Phone Number:</label>
          <input type="text" class="form-control input-sm" id="pnum" name="phone_number">
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
                    