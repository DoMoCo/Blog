<?php

    function post_view($sqlHelper,$ip,$ID)
    {
        date_default_timezone_set('Asia/Shanghai');
        $visit_date=date("Y-m-d H:i:s");
        if(empty($_SESSION['user']))
        {   //是否为游客
            $sql1="select ip from guests where ip='$ip'";
            //查询该ip是否之前访问过该站
            $sql2="insert into guests(ip,visit_date) values('$ip','$visit_date')";
            //将该ip信息写入数据库
        }
        if((!empty($_SESSION['user'])&&$_SESSION['user']!='admin'))
        {   //是否为用户且不是管理员
            $username=$_SESSION['user'];
            $sql1=$sql="select ip,username from guests where ip='$ip'";
            $sql2="insert into guests(ip,username,visit_date) values('$ip','$username','$visit_date')";
        }
        if(isset($sql1))
        {
            //该文章浏览量+1
            $sql="update posts set post_views=post_views+1 where ID='$ID'";
            $sqlHelper->execute_dml($sql);

            $res=$sqlHelper->execute_dql($sql1);
            if($res->num_rows==0)
            {                              
                $sqlHelper->execute_dml($sql2);
                        
            }
            else
            {                
                $sql="update guests set visit_date='$visit_date' where ip='$ip'"; 
                while($row=$res->fetch_assoc())
                    //更新用户名和访问时间
                    if(isset($username)||(!empty($row['username'])&&$row['username']!=$username))
                        $sql="update guests set visit_date='$visit_date',username='$username' where ip='$ip'";
                    else//只更新访问时间
                         $sql="update guests set visit_date='$visit_date' where ip='$ip'";
                $sqlHelper->execute_dml($sql);
            }

        }
    }
?>