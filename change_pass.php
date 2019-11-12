<?php
 require_once('non_connect.php');

$conn=new mysqli('localhost','root','','final') or die(mysqli_error($conn));
$id=0;
        $update=false;
      $id="";
      $password="";
      if(isset($_GET['change_pass']))
    {
      $id=$_GET['change_pass'];
      $update=true;
      $res=$conn->query("SELECT * FROM user WHERE id=$id") or die($conn->error());
      

      if(mysqli_num_rows($res))
      {

        $row=$res->fetch_array();
       
          $id=$row['id'];
          
          $password=$row['password'];
          
         }
    }
    if(isset($_POST['confirmer']))
    {
          $id=$_SESSION['id'];
          
          $password=$_POST['password'];
          $new_password=$_POST['new_password'];
          $confirm_password=$_POST['confirm_password'];

          $qpass=$conn->query("SELECT password FROM user WHERE id=$id") or die($conn->error());
          $qrow=$qpass->fetch_array();
      
          if($password==$qrow['password'])
          {
            if($new_password==$confirm_password)
            {
              $conn->query("UPDATE user SET password='$new_password' WHERE id='$id'") or die($conn->error());

              $_SESSION['message']="mot de pass bien modifié";
              $_SESSION['msg_type']="success";
              header("location:acceuil.php");
            }
            else 
              echo"<script>alert('vous n avez pas bien confirmer le nouveau mot de pass'); </script>";
          }
          else
              echo"<script>alert('l ancien mot de pass est incorrecte'); </script>";

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/style_ajouter.css">
  <link href="https://fonts.googleapis.com/css?family=Bangers|Monoton|Permanent+Marker&display=swap" rel="stylesheet">

  <title>Modifier mot de pass</title>
  
</head>
<body>
 
  <div class="container">
    <center>
      <h1>Modifier Votre mot de pass</h1>
   
    
</center>
<div class="row justify-content-center">
<form action="change_pass.php" method="POST">
 
  <div class="form-group">
  <label>Mot de Pass</label>
  <input type="password" name="password" class="form-control"required="required">
  </div>
  <div class="form-group">
   <label>Nouveu mot de pass</label>
  <input type="password" name="new_password" class="form-control"required="required">
  </div>
  <div class="form-group">
   <label>Confirmer le nouveau mot de pass</label>
  <input type="password" name="confirm_password" class="form-control"required="required">
  </div>
  
  <div class="form-group">

      <button type="submit" name="confirmer"class="btn btn-primary">Confirmer</button>
    
  </div>
</form>
</div>
</div>
<script src="js/main.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.js"></script>

</body>
</html>