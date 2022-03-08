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
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
  rel = "stylesheet">
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
      <li class="nav-item">
        <a class="nav-link" aria-label="add deatils" title="Transaction History"  href="transactionhistory.php"><i class="fas fa-file-invoice-dollar fa-2x"></i></a>
    </li>
    </ul>
</div>
      <br><br><h1>Payment Details</h1>
      <div class="form__container">
        <form action="transact.php" method="post" id="f">
               <h6 style="font-size:21px;">From :<a id="sender" style="margin-left:5% ;">Name</a></h6>
               <h6 style="font-size:21px;">Current Balance :<a id="senderbal" style="margin-left:5% ;">0000</a></h6>
                <div class="col-md-5">
                    <label for="inputPassword4" class="form-label" style="font-size:21px;">Send to :</label>
                    <select class="form-select" name="touser" id="ddlViewBy" required>
                        <option>   </option>
                        <p><?php
    
                          $host = "ec2-35-169-188-58.compute-1.amazonaws.com";
$user = "dpnmurbcrzfqiv";
$pass = "57c218b8f114296469c8ebc02e35e98e306a9c5a615fd10660cd0ebc917a9dc5";
$db = "d8upqskpp51oj3";
                          
                          $con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to Server\n");
                          
                          $query = "SELECT username FROM signin";
                          $result=pg_query($con, $query); 
                          if (pg_num_rows($result)> 0){
                            while($row = pg_fetch_assoc($result)) {
                              ?></p>
                        <option><?php echo $row["username"]?></option>
                        <?php }}?>
                      </select>
                  </div>
                <div class="col-md-5">
                  <label for="inputCity" class="form-label" style="font-size:19.5px;">Enter Amount</label>
                    <input type="number" class="form-control" id="inputNumber" name="sending_amt" min='0' required>
                </div>
                <div class="col-md-5">
                  <label for="inputCity" class="form-label" style="font-size:19.5px;">Re-Enter Your Name</label>
                  <input type="text" class="form-control" id="inputusername" name="sender" required>
                </div><br>
                <div class="d-grid col-4 mx-auto">
                  <button type="submit" class="btn btn-primary" id="user__create" style="font-size:19px;">Confirm</button>
                </div>
            </form>
            </div>
            <div id = "dialog-1" title = "Transaction Successful!" style="background:whitesmoke"><img src="success.gif" alt="Success Gif" style="width:100%;height: 100%;"></div>
            <div id = "dialog-2" title = "Error!" style="background:whitesmoke"><img src="sad.png" alt="Sad" style="width:100%;height: 100%;"></div>
            <style>
              .ui-widget-header,.ui-state-default, .ui-button {
                 background:#022e57;
                 border: 1px solid #022e57;
                 color: white;
                 font-weight: bold;
              }
              .ui-button:hover{
                background:#022e57;
                color: #B8DFD8;
                border: 1px solid #022e57;
              }
            </style>
            <script>
              const username = localStorage.getItem('username');
              document.getElementById('sender').innerHTML=username;
              const balance = localStorage.getItem('balance');
              document.getElementById('senderbal').innerHTML=balance;
              jQuery(document).ready(function()
    {
        //Init your dialog box.
        $( "#dialog-1" ).dialog({
               autoOpen: false,
               modal: true,
               height: 400,
               width: 300,
               buttons: {
                  OK: function() {
                    var form = document.getElementById('f');
                    form.submit();
                    $(this).dialog("close");}
               }
            });
            $( "#dialog-2" ).dialog({
               autoOpen: false,
               modal: true,
               height: 400,
               width: 300,
               buttons: {
                  OK: function() {
                    $(this).dialog("close");}
               }
            });
        //Attach you click handler to the button.
        $("#user__create").click(function(event)
        {
            //Stop any default actions on the button.
            event.preventDefault();
            //Open your dialog.
            var form = document.getElementById('f');
            var e = document.getElementById("ddlViewBy");
            var y = e.options[e.selectedIndex].value;
            var x= document.getElementById("inputNumber").value;
            var z=document.getElementById("inputusername").value;

            if(y==username){
              $( "#dialog-2" ).dialog({title: "You Can't Send to Yourself"}).dialog('open'); }
            else if(Number(x)>balance){
              $( "#dialog-2" ).dialog({title: 'Insufficient Balance' }).dialog('open');
            }
            else if(z!=username){
              $( "#dialog-2" ).dialog({title: 'Incorrect Username'}).dialog('open');}
            else if(form.checkValidity()){
            $( "#dialog-1" ).dialog( "open" );}
            //else{
              //$( "#dialog-2" ).dialog({title: "Enter all the details"}).dialog('open');
            //}
        });
    });
    </script>
  </body>
</html>
