<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="primary">
<?php
	$title = "Login";
	include('header.php');
?>
<h2 style="text-decoration: underline;">Account</h2>

<form action="loginHandler.php" method=
'post'>
  <?php if(isset($_GET['error'])){ ?>
    <p><?php echo $_GET['error']; ?></p>
    <?php } ?>
  <label for="username">Username or Email</label>
  <input type="text" name="username" id="username" placeholder="Username">

  <!-- <label for="password">Password</label>
  <input type="text" name="password" id="password" placeholder="Password"> -->

  <button type="submit">Log In</button>
  
<p>Don't have an account? <a href="signup.php" class="secondary">Sign up!</a></p>
</form>
</body>
</html>