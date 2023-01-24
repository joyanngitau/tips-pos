<!DOCTYPE html>
<html>
<head>
	<title>
		TIPS Liqourstore
	</title>
	<link href="css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<style type="text/css">
    	.sidebar-nav {
        	padding: 9px 0;
			margin-top: 1px;
    	}
	</style>
	<link href="css/bootstrap-responsive.css" type="text/css" rel="stylesheet">
	<!-- my styling -->
	<link href="css/mystyle.css" rel="stylesheet">
	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="lib/jquery.js" type="text/javascript"></script>
	<script src="src/facebox.js" type="text/javascript"></script>
	<script type="text/javascript">
  		jQuery(document).ready(function($) {
    		$('a[rel*=facebox]').facebox({
      			loadingImage : 'src/loading.gif',
      			closeImage   : 'src/closelabel.png'
    		})
  		})
	</script>
	<?php
		require_once('auth.php');
	?>
	<?php
		function createRandomPassword() {
			$chars = "003232303232023232023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;
			while ($i <= 7) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}
			return $pass;
		}
		$finalcode='RS-'.createRandomPassword();
	?>

	<script language="javascript" type="text/javascript">
	/* Visit http://www.yaldex.com/ for full source code
	and get more free JavaScript, CSS and DHTML scripts! */
	<!-- Begin
		var timerID = null;
		var timerRunning = false;
		function stopclock (){
			if(timerRunning)
			clearTimeout(timerID);
			timerRunning = false;
		}
	function showtime () {
		var now = new Date();
		var hours = now.getHours();
		var minutes = now.getMinutes();
		var seconds = now.getSeconds()
		var timeValue = "" + ((hours >12) ? hours -12 :hours)
		if (timeValue == "0") timeValue = 12;
		timeValue += ((minutes < 10) ? ":0" : ":") + minutes
		timeValue += ((seconds < 10) ? ":0" : ":") + seconds
		timeValue += (hours >= 12) ? " P.M." : " A.M."
		document.clock.face.value = timeValue;
		timerID = setTimeout("showtime()",1000);
		timerRunning = true;
	}
	function startclock() {
		stopclock();
		showtime();
	}
	window.onload=startclock;
	// End -->
	</SCRIPT>	
</head>
<body>
	<?php include('navfixed.php');?>
	<?php
		$position=$_SESSION['SESS_LAST_NAME'];
		if($position=='cashier') {
	?>

	<a href="../index.php">Logout</a>
	<?php
		}
	if($position=='admin') {
	?>
	
	<div class="container-fluid">
    <div class="row-fluid">
	<div class="span2">
        <div class="well sidebar-nav">
            <ul class="nav nav-list">
            	<li class="active"><a href="#"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
				<li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i> Sales</a>  </li>             
				<li><a href="products.php"><i class="icon-list-alt icon-2x"></i> Products</a>                                     </li>
				<li><a href="customer.php"><i class="icon-group icon-2x"></i> Customers</a>                                    </li>
				<li><a href="supplier.php"><i class="icon-group icon-2x"></i> Suppliers</a>                                    </li>
				<li><a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Sales Report</a>                </li>
			<br><br><br><br><br><br>		
				<li>
			 		<div class="hero-unit-clock">
						<form name="clock">
							<font color="white">Time: <br></font>&nbsp;<input style="width:150px;" type="submit" class="trans" name="face" value="">
						</form>
			  		</div>
				</li>
			</ul>                               
        </div><!--/.well -->
    </div><!--/span-->
	<div class="span10">
		<div class="space" style="padding-top:5%" ><font style="font:bold 44px 'Aleo'; color:#000;"><center>TIPS LIQUOR</center></font></div>
			<div id="mainmain">
	<?php
	}
	?>
	
	<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><br><i class="icon-shopping-cart icon-2x"></i>   Make Sale</a><br><br>

	<!-- plus icon -->
	<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><br><i class="icon-plus icon-2x black-icon"></i>   Make Sale</a><br><br>
	<div style="margin-top: -19px; margin-bottom: 21px;">
	<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="14%"> Product Name </th>
			<th width="10%"> Expiry Date </th>
			<th width="7%"> Selling Price </th>
			<th width="7%"> QTY </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				include('../connect.php');
				$result = $db->prepare("SELECT *, price * qty as total FROM products ORDER BY product_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$total=$row['total'];
				$availableqty=$row['qty'];
				if ($availableqty < 3) {
				echo '<tr class="alert alert-warning record" style="color: #fff; background:rgb(255, 95, 66);">';
				}
				else {
				echo '<tr class="record">';
				}
			?>
		
			<td><?php echo $row['product_name']; ?></td>
			
			<td><?php 
			$expirydt=$row['expiry_date'];
			if ($expirydt == '2030-01-06') {
				echo 'None';
				}
			else{
				echo $row['expiry_date'];
				} ?></td>
			
			<td><?php
			$pprice=$row['price'];
			echo formatMoney($pprice, true);
			?></td>
			<td><?php echo $row['qty']; ?></td>
			</tr>
			<?php
				}
			?>
		
		
		
	</tbody>
</table></div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
</body>
<?php include('footer.php'); ?>
</html>
