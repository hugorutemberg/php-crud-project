<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'dbconfig.php';
	
	if(isset($_POST['btnsave']))
	{
		$username = $_POST['user_name'];
		$userjob = $_POST['user_job'];
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
		$nickName = $_POST['nick_name'];
		$realName = $_POST['real_name'];
		$originDescription = $_POST['origin_description'];
		$superPowers = $_POST['super_powers'];
		$catchPhrase = $_POST['catch_phrase'];
		
		
		if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		}
		else if(empty($nickName)){
			$errMSG = "Please Select nickName.";
		}
		else if(empty($realName)){
			$errMSG = "Please Select realName.";
		}
		else if(empty($originDescription)){
			$errMSG = "Please Select originDescription.";
		}
		else if(empty($superPowers)){
			$errMSG = "Please Select superPowers.";
		}
		else if(empty($catchPhrase)){
			$errMSG = "Please Select catchPhrase.";
		}
		else
		{
			$upload_dir = 'user_images/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO tbl_users( userPic, nickName, realName, originDescription, superPowers, catchPhrase) 
			VALUES(:upic, :nname, :rname, :odescription, :spowers, :cphrase)');
			$stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':nname',$nickName );
			$stmt->bindParam(':rname',$realName);
			$stmt->bindParam(':odescription',$originDescription);
			$stmt->bindParam(':spowers',$superPowers);
			$stmt->bindParam(':cphrase',$catchPhrase);
			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("refresh:5;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="http://getbootstrap.com.br/favicon.ico">

    <title>Application - Superhero</title>
    
    <!--CSS Bootstrap -->
    <link href="./Bootstrap/bootstrap.min.css" rel="stylesheet">

    <!--CSS Custon-->
    <link href="./Bootstrap/custon.css" rel="stylesheet">
  </head>

  <body>
    <header>

      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="index.php" class="navbar-brand d-flex align-items-center">
            <strong>Application - Superhero</strong>
          </a>
       
        </div>
      </div>
    </header>
<body>

<main role="main">

      <section class="jumbotron">
        <div class="container">
          <h1>Create new Superhero</h1>
          
          

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data">
	    
	<table class="table  table-responsive">
    
    <tr>
    	<td><label class="control-label">Profile Img.</label></td>
        <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
    </tr>

		<tr>
    	<td><label class="control-label">NickName</label></td>
        <td><input class="form-control" type="text" name="nick_name" value="<?php echo $nickName; ?>" required /></td>
    </tr>

	<tr>
    	<td><label class="control-label">Real Name</label></td>
        <td><input class="form-control" type="text" name="real_name" value="<?php echo $realName; ?>" required /></td>
    </tr>

	<tr>
    	<td><label class="control-label">Origin description</label></td>
        <td><textarea class="form-control" type="text" name="origin_description" value="<?php echo $originDescription; ?>" required /></textarea></td>
    </tr>

	<tr>
    	<td><label class="control-label">Super powers</label></td>
        <td><input class="form-control" type="text" name="super_powers" value="<?php echo $superPowers; ?>" required /></td>
    </tr>

	<tr>
    	<td><label class="control-label">Catch phrase</label></td>
        <td><textarea class="form-control" type="text" name="catch_phrase" value="<?php echo $catchPhrase; ?>" required /></textarea></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-primary btn-sm btn-block">
        <a>Register</a>
        </button>
        </td>
    </tr>
    
    </table>
	</form>
</div>
      </section>
    
</main>



<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


<!-- JavaScript - Bootstrap-->
    <script src="./Bootstrap/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <script src="./Bootstrap/popper.min.js.download"></script>
    <script src="./Bootstrap/bootstrap.min.js.download"></script>
    <script src="./Bootstrap/holder.min.js.download"></script>
  

</body>
</html>