<?php
  	require_once '../SqlHelper.class.php';
   	session_start();
   	$post_content=$_POST['editorValue'];
   	$post_autor=$_SESSION['ID'];
   	date_default_timezone_set('Asia/Shanghai');
    $post_date=date("Y-m-d H:i:s");
    $post_title=$_POST['title'];
    $sqlHelper=new SqlHelper();
    $sql="insert into posts(post_autor,post_date,post_title,post_content) values('$post_autor','$post_date','$post_title','$post_content')";
    $res1=$sqlHelper->execute_dml($sql);
    if ($res1==0) {
        echo "<h1>发表失败</h1>";
    }
    else if($res1==1)
    {
    	$sql="select ID from posts where post_date='$post_date'";
    	$res2=$sqlHelper->execute_dql($sql);
    	if($res2->num_rows>0)
    	{
      		while($row = $res2->fetch_assoc())
      			$ID=$row['ID'];
      		echo "<h1>发表成功<a href='ShowBlog.php?ID={$ID}'>现在查看？</a></h1>";
    	} 
    	$res2->free();
    }      
    else
        echo "<h1>发表无效</h1>";
?>