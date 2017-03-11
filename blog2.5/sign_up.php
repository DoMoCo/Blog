<!DOCTYPE html>
<html>
<head>
	<title>注册</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/sign_up.css">
</head>
<body>
<div id="login">
    <a href="index.php"><img src="img/logo.jpg"></a>	
    <form action="sign_up.php" method="POST">
   	  <input type="text" name="email" placeholder="Email">
      <input type="text" name="username" placeholder="Username">
   	  <input type="password" name="password" placeholder="Password">
      <input type="password" name="ConfirmPassword" placeholder="Confirm Password">
      <input type="text" name="check_code" placeholder="请输入验证码">
      <img src="VerificationCode.php" onclick="this.src='VerificationCode.php?aa=randdom();'">
      <span>点击图片刷新</span>
      <!-- 隐藏域，用于确认是否提交 -->
      <input type="hidden" name="submit" value="ture">
      <input type="submit" name="sign_up" value="注册" id="click">
    </form>
    <a href="index.php" id="return">返回主页</a> 
</div>
<?php
    require 'GetTouch.php';  
    if(!empty($_POST["email"])&&!empty($_POST["username"])&&!empty($_POST["password"])&&!empty($_POST["ConfirmPassword"])&&!empty($_POST["check_code"]))
    {
      if($_POST["password"]!=$_POST["ConfirmPassword"])
        echo "<h1>输入密码不一致</h1>";
      else
      {
        $email=$_POST["email"]; 
        $name=$_POST["username"];
        $passwd=$_POST["password"];
        $check_code=$_POST["check_code"];
        sign_up($name,$email,$passwd,$check_code);
      }          
    }
    else if(!empty($_POST['submit']))
      echo "<h1>不能留空</h1>";
?>
</body>
</html>