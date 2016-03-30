<?PHP
// MY DB CLASSES 

class CRUD_DB
{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "admc-db";
    private $username = "root";
    private $password = '';
	private $table_name = " ";
	//private $id = " ";
    public $conn;
 
    //METHOD TO GET THE DATABASE CONECTION
    public function getConnection()
	{
 
        $this->conn = null;
 
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
	//METHOD TO READ ALL ROWS IN THE TABLE
	public function select_all($table_name)
	{
        $this->table_name = $table_name;
		//select all data
        $query = " SELECT * FROM ".$this->table_name." ORDER BY id ";  
 
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
	//METHOD TO READ ON ROW IN THE TABLE
	public function select_one($table_name)
	{
		$this->table_name = $table_name;
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id = ? limit 0,1";
	 
		$stmt = $this->getConnection()->prepare( $query );
		$stmt->bindParam(1, $_POST['id']);
		$stmt->execute();
		return $stmt;
		
	}
	//METHOD TO COUNT NUMBERS OF ROWS IN THE TABLE
	public function count_all($table_name)
	{
	
		$this->table_name = $table_name;
		$query = "SELECT id FROM ".$this->table_name."";
	 
		$stmt = $this->getConnection()->prepare($query);
		$stmt->execute();
	 
		$num = $stmt->rowCount();
	 
		return $num;
	}
	//METHOD TO UPDATE ROW IN THE TABLE
	public function update($table_name)
	{
		$this->table_name = $table_name;
		
		$query = "UPDATE
					" . $this->table_name . "
				SET
					field1 = ?,
					field2 = ?,
					field3 = ?,
					field4 = ?
				WHERE
					id = ?";
	 
		$stmt = $this->getConnection()->prepare($query);
	 
		// posted values
		
		$rows = array($_POST['field1'],$_POST['field2'],$_POST['field1'],$_POST['field3'],$_POST['field4'],$_POST['id']);
                                                               
		// execute the query
		if($stmt->execute($rows))
		{
			return true;
		}else
		{
			return false;
		}
	}
	//METHOD TO CREATE ROW IN THE TABLE
	public function create($table_name)
	{
		$this->table_name = $table_name;
		$query = "INSERT INTO".$this->table_name."(field1, field2,field3, field4) VALUES (:field1, :field2, :field3, :field4)')";
                                                               
		$stmt = $this->getConnection()->prepare($query);
	 
		// posted values
		
		 $rows = array(':field1'=>$_POST['field1'],':field2'=>$_POST['field2'],':field3'=>$_POST['field3'],':field4'=>$_POST['field4']); 
        
                                                               
		// execute the query
		if($stmt->execute($rows))
		{
			return true;
		}else
		{
			return false;
		}
	}
	//METHOD TO DELETE ROW IN THE TABLE
	public function delete($table_name)
	{
		$this->table_name = $table_name;
		$query = "DELETE FROM".$this->table_name."WHERE id = :id";
		$stmt = $this->getConnection()->prepare($query);
		// posted values
		$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
	                                
		// execute the query
		if($stmt->execute())
		{
			return true;
		}else
		{
			return false;
		}
	}
}

class DB_BACKUP extends CRUD_DB
{

			public function backupTables($tables)
			{
				$DBH = parent::getConnection();
				$DBH->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL );

				//Script Variables
				$compression = false;
				$BACKUP_PATH = "C:/xampp/htdocs/litle-project/backup/";
				$nowtimename = time();
				//create/open files
			
				if($compression)
				{
						$zp = gzopen($BACKUP_PATH.'backup_'.$nowtimename.'.sql.gz', "a9");
				}
				else
				{
						$handle = fopen($BACKUP_PATH.'backup_'.$nowtimename.'.sql','a+');
				}
				
			
				//array of all database field types which just take numbers 
				$numtypes=array('tinyint','smallint','mediumint','int','bigint','float','double','decimal','real');
				//get all of the tables
				if(empty($tables))
				{
					$pstm1 = $DBH->query('SHOW TABLES');
					while ($row = $pstm1->fetch(PDO::FETCH_NUM))
					{
						$tables[] = $row[0];
					}
				}
				else
				{
					$tables = is_array($tables) ? $tables : explode(',',$tables);
				}

				//cycle through the table(s)

				foreach($tables as $table)
				{
					$result = $DBH->query("SELECT * FROM $table");
					$num_fields = $result->columnCount();
					$num_rows = $result->rowCount();

					$return="";
				//uncomment below if you want 'DROP TABLE IF EXISTS' displayed
				//$return.= 'DROP TABLE IF EXISTS `'.$table.'`;'; 
					//table structure
					$pstm2 = $DBH->query("SHOW CREATE TABLE $table");
					$row2 = $pstm2->fetch(PDO::FETCH_NUM);
					$ifnotexists = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $row2[1]);
					$return.= "\n\n".$ifnotexists.";\n\n";

					if($compression)
					{
						gzwrite($zp, $return);
					}
					else
					{
						fwrite($handle,$return); 
					}
					$return = "";

					//insert values
					if ($num_rows)
					{
						$return= 'INSERT INTO `'."$table"."` (";
						$pstm3 = $DBH->query("SHOW COLUMNS FROM $table");
						$count = 0;
						$type = array();

						while ($rows = $pstm3->fetch(PDO::FETCH_NUM))
						{

							if (stripos($rows[1], '('))
							{
								$type[$table][] = stristr($rows[1], '(', true);
							}
							else $type[$table][] = $rows[1];

							$return.= "`".$rows[0]."`";
							$count++;
							if($count < ($pstm3->rowCount()))
							{
								$return.= ", ";
							}
						}

						$return.= ")".' VALUES';

						if($compression)
						{
							gzwrite($zp, $return);
						}
						else
						{
							fwrite($handle,$return); // alterei 
						}
						$return = "";
					}
			
					$count =0;
					while($row = $result->fetch(PDO::FETCH_NUM))
					{
						$return= "\n\t(";

						for($j=0; $j<$num_fields; $j++)
						{

							//$row[$j] = preg_replace("\n","\\n",$row[$j]);
							if (isset($row[$j]))
							{

							//if number, take away "". else leave as string
								if ((in_array($type[$table][$j], $numtypes)) && (!empty($row[$j]))) $return.= $row[$j] ; 
								else $return.= $DBH->quote($row[$j]); 

							}
							else
							{
								$return.= 'NULL';
							}
							if($j<($num_fields-1))
							{
								$return.= ',';
							}
						}
						$count++;
						if($count < ($result->rowCount()))
						{
							$return.= "),";
						}
						else
						{
							$return.= ");";

						}
						if ($compression)
						{
							gzwrite($zp, $return);
						}
						else
						{
							fwrite($handle,$return);
						}
						$return = "";
					}

						$return="\n\n-- ------------------------------------------------ \n\n";
						if ($compression)
						{
							gzwrite($zp, $return);
						} 
						else
						{
							fwrite($handle,$return);
						}
						$return = "";
					}


					$error1= $pstm2->errorInfo();
					$error2= $pstm3->errorInfo();
					$error3= $result->errorInfo();
					echo $error1[2];
					echo $error2[2];
					echo $error3[2];

					if ($compression)
					{
						gzclose($zp);
					} 
					else 
					{
						fclose($handle);
					}
			}
			
			

}