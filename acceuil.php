<?php 
require_once('non_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/style_acceuil.css">
	<link rel="stylesheet" href="css/fontawesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Bangers|Monoton|Permanent+Marker&display=swap" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="img/logo-.png">

	<title>ACCEUIL</title>
	
</head>
<body style="color: white;" >
	
<!--<div> <img src=""></div>-->
	<?php require_once'supprimer.php' ?>
	

	<?php if(isset($_SESSION['message'])):	?>
	<div class="alert alert-<?=$_SESSION['msg_type']?>">
		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);

		?>
	</div>
    <?php endif ?>
    
	<canvas id="bien" height="100px" width="1360px" style="background-color: #656565;
	position: absolute;"></canvas>
	<canvas id="logo"height="100px" width="100px" style="background-color: #656565;
	position: relative;"></canvas>
	<canvas id="can"height="50px" width="350px" style="background-color: #656565;
	margin-top: 100px;position: absolute;"></canvas>
<script type="text/javascript">
	var canvas = document.getElementById("can");
var ctx = canvas.getContext("2d");
ctx.font = "30px Arial";
ctx.fillStyle="white";
ctx.fillText("Listes Des Places", 50, 33);

var canvas = document.getElementById("bien");
var ctx = canvas.getContext("2d");
ctx.font = "50px Arial";
ctx.fillStyle="white";
ctx.fillText("BIENVENUE", 150, 70);

var canvass = document.getElementById('logo'),
context = canvass.getContext('2d');

make_base();

function make_base()
{
  base_image = new Image();
  base_image.src = 'img/logo-.png';
  base_image.onload = function(){
    context.drawImage(base_image,-35, 0);
  }
}
</script>

	<div class="row justify-content-center" >
	 	<center id="h1decor" ><?php //echo "<h1>BIENVENUE &quot; ".$_SESSION['username']." &quot;</h1>"; ?></center>	
	<div class="search-container">
	 <form method="POST"  action="acceuil.php">

	 	<input type="text" name="search_input" style="margin-bottom: 20px; ">
	 	<button type="submit" value="chercher" name="search"class="btn btn-light"><i class="fas fa-search"></i></button>
	 	
	 </form>
</div>
	 </div>


	

	<div class="container">
<center>
	<div id="menu">
            <a href="editer_profile.php?editer_profile=<?php echo $_SESSION['id']; ?>"
	 		id="editer_profile" class="btn btn-info" ><i class="fas fa-user-edit"></i></a>

	 		<a href="change_pass.php?change_pass=<?php echo $_SESSION['id']; ?>"
	 		id="change_pass" class="btn btn-info" ><i class="fas fa-key"></i></i></a>
	 		<a href="form_ajouter.php" id="ajouter" name="ajouter" class="btn btn-success"><i class="fas fa-plus-square"></i></a>
	 		<a href="logout.php" name="logout" class="btn btn-danger" id="deconnecter"><i class="fas fa-lock"></i></a>
	
	
	</div>
	</center>

    <?php/* 
    ob_start();
    include 'login.php';
    ob_end_clean(); */?>
	<?php 
	 $conn=new mysqli('localhost','root','','final') or die(mysqli_error($conn));

	 
     /* $res=$conn->query("SELECT * FROM place ") or die($conn->error);*/
   $id=$_SESSION['id'];
   $etat=false;
    if(isset($_POST['search']) and !empty($_POST['search_input']))
    {
    	
    	$inp=$_POST['search_input'];
    	$res=$conn->query("SELECT idp,type,place.nom,latitude,longitude,id_fk FROM place JOIN user WHERE user.id='$id' AND user.id=place.id_fk AND place.nom LIKE '$inp%' order by idp DESC") or die($conn->error);
        $etat=true;
    }
    else
    {

	 $res=$conn->query("SELECT idp,type,place.nom,latitude,longitude,id_fk FROM place JOIN user WHERE user.id='$id' AND user.id=place.id_fk order by idp DESC") or die($conn->error);
     }
	 //idp,type,place.nom,latitude,longitude,id_fk
	 //pre_r($res);
	 //pre_r(res$->fetch_assoc());
	 ?>

<?php if($etat): ?>

    <a class="btn btn-light" href="acceuil.php" ><i class="fas fa-arrow-left"></i></a> 

<?php endif; ?>

	 

	 <div class="row justify-content-center ">
	 	<div class="table-wrapper-scroll-y my-custom-scrollbar">
<div class="table-responsive">
	 	<table class="table table-striped table-hover table-dark">
	 		
	 		<thead class="thead-dark">
	 			<th scope="col">idp</th>
	 			<th scope="col">type</th>
	 			<th scope="col">nom</th>
	 			<th scope="col">latitude</th>
	 			<th scope="col">longitude</th>
	 			<!--<th scope="col">id_fk</th>-->
	 			<th scope="col" colspan="2" >action</th>
	 		</thead>
	 		<?php
	 		while ($row=$res->fetch_assoc()):?> 
	 			
	 			<tr scope="row">
	 				<td><?php echo $row['idp']; ?></td>
	 				<td><?php echo $row['type']; ?></td>
	 				<td><?php echo $row['nom']; ?></td>
	 				<td><?php echo $row['latitude']; ?></td>
	 				<td><?php echo $row['longitude']; ?></td>
	 				<!--<td><?php //echo $row['id_fk']; ?></td>-->
	 				<td>
	 					<a href="form_ajouter.php?editer=<?php echo $row['idp']; ?>"
	 						class="btn btn-info" ><i class="fas fa-edit"></i></a>
	 					<a href="supprimer.php?supprimer=<?php echo $row['idp']; ?>"
	 					onclick="return confirm('êtes-vous sûr de vouloir supprimer ce lieu?')"	class="btn btn-warning" ><i class="fas fa-trash-alt"></i>
	 				    </a>
	 				</td>
	 			</tr>
	 		<?php endwhile; ?>
	 		
	 	</table>
	 	</div>
	 </div>
</div>

	 <center>
	 	<!--<a href="editer_profile.php?editer_profile=<?php //echo $_SESSION['id']; ?>"
	 		id="editer_profile" class="btn btn-info" >Editer Profile</a>

	 		<a href="change_pass.php?change_pass=<?php //echo $_SESSION['id']; ?>"
	 		id="change_pass" class="btn btn-info" >Changer le mot de pass</a>

	 <a href="form_ajouter.php" id="ajouter" name="ajouter" class="btn btn-success">Ajouter une place-->
	</a>
	
</center>
</div>
     <?php
	 /*function pre_r( $array )
	 {
	 	echo '<pre>';
	 	print_r($array);
	 	echo '</pre>';
	 }*/
	 ?>




<script src="js/main.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.js"></script>
</body>
</html>