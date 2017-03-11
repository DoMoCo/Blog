<?php

  	require 'SqlHelper.class.php';
	function sign_in($name,$passwd,$check_code)
	{
      session_start();
      if($check_code!=$_SESSION["captcha"])
         echo "<h1>验证码错误！</h1>";
      else
      {
   		$sqlHelper = new SqlHelper();
   	  	$sql="select name,passwd from users where name='$name'";
         $res=$sqlHelper->execute_dql($sql);
         if($res->num_rows>0)
         {
         	while($row = $res->fetch_assoc())
         	{
         		if($row['passwd']==md5($passwd))
         		{
                  session_start();
                  $lifeTime = 7*24 * 3600;//一周内免登入
                  setcookie(session_name(), session_id(), time() + $lifeTime, "/");//设置sessionID存留时间
            		$_SESSION["user"]=$name;
                  $_SESSION['page']=1;
            		header("Location:./users/index.php?sign_in=true");
            		return;
         		}
            	else
         		{
            		echo "<h1>密码错误</h1>";
         		}
         	}
      	}
      	else
         	echo "<h1>该用户不存在</h1>";
         $res->free();
      }
	}

   function sign_up($name,$email,$passwd,$check_code)
   {
      session_start();
      if($check_code!=$_SESSION["captcha"])
         echo "<h1>验证码错误！</h1>";
      else
      {
         $sqlHelper = new SqlHelper();
         $sql="select Email from users where Email='$email'";
         $res=$sqlHelper->execute_dql($sql);
         if ($res->num_rows>0) {
            die("<h1>该邮箱已经注册</h1>");
         }
         $res->free();

         $sql="select name from users where name='$name'";
         $res=$sqlHelper->execute_dql($sql);
         if ($res->num_rows>0) {
            die("<h1>该用户名已经注册</h1>");
         }
         $res->free();

         date_default_timezone_set('Asia/Shanghai');
         $date=date("Y-m-d H:i:s");
         $sql="insert into users(name,passwd,email,registered) values('$name',md5('$passwd'),'$email','$date')";
         $res=$sqlHelper->execute_dml($sql);
         if ($res==0) {
            echo "<h1>注册失败</h1>";
         }
         else if($res==1)
            echo "<h1>注册成功<a href='sign_in.php'>现在登入？</a></h1>";
         else
            echo "<h1>注册无效</h1>";
      }
   }
?>