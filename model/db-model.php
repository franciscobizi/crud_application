<?PHP
	require_once '../src/db.php';
	//USE OF CLASSES 

	$object = new CRUD_DB();
	$table_name = "utentes";
	$stmt = $object->select_all($table_name);