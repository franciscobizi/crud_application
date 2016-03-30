<?PHP
	require_once'../../src/sessions.php';
	require_once '../../src/db.php';
	$tables = array();
	$dump = new DB_BACKUP;
	$dump->backupTables($tables);
    //USE OF SESSIONS CLASSES
	$sessao = new SESSIONS();
	$sessao->start();
	
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CRUD APLICATION</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/styles.css" rel="stylesheet">
		
    </head>
    <body>
        <div class="container">
            <div class="content">
				<h1 class="title">Welcome</h1>
				<div class="panel panel-primary">
				  <div class="panel-heading">
					<h3 class="panel-title">MAKE YOUR LOGIN HERE</h3>
				  </div>
				  <div class="panel-body">
					<div class="pad">
					<form method="post" class="form-horizontal" action="">
					  <div class="form-group">
						
						<input type="text" class="form-control" name="username" placeholder="Username" required></td>
					  </div>
					  <div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Password" required>
					  </div>
					  <div class="form-group">
						<input type="submit" name="login" class="btn btn-block " value="Login">
					  </div>
				  </form>
						
						<?PHP
							if(isset($_POST['login']))
							{
								if($_POST['username']=='admin' && $_POST['password']=='12345')
								{
									
									$sessao->setValue('USER',$_POST['username']);
									header('location:../index.php');
								}
								else
								{	
									echo'<div class="alert alert-danger">';
										echo 'Error! You are not user of this aplication.';
									echo'</div>';
								}
							}
						
						
						?>
						
					</div>
				  </div>
				</div>
                
				  
					
            </div>
        </div>
    </body>
</html>
