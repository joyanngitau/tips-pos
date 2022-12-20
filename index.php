<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<html>
<head>
<title>
TIPS Liqourstore
</title>
    <link rel="shortcut icon" href="main/images/pos.jpg">
	<link href="main/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="main/css/DT_bootstrap.css">
	<link rel="stylesheet" href="main/css/font-awesome.min.css">
	<link href="main/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
</head>
<body>
    <div class="container-fluid">
      <div class="row-fluid">
		<div class="span4">
		</div>
	
</div>
<div id="login">
<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
	foreach($_SESSION['ERRMSG_ARR'] as $msg) {
		echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
	}
	unset($_SESSION['ERRMSG_ARR']);
}
?>
<form action="login.php" method="post">

			<font style=" font:bold 44px 'Aleo'; color:#000;"><center>TIPS</center></font>
		<br>

		
<div class="input-prepend">
		<span style="height:30px; width:25px; color: #000; background-color: #fff;" class="add-on"><i class="icon-user icon-2x"></i></span><input style="height:40px;" type="text" name="username" Placeholder="Username" required/><br>
</div>
<div class="input-prepend">
	<span style="height:30px; width:25px; color: #000; background-color: #fff;" class="add-on"><i class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;" name="password" Placeholder="Password" required/><br>
		</div>
		<div class="qwe">
		<!-- removed btn-primary class to remove the bg-color blue -->
		<!-- returned it cause all i needed to do was clear the goddamn cache -->
		<button class="btn btn-primary btn-large btn-block pull-right" href="dashboard.html" type="submit"><i class="icon-signin icon-large" ></i> Login</button>
</div>
		</form>
</div>
</div>
</div>
</div>
</body>
</html>

000webhost password:!5T(uZS3osMHvv^!3Zr1