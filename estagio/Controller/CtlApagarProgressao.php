<?php

	// A sessao precisa ser iniciada em cada pagina diferente
		if (!isset($_SESSION)) session_start();
	 $nivel_necessario = 1;
	// Verifica se não há a variavel da sessao que identifica o usuario
	if (!isset($_SESSION['usuarioNome']) OR ($_SESSION['usuarioNivel'] < $nivel_necessario)) {
 	// Destr?i a sess?o por seguran?a
	    session_destroy();
	// Redireciona o visitante de volta pro login
	    header("Location: index_.php"); exit; // mudar depois dos testes
	}
        
?>

<?php
    include_once '../DataAccess/ProgressaoCarreiraDAO.php';
    include_once '../DomainModel/ProgressaoCarreira.php';
    
    $id = $_GET['id'];
   
    if(isset($_GET['idF'])){
        $idF = $_GET['idF'];
    }
    
    $dao = new ProgressaoCarreiraDAO();
    $progressao = new ProgressaoCarreira();
    
    $progressao->setId($id);
  
    $dao->apagar($progressao);
    if(isset($_GET['op'])){
        echo '<script type="text/javascript"> alert("Apagado com Sucesso !");
        window.location="../Presentation/main.php?pagina=frmCadastroProgressaoCarreira.php";</script>';
    
    }else{
        echo '<script type="text/javascript"> alert("Apagado com Sucesso !");
        window.location="../Presentation/main.php?pagina=frmDetalharFuncionario.php&idFuncionario='. $idF .'";</script>';
    }
           
?>
