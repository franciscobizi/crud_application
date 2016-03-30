<?PHP
	require_once'sessions.php';
	
    //USE OF SESSIONS CLASSES
	$sessao = new SESSIONS();
	$sessao->start();
	
	$admin = $sessao->getValue('USER');
    
    if(isset($_GET['acao']) && isset($_GET['acao'])=='sair')
	{

        $sessao->deleteValue('USER');
        $sessao->destroy();
        
    }
    if(!$sessao->getValue('USER'))
	{
        //put table names you want backed up in this array.
		//leave empty to do all

		
        header('location:views/welcome.php');
        
    }