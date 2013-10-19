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
	include_once ("../DataAccess/CampusDAO.php");
	include_once ("../DomainModel/Campus.php");

	
	$campus = new Campus();
	$dao = new CampusDAO();
	
	$codCampus = $_POST['codCampus'];
	$nomeCampus =  $_POST['nomeCampus'];
	$campus->setNome($nomeCampus);
	$campus->setId($codCampus);
	
	//Opção para o IF de Salvar,Alterar ou Excluir(Mudar status de 1 para 0)
	$opcao = $_GET['oP'];
	
	if($opcao == 1){
		if(!$dao->Inserir($campus)){
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarCampus.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarCampus.php&aux=0&msg=2'
				  </script>";
		}
	}
	
	//Alterar
	if($opcao == 2){
    	if(!$dao->Atualizar($campus)){
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarCampus.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarCampus.php&aux=0&msg=2'
				  </script>";
		}
	}
	
	//Excluir
	if($opcao == 3){
		$codCampus = $_GET['codCampus'];
		
		if(!$dao->Apagar($codCampus)){
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarCampus.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarCampus.php&aux=0&msg=2'
				  </script>";
		}
	}
?>
