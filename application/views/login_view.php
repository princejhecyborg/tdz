<head>
<style>
.login{background: white;padding-left:30px;padding-right:30px; }
.btn_login{float: right;}
.btn_Clear{float: right;margin-right: 5px;}
.forgot_pass, .msg_change_pass{display: none;}
.forgot_label, .login_label{cursor: pointer;}
.msg_not_match{color: red;}
</style>
<script type="text/javascript">
   $(function(){
        // $("#LGcontainer").slideToggle(1000);
        $('li').removeAttr('class');
        $('.forgot_label').click(function(){
          // alert('Sorry, this link is under Development');
           $('.forgot_pass').fadeIn();
           $('.login_container').hide();
        });
        $('.login_label').click(function(){
           $('.forgot_pass').hide();
           $('.msg_change_pass').hide();
           $('.login_container').fadeIn();
           $('.forgot_pass_form').fadeIn();
        });
        $('.btn_Next').click(function(){
          var new_pass = $('.new_pass');
          var confirm_pass = $('.confirm_pass');
            if(new_pass.val() != confirm_pass.val()){
              $(confirm_pass).css('border','1px solid red');
              $('.msg_not_match').text('Password not match');
            }else{
              $(confirm_pass).css('border','1px solid #ccc');
              $('.msg_not_match').text("");
              $.ajax({
                  url:'<?=base_url()?>draftingzone/forgot_pass',
                  type:'post',
                  data:{'username':$('.username').val(),'security_question':$('.security_question').val(),'answer':$('.answer').val(),'new_pass':$('.new_pass').val(),'confirm_pass':$('.confirm_pass').val()},
                  success: function(data){
                      if(data == '1'){
                         $('.forgot_pass_form').hide();
                         $('.msg_change_pass').show();
                         $('.msg_container').removeClass('alert-danger');
                         $('.msg_container').addClass('alert-success');
                         $('.msg_container').text('Your password successfully changed.');
                      }else{
                         $('.forgot_pass_form').hide();
                         $('.msg_change_pass').show();
                         $('.msg_container').removeClass('alert-success');
                         $('.msg_container').addClass('alert-danger');
                         $('.msg_container').text('Data not match. Please contact your administrator.');
                      }
                  },
                  error:function(){
                  }
              });
            }
            
           
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('.modal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
        });
        $('.btn_Clear, .login_label').click(function(){
          $('.clear').val("");
        });
    });
</script>
</head>
<div id="" >
    <div  class="login login_container" >
    <h3 class="text-primary"><span class="glyphicon glyphicon-lock text-primary"></span> Login
     <span><img src="<?=base_url()?>img/logo.png" class="company_logo"></span>
     </h3>
    
    <hr/>
      <?php
        echo form_open('');
              $sessionMsg = $this->session->userdata('err_msg');
              $display = (empty($sessionMsg)) ? "none" : "";
            ?>
            <div class="form-group">
              <label for="email" class="text-primary"><span class="glyphicon glyphicon-user text-primary"></span> Username:</label>
              <input type="text" class="form-control input" id="email" name="username" placeholder="Enter Username" <?=$err = (!empty($sessionMsg)) ? "style='background: #f6d6d5;border:1px solid #d9534f' " : "";?>>
            </div>
            <div class="form-group">
              <label for="pwd" class="text-primary"><span class="glyphicon glyphicon-eye-open text-primary"></span> Password:</label>
              <input type="password" class="form-control input" id="pwd" name="password" placeholder="Enter Password" <?=$err = (!empty($sessionMsg)) ? "style='background: #f6d6d5;border:1px solid #d9534f' " : "";?>>
            </div>
            <input type="submit" name="login" class="btn btn-primary btn_login" value="Login">
            <input type="reset" name="Clear" class="btn btn-danger btn_Clear" value="Clear">
            <a class="text-primary forgot_label">Forgot Password?</a>
            <div class="alert alert-danger form-group session_login_msg" style="margin-top:50px;width:100%;display:<?=$display;?>">
              <?=$sessionMsg;?>
              <?=$this->session->unset_userdata('err_msg');?>
            </div>
            
          <?php
        echo form_close();
      ?>
    </div>
    <div  class="login forgot_pass" >
    <h3 class="text-primary"><span class="glyphicon glyphicon-lock text-primary"></span> Forgot Password
     </h3>
    
    <hr/>
    <div class="msg_change_pass">
       <div class="alert msg_container">
      </div>
      <a  class="text-primary login_label">Login</a>
    </div>
      
        <div  class="forgot_pass_form">
            <div class="form-group">
              <label for="email" class="text-primary"><span class="glyphicon glyphicon-user text-primary"></span> Username:</label>
              <input type="text" class="form-control input-sm username clear" id="email" name="username" placeholder="Enter Username">
            </div>
            <div class="form-group">
              <label for="pwd" class="text-primary"><span class="glyphicon glyphicon-lock text-primary"></span> Security Question:</label>
              <select class="form-control input-sm security_question "> <?php foreach ($security_question as $value) {?> <option value="<?=$value->id;?>"><?=$value->question;?></option> <?php } ?> </select>
            </div>
            <div class="form-group">
              <label for="pwd" class="text-primary"><span class="glyphicon glyphicon-lock text-primary"></span> Answer:</label>
              <input type="password" class="form-control input-sm answer clear" id="pwd" name="password" placeholder="Enter Answer">
            </div>
            <div class="form-group">
              <label for="pwd" class="text-primary"><span class="glyphicon glyphicon-eye-open text-primary"></span> New Password:</label>
              <input type="password" class="form-control input-sm new_pass clear" id="pwd" name="password" placeholder="New Password">
            </div>
            <div class="form-group">
              <label for="pwd" class="text-primary"><span class="glyphicon glyphicon-eye-open text-primary"></span> Confirm Password:</label>
              <input type="password" class="form-control input-sm confirm_pass clear" id="pwd" name="password" placeholder="Confirm Password">
              <span class="msg_not_match"></span>
            </div>
            <input type="submit" name="login" class="btn btn-primary btn_login btn_Next" value="Next">
            <input type="reset" name="Clear" class="btn btn-danger btn_Clear" value="Clear">
            <a  class="text-primary login_label ">Login</a>
            <?php
              $sessionMsg = $this->session->userdata('err_msg');
              $display = (empty($sessionMsg)) ? "none" : "";
            ?>
            <div class="alert alert-danger form-group session_login_msg" style="margin-top:10px;width:100%;display:<?=$display;?>">
              <?=$sessionMsg;?>
              <?=$this->session->unset_userdata('err_msg');?>
            </div>
        </div>  
    </div>
</div>