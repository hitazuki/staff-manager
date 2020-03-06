<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>password</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <section class="container">
    <div class="login">
      <h1>修改密码</h1>
      <form method="post" action="password.php">
        <p><input type="password" name="old" value="" placeholder="Old Password"></p>
        <p><input type="password" name="new" value="" placeholder="New Password"></p>
        <p class="submit"><input type="submit" name="submit" value="修改"></p>
      </form>
      
      <?php
	  session_start();

      //检测是否登录，若没登录则转向登录界面
      if(!isset($_SESSION['userid'])){
          header("Location:index.html");
          exit();
      }
        if(isset($_POST['submit']) && $_POST["submit"] == "修改"){
			$old = $_POST['old'];
			$new = $_POST['new'];
			if($old == "" || $new == ""){  
               echo "<script>alert('请输入旧密码或新密码！'); history.go(-1);</script>";  
            }  
            else  
            {
			   include('../conn.php');
               $userid = $_SESSION['userid'];
               $user_query = mysql_query("select * from staff where S=$userid limit 1");
               $row = mysql_fetch_array($user_query); 
			   if($row['SPASSWORD'] == $old){
				   $user_query = mysql_query("update staff set SPASSWORD=$new where S=$userid");
				   echo "<h2>修改成功，新密码为：</h2>";
                   echo $new;
			   }
			   else{
				   echo "<script>alert('旧密码不正确！'); history.go(-1);</script>"; 
			   }
		    }
         }
      ?>
    </div>
  </section>

  <section class="about">
    <p class="about-links"><a href="../my.php" target="_parent">返回</a></p>
  </section>
</body>
</html>