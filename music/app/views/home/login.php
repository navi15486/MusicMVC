
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
    <script>
        function validation()
        {
            var validate = true;
            var username = $("#username").val();
            var password = $("#password").val();
            if (username === "" || username == null)
            {
                $(document).ready(function () {
                    $( "#usernameError" ).addClass( "has-error" );
                });
                document.getElementById("user-help-block").style.visibility = "visible";
                validate = false;
            }
            else
            {
                $(document).ready(function () {
                $( "#usernameError" ).removeClass( "has-error" )
                });
            }
            if (password === "" || password == null)
            {
                $(document).ready(function () {
                    $( "#passwordError" ).addClass( "has-error" );
                });
                document.getElementById("password-help-block").style.visibility = "visible";

                validate =  false;
                }
                else
                {
                $(document).ready(function () {
                    $( "#passwordError" ).removeClass( "has-error" )
                });
            }
            return validate;
        }
    </script>

    <form  id = "loginForm" class="form-horizontal" onsubmit="return validation()" method="post" action = "">
        <div class="form-group" >
            <label class="col-sm-2 control-label " for="username"  >Username</label>
            <div class="col-sm-3" id = "usernameError">
                <input type="text"   class="form-control" placeholder="Username" name = "username" id="username"  >
                <span class="help-block" id = "user-help-block" style="visibility: hidden;">*Username Field is empty</span>
            </div>
        </div>
        <div class="form-group" >
            <label class="col-sm-2 control-label" for="password"  >Password</label>
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