 
<?php include '../app/views/includes/header.php'; ?>
<div class="jumbotron bs-example formLogin"   >
<h2>Recover your password</h2>
 <form  class="form-horizontal" onsubmit="return validation()" method="post" action = "">
        
        <div class="form-group" >
            <label class="col-sm-2 control-label" for="inputWarning"  >Please Provide your email address</label>
            <div class="col-sm-3" id="passwordError">
                <input type="text" id="email" class="form-control" name = "email" placeholder="Email" >
                <span class="help-block" id = "password-help-block" style="visibility: hidden;">*Email Field is empty</span>
            </div>
        </div> 
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-primary" name ="recover">Send an Email</button>
            </div>

        </div>
         
    </form>
 </div>


<?php include '../app/views/includes/footer.php'; ?>