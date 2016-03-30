<?PHP
    
    require_once '../vendor/autoload.php';
	require_once '../src/securit.php';
	require_once '../model/db-model.php';
	require_once 'layouts/header.php';
	
?>	
    <div class="container-fluid">
		<div class="row">
        
			<div class="col-xs-12 col-sm-12">
					
				  <h1 class="page-header" style="text-align:center">ALL ROWS OF TABLE</h1>

					<div class="table-responsive">
						<table class="table table-striped">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Name</th>
							  <th>Address</th>
							  <th>Fone</th>
							  <th>Date</th>
							  <th>Action</th>
							  
							</tr>
						  </thead>
						  <tbody>
							<?PHP
								while($row = $stmt->fetch(PDO::FETCH_ASSOC))
								{
									extract($row);
									echo "<tr><td>{$id}</td><td>".utf8_encode($nome)."</td><td>".utf8_encode($cidade)."</td><td>{$fone}</td><td>{$data_c}</td><td><a href='?edit={$id}'>Edit</a>  <a href='?delete={$id}' style='color:red'>Delete</a> <a href='#'>Create New</a></td></tr>";
								}
							?>
					      </tbody>
						</table>
					</div>
			</div>
			
		</div>
	</div>
<?PHP
	require_once 'layouts/footer.php';
?>