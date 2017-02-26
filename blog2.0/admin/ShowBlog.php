<?php
	  require '../SqlHelper.class.php';
    $ID=$_GET['ID'];
    $sqlHelper=new SqlHelper();
    $sql="select post_content from posts where ID='$ID'";
    $res=$sqlHelper->execute_dql($sql);
    if($res->num_rows>0)
    {
      	while($row = $res->fetch_assoc())
      	{
      		echo $row["post_content"];
      	}
   	}
   	else
      	echo "<h1>貌似页面走丢了</h1>";

?>