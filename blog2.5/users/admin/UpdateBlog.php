<?php

	function UpdateBLog()
	{
        echo "<h1>in</h1>";
		if(empty($_POST['editorValue'])&&empty($_POST['title']))
        {
            echo "<h1>内容不能为空！</h1>";
            return;
        }
        $ID=$_GET['ID'];
        $post_content=$_POST['editorValue'];
        date_default_timezone_set('Asia/Shanghai');
        $post_update=date("Y-m-d H:i:s");
        $sqlHelper=new SqlHelper();
        if(!empty($_POST['title']))//判断是否修改了标题（未修改为空）
        {
        	$post_title=$_POST['title'];
        	$sql="update posts set post_title='$post_title',post_content='$post_content',post_update='$post_update' where ID='$ID'";
        }
        else
        	$sql="update posts set post_content='$post_content',post_update='$post_update'where ID='$ID'";
        $res1=$sqlHelper->execute_dml($sql);
        if ($res1==0)
        {
            echo "<h1>更新失败</h1>";
        }
        else if($res1==1)
        {
            echo "<h1>更新成功<a href='../users/ShowBlog.php?ID={$ID}'>现在查看？</a></h1>";
        }      
        else
          echo "<h1>更新无效</h1>";
	}

?>