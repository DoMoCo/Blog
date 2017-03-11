<?php
	session_start();
 	if(empty($_SESSION['user']))
 		header("Location:../sign_in.php?log=1");
?>
<!DOCTYPE html>
<html>
<head>
	<title>
	<?php 

		$name=$_SESSION['user'];
		echo $name;

	?>	
	</title>
	<meta charset="utf-8">
</head>
<body>
<?php
	
	require '../SqlHelper.class.php';
	$sqlHelper = new SqlHelper();
	$sql="select email,registered from users where name='$name'";
    $res=$sqlHelper->execute_dql($sql);
    if($res->num_rows>0)
    {
      	while($row = $res->fetch_assoc())
      	{
      		echo "名字：".$name."<br><br>";
      		echo "邮箱：".$row["email"]."<br><br>";
      		echo "注册时间：".$row['registered']."<br>";         	
      	}
   	}
   	$res->free();

?>
</body>
</html>