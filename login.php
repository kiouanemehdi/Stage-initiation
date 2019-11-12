<?php
session_start();
 $conn=new mysqli('localhost','root','','final') or die(mysqli_error($conn));

 
 if (isset($_POST['login']))
        {     
   // session_start();

    $username=$_POST['username'];
    $password=$_POST['password'];
     
     $idq = $conn->query("SELECT id FROM user WHERE username='$username' and password='$password'")or die($conn->error());
    $query = $conn->query("SELECT username FROM user WHERE username='$username' and password='$password'")or die($conn->error());

    

     if (mysqli_num_rows($query) != 0)
    {
      
      $row=$idq->fetch_assoc();
      $idu=$row['id'];
     $_SESSION['username']= $username;
     $_SESSION['id']=$idu;
header("location:acceuil.php");
     //echo "<script language='javascript' type='text/javascript'> location.href='acceuil.php' </script>";   
      }
      else
      {
    echo "<script type='text/javascript'>alert('Mot de pass ou username incorrecte!');
    location.href='login_page.php'</script>";
   /* header("location:login_page.php");*/
    }
    }
     
?>