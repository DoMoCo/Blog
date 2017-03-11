<!DOCTYPE html>
<html>
<head>
  <title>此岸花谢 彼岸花开</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/all.css">
  <link rel="stylesheet" type="text/css" href="css/article.css">
</head>
<body>
    <head>
  <title>Just for fun!</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
 <link rel="stylesheet" type="text/css" href="css/article.css">
</head>
<body>
    <header>
    <img src="img/logo.gif" id="logo">
    <div id="sign_in">
    <a href="sign_in.php" >Sign in</a>
    </div>    
    <div id="sign_up">
        <a href="sign_up.php" >Sign up</a>    
    </div>
      <nav>
        <a href="index.php" >BLOG</a>
        <a href="#">LATEST</a>
        <a title="点我吧！" href="books/books.html" target="_blank">
          READING<sup>荐</sup></a>
        <a href="#">FRIEND</a>
        <a href="about.php">ABOUT ME</a>
      </nav>  
    </header>
  <content>
    <div id="page">
      <?php
      
        require 'SqlHelper.class.php';
        $sqlHelper=new SqlHelper();
        session_start();
        $ID=$_GET['ID'];
        $sql="select post_title,post_content from posts where ID='$ID'";
        $res=$sqlHelper->execute_dql($sql);
        if($res->num_rows>0)
        {
          while($row = $res->fetch_assoc())
          {
            
            if($row['post_title']=="")
              echo "<div><h1>&nbsp;&nbsp;&nbsp;</h1>";
            else
              echo "<div><h1>".$row['post_title']."</h1>";
            echo "<div>".$row["post_content"]."</div></div>";
          }
          if($_SERVER['REMOTE_ADDR'])
          {
            require_once 'post_view.php';
            post_view($sqlHelper,$_SERVER['REMOTE_ADDR'],$ID);
          }
        }
        else
          echo "<h1 id='error_404'>貌似页面走丢了~</h1>";
        $res->free();
        if(empty($_SESSION['page']))
          echo "<a id='return' href='index.php?page=1'>▤☜</a>";
        else
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
</body>
</html>
