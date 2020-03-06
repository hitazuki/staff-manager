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
    header("Location:../index.html");
    exit();
}
?>
<section class="container">
  <div class="page">
    <h1>部门查询</h1>
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
    <p class="about-links"><a href="../my2.php">返回</a></p>
  </section>
</body>
</html>