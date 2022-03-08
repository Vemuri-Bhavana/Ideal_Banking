<?php
$host = "ec2-35-169-188-58.compute-1.amazonaws.com";
$user = "dpnmurbcrzfqiv";
$pass = "57c218b8f114296469c8ebc02e35e98e306a9c5a615fd10660cd0ebc917a9dc5";
$db = "d8upqskpp51oj3";

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to Server\n");

if(!$con) {
echo "Error: Unable to open database\n"; 
}
else{
$from = $_POST['sender'];
$to=$_POST['touser'];
$bal = $_POST['sending_amt'];

$query = "select * from signin WHERE username='$from';";
$result=pg_query($con, $query);
$row = pg_fetch_assoc($result);
echo $row['balance'];
if($bal<$row['balance'] && $to!=$from){
$query = "UPDATE signin SET balance=balance-'$bal' WHERE username='$from';";
$result=pg_query($con, $query);

$query = "UPDATE signin SET balance=balance+'$bal' WHERE username='$to';";
$result=pg_query($con, $query);

$query="SELECT * FROM transactiontable";
$result=pg_query($con, $query);
$count=pg_num_rows($result);
$count= $count+1;

$time=date("Y-m-d H:i:s");

$query = "INSERT INTO transactiontable ( sno, fromuser,  touser, attime, amount) VALUES ('$count', '$from', '$to','$time', '$bal')";
$result=pg_query($con, $query);
}

header('Location:transfermoney.php');
}

pg_close($con);
?>