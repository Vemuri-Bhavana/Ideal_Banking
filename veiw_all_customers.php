<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link
    rel="stylesheet"
    href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
    crossorigin="anonymous"
  />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet"
  />
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>
<body>
  <a class="navbar-brand" href="#">
    <img src="logo.png" alt="Logo" style="width:180px;">
</a>
<div class="navbar navbar-expand-sm fixed-top justify-content-end">
    <ul class="navbar gap-1">
      <li class="nav-item">
        <a class="nav-link" aria-label="Back to the page" title="Go to home page"  href="index.html"><i class="fas fa-home fa-2x"></i></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" aria-label="add deatils" title="Add a user"  href="signinhtml.php"><i class="fas fa-user-plus fa-2x"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" aria-label="add deatils" title="Transaction History"  href="transactionhistory.php"><i class="fas fa-file-invoice-dollar fa-2x"></i></a>
    </li>
    </ul>
</div>
<h1>CUSTOMER DETAILS</h1>
<div class="table-responsive">
  <table class="table">
    <tr class="heading__row">
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Country</th>
      <th>Balance</th>
      <th>View Customer Details</th>
    </tr>
    <p><?php
    
      $host = "ec2-35-169-188-58.compute-1.amazonaws.com";
      $user = "dpnmurbcrzfqiv";
      $pass = "57c218b8f114296469c8ebc02e35e98e306a9c5a615fd10660cd0ebc917a9dc5";
      $db = "d8upqskpp51oj3";
    
    $con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to Server\n");
    
    $query = "SELECT * FROM signin ORDER BY userid ASC";
    $result=pg_query($con, $query); 
    if (pg_num_rows($result)> 0){
      while($row = pg_fetch_assoc($result)) {
        ?></p>
    <tr>
      <td><?php echo $row["userid"]?></td>
      <td><?php echo $row["username"]?></td>
      <td><?php echo $row["email"]?></td>
      <td><?php echo $row["country"]?></td>
      <td><?php echo $row["balance"]?></td>
      <td id="displaybutton" role="button" onclick="printdetails(Event)" >Transfer</td>
      <?php }}?>
    </tr>
  </table>
</div>
<script>
function printdetails(Event){
     var username = event.target.parentNode.cells[1].textContent;
     var balance = event.target.parentNode.cells[4].textContent;

     localStorage.setItem("username", username);
     localStorage.setItem("balance", balance);
     window.open('transfermoney.php', "_self");
}
</script>
</body>
</html>