<?php

	class SqlHelper{
		private $mysqli;
		private static $host="localhost";
		private static $user="root";
		private static $passwd="iwantmore";
        private static $db="blog";

        public function __construct()
        {
        	$this->mysqli=new MySQLi(self::$host,self::$user,self::$passwd,self::$db);
        	if($this->mysqli->connect_error){
        		die ("连接失败：".$this->mysqli->connect_error);
        	}//设置访问数据库的字符集
                $this->mysqli->query("set names utf8");
        }
        //dql操作
        public function execute_dql($dql){
        	$res=$this->mysqli->query($dql) or die("操作失败：".$this->mysqli->error);
        	return $res;
        } 
        //dml操作
        public function execute_dml($dml){
        	$res=$this->mysqli->query($dml) or die("操作失败：".$this->mysqli->error);
        	if(!$res)
        	{
        		return 0;//修改成功
        	}
        	else
        	{
        		if($this->mysqli->affected_rows>0)
        			return 1;//修改成功
        		else
        			return -1;//没有行受到影响
        	}
        } 
        function __destruct()
        {
                $this->mysqli->close();
        }
    }
?>
