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
   
    $dao = new ProgressaoCarreiraDAO();
    $progressao = new ProgressaoCarreira();
    
    $progressao->setId($id);
  
    if($dao->apagar($progressao)){
        echo '<script type="text/javascript"> alert("Erro ao apagar")</script>';
    }  else {
        
        echo '<script type="text/javascript"> alert("Apagado com Sucesso !"); window.location="../Presentation/main.php?pagina=frmCadastroP.php";</script>';
    }

?>
