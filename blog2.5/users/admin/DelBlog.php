<?php

    require_once '../../SqlHelper.class.php';
    session_start();
    $ID=$_GET['ID'];
    $sql="delete from posts where ID='$ID'";
    $sqlHelper=new SqlHelper();
    $res1=$sqlHelper->execute_dml($sql);
    //$_SESSION['page']}为所删文章的页面
    header("Location:../index.php?page={$_SESSION['page']}&status=del_ok");

?>