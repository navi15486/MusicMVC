
<?php include '../app/views/includes/header.php'; ?>
<div class="jumbotron bs-example formLogin"   >
<h2>Please Login Here</h2>
<div class="panel" >
<?php
    if (isset($data['errors']))
    {
        $errors  = $data['errors'];
        foreach($errors as $error => $data)
        {
         echo $data . "<br>";
        }
    }
    if (isset($data['message']))
        echo $data['message'];

    if (isset($_SESSION['message']))
    {
        echo $_SESSION['message'];
        $_SESSION['message'] = '';
    }

?>
            </div>  
		

    <form  class="form-horizontal" onsubmit="return validation()" method="post" action = "">
        <div class="form-group" >
            <label class="col-sm-2 control-label " for="inputSuccess"  >Username</label>
            <div class="col-sm-3" id = "usernameError">
                <input type="text"   class="form-control" placeholder="Username" name = "username" id="username"  >
                <span class="help-block" id = "user-help-block" style="visibility: hidden;">*Username Field is empty</span>
            </div>
        </div>
        <div class="form-group" >
            <label class="col-sm-2 control-label" for="inputWarning"  >Password</label>
            <div class="col-sm-3" id="passwordError">
                <input type="password" id="password" class="form-control" name = "password" placeholder="Password">
                <span class="help-block" id = "password-help-block" style="visibility: hidden;">*Password Field is empty</span>
            </div>
        </div>
         <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>
        </div>
    </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-primary" name ="login">Login</button>
            </div>

        </div>
         <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <a href="http://localhost/music/public/login/recoverPassword">Recover Password</a>
            </div>
        </div>
    </form>
</div>
<?php include '../app/views/includes/footer.php'; ?>