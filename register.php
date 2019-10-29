<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('error.php'); ?>
  	<div class="input-group">
  	  <label>Firstname</label>
  	  <input type="text" name="First_Name" value="<?php echo $firstname; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Lastname</label>
  	  <input type="text" name="Last_Name" value="<?php echo $lastname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Phone</label>
  	  <input type="text" name="Phone" value="<?php echo $phone; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="Password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="Password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>