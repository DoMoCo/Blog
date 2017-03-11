<?php
    function AddBLog()
    {
      if(empty($_SESSION["status"]))//防止重复提交
      {
        if(empty($_POST['editorValue'])&&empty($_POST['title']))
        {
            echo "<h1>内容不能为空！</h1>";
            return;
        }
        $post_content=$_POST['editorValue'];//编辑器内容的索引
        $post_autor=$_SESSION['user'];
        $post_title=$_POST['title'];
        //获取当前时间
        date_default_timezone_set('Asia/Shanghai');
        $post_date=date("Y-m-d H:i:s");
        $sqlHelper=new SqlHelper();
        $sql="insert into posts(post_autor,post_date,post_title,post_content,post_views) values('$post_autor','$post_date','$post_title','$post_content',0)";
        $res1=$sqlHelper->execute_dml($sql);
        if ($res1==0)
        {
            echo "<h1>发表失败</h1>";
        }
        else if($res1==1)
        {
          //取得文章ID,跳转到文章页面
          $sql="select ID from posts where post_date='$post_date'";
          $res2=$sqlHelper->execute_dql($sql);
          if($res2->num_rows>0)
          {
            while($row = $res2->fetch_assoc())
              $ID=$row['ID'];
            echo "<h1>发表成功<a href='../users/ShowBlog.php?ID={$ID}&status=add_ok'>现在查看？</a></h1>";
          } 
          $res2->free();
        }      
        else
          echo "<h1>发表无效</h1>";
        $_SESSION["status"]="published";//提交状态为已发表
        //可在文章显示页和网站链接页取消状态
      }
      else
        echo "<h1>不能重复提交！</h1>";
    }
?>