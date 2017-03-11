<?php

  require '../SqlHelper.class.php';
  $sqlHelper=new SqlHelper();
  session_start();
  if(empty($_SESSION['user']))
    header("Location:../sign_in.php?log=1");

  //释放$_SESSION["status"]状态，从而能继续博客
  if(!empty($_SESSION["status"]))
    unset($_SESSION["status"]);
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>念念不忘，必有回响</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/admin_index.css">
  <link rel="stylesheet" type="text/css" href="../css/article.css">
  <script src="../js/users.js"></script>
</head>
<body>
    <header>
    <img src="../img/logo.gif" id="logo">
    <div id="user">
    <a onclick=ShowUserInfo() href="#">
    <?php

      echo $_SESSION['user'];
      
    ?> 
    </a>
    <a href="../sign_in.php?log=2">注销</a>
    <?php

      if($_SESSION['user']=='admin')
        echo '<a href="../UEditor/../UEditor/index.php?status=add">写博客</a>';
    ?>
    </div>    
    <nav>
      <a href="index.php">BLOG</a>
      <a href="#">LATEST</a>
      <a title="点我吧！" href="../books/books.html" target="_blank">
        READING<sup>荐</sup></a>
      <a href="#">FRIEND</a>
      <a href="about.php">ABOUT ME</a>
    </nav>  
    </header>
  <content>   
    <div id="page">
      <?php
        $ID=$_GET['ID'];
        $sql="select post_title,post_content from posts where ID='$ID'";
        $res=$sqlHelper->execute_dql($sql);
        if($res->num_rows>0)
        {
          echo "<div>";
          if($_SESSION['user']=='admin')
          {//只有admin有这些权限
            echo "<a id='editor' href='../UEditor/index.php?status=up&ID={$ID}'>编辑</a>";
            //我也不知道这个onclick为什么这么诡异
            echo "<a id='del' onclick='return del_confirm();' href='admin/DelBlog.php?ID={$ID}'>删除</a>";
          }
          while($row = $res->fetch_assoc())
          {
            if($row['post_title']=="")//显示为空（占位）
              echo "<h1>&nbsp;&nbsp;&nbsp;</h1>";
            else
              echo "<h1>".$row['post_title']."</h1>";
            echo "<div>".$row["post_content"]."</div></div>";
          }

          //浏览量统计
          if($_SERVER['REMOTE_ADDR'])
          {
            require_once '../post_view.php';
            post_view($sqlHelper,$_SERVER['REMOTE_ADDR'],$ID);
          }
        }
        else
          echo "<h1 id='error_404'>貌似页面走丢了~</h1>";
        $res->free();

        //设置回跳页面
        if((!empty($_GET['status'])&&$_GET['status']=='add_ok')||empty($_SESSION['page']))//刚发表的文章
          echo "<a id='return' href='index.php?page=1'>▤☜</a>";
        else //已发表的文章     
          echo "<a id='return' href='index.php?page={$_SESSION['page']}'>▤☜</a>";

        ?>
    </div>
    <div id="sidebar">
        <fieldset>
          <legend>热门文章</legend>
            <?php
              $sql="select ID,post_title,post_views from posts order by post_views desc limit 0,6";
              $res=$sqlHelper->execute_dql($sql);
              if($res->num_rows>0)
              {
                  while($row = $res->fetch_assoc())
                    if($row['post_title']=='')
                      echo "<a href='ShowBlog.php?ID={$row['ID']}'>☞···</a><span>".$row['post_views']."&nbsp;views</span>";
                    else
                      echo "<a href='ShowBlog.php?ID={$row['ID']}'>☞".$row['post_title']."</a><span>".$row['post_views']."&nbsp;views</span>";
              }
              $res->free();
            ?>
        </fieldset>
    </div>
  </content>
  <footer>
    <p>
      &copy;2016 <a href="http://domoco.cc" target="_blank">
      DoMoCo</a><br><br>
      All rights reserved 
    </p>
  </footer>
  <script type="text/javascript">
    //用于确认是否删除文章
    function del_confirm()
    {
      if(window.confirm('你确定删除该文章吗？'))
      {
         //alert("确定");
         return true;
      }
      else
      {
         //alert("取消");
         return false;
      }
    }
  </script>
</body>
</html>
