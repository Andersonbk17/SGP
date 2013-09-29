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
	include_once ("../DataAccess/DisciplinaDAO.php");
	include_once ("../DomainModel/Disciplina.php");
	include_once ("../DataAccess/CursoDAO.php");

	
	$disciplina = new Disciplina();
	$dao = new DisciplinaDAO();
	
	$cod = $_POST['codDisciplina'];
	$nomeDisciplina =  $_POST['nomeDisciplina'];
	$sigla = $_POST['siglaDisciplina'];
	$chDisciplina = $_POST['chDisciplina'];
	$curso = $_POST['curso'];
	
	$disciplina->setNome($nomeDisciplina);
	$disciplina->setSigla($sigla);
	$disciplina->setCargaHoraria($chDisciplina);
	$disciplina->setId($cod);
	
	//Opção para o IF de Salvar,Alterar ou Excluir(Mudar status de 1 para 0)
	$opcao = $_GET['oP'];
	
	if($opcao == 1){
		if(!$dao->Inserir($disciplina)){
			
			$dao->SalvarCurso($curso);
			
			echo"<script language='javascript'>
						
						window.location.href='../Presentation/main.php?pagina=frmCadastroDisciplina.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmCadastroDisciplina.php&aux=0&msg=2'
				  </script>";
		}
	}
	
	//Alterar
	if($opcao == 2){
    	if(!$dao->Atualizar($disciplina)){
			
			$dao->AtualizarCurso($cod,$curso);
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmCadastroDisciplina.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmCadastroDisciplina.php&aux=0&msg=2'
				  </script>";
		}
	}
	
	//Excluir
	if($opcao == 3){
		$cod = $_GET['codDisciplina'];
		if(!$dao->Apagar($cod)){
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmCadastroDisciplina.php&aux=0&msg=1'
				  </script>";
		}else{
			echo"<script language='javascript'>
						window.location.href='../Presentation/main.php?pagina=frmCadastroDisciplina.php&aux=0&msg=2'
				  </script>";
		}
	}
?>
