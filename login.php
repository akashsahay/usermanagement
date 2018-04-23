<?php
session_start();
require_once('connect.php');
if (isset($_SESSION) && !empty($_SESSION)){
  //$smsg =  "Already Exists" .$_SESSION['username'];
}

if (isset($_POST['username']) && !empty($_POST)) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM `usermanagement` WHERE username = '$username'";
  $res = mysqli_query($connection,$sql);
  $count = mysqli_num_rows($res);
  $passp=md5($password);
  if ($passp==mysqli_fetch_array($res)['password']){
  $_SESSION['username'] = $username;
  header('location:members/index.php');
  }
  else {
    $fmsg =  "Please register first";
  }
}
?>



<html>
  <head>
    <title>User Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="styles.css" >
<script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <?php if(isset($smsg)) { ?><div class="alert alert-success" role="alert"><?php echo $smsg?></div><?php } ?>
      <?php if(isset($fmsg)) { ?><div class="alert alert-danger" role="alert"><?php echo $fmsg?></div><?php } ?>
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Login</h2>
        <div class="input-group">
	         <span class="input-group-addon" id="basic-addon1">@</span>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            <span id="usernameLoading" class="input-group-addon"></span>
        </div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <a class="btn btn-lg btn-primary btn-block" href="register.php">Register</a>
      </form>
</div>
  </body>
</html>
