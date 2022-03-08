<!DOCTYPE html>
<html lang="en">
<head>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
    </svg>
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
</head>
<body>
  <a class="navbar-brand" href="#">
    <img src="logo.png" alt="Logo" style="width:180px;">
</a>
<div class="navbar navbar-expand-sm fixed-top justify-content-end">
    <ul class="navbar gap-1">
      <li class="nav-item">
        <a class="nav-link" aria-label="Back to the page" title="Go to home page"  href="index.php"><i class="fas fa-home fa-2x"></i></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" aria-label="add deatils" title="Veiw Cutomers"  href="veiw_all_customers.php"><i class="fas fa-users fa-2x"></i></a>
      </li>
    </ul>
</div>
<h1 id='history'>Transaction History</h1>
<div class="table-responsive">
  <table class="table">
    <tr class="heading__row">
      <th>S.No</th>
      <th>From</th>
      <th>To</th>
      <th>Date/Time</th>
      <th>Amount</th>
    </tr>
    <p><?php
    
      $host = "ec2-35-169-188-58.compute-1.amazonaws.com";
      $user = "dpnmurbcrzfqiv";
      $pass = "57c218b8f114296469c8ebc02e35e98e306a9c5a615fd10660cd0ebc917a9dc5";
      $db = "d8upqskpp51oj3";
    
    $con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to Server\n");
    
    $query = "SELECT * FROM transactiontable ORDER BY sno ASC";
    $result=pg_query($con, $query); 
    if (pg_num_rows($result)> 0){
      while($row = pg_fetch_assoc($result)) {
        ?></p>
    <tr>
      <td><?php echo $row["sno"]?></td>
      <td><?php echo $row["fromuser"]?></td>
      <td><?php echo $row["touser"]?></td>
      <td><?php echo $row["attime"]?></td>
      <td><?php echo $row["amount"]?></td>
      <?php }}?>
    </tr>
  </table>
</div>
</body>
</html>
