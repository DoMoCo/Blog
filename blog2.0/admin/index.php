<?php
	session_start();
 	if(empty($_SESSION['user']))
 		header("Location:../sign_in.php?log=1");

?>
<!DOCTYPE html>
<html>
<head>
	<title>念念不忘，必有回响</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/admin_index.css">
</head>
<body>
    <header>
    <img src="../img/logo.gif" id="logo">
    <div id="user">
		<a href="#">
		<?php
			echo $_SESSION['user'];
		?> 
		</a>
		<a href="../sign_in.php?log=2">注销</a>
		<?php

			if($_SESSION['user']=='admin')
				echo '<a href="../UEditor/">写博客</a>';
		?>
    </div>   	
    <table>
    	<tr>
    		<td><a href="index.php" id="all">ALL</a></td>
    		<td><a href="#">LATEST</a></td>
    		<td title="点我就对了">
    		<a href="../books/books.html" target="_blank">READING<sup>荐</sup></a>
    		</td>
    		<td><a href="#">FRIEND</a></td>
    		<td><a href="about.php">ABOUT ME</a></td>
    	</tr>
    </table>	
    </header>
	<content>
		<div id="page">
			<div id="content_start">
				<h1>HELLO,WORLD!!!</h1>
				<p>
					这是我的第一个博客...
				</p>
			</div>
			<div>
				<h1>HELLO,WORLD!!!too!</h1>
				<p>
					这是我的第二个博客...
				</p>
			</div>
			<div>
				<h1>HELLO,WORLD!!!too!too!</h1>
				<p>
					这是我的第三个博客...
				</p>
			</div>
			<div id="last">
				<h1>HELLO,WORLD!!!too!too!too!</h1>
				<p>
					这是我的第四个博客...
				</p>
			</div>
		</div>
		<div id="sidebar">
          	<fieldset>
    			<legend>热门文章</legend>
                   <h2>HELLO,WOELD!!!</h2>
                   <h2>HELLO,WORLD!!!too!</h2>
  			</fieldset>
			</form>
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