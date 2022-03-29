<?php
$host = "ec2-3-209-61-239.compute-1.amazonaws.com";
$user = "znymfvyrbmpapp";
$pass = "fd8888af32ed35e7e25cd7c11760a8ab4eb6ee10e8abb5ada89878db38ac264b";
$db = "d1mrogv95i40m8";

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
