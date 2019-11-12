<?php 
require_once('non_connect.php');
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
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	<title>Form pour ajouter une place</title>
	
</head>
<body>
	<?php require_once'ajouter.php' ?>
	
	<div class="container">
		<center>
<?php if($update == true):?>
			<h1>Modifier une Place</h1>
		<?php else: ?>
			<h1>Ajouter une Place</h1>
		<?php endif; ?>
</center>
<div class="row justify-content-center">
<form action="ajouter.php" method="POST">
	<input type="hidden" name="idp" value="<?php echo $idp ?>">
	<!--<div class="form-group">
	 <label>idp</label>
	<input type="number" name="idp" class="form-control"value="<?php echo $idp ?>" required="required">
	</div>-->
	<div class="form-group">
	<label>type</label>
	<input type="text" name="type" class="form-control"value="<?php echo $type ?>" required="required">
	</div>
	<div class="form-group">
	<label>nom</label>
	<input type="text" name="nom" class="form-control"value="<?php echo $nom ?>" required="required">
	</div>
	<div class="form-group">

	<label>latitude</label>
	<input type="text" name="latitude" id="lat" class="form-control MapLat"value="<?php echo $latitude ?>" required="required" >
	</div>
	<div class="form-group">
	<label>longitude</label>
	<input type="text" name="longitude" id="lon" class="form-control MapLon"value="<?php echo $longitude ?>" required="required">
	</div>
	<!-- <label>entrer l'addresse</label>
	<select id="sel" onchange="myFunction(this.value)">
		<option selected="true" value="none">none</option>
		<option value="manuel"> Manuel</option>
		<option value="auto"> Automatique</option>
	</select>
	<div id="demo"></div>-->
    <script>
    	
    	//var intervalID = window.setInterval(myFunction(), 500);
       //var val;
    	/*function myFunction(val)
    	 {
    	 	      $.ajax({
    url: "test.php",
    type: "post",
    data: { test: val },
    success: function(e) {
        $('#demo').text(e);
    }
})*/
          //var val= document.getElementById("sel").value;
/*$(document).ready(function () { 
    createCookie("test", val, "10"); 
}); 
   
// Function to create the cookie 
function createCookie(name, value, days) { 
    var expires; 
      
    if (days) { 
        var date = new Date(); 
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
        expires = "; expires=" + date.toGMTString(); 
    } 
    else { 
        expires = ""; 
    } 
      
    document.cookie = escape(name) + "=" +  
        escape(value) + expires + "; path=/"; 
} 

            
         }*/
               
    </script>
    <?php
/*if(isset($_POST['test']))
{
 echo $_POST['test']; 
}
else 
echo "erreur";*/
?>
   <?php
//echo "<script>setInterval(function(){document.writeln(val)},500);</script>";
?>
 
<!-- <div id="cont"></div> -->

	<!-------------------------------------
	<div id="map">
	<?php// include('../map/index.php'); ?>
</div>
--------------------------------------------->
	<!--<div class="form-group">
	<label>id_fk</label>
	<input type="number" name="id_fk" class="form-control"value="<?php //echo $id_fk ?>" required="required">
	</div>-->
	<div class="form-group">
		<?php if($update == true):?>
			<button type="submit" name="modifier"class="btn btn-primary">Modifier</button>
		<?php else: ?>
			<button type="submit" name="ajouter"class="btn btn-primary">Ajouter</button>
		<?php endif; ?>
	</div>
</form>

</div>
</div>

<?php //if( $_POST["valeur"]='auto'):?>
<center>
<button class="btn btn-success" onclick="getLocation()">Ma position</button>
<p id="erreur"></p>
</center>
<?php //elseif( $_POST["valeur"]="none"):?>
<!--	<div id="map"></div> -->
	<?php// include('../map/index.php'); ?>

<?php// endif;?>
<script>
	var x = document.getElementById("erreur");

var lat = document.getElementById("lat");
var lon = document.getElementById("lon");


function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
	var accuracy=position.coords.accuracy;
	console.log(accuracy);

	if(accuracy <= 50)
	{
lat.value =position.coords.latitude ;
  lon.value = position.coords.longitude;
  }
  else
  {
  	lat.value = null;
  	lon.value = null;
  }
}
</script>


<script src="js/main.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/all.js"></script>

</body>
</html>