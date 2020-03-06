<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>myad</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<section class="container">
    <div class="login">
<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:index1.html");
    exit();
}

//包含数据库连接文件
include('conn.php');
$userid = $_SESSION['userid'];
$user_query = mysql_query("select * from administrator where A=$userid limit 1");
$row = mysql_fetch_array($user_query);
echo '管理员信息：<br />';
echo '管理员ID：',$userid,'<br />';
echo '电话：',$row['TEL'],'<br />';
?>

</div>
  </section>
  
  <section class="about">
   <p class="about-links"><a href="select/select.php?action=select">查询管理员</a></p>
   <p class="about-links"><a href="select/seldep1.php?action=select">部门管理</a></p>
   <p class="about-links"><a href="select/selstaff1.php?action=select">查询职工</a></p>
   <p class="about-links"><a href="select/updstaff.php?action=select">更改职工信息</a></p>
   <p class="about-links"><a href="select/addstaff.php?action=select">增加职工</a></p>
   <p class="about-links"><a href="select/delstaff.php?action=select">删除职工</a></p>
   <p class="about-links"><a href="update/password1.php">更改密码</a></p>
   <p class="about-links"><a href="index1.php?action=logout">注销</a></p>
  </section>;

</body>
</html>