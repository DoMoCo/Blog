<!DOCTYPE html>
<html>
<head>
	<title>此岸花谢 彼岸花开</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/about.css">
</head>
<body>
    <header >
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
      <a href="about.php" id="about">ABOUT ME</a>
    </nav>	
    </header>
	<content>
		<div id="page">	
			<div>
		 		<p id="decript">
		 		必修课选翘，选修课必翘，一个严格意义上的坏学生<br>
            	+一个自娱自乐、孤芳自赏的迷途少年。
            	</p>
            	<p>				
				<span>Email:</span> do_moco@outlook.com<br><br>
				<span>GitHub:</span> DoMoCo<br><br>
				</p>
				尾巴:<br>
				<p>
				认真生活，专注做事，这里，是，梦开始，同时也是，心灵驻足的地方。
				<br><br>
				破网取意打破种种束缚，跟随内心之声，创造美丽未来。至于是不是破的网，对，就是破的网，人生好似一张破网，次次撒网，若有所失，若有所得，总不能全要吧！另外 ，“鱼”死方才网破，凡事留一线，破网一张——放行锱铢小事，坚守原则之物，就好了。
				</p>
			</div>			
		</div>
		<div id="sidebar">
      		<fieldset>
				<legend>热门文章</legend>
                <?php
                	require_once 'SqlHelper.class.php';
                	$sqlHelper=new SqlHelper();
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