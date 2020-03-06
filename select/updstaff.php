<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>updstaff</title>
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
    <h1>修改职工信息</h1>
    <form method="post" action="updstaff.php">
     <p>&nbsp;&nbsp;
       <input type="text" name="id" value="" placeholder="需要修改的职工的ID">&nbsp;&nbsp;
       <input type="submit" name="submit" value="查看职工信息">
      </p>
        <p>&nbsp;</p>
        <p>&nbsp;&nbsp;
          <input type="text" name="name" value="" placeholder="姓名">&nbsp;&nbsp;
          <input type="text" name="age" value="" placeholder="年龄">&nbsp;&nbsp;
          <input type="text" name="tel" value="" placeholder="电话">
        </p>
      <p>&nbsp;&nbsp;
        <input type="text" name="dep" value="" placeholder="部门">&nbsp;&nbsp;
        <input type="text" name="sex" value="" placeholder="性别">&nbsp;&nbsp;
        <input type="text" name="sal" value="" placeholder="薪水">
      </p>
     
        <p class="submit">
        <input type="submit" name="submit" value="修改">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>&nbsp;</p>
    </form>
    <?php
	  if(isset($_POST['submit']) && ($_POST["submit"] == "修改"))
	  {
		  if($_POST['id'] != "")
		  {
	      $id = $_POST['id'];
	      include ("../conn.php");
	      $result = mysql_query("select* from staff where S=$id");
		  $num = mysql_num_rows($result);
		  if($num)
		  {
	      if($_POST['dep'] != ""){
		  $dep = "'".$_POST['dep']."'";
		  $result1 = mysql_query("select* from department where DNAME=$dep");
		  $num1 = mysql_num_rows($result1);
		  }
		  else $num1 = 1;
		  if($num1)
		  {
			  if($_POST['name'] != "") $result2 = mysql_query("update staff set SNAME='{$_POST['name']}' where S=$id");
			  if($_POST['dep'] != "")
			  {
				  $result3 = mysql_query("select* from department where MANAGER=$id and DNAME!=$dep");
		          $num3 = mysql_num_rows($result3);
				  if($num3)
				  {
					  echo "<script>alert('该职工是部门经理，更改部门前请先更换经理！');history.go(-1);</script>";
				  }
				  else
				  {
				      $result2 = mysql_query("update staff set DNAME='{$_POST['dep']}' where S=$id");
				  }
			  }
			  if($_POST['sex'] != "") $result2 = mysql_query("update staff set SEX='{$_POST['sex']}' where S=$id");
			  if($_POST['age'] != "") $result2 = mysql_query("update staff set AGE={$_POST['age']} where S=$id");
			  if($_POST['sal'] != "") $result2 = mysql_query("update staff set SALARY={$_POST['sal']} where S=$id");
			  if($_POST['tel'] != "") $result2 = mysql_query("update staff set TEL='{$_POST['tel']}' where S=$id");
	   	      
			  echo '修改成功';
		  }
		  else
		  {
			  echo "<script>alert('该部门不存在！');history.go(-1);</script>";
		  }
		  }
		  }
		  else
		  {
			  echo "<script>alert('该职工ID不存在！');history.go(-1);</script>";
		  }
	  } 
    ?>
    
    <?php
	  if(isset($_POST['submit']) && $_POST["id"] != "" && ($_POST["submit"] == "查看职工信息"||"修改"))
	  {
		  $id = $_POST['id'];
		  include ("../conn.php");
		  $result = mysql_query("select* from staff where S=$id");
		  $row = mysql_fetch_array($result);
	?>
    <table class="hovertable" width="780" height="" border="">
      <tbody>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">姓名</th>
          <th scope="col">部门</th>
          <th scope="col">性别</th>
          <th scope="col">年龄</th>
          <th scope="col">电话</th>
          <th scope="col">薪水</th>
        </tr>
        <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#d4e3e5';">
               <td><?php echo $row['S']?></td>
               <td><?php echo $row['SNAME']?></td>
               <td><?php echo $row['DNAME']?></td>
               <td><?php echo $row['SEX']?></td>
               <td><?php echo $row['AGE']?></td>
               <td><?php echo $row['TEL']?></td>
               <td><?php echo $row['SALARY']?></td>
             </tr>
    <?php
	  }
    ?>
      </tbody>
    </table>
   
   </div>
  </section>
   <section class="about">
    <p class="about-links"><a href="../my1.php">返回</a></p>
  </section>
  
  
</body>
</html>