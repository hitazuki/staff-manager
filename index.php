<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<section class="container">
    <div class="login">
    
<?php  
    session_start();

//注销登录
if(isset($_GET['action']) and $_GET['action'] == "logout"){
    unset($_SESSION['userid']);
    echo '注销登录成功！点击此处 <a href="index.html">登录</a>';
    exit;
}

    if(isset($_POST["submit"]) && $_POST["submit"] == "Login")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        if($user == "" || $psw == "")  
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else  
        {  
            include('conn.php'); 
            $sql = "select * from staff where S = '$_POST[username]' and SPASSWORD = '$_POST[password]'"; 
            $result = mysql_query($sql);  
            $num = mysql_num_rows($result);  
            if($num)  
            {  
                $row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中  
                $_SESSION['userid'] = $row['S'];
				$userid = $row['S'];
				$result2 = mysql_query("select * from department where MANAGER=$userid"); 
				$num2 = mysql_num_rows($result2); 
				if($num2)
				{
                    echo '部门经理 ',$row['SNAME'],' 欢迎你！进入 <a href="my2.php">用户中心</a><br />';
                    echo '点击此处 <a href="index.php?action=logout">注销</a> 登录！<br />';
                    exit;
				}
				else
				{
					echo $row['SNAME'],' 欢迎你！进入 <a href="my.php">用户中心</a><br />';
                    echo '点击此处 <a href="index.php?action=logout">注销</a> 登录！<br />';
                    exit;
				}
            }  
            else  
            {  
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";  
            }  
        }  
    }  
    else  
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  
  
?> 
    </div>
  </section>
</body>
</html>