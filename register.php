<?php
require_once('connect.php');
if (isset($_POST) && !empty($_POST)) {
  $username = mysqli_real_escape_string($connection,$_POST['username']);
  $ne = mysqli_real_escape_string($connection,$_POST['ne']);
  $email = mysqli_real_escape_string($connection,$_POST['email']);
  $city = mysqli_real_escape_string($connection,$_POST['city']);
  $contact = mysqli_real_escape_string($connection,$_POST['contact']);
  $password = md5($_POST['password']);
  $passwordagain = md5($_POST['passwordagain']);
  if ($password == $passwordagain) {
    //$fmsg = "";
    $usernamesql = "SELECT * from `usermanagement` WHERE username = '$username'";
    $usernameres = mysqli_query($connection,$usernamesql);
    $count = mysqli_num_rows($usernameres);
    if ($count == 1) {
      $fmsg .= "Username already exists Please try with a different username";
    }
    $sql = "INSERT into `usermanagement`(ne,username,email,password,city,num) VALUES('$ne','$username','$email','$password','$city','$contact')";
    if (mysqli_query($connection,$sql)) {
      $smsg =  "Registration Successfull";
    }else {
      $fmsg .= "Failed To Register";
    }
  }else {
    $fmsg = "Password do not match";
  }
}
 ?>




<html>
  <head>
    <title>User Registration</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="styles.css" >
<script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
$('#usernameLoading').hide();
$('#username').keyup(function(){
 $('#usernameLoading').show();
      $.post("check.php", {
        username: $('#username').val()
      }, function(response){
        $('#usernameResult').fadeOut();
        setTimeout("finishAjax('usernameResult', '"+escape(response)+"')", 400);
      });
    return false;
});
});

function finishAjax(id, response) {
  $('#usernameLoading').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} //finishAjax
</script>
  </head>
  <body>
    <div class="container">
      <?php if(isset($smsg)) { ?><div class="alert alert-success" role="alert"><?php echo $smsg?></div><?php } ?>
      <?php if(isset($fmsg)) { ?><div class="alert alert-danger" role="alert"><?php echo $fmsg?></div><?php } ?>
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please Register</h2>
        <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">@</span>
	  <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php if(isset($username) & !empty($username)) {echo $username;}?>" required>
    <span id="usernameLoading" class="input-group-addon"></span>
  </div>
        <span id="usernameResult"></span>
        <label for="inputEmail" class="sr-only">Full Name</label>
        <input type="text" name="ne" id="inputEmail" class="form-control" placeholder="Full Name"  required autofocus>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address"  required autofocus>
        <label for="inputEmail" class="sr-only">City</label>
        <input type="text" name="city" id="inputEmail" class="form-control" placeholder="City"  required autofocus>
        <label for="inputEmail" class="sr-only">Contact Number</label>
        <input type="number" name="contact" id="inputEmail" class="form-control" placeholder="Contact Number" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword" class="sr-only">Password Again</label>
        <input type="password" name="passwordagain" id="inputPassword" class="form-control" placeholder="Confirm Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
      </form>
</div>
  </body>
</html>
