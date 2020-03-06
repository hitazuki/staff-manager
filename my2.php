<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>mydep</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<section class="container">
    <div class="login">
<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:index.html");
    exit();
}

//包含数据库连接文件
include('conn.php');
$userid = $_SESSION['userid'];
$user_query = mysql_query("select * from staff where S=$userid limit 1");
$row = mysql_fetch_array($user_query);
echo '经理信息：<br />';
echo '经理ID：',$userid,'<br />';
echo '姓名：',$row['SNAME'],'<br />';
echo '部门：',$row['DNAME'],'<br />';
echo '性别：',$row['SEX'],'<br />';
echo '年龄：',$row['AGE'],'<br />';
echo '电话：',$row['TEL'],'<br />';
echo '薪水：',$row['SALARY'],'<br />';
?>

</div>
  </section>
  
  <section class="about">
   <p class="about-links"><a href="select/seldep.php?action=select">查询部门</a></p>
   <p class="about-links"><a href="select/selstaff2.php?action=select">查询职工</a></p>
   <p class="about-links"><a href="update/password2.php">更改密码</a></p>
   <p class="about-links"><a href="index.php?action=logout">注销</a></p>
  </section>;

</body>
</html>