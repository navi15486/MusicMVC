<?php include '../app/views/includes/header.php'; ?>
<div class="jumbotron bs-example formLogin"   >
	<h2>Reset Password</h2>
    <div class = 'panel'>
  <?php  
   if(isset($data['message']))
        echo   $data['message'];
        if (isset($data['errors']))
        {
            $errors  = $data['errors'];
            foreach($errors as $error => $data)
            {
                echo $data . "<br>";
            }
        }
        ?>
</div>
    <form  class="form-horizontal" onsubmit="return validation()" method="post" action = "">
         
        <div class="form-group" >
            <label class="col-sm-2 control-label" for="inputWarning"  >Old Password</label>
            <div class="col-sm-3" id="passwordError">
                <input type="password" id="password" class="form-control" name = "password" placeholder="Password">
                <span class="help-block" id = "password-help-block" style="visibility: hidden;">*Password Field is empty</span>
            </div>
        </div>

         <div class="form-group" >
            <label class="col-sm-2 control-label" for="inputWarning"  >New Password</label>
            <div class="col-sm-3" id="passwordError">
                <input type="password" id="password" class="form-control" name = "newPassword" placeholder="Password">
                <span class="help-block" id = "password-help-block" style="visibility: hidden;">*Password Field is empty</span>
            </div>
        </div>

         <div class="form-group" >
            <label class="col-sm-2 control-label" for="inputWarning" >Confirm New Password</label>
            <div class="col-sm-3" id="passwordError">
                <input type="password" id="password" class="form-control" name = "confirmPassword" placeholder="Password">
                <span class="help-block" id = "password-help-block" style="visibility: hidden;">*Password Field is empty</span>
            </div>
        </div>
          
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button   type="submit" class="btn btn-primary" name ="reset">Reset Password</button>
            </div>
        </div>
    </form>
</div>
<?php include '../app/views/includes/footer.php'; ?>