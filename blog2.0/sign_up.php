<!DOCTYPE html>
<html>
<head>
	<title>注册</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/sign_up.css">
</head>
<body>
<div id="login" class="center">
    <a href="index.php"><img src="img/logo.jpg"></a>	
    <form action="sign_up.php" method="POST">
   	  <input type="text" name="email" placeholder="Email">
   	  <br>
      <input type="text" name="username" placeholder="Username">
   	  <br>
   	  <input type="password" name="password" placeholder="Password">
   	  <br>
      <input type="password" name="password" placeholder="Confirm Password">
      <br>
      <input type="submit" name="sign_up" value="注册" id="click">
      <br>
    </form>
    <a href="index.php" id="return">返回主页</a> 
</div>
<?php
    require 'GetTouch.php';
    if(!empty($_POST["email"])&&!empty($_POST["username"])&&!empty($_POST["password"]))
    {
      $email=$_POST["email"]; 
      $name=$_POST["username"];
      $passwd=$_POST["password"];
      sign_up($name,$email,$passwd);         
    }
?>
</body>
</html>