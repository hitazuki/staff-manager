<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>addstaff</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:../index1.html");
    exit();
}
?>
<section class="container">
    <div class="page">
    <h1>增加职工</h1>
    <form method="post" action="addstaff.php">
        <p>&nbsp;&nbsp;
          <input type="text" name="id" value="" placeholder="ID">&nbsp;&nbsp;
          <input type="text" name="age" value="" placeholder="年龄">&nbsp;&nbsp;
          <input type="text" name="tel" value="" placeholder="电话">
        </p>
      <p>&nbsp;&nbsp;
        <input type="text" name="name" value="" placeholder="姓名">&nbsp;&nbsp;
        <input type="text" name="sex" value="" placeholder="性别">&nbsp;&nbsp;
        <input type="text" name="sal" value="" placeholder="薪水">
      </p>
      <p>&nbsp;&nbsp;
      <input type="text" name="dep" value="" placeholder="部门"></p>
        <p class="submit">
        <input type="submit" name="submit" value="增加">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>&nbsp;</p>
    </form>
    <?php
	  if(isset($_POST['submit']) && ($_POST["submit"] == "增加"))
	  {
		  if($_POST['id'] == "" || $_POST['name'] == "" || $_POST['dep'] == "")
		  {
			  echo "<script>alert('ID、姓名或部门不能为空！');history.go(-1);</script>";
		  }
		  else
		  {
		      $id = $_POST['id'];
		      include ("../conn.php");
		      $result = mysql_query("select* from staff where S=$id");
		      $num = mysql_num_rows($result);
		      if($num)
		      {
		    	  echo "<script>alert('ID重复！');history.go(-1);</script>";
		      }
		      else
		      {
				  $dep = "'".$_POST['dep']."'";
				  $result1 = mysql_query("select* from department where DNAME=$dep");
				  $num1 = mysql_num_rows($result1);
				  if($num1)
				  {
					  $name = "'".$_POST['name']."'";
					  if($_POST['sex'] != "") $sex = "'".$_POST['sex']."'";
					  else $sex = 'NULL';
					  if($_POST['age'] != "") $age = $_POST['age'];
					  else $age = 'NULL';
					  if($_POST['sal'] != "") $sal = $_POST['sal'];
					  else $sal = 'NULL';
					  if($_POST['tel'] != "") $tel = "'".$_POST['tel']."'";
					  else $tel = 'NULL';
		    	      $result2 = mysql_query("INSERT INTO staff VALUES('$id',$name,'111111',$sex,$age,$sal,$tel,$dep)");
					  echo '添加成功';
				  }
				  else
				  {
					  echo "<script>alert('该部门不存在！');history.go(-1);</script>";
				  }
		      }
		  }
	  } 
    ?>

   
   </div>
  </section>
   <section class="about">
    <p class="about-links"><a href="../my1.php">返回</a></p>
  </section>
  
  
</body>
</html>