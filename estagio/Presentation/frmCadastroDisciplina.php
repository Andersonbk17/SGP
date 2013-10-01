<?php
/*
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
      */  
?>

<!DOCTYPE html>

	<?php
		include_once ("../DataAccess/DisciplinaDAO.php");
		include_once ("../DomainModel/Disciplina.php");
		
		$dao = new DisciplinaDAO();
		
	?>
	<!-- Inicio Head -->
	<head>
		<title>Cadastrar Disciplina</title>
		<link rel="stylesheet" type="text/css" href="style/estiloConteudo.css"/>
		<script type="text/javascript" src="script/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="script/jquery.maskedinput-1.1.4.pack.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
                $('table#tbl tr:odd').addClass('impar');
                $('table#tbl tr:even').addClass('par');
			});
		</script>
		<script language="Javascript">
	
			function confirmacao(id) { 
				var resposta = confirm("Deseja remover esse registro?");   
				if (resposta == true) { 
					window.location.href = "../Controller/CtlDisciplina.php?oP=3&codDisciplina="+id; 
				} 
			} 
		</script>
	</head>
	<!-- Fim Head -->
	
	<!-- Inicio Body -->
	<body>
		
		<!-- Inicio Formulario -->
		<?php
		echo"<fieldset class='moldura1'>";
				if(isset($_GET['aux'])){
					$aux = $_GET['aux'];
				}else{
					$aux = 0;
				}
				//---
				include_once '../DataAccess/CursoDAO.php';
                include_once '../DomainModel/Curso.php';

                $daoc = new CursoDAO();
                $c = new Curso();
				
	
                $c = $daoc->ListarTodos();
				
				
				//Salvar Campus
				if($aux == 0){
					echo"<legend>Registrar Disciplina</legend>";
					echo"<form name='frmCadastroDisciplina' action='../Controller/CtlDisciplina.php?oP=1' method='POST'>";
						echo"<label for='nomeDisciplina'>Nome*</label><br/>";
						echo"<input type='text' id='nomeDisciplina' name='nomeDisciplina' required size='40' maxlength='50' class='input-div'/><br/>";
						echo"<label for='nomeCampus'>Sigla*</label><br/>";
						echo"<input type='text' id='siglaDisciplina' name='siglaDisciplina' required size='40' maxlength='50' class='input-div'/><br/>";
						echo"<label for='chDisciplina'>Carga Horaria*</label><br/>";
						echo"<input type='text' id='chDisciplina' name='chDisciplina' required size='40' maxlength='50' class='input-div'/><br/>";
						echo"<label for='curso' class='label'>Curso*</label><br/>";
						echo"<select name='curso' id='curso' style='width: 160px' class='input-div' required>";
						
							//Valor padrão
							echo("<option selected='selected' value=''>Selecione</option>"); 
							//Fazendo o looping para exibição de todos registros que contiverem
							foreach ($c as $ic){
								echo("<option value='".$ic->getId()."'>".$ic->getNome()."</option>");
								$ic++;
							}
						echo"</select>";
						echo"<input type='submit' id='btnDisciplina' name='btnDisciplina' value='Salvar' class='botao' /><br/>";
					echo"</form>";
					
					
			   //Atualizar Campus
			   }else{
				    //Pegando $_GET['CodCampus'];
					$id = $_GET['cod'];
					
				    //Destruindo o $_GET['aux'];
					unset($_GET['aux']);
					
					//----
					$editar = new Disciplina();
					//----
					$editar = $dao->Abrir($id);	
					
					echo"<legend>Editar Disciplina</legend>";
					echo"<form name='frmCadastroDisciplina' action='../Controller/CtlDisciplina.php?oP=2' method='POST'>";
					    
						echo"<label for='codigo'>Código </label><br/>";
						
						foreach ($editar as $i){
							echo"<input type='text' id='id' name='id' value='".$i->getId()."' disabled size='2' class='input-div'/>";
							echo"<input type='hidden' id='codDisciplina' name='codDisciplina' value='".$i->getId()."' size='2'/><br/>";
							echo"<label for='nomeDisciplina'>Nome*</label><br/>";
							echo"<input type='text' id='nomeDisciplina' name='nomeDisciplina' value='".$i->getNome()."' required size='40' maxlength='50' class='input-div'/><br/>";
							echo"<label for='siglaDisciplina'>Sigla*</label><br/>";
							echo"<input type='text' id='siglaDisciplina' name='siglaDisciplina' value='".$i->getSigla()."'required size='40' maxlength='50' class='input-div'/><br/>";
							echo"<label for='chDisciplina'>Carga Horaria</label><br/>";
							echo"<input type='text' id='chDisciplina' name='chDisciplina' value='".$i->getCargaHoraria()."'required size='40' maxlength='50' class='input-div'/><br/>";
							echo"<label for='curso'>Curso*</label><br/>";
							echo"<select name='curso' id='curso' style='width: 160px' class='input-div' required>";
						
							//Valor padrão
							
							//$abrir = new Curso();
							//$abrir = $daoc->ProcurarCurso($id);
							//foreach($abrir as $cd){
                                                        
                                                        
                                                        //Fazendo a consulta do curso da disciplina para colocar no combobox pois está em uma
                                                        // entidade fraca enao tem dao para ver o valor
                                                        $sql = "SELECT * FROM disciplina_curso WHERE idDisciplina=".$i->getId();
                                                        $resultado = mysql_query($sql);
                                                        
                                                        while($rs = mysql_fetch_array($resultado)){
                                                            $idCurso = $rs['idCurso'];
                                                        }
								echo("<option selected='' value=''>Selecione</option>"); 
								//$cd++;
							//}*/
							//Fazendo o looping para exibição de todos registros que contiverem
								
							foreach ($c as $ic){	
								echo("<option value='".$ic->getId()."'>".$ic->getNome()."</option>");
								$ic++;
							}	
							$i++;
						}							
						echo"</select>";
                                                 echo"<script type='text/javascript'> $(document).ready(function(){  $('#curso').val($idCurso)      }) </script>";//select ok
						echo"<a href=main.php?pagina=frmCadastroDisciplina.php&aux=0><input type='button' id='cancelar' name='cancelar' value='Cancelar' class='botao'/></a>";
						echo"<input type='submit' id='btnDisciplina' name='btnDisciplina' value='Atualizar' class='botao'/>";
					echo"</form>";
				   
			   }
				
		echo"</fieldset>";
		?>
		<!-- Fim Formulario -->
		
		<!-- Inicio Tabela -->
		<?php
		

			
			$d = new Disciplina();
			$d = $dao->ListarTodos();
			
			//----
			echo "<br/>";
			echo "<fieldset class='moldura2'>";
			echo	"<legend>Disciplinas Registrados</legend>";
			echo	"<table class='tbl' name='tbl' id='tbl' border='1'>";
			echo		"<tr>";
			echo			"<td class='nomeCampus' width='30' align='middle'><b>ID</b></td>";
			echo			"<td class='nomeCampus' width='600' align='middle'><b>NOME</b></td>";
			echo			"<td class='nomeCampus' width='300' align='middle'><b>SIGLA</b></td>";
			echo			"<td class='nomeCampus' width='300' align='middle'><b>CARGA HORARIA</b></td>";
			echo		"</tr>";
			
			foreach ($d as $i){
				echo		"<tr class='linha-td'>";
				echo			"<td class='linha-td' width='30' align='middle'>".$i->getId()."</td>";
				echo			"<td class='linha-td'width='600' align='middle'>".$i->getNome()."</td>";
				echo			"<td class='linha-td' width='300' align='middle'>".$i->getSigla()."</td>";
				echo			"<td class='linha-td' width='300' align='middle'>".$i->getCargaHoraria()."</td>";
				echo			"<td class='coluna'><a href=main.php?pagina=frmCadastroDisciplina.php&aux=1&cod=".$i->getId()."><img src='./image/editar.png'></a></td>";
				echo			"<td class='coluna'><a href='javascript:func()' onclick='confirmacao(".$i->getId().")'><img src='./image/excluir.png'></a></td>";
				echo		"</tr>";
				$i++;
		    }
			echo	"</table>";
			
			echo "</fieldset>";
			
			
		?>
		
		<?php
			//Mensagens de Alerta
			
			//Alerta para sucesso ou fracasso
			if(isset($_GET['msg'])){
				$alerta = $_GET['msg'];
			}else{
				$alerta = 3;
			}
			//Destruindo $_GET['msg']
		    unset($_GET['msg']);
					
			if($alerta == 1){
				$alerta = 3;
				echo "<script type='text/javascript'> 
							alert('Operação realizada com sucesso!');
				      </script>";
			}else{
				if($alerta == 2){
					$alerta = 3;
					echo "<script type='text/javascript'> 
								alert('Ocorreu um erro na operação!');
						  </script>";
				}
		    }
		    //Fim Alerta --------------------
		     
		?>
	
	</body>
	<!-- Fim Body -->

</html>
