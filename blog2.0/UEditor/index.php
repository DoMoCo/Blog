<!DOCTYPE html>
<html>
<head>
    <title>写博客</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="lang/zh-cn/zh-cn.js"></script>

    <style type="text/css">
        div{
            width:100%;
        }
    </style>
</head>
<body>
<form action="../admin/AddBlog.php" method="POST">   
<div>
    标题：<input type="text" name="title">
    <script id="editor" type="text/plain" style="width:1024px;height:400px;"></script>
</div>
<div>
    <input onclick="PostSubmit()" type="submit" value="发表">
</div>
</form>
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
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