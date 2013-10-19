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
	include_once ("../DataAccess/AreaDAO.php");
	include_once ("../DomainModel/Area.php");

	
	$area = new Area();
	$dao = new AreaDAO();
	
	$codArea = $_POST['codArea'];
	$nomeArea =  $_POST['nomeArea'];
	$area->setNome($nomeArea);
	$area->setId($codArea);
	
	//Opção para o IF de Salvar,Alterar ou Excluir(Mudar status de 1 para 0)
	$opcao = $_GET['oP'];
	
	if($opcao == 1){
		if(!$dao->Inserir($area)){
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarArea.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarArea.php&aux=0&msg=2'
				  </script>";
		}
	}
	
	//Alterar
	if($opcao == 2){
    	if(!$dao->Atualizar($area)){
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarArea.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarArea.php&aux=0&msg=2'
				  </script>";
		}
	}
	
	//Excluir
	if($opcao == 3){
		$cod = $_GET['codArea'];
		
		if(!$dao->Apagar($cod)){
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarArea.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmListarArea.php&aux=0&msg=2'
				  </script>";
		}
	}
?>
