<?php

require_once 'dbconfig.php';

if(isset($_GET['delete_id']))
{
    // select image from db to delete
    $stmt_select = $DB_con->prepare('SELECT userPic FROM tbl_users WHERE userID =:uid');
    $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
    $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
    unlink("user_images/".$imgRow['userPic']);
    
    // it will delete an actual record from db
    $stmt_delete = $DB_con->prepare('DELETE FROM tbl_users WHERE userID =:uid');
    $stmt_delete->bindParam(':uid',$_GET['delete_id']);
    $stmt_delete->execute();
    
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="http://getbootstrap.com.br/favicon.ico">

    <title>Superhero</title>

    <!--CSS - Bootstrap -->
    <link href="./Bootstrap/bootstrap.min.css" rel="stylesheet">

   <!--CSS Custon-->
    <link href="./Bootstrap/custon.css" rel="stylesheet">
  </head>

  <body>
    <header>

      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>Application - Superhero</strong>
          </a>
       
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Superheros</h1>
          <p class="lead text-muted">Application for creating, editing, and deleting Super Hero records..</p>
          <p>
            <a href="addnew.php" class="btn btn-primary my-2">Create new Superhero</a>
          </p>
        </div>
      </section>
      

      <div class="album py-5 bg-light">
        <div class="container">

             <div class="row">
<?php
	
	$stmt = $DB_con->prepare('SELECT userID, userPic, nickName, realName, originDescription, superPowers, catchPhrase FROM tbl_users ORDER BY userID DESC');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
			<div class="col-md-4">
            <div class="card mb-4 box-shadow">
				<img src="user_images/<?php echo $row['userPic']; ?>" class="card-img-top" alt="Thumbnail [100%x310]" style="height: 310px; width: 100%; display: block;"/>
				<div class="card-body">
                <p class="card-text"><?php echo 
                
                "<strong>Nick Name</strong>: ".$nickName."<br>"
                    ."<strong>Real name</strong>: ".$realName."<br>"
                        ."<strong>Origin description</strong>: ".$originDescription."<br>"
                            ."<strong>Super powers</strong>: ".$superPowers."<br>"
                                ."<strong>Catch phrase</strong>: ".$catchPhrase; ?></p>
                
                <span>
				<a class="btn btn-info" href="editform.php?edit_id=<?php echo $row['userID']; ?>" title="click for edit" onclick="return confirm('sure to edit?')"><span class="glyphicon glyphicon-edit"></span>Edit</a> 
				<a class="btn btn-danger" href="?delete_id=<?php echo $row['userID']; ?>" title="click for delete" onclick="return confirm('sure to delete?')"><span class="glyphicon glyphicon-remove-circle"></span>Delete</a>
                </span>
        </div>
                
                </div>
			</div>       
			<?php
		}
	}
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
	}
	
?>
          </div>
          </div>
          
    </main>


    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to the top</a>
        </p>
      </div>
    </footer>

    <!-- JavaScript - Bootstrap-->
    <script src="./Bootstrap/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <script src="./Bootstrap/popper.min.js.download"></script>
    <script src="./Bootstrap/bootstrap.min.js.download"></script>
    <script src="./Bootstrap/holder.min.js.download"></script>
  

</body>
</html>