<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>seldep</title>
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
    <h1>部门管理</h1>
    <form method="post" action="seldep1.php">
     <p>&nbsp;&nbsp;
       <input type="text" name="dep" value="" placeholder="需要修改的部门">&nbsp;&nbsp;
       <input type="text" name="id" value="" placeholder="新经理ID">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="submit" name="submit" value="修改">
      </p>

        <p>&nbsp;</p>
    </form>
    <?php
	if(isset($_POST['submit']) && ($_POST["submit"] == "修改"))
	{
		if($_POST['dep'] == "")
		{
			echo "<script>alert('请输入部门！');history.go(-1);</script>";
		}
		else
		{
			include ("../conn.php");
			$result = mysql_query("select * from department where DNAME='{$_POST['dep']}'");
			$num = mysql_num_rows($result);
			if($num)
			{
				if($_POST['id'] != "")
				{
				$id = $_POST['id'];
				$result1 = mysql_query("select * from staff where S=$id and DNAME='{$_POST['dep']}'");
			    $num1 = mysql_num_rows($result1);
				if($num1)
				{
					$result2 = mysql_query("update department set MANAGER='{$_POST['id']}' where DNAME='{$_POST['dep']}'");
					echo '修改成功';
				}
				else
				{
					echo "<script>alert('该部门不存在此ID职工！');history.go(-1);</script>";
				}
				}
			}
			else
			{
				echo "<script>alert('该部门不存在！');history.go(-1);</script>";
			}
		}
	}
	?>
    <table class="gridtable" width="851" height="151" border="">
      <tbody>
        <tr>
          <th scope="col">部门</th>
          <th scope="col">经理ID</th>
          <th scope="col">经理姓名</th>
          <th scope="col">经理电话</th>
          <th scope="col">平均工资</th>
        </tr>
    <?php
         include ("../conn.php");
		 $result = mysql_query("select B.DNAME,A.S,A.SNAME,A.TEL,AVG(B.SALARY) from department,staff as A,staff as B where MANAGER=A.S and department.DNAME=B.DNAME group by B.DNAME");

         while($row = mysql_fetch_array($result))
        {
			?>
			 <tr>
               <td><?php echo $row['DNAME']?></td>
               <td><?php echo $row['S']?></td>
               <td><?php echo $row['SNAME']?></td>
               <td><?php echo $row['TEL']?></td>
               <td><?php echo $row['AVG(B.SALARY)']?></td>
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