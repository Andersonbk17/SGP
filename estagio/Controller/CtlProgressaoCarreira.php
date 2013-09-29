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
    
    
    $dataProgressao = implode("-",array_reverse(explode("/",$_POST['dataProgressao']))) ;
    $descricaoNivelCategoria = $_POST['descricaoNivelCategoria'];
    
    $dao = new ProgressaoCarreiraDAO();
    $progressao = new ProgressaoCarreira();
    
    $progressao->setDataProgressao($dataProgressao);
    $progressao->setDescricaoNivelCategoria($descricaoNivelCategoria);
    
    
    if(isset($_SESSION['idFuncionario'])){
        $idFuncionario = $_SESSION['idFuncionario'];
        //echo '<script type="text/javascript"> alert("'.$idFuncionario.' na secao")</script>';
        
    }else{
        $idFuncionario = $_POST['funcionario'];
        //echo '<script type="text/javascript"> alert("'.$idFuncionario.' pelo formulario")</script>';
    }
    
    $progressao->setIdfuncionario($idFuncionario);
    //echo '<script type="text/javascript"> alert("'.$idFuncionario.' na variavel")</script>';
    
    if($dao->Inserir($progressao)){
        echo '<script type="text/javascript"> alert("Erro ao Inserir")</script>';
    }  else {
        
        echo '<script type="text/javascript"> alert("Inserido com Sucesso !"); window.location="../Presentation/main.php?pagina=frmCadastroProgressaoCarreira.php";</script>';
    }

?>
