<?php include '../app/views/includes/header.php'; ?>

<!--email validation is not done-->
<div class="jumbotron bs-example formLogin"  >
	<h2>Contact Us</h2>
    <div class="panel" >
    <?php
        if ($data['errors'])
            {
                $errors  = $data['errors'];
                foreach($errors as $error => $data)
                {
                    echo $data . "<br>";
                }
            }
        ?>

    </div>
	<h3>Feel free to ask us questions</h3>
    <form class="form-horizontal" method = "post" action="" >
       
        <div class="form-group" id="firstnameError">
            <label class="col-sm-3 control-label" for="inputWarning"  >FirstName</label>
            <div class="col-sm-3">
                <input type="text" id="firstname" class="form-control" placeholder="name" name="name" required>
                <span class="help-block" id = "firstname-help-block" style="visibility: hidden;">*Firstname Field is empty</span>
            </div>
        </div>
        <div class="form-group" id="lastnameError">
            <label class="col-sm-3 control-label" for="inputWarning"  >LastName</label>
            <div class="col-sm-3">
                <input type="text" id="lastname" class="form-control" name = "lastname" placeholder="Lastname" required>
                <span class="help-block" id = "lastname-help-block" style="visibility: hidden;">*Lastname Field is empty</span>
            </div>
        </div>
        <div class="form-group" id="emailError">
            <label class="col-sm-3 control-label" for="inputWarning"  >Email </label>
            <div class="col-sm-3">
                <input type="text" id="email" class="form-control" name = "email" placeholder="Email" required>
                <span class="help-block" id = "password-help-block" style="visibility: hidden;">*Email Field is empty</span>
            </div>
        </div>
         <div class="form-group" id = "usernameError">
            <label class="col-sm-3 control-label " for="inputSuccess"  >Username</label>
            <div class="col-sm-3">
                <input type="text"   class="form-control" placeholder="Username" id="username" name="username" required>
                <span class="help-block" id = "user-help-block" style="visibility: hidden;">*Username Field is empty</span>
            </div>
        </div>
         <div class="form-group" id = "textAreaError">
      <label class="col-sm-3 control-label " for="inputSuccess"  >Comments</label>
            <div class="col-sm-3">
      <textarea class="form-control" rows="5" id="comments" name= "message" placeholder="comments"></textarea>
		</div>
		</div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                <button   type="submit" class="btn btn-primary" name ="submit">Submit</button>
                 <button   type="button" id ="cancel" class="btn btn-primary" name ="cancel">Cancel</button>
            </div>
        </div>
    </form>
</div>

<script>
$("#cancel").click(function(){
   document.getElementById("firstname").value ="";
   document.getElementById("lastname").value    ="";
   document.getElementById("email").value ="";
   document.getElementById("username").value ="";
   document.getElementById("comments").value ="";
}) ;
    

</script>
 
<?php include '../app/views/includes/footer.php';?>