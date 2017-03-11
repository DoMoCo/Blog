<!DOCTYPE html>
<html>
<head>
	<title>登入</title>
	<meta charset="utf-8">
  <!--  根据设备决定内容宽度（会发生不可预知的结果，不好控制） -->
   <meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/sign_in.css">
</head>
<body>
<div id="login">
   <a href="index.php"><img src="img/logo.jpg"></a>	
   <form action="sign_in.php" method="POST">
   	<div class="table-row">
         <p>Username:</p>
         <p><input type="text" name="username"></p>
      </div>
   	<div class="table-row">
         <p>Password:</p>
         <p><input type="password" name="password"></p>
      </div>
      <div class="table-row">
         <p>验&nbsp;&nbsp;证&nbsp;&nbsp;码:</p>
         <p id="check"><input type="text" name="check_code"
         placeholder="点击图片刷新">
         <img src="VerificationCode.php" onclick="this.src='VerificationCode.php?aa=randdom();'">
         </p>
      </div>
      <!-- 隐藏域，用于确认是否提交 -->
      <input type="hidden" name="submit" value="ture">
      <div id="click">
         <input type="submit" name="log_in" value="登入">
      </div>
   </form>
   <a href="index.php" id="return">返回主页</a>
</div>
<?php
   require_once 'GetTouch.php';
   if(!empty($_GET['log']))
      if($_GET['log']==1)
         echo "<h1>您需要登入</h1>";
      else if($_GET['log']==2)
      {
         session_start();
         if (isset($_COOKIE[session_name()])) 
            setcookie(session_name(), '', time()-100, '/');
         session_destroy();
         echo "<h1>已安全注销</h1>";
      }
   if(!empty($_POST["username"])&&!empty($_POST["password"])&&!empty($_POST["check_code"]))
   {
      $name=$_POST["username"];      
      $pwd=$_POST["password"];
      $check_code=$_POST["check_code"];
      sign_in($name,$pwd,$check_code);
   }
   else if(!empty($_POST['submit']))
      echo "<h1>不能留空</h1>";     	   
?>
</body>
</html>
