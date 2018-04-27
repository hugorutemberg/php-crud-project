<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT userName, userProfession, userPic, nickName, realName, originDescription, superPowers, catchPhrase FROM tbl_users WHERE userID =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
		$nickName = $_POST['nick_name'];
		$realName = $_POST['real_name'];
		$originDescription = $_POST['origin_description'];
		$superPowers = $_POST['super_powers'];
		$catchPhrase = $_POST['catch_phrase'];
			
		
					
		if($imgFile)
		{
			$upload_dir = 'user_images/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['userPic']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['userPic']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE tbl_users 
									     SET userPic=:upic,
											 nickName=:nname,
											 realName=:rname,
											 originDescription=:odescription,
											 superPowers=:spowers,
											 catchPhrase=:cphrase

								       WHERE userID=:uid');
			$stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':nname',$nickName );
			$stmt->bindParam(':rname',$realName);
			$stmt->bindParam(':odescription',$originDescription);
			$stmt->bindParam(':spowers',$superPowers);
			$stmt->bindParam(':cphrase',$catchPhrase);

			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Atualizado com sucesso ...');
				window.location.href='index.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Desculpe, não podem ser atualizados!";
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
    
    <!--CSS - Bootstrap -->
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

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
 
    </div>
</div>


<main role="main">

<section class="jumbotron">
  <div class="container">
	<h1>Update Super Hero</h1>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
   <table class="table  table-responsive">
    
    <tr>
    	<td><label class="control-label">Profile Img.</label></td>
        <td>
        	<p><img src="user_images/<?php echo $userPic; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="user_image" accept="image/*" />
        </td>
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
        <td><textarea class="form-control" type="text" name="origin_description" required /><?php echo $originDescription; ?></textarea></td>
    </tr>

	<tr>
    	<td><label class="control-label">Super powers</label></td>
        <td><input class="form-control" type="text" name="super_powers" value="<?php echo $superPowers; ?>" required /></td>
    </tr>

	<tr>
    	<td><label class="control-label">Catch Phrase</label></td>
        <td><textarea class="form-control" type="text" name="catch_phrase" required /><?php echo $catchPhrase; ?></textarea></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-primary btn-sm btn-block">
        <span class="glyphicon glyphicon-save">Update</span>
        </button>
        
        <a class="btn btn-dark btn-sm btn-block" href="index.php"> <span class="glyphicon glyphicon-backward"></span>Cancel</a>
        
        </td>
    </tr>
    
	</table>
	</form>
</div>
      </section>
    
</main>

<!-- JavaScript - Bootstrap-->
    <script src="./Bootstrap/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <script src="./Bootstrap/popper.min.js.download"></script>
    <script src="./Bootstrap/bootstrap.min.js.download"></script>
    <script src="./Bootstrap/holder.min.js.download"></script>
  
</body>
</html>