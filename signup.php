<html>
<head>
<title>Signup</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="primary">
<?php
	$title = "Sign Up";
	include("header.php");
?>
<h2 style="text-decoration: underline;">Account</h2>

<form action="signupHandler.php" method="post">
  <?php if(isset($_GET['error'])){ ?>
    <p><?php echo $_GET['error']; ?></p>
    <?php } ?>
  <label for="username">Username</label>
  <input type="text" id="username" name="username" placeholder="Username">

  <label for="email">Email</label>
  <input type="text" id="email" name="email" placeholder="Email">

  <label for="name">Name</label>
  <input type="text" id="name" name="name" placeholder="name">

  <!-- <label for="password">Password</label>
  <input type="text" id="password" name="password" placeholder="Password">

  <label for="passwordConfirm">Password Confirm</label>
  <input type="text" id="passwordConfirm" name="passwordConfirm" placeholder="Password"> -->

  <button type="submit">Sign Up</button>
</form>
</body>
</html>