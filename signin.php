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