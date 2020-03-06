<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>selad</title>
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
    <h1>管理员查询</h1>
    <table class="gridtable" width="300" height="151" border="">
      <tbody>
        <tr>
          <th scope="col">管理员ID</th>
          <th scope="col">电话</th>
        </tr>
    <?php
         include ("../conn.php");
		 $result = mysql_query("SELECT * FROM administrator");

   

         while($row = mysql_fetch_array($result))
        {
			?>
			 <tr>
               <td><?php echo $row['A']?></td>
               <td><?php echo $row['TEL']?></td>
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