<!DOCTYPE html>
<html>
<head>
	<title>登入</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/sign_in.css">
</head>
<body>
<div id="login" class="center">
   <a href="index.php"><img src="img/logo.jpg"></a>	
   <form action="sign_in.php" method="POST">
   	Username:<input type="text" name="username"><br><br>
   	Password:<input type="password" name="password"><br><br>
      <!-- 隐藏域，用于确实是否提交 -->
      <input type="hidden" name="submit" value="ture">
      <input type="submit" name="log_in" value="登入" id="click"><br>
   </form>
   <a href="index.php" id="return">返回主页</a>
</div>
<?php
   require_once 'GetTouch.php';
   if(!empty($_GET['log']))
      if($_GET['log']==1)
         echo "<h1>你还没有登入</h1>";
      else if($_GET['log']==2)
         echo "<h1>已安全注销</h1>";
   if(!empty($_POST["username"])&&!empty($_POST["password"]))
   {
      $name=$_POST["username"];      
      $pwd=$_POST["password"];
      sign_in($name,$pwd);
   }
   else if(!empty($_POST['submit']))
      die("<h1>不能留空<h1>");
       	   
?>
</body>
</html>
