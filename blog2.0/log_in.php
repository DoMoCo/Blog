<!DOCTYPE html>
<html>
<head>
	<title>登入</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/log_in.css">
</head>
<body>
<div id="login" class="center">
   <a href="index.html"><img src="img/logo.jpg"></a>	
   <form action="log_in.php" method="POST">
   	Username:<input type="text" name="username"><br><br>
   	Password:<input type="password" name="password"><br><br>
      <input type="submit" name="log_in" value="登入" id="click"><br>
   </form>
   <a href="index.html" id="return">返回主页</a>
</div>
<?php

   require 'SqlHelper.class.php';
   $name=@$_POST["username"];
   if ($name) 
   {
      $pwd=$_POST["password"];
      $sqlHelper = new SqlHelper();
      $sql="select name,passwd from users where name='$name'";
      $res=$sqlHelper->execute_dql($sql);
      if($res->num_rows>0)
      {
         while($row = $res->fetch_assoc())
         {
         if($row['passwd']==md5($pwd))
            header("Location:index.html");
         else
            echo "<h1>密码错误</h1>";
         }
      }
      else
         echo "<h1>密码错误</h1>";
   }  	   
?>
</body>
</html>
