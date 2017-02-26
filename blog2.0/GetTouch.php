<?php

  	require 'SqlHelper.class.php';

	function sign_in($name,$passwd)
	{
		$sqlHelper = new SqlHelper();
	  	$sql="select ID,name,passwd from users where name='$name'";
      echo $sql;
      $res=$sqlHelper->execute_dql($sql);
      if($res->num_rows>0)
      {
      	while($row = $res->fetch_assoc())
      	{
      		if($row['passwd']==md5($passwd))
      		{
               session_start();
         		$_SESSION["user"]=$name;
               $_SESSION["ID"]=$row['ID'];
         		header("Location:./admin/index.php?sign_in=true");
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
	}

   function sign_up($name,$email,$passwd)
   {
      $sqlHelper = new SqlHelper();
      $sql="select Email from users where Email='$email'";
      $res=$sqlHelper->execute_dql($sql);
      if ($res->num_rows>0) {
         die("<h1>该邮箱已经注册</h1>");
      }      
      $sql="select Email from users where name='$name'";
      $res=$sqlHelper->execute_dql($sql);
      if ($res->num_rows>0) {
         die("<h1>该用户名已经注册</h1>");
      }
      $sql="select * from users";
      $res=$sqlHelper->execute_dql($sql);
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
?>