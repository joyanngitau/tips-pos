<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['amount'];
$z = $_POST['profit'];
$cname = $_POST['cname'];
$y = $_POST['amount_paid'];

if($d=='credit') {
$f = $_POST['due'];
$bal = $e - $y;
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name,cash_paid,balance) VALUES (:a,:b,:c,:d,:e,:z,:f,:cname,:y,:bal)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':cname'=>$cname,':y'=>$y,':bal'=>$bal));
header("location: preview.php?invoice=$a");
exit();
}
if($d=='cash') {
$f = $_POST['amount_paid'];
$bal = 0;
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name,cash_paid,balance) VALUES (:a,:b,:c,:d,:e,:z,:f,:cname,:y,:bal)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':cname'=>$cname,':y'=>$y,'bal'=>$bal));
header("location: preview.php?invoice=$a");
exit();
}
// query



?>