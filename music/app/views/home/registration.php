
<?php include '../app/views/includes/header.php'; ?>

<div class="jumbotron">
  <h2>Registration</h2>
  <div class="panel" >
  <script type="text/javascript">
 // if ($(":text").text() == "")
   // alert();
  </script>
  <?php 
  if (isset($data['message']))
  {
    $message = $data['message'];
    echo $message;
  }
  

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
  <form role="form" class="form-horizontal" method="post" onsubmit="return validation();" enctype="multipart/form-data" id="createProfile">
    <div class="form-group  ">
      <label class="col-sm-2 control-label " for="fname">First Name:</label>
        <div class="col-sm-3" id = "fnameError">
            <input type="text" class="form-control" id="fname" name= "fname" value = "" placeholder="First name">
            <span class="help-block" id = "fname-help-block" style="visibility: hidden;">*Firstname Field is empty</span>
        </div>
    </div>
    <div class="form-group ">
      <label class="col-sm-2 control-label " for="lname">Last Name:</label>
        <div class="col-sm-3" id = "lnameError">
            <input type="text" class="form-control" id="lname" name= "lname" value = "" placeholder="Last name">
            <span class="help-block" id = "lname-help-block" style="visibility: hidden;">*Lastname Field is empty</span>
        </div>
    </div>
    <div class="form-group  ">
      <label class="col-sm-2 control-label " for="username">Username:</label>
        <div class="col-sm-3" id = "usernameError">
             <input type="email" class="form-control" id="username" name= "username" value = "" placeholder="Email">
            <span class="help-block" id = "user-help-block" style="visibility: hidden;">*Username Field is empty</span>

        </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label " for="password">Password:</label>
        <div class="col-sm-3" id = "passwordError">
            <input type="password" class="form-control" id="password" name="password" value = "" placeholder="Password" />
        <span class="help-block" id ="password-help-block" style="visibility: hidden;">*Password field is empty</span>
        </div>
    </div>
    <div class="form-group  ">
      <label class="col-sm-2 control-label " for="confirmPassword">Confirm Password:</label>
        <div class="col-sm-3" id = "cPasswordError">
            <input type="password" class="form-control" id="confirmPassword" value = "" name="confirmPassword" placeholder="Confirm Password">
        </div>
    </div>
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
  </form>
</div>
<style>
    #password-help-block
    {
        display:inline-block;
        color:#000000;
        width:200px;
        height:25px;
        text-align: center;
        border-radius: 5px;
        text-decoration: solid;
    }
</style>
<script>
    $(document).ready(function(){
        $('#password').keyup(function(){7

            var length = $('#password').val().length;
            document.getElementById("password-help-block").style.visibility = "visible";
            if (length <= 4)
            {
                $('#password-help-block').text('Weak');
                $('#password-help-block').css('background-color','#ff0000');
                $('#password-help-block').css('width','100');
            }
            else if (length >= 5 && length <= 7)
            {
                $('#password-help-block').text('Good');
                $('#password-help-block').css('background-color','#FFFF00');
                $('#password-help-block').css('width','150');
            }
            else
            {
                $('#password-help-block').text('Excellent');
                $('#password-help-block').css('background-color','#008000');
                $('#password-help-block').css('width','200');
            }

        });
    });
</script>

<script>
    function validation()
    {
        var validate = true;
        var username = $("#username").val();
        var password = $("#password").val();
        var fname    = $("#fname").val();
        var lname    = $("#lname").val();



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
           // $("#password-help-block").innerHTML = "*Password field is empty";
            $('#password-help-block').text('*Password field is empty');
            $('#password-help-block').css('background-color','transparent');
            validate =  false;
        }
        else
        {
            $(document).ready(function () {
                $( "#passwordError" ).removeClass( "has-error" )
            });
        }

        if (fname === "" || fname == null)
        {
            $(document).ready(function () {
                $( "#fnameError" ).addClass( "has-error" );
            });
            document.getElementById("fname-help-block").style.visibility = "visible";
            validate = false;
        }
        else
        {
            $(document).ready(function () {
                $( "#fnameError" ).removeClass( "has-error" )
            });
        }

        if (lname === "" || lname == null)
        {
            $(document).ready(function () {
                $( "#lnameError" ).addClass( "has-error" );
            });
            document.getElementById("lname-help-block").style.visibility = "visible";
            validate = false;
        }
        else
        {
            $(document).ready(function () {
                $( "#lnameError" ).removeClass( "has-error" )
            });
        }
        //$("#password-help-block").innerHTML = "*Password field is empty";
         return  validate;
    }
</script>
 <?php include '../app/views/includes/footer.php';?>