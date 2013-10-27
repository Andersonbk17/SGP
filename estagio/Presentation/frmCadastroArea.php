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

<!DOCTYPE html>
<html>

	<?php
		include_once ("../DataAccess/AreaDAO.php");
		include_once ("../DomainModel/Area.php");
		
		$dao = new AreaDAO();
		
	?>
	<!-- Inicio Head -->
	<head>
		<title>Cadastrar Campus</title>
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
					window.location.href = "../Controller/CtlArea.php?oP=3&codArea="+id; 
				} 
			} 
		</script>
	</head>
	<!-- Fim Head -->
	
	<!-- Inicio Body -->
	<body>
        
        
            
                
		<?php
		echo"<fieldset class='moldura1'>";
				if(isset($_GET['aux'])){
					$aux = $_GET['aux'];
				}else{
					$aux = 0;
				}
				//Salvar Campus
				if($aux == 0){
					echo"<legend>Registrar Area</legend>";
					echo"<form name='frmCadastroArea' action='../Controller/CtlArea.php?oP=1' method='POST'>";
						echo"<label for='nomeArea' class='labelForms'>Nome:</label>";
						echo"<input type='text' id='nomeArea' name='nomeArea' required size='40' maxlength='50' class='input-div'/>";
						
                                                echo"<a href=main.php?pagina=frmListarArea.php><input type='button' id='cancelar' name='cancelar' value='Cancelar' class='botao'  title='Cancelar operação atual'/></a>";
                                                echo"<input type='submit' id='btnArea' name='btnArea' value='Salvar' class='botao' title='Salvar informações'/><br/>";
					echo"</form>";
					
					
			   //Atualizar Campus
			   }else{
				    //Pegando $_GET['CodCampus'];
					$id = $_GET['codArea'];
					
				    //Destruindo o $_GET['aux'];
					unset($_GET['aux']);
					
					//----
					$editar = new Area();
					//----
					$editar = $dao->Abrir($id);	
                                        
					echo"<legend>Editar Area</legend>";
					echo"<form name='frmCadastroArea' action='../Controller/CtlArea.php?oP=2' method='POST'>";
					    
						echo"<label for='codigo' class='labelForms'>Código:</label>";
						
						foreach ($editar as $i){
							echo"<input type='text' id='id' name='id' value='".$i->getId()."' disabled size='2' class='input-div'/>";
							echo"<input type='hidden' id='codArea' name='codArea' value='".$i->getId()."' size='2'/><br/>";
							echo"<label for='nomeCampus' class='labelForms'>Nome:</label>";
							echo"<input type='text' id='nomeArea' name='nomeArea' value='".$i->getNome()."' required size='40' maxlength='50' class='input-div'/>";
							$i++;
						}
						echo"<a href=main.php?pagina=frmListarArea.php><input type='button' id='cancelar' name='cancelar' value='Cancelar' class='botao' title='Cancelar operação atual'/></a>";
						echo"<input type='submit' id='btnArea' name='btnArea' value='Atualizar' class='botao' title='Salvar alterações'/>";
					echo"</form>";
				   
			   }
				
		echo"</fieldset>";
		?>
		<!-- Fim Formulario -->
		
		<!-- Inicio Tabela -->
		<?php
		/*
			//----
			$a = new Area();
			 
			$a = $dao->ListarTodos();
			
			//----
			echo "<br/>";
			echo "<fieldset class='moldura2'>";
			echo	"<legend>Areas Registradas</legend>";
			echo	"<table class='tbl' name='tbl' id='tbl' border='1'>";
			echo		"<tr>";
			echo			"<td class='nomeCampus' width='30' align='middle'><b>ID</b></td>";
			echo			"<td class='nomeCampus' width='600' align='middle'><b>NOME</b></td>";

			echo		"</tr>";
			
			foreach ($a as $i){
				echo		"<tr class='linha-td'>";
				echo			"<td class='linha-td' width='30' align='middle'>".$i->getId()."</td>";
				echo			"<td class='linha-td' width='1200' align='middle'>".$i->getNome()."</td>";
				echo			"<td class='coluna'><a href=main.php?pagina=frmCadastroArea.php&aux=1&codArea=".$i->getId()."><img src='./image/editar.png'></a></td>";
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
				echo "<script type='text/javascript'> 
							alert('Operação realizada com sucesso!');
				      </script>";
			}else{
				if($alerta == 2){
					echo "<script type='text/javascript'> 
								alert('Ocorreu um erro na operação!');
						  </script>";
				}
		    }
		    //Fim Alerta --------------------
		     */
		?>
            
        </body>
           
        </html>