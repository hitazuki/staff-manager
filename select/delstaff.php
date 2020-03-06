<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>delstaff</title>
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
    <div class="login">
    <h1>删除职工</h1>
    <form method="post" action="delstaff.php">
      <p><input type="text" name="id" value="" placeholder="输入需要删的除职工的ID"></p>
      <p class="submit"><input type="submit" name="submit" value="删除">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
      <p>&nbsp;</p>
    </form>
    <?php
	  if(isset($_POST['submit']) && ($_POST["submit"] == "删除"))
	  {
		  if($_POST['id'] == "")
		  {
			  echo "<script>alert('ID不能为空！');history.go(-1);</script>";
		  }
		  else
		  {
		      $id = $_POST['id'];
		      include ("../conn.php");
		      $result = mysql_query("select* from staff where S=$id");
		      $num = mysql_num_rows($result);
		      if($num)
		      {
				  $result1 = mysql_query("select* from department where MANAGER='$id'");
				  $num1 = mysql_num_rows($result1);
				  if($num1)
				  {
					  echo "<script>alert('该职工是经理，删除前请先更换经理！');history.go(-1);</script>";
				  }
				  else
				  {
		    	      $result2 = mysql_query("delete from staff where S=$id");
				      echo '删除成功';
				  }
		      }
		      else
		      {
				   echo "<script>alert('该职工不存在！');history.go(-1);</script>";
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