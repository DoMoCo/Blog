<?php

    require '../SqlHelper.class.php';
    session_start();

    //禁止非登入用户进入
    if(empty($_SESSION['user']))
        header("Location:../sign_in.php?log=1");

    //分辨当前状态，写文章or更改文章
    if((!empty($_GET["status"])&&$_GET["status"]=='up')||(!empty($_POST["action"])&&$_POST["action"]=='up'))
    {
        $action='up';
        $submit="更新";
        $ID=$_GET['ID'];
        $sqlHelper=new SqlHelper();
        $sql="select post_title,post_content from posts where ID='$ID'";
        $res=$sqlHelper->execute_dql($sql);
        if($res->num_rows>0)
        {
            while($row = $res->fetch_assoc())
            {
                //获取文章标题和内容
                $post_title=$row['post_title'];
                $post_content=$row['post_content'];
            }
        }
        $res->free(); 
    }
    else if((!empty($_GET["status"])&&$_GET["status"]=='add')||(!empty($_POST["action"])&&$_POST["action"]=='add'))
    {
        $action='add';
        $submit="发布";
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>写博客</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width">
    <script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="lang/zh-cn/zh-cn.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/EditorBlog.css">
</head>
<body>
<form action=
    <?php 
        //用于循环更新
        if(!empty($_GET["status"])&&$_GET["status"]=='up')
            echo "index.php?status=up&ID=".$ID;
        else
            echo "index.php";
    ?> 
    method="POST"> 
<div id="title">
    <input type="text" name="title"
    <?php 
        //内容提示
        if(empty($_POST['title']))
        {
            if(!empty($_GET["status"])&&$_GET["status"]=='up'&&!empty($post_title))
            {
                echo "value=".$post_title;
            }
            else
                echo "placeholder=标&nbsp;题";  
        }
        else //若反复更新，则提示上次提交的标题
            echo "value=".$_POST['title']; 
        //value编辑时提示信息不消失，placeholder会消失     
    ?>
    >   
</div>
<div><!-- 启动编辑器 -->
    <script id="editor" type="text/plain" style="width:1024px;height:380px;">
    <?php
        //加入要编辑的文章
        if(empty($_POST['editorValue']))
        {  
            if(!empty($post_content))
                echo $post_content;
        }
        else
            echo $_POST['editorValue'];
    ?>
    </script>
</div>
<div id="post">
    <!-- 隐藏域,提供所做动作的额外信息-->
    <input type="hidden" name="action" 
    value=<?php echo $action; ?> >
    <a href=
    <?php
        //规定返回跳转到的页面
        if(!empty($_GET["status"])&&$_GET["status"]=='up')
            echo "../users/ShowBlog.php?ID=$ID";
        else if(!empty($_SESSION['page']))
            echo "../users/index.php?page={$_SESSION['page']}";
        else
            echo "../users/index.php";
    ?>
    >▤☜</a>
    <input onclick="PostSubmit()" type="submit" value=
    <?php echo $submit; ?> >
</div>
</form>
    <?php //提交动作(和?php至少要保留一个空格)
        if(!empty($_POST["action"])&&$_POST["action"]=='up')
        {
            require '../users/admin/UpdateBlog.php';
            UpdateBlog();

        }//更新

        if(!empty($_POST["action"])&&$_POST["action"]=='add')
        {
            require '../users/admin/AddBlog.php';
            AddBLog();
        }//发布

    ?>
<script type="text/javascript">
    //实例化一个编辑器（显示编辑器）
    var ue = UE.getEditor('editor');
    //虚拟出一个表单，并提交（用于提交编辑器内的内容）
    function PostSubmit() 
    {  
        var postUrl = '../admin/AddBlog.php';//提交地址  
        var postData = ue.getAllHtml();//第一个数据
        var ExportForm = document.createElement("FORM");  
        document.body.appendChild(ExportForm);  
        ExportForm.method = "POST";  
        var newElement = document.createElement("textarea"); 
        newElement.setAttribute("name", "content");  
        newElement.setAttribute("type", "hidden");   
        ExportForm.appendChild(newElement);  
        newElement.value = postData; 
        ExportForm.action = postUrl;  
        ExportForm.submit();  
    }
</script>
</body>
</html>