<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>

<?php
/*****************************
*数据库连接
*****************************/
$conn = @mysql_connect("localhost","root","root");
if (!$conn){
    die("连接数据库失败：" . mysql_error());
}
mysql_select_db("company", $conn);
//字符转换，读库
mysql_query("set character set 'gbk'");
//写库
mysql_query("set names 'gbk'");
?>
</body>
</html>