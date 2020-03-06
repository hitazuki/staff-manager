<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>selstaff</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:../index.html");
    exit();
}
?>
<section class="container">
  <div class="page">
    <h1>职工查询</h1>
    <form method="post" action="selstaff.php">
      <p>&nbsp;&nbsp;
        <input type="text" name="id" value="" placeholder="ID">&nbsp;&nbsp;
        <input type="text" name="dep" value="" placeholder="部门">&nbsp;&nbsp;
        <input name="agemin" type="text" placeholder="年龄下限" value="">
      </p>
      <p>&nbsp;&nbsp;
        <input type="text" name="name" value="" placeholder="姓名">&nbsp;&nbsp;
        <input type="text" name="sex" value="" placeholder="性别">&nbsp;&nbsp;
      <input type="text" name="agemax" value="" placeholder="年龄上限"></p>
      <p><br/>
      </p>
      <p class="submit"><input type="submit" name="submit" value="查询">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
      <p>&nbsp;</p>
    </form>
    <?php
	  if(isset($_POST['submit']) && $_POST["submit"] == "查询")
	  {
	?>
    <table class="hovertable" width="865" height="" border="">
      <tbody>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">姓名</th>
          <th scope="col">部门</th>
          <th scope="col">性别</th>
          <th scope="col">年龄</th>
          <th scope="col">电话</th>
        </tr>
    <?php
	     $id = '1=1';
		 $name = '';
		 $dep = ' and 1=1';
		 $sex = ' and 1=1';
		 $agemin = ' and 1=1';
		 $agemax = ' and 1=1';
		 
		 if($_POST['id'] != '') $id = "S='{$_POST['id']}'";
		 if($_POST['name'] != '') $name = " and SNAME like '%{$_POST['name']}%'";
		 if($_POST['dep'] != '') $dep = " and DNAME like '%{$_POST['dep']}%'";
		 if($_POST['sex'] != '') $sex = " and SEX='{$_POST['sex']}'";
		 if($_POST['agemin'] != '') $agemin = " and AGE>='{$_POST['agemin']}'";
		 if($_POST['agemax'] != '') $agemax = " and AGE<='{$_POST['agemax']}'";
         include ("../conn.php");
		 $result = mysql_query("SELECT * FROM staff where ".$id.$name.$dep.$sex.$agemin.$agemax);


         while($row = mysql_fetch_array($result))
        {
			?>
			 <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#d4e3e5';">
               <td><?php echo $row['S']?></td>
               <td><?php echo $row['SNAME']?></td>
               <td><?php echo $row['DNAME']?></td>
               <td><?php echo $row['SEX']?></td>
               <td><?php echo $row['AGE']?></td>
               <td><?php echo $row['TEL']?></td>
             </tr>
     <?php
        }
	  }
		 
    ?>
      </tbody>
    </table>
   
   </div>
  </section>
   <section class="about">
    <p class="about-links"><a href="../my.php">返回</a></p>
  </section>
  
  
</body>
</html>