<?php

	require 'SqlHelper.class.php';
	$sqlHelper = new SqlHelper();
	$sql="select * from users";
	$res=$sqlHelper->execute_dql($sql);
	$id=$res->num_rows+1;
	echo $id;
	$sql="insert into users values('$id','董梦成',md5('123456'))";
	$res=$sqlHelper->execute_dml($sql);
	if($res>0)
		echo "操作成功$id";
	else
		echo "操作失败";


?>