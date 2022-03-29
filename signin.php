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
$name = $_POST['user_name'];
$email = $_POST['inputEmail4'];
$country =$_POST['inputCountry'];
$bal = $_POST['inputNumber'];

$query="SELECT * FROM signin";
$result=pg_query($con, $query);
$count=pg_num_rows($result);
$count= $count+1;

$query = "INSERT INTO signin ( userid, username, email, country, balance) VALUES ('$count', '$name', '$email', '$country', '$bal')";
$result=pg_query($con, $query);

header('Location:signinhtml.php');
}

pg_close($con);
?>
