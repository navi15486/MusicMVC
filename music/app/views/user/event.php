<?php include '../app/views/includes/header.php'; ?>

<div class=" jumbotron  bs-example formLogin"  >
 <?php include '../app/views/includes/profileMenu.php'; ?>
 
	<h2>Add an Event</h2> 
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

?>
            </div>  
    <form class="form-horizontal" method = "post" action="" >
       
        <div class="form-group" id="firstnameError">
            <label class="col-sm-3 control-label" for="inputWarning"  >Event Name: </label>
            <div class="col-sm-3">
                <input type="text" id="firstname" class="form-control" placeholder="name" name="eventname" required>
                <span class="help-block" id = "firstname-help-block" style="visibility: hidden;">*EventName Field is empty</span>
            </div>
        </div>
        <div class="form-group" id = "textAreaError">
      <label class="col-sm-3 control-label " for="inputSuccess"  >Description: </label>
            <div class="col-sm-3">
      <textarea class="form-control" rows="5" id="comment" name= "description" placeholder="description"></textarea>
		</div>
		</div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                <button   type="submit" class="btn btn-primary" name ="submit">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php include '../app/views/includes/footer.php'; ?>