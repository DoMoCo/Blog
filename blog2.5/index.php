<?php

  require 'SqlHelper.class.php';
  $sqlHelper=new SqlHelper();
  session_start();
  if(!empty($_SESSION['user']))
    header("Location:users/index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>此岸花谢 彼岸花开</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
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
      <a href="index.php?page=1" id="blog">BLOG</a>
      <a href="#">LATEST</a>
      <a title="点我吧！" href="books/books.html" target="_blank">
        READING<sup>荐</sup></a>
      <a href="#">FRIEND</a>
      <a href="about.php">ABOUT ME</a>
    </nav>  		
  </header>

	<content>
		<div id="page">
      <!-- <div class="blank">
      </div> -->
			<?php 

				$num_article=10;//定义每页显示文章数
        $start=0;
        if(!empty($_GET['page']))
        {//设置当前页面session,便于返回时定位页面
          $_SESSION['page']=$_GET['page'];
          $start=($_GET['page']-1)*$num_article;
        }
        $sql="select ID from posts";
        $res=$sqlHelper->execute_dql($sql);
        $num_page=ceil($res->num_rows/$num_article);
        $res->free();

        $sql="select ID,post_date,post_update,post_title,post_content,post_views from posts order by ID desc limit {$start},{$num_article} ";
        $res=$sqlHelper->execute_dql($sql);
  			if($res->num_rows>0)
  			{
    				while($row = $res->fetch_assoc())
    				{
    					if($row['post_title']=='')
    						echo "<div><a href='ShowBlog.php?ID={$row['ID']}'>&nbsp;&nbsp;&nbsp</a>";
    					else
    						echo "<div><a href='ShowBlog.php?ID={$row['ID']}'>".$row['post_title']."</a>";
              echo "<span>浏览量:".$row["post_views"]."</span>";
              echo "<span>发表时间:".date('Y-m-d', strtotime($row["post_date"]))."</span>";
              if(!empty($row["post_update"]))
                echo "<span>更新时间:".date('Y-m-d', strtotime($row["post_update"]))."</span>";
    					echo "<div>".$row["post_content"]."</div></div>";
    				}
    			}
          $res->free();
			?>
      <div id="page_link">
        <?php

          echo "<span>Go</span>";
          for ($page=1; $page <=$num_page; $page++) 
          { //实现分页并利用css分辨当前页
            if($page==1&&empty($_SESSION['page']))
              echo "<a id='pagenow'  href='index.php?page={$page}'>1</a>";
            else if(!empty($_SESSION['page'])&&$page==$_SESSION['page'])
              echo "<a id='pagenow' href='index.php?page={$page}'>".$page."</a>";
            else
              echo "<a  href='index.php?page={$page}'>".$page."</a>";
          }

        ?>
      </div>
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