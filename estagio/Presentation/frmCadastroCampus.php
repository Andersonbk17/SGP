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

	<?php
		include_once ("../DataAccess/CampusDAO.php");
		include_once ("../DomainModel/Campus.php");
		
		$dao = new CampusDAO();
		
	?>
	<!-- Inicio Head -->
	<head>
		<title>Cadrastar Campus</title>
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
					window.location.href = "../Controller/CtlCampus.php?oP=3&codCampus="+id; 
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
					//Salvar Campus
					if($aux == 0){
						echo"<legend>Registrar Campus</legend>";
						echo"<form name='frmCadastroCampus' action='../Controller/CtlCampus.php?oP=1' method='POST'>";
							echo"<label for='nomeCampus'>Nome*</label><br/>";
							echo"<input type='text' id='nomeCampus' name='nomeCampus' required size='50' maxlength='50' class='input-div'/>";
							echo"<input type='submit' id='btnCampus' name='btnCampus' value='Salvar' class='botao' /><br/>";
						echo"</form>";
						
						
				   //Atualizar Campus
				   }else{
						//Pegando $_GET['CodCampus'];
						$id = $_GET['codCampus'];
						
						//Destruindo o $_GET['aux'];
						unset($_GET['aux']);
						
						//----
						$editar = new Campus();
						//----
						$editar = $dao->Abrir($id);	
						
						echo"<legend>Editar Campus</legend>";
						echo"<form name='frmCadastroCampus' action='../Controller/CtlCampus.php?oP=2' method='POST'>";
							
							echo"<label for='codigo'>Código </label><br/>";
							
							foreach ($editar as $i){
								echo"<input type='text' id='id' name='id' value='".$i->getId()."' disabled size='2' class='input-div'/><br/>";
								echo"<input type='hidden' id='codCampus' name='codCampus' value='".$i->getId()."' size='2'/><br/>";
								echo"<label for='nomeCampus'>Nome*</label><br/>";
								echo"<input type='text' id='nomeCampus' name='nomeCampus' value='".$i->getNome()."' required size='50' maxlength='50' class='input-div'/>";
								$i++;
							}
							echo"<a href=main.php?pagina=frmCadastroCampus.php&aux=0><input type='button' id='cancelar' name='cancelar' value='Cancelar' class='botao'/></a>";
							echo"<input type='submit' id='btnCampus' name='btnCampus' value='Salvar' class='botao'/>";
						echo"</form>";
					   
				   }
					
			echo"</fieldset>";
	
		?>
		<!-- Fim Formulario -->
		
		<!-- Inicio Tabela -->
		<?php
		
			//----
			$c = new Campus();
			 
			$c = $dao->ListarTodos();
			
			//----
			echo "<br/>";
			echo "<fieldset class='moldura2'>";
			echo	"<legend>Campus Registrados</legend>";
			echo	"<table class='tbl' name='tbl' id='tbl' border='1'>";
			echo		"<tr>";
			echo			"<td class='nomeCampus' width='30' align='middle'><b>ID</b></td>";
			echo			"<td class='nomeCampus' width='600' align='middle'><b>NOME</b></td>";

			echo		"</tr>";
			
			foreach ($c as $i){
				echo		"<tr class='linha-td'>";
				echo			"<td class='linha-td' width='30' align='middle'>".$i->getId()."</td>";
				echo			"<td class='linha-td' width='1200' align='middle'>".$i->getNome()."</td>";
				echo			"<td class='coluna'><a href=main.php?pagina=frmCadastroCampus.php&aux=1&codCampus=".$i->getId()."><img src='./image/editar.png'></a></td>";
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
		     
		?>
	
	</body>
	<!-- Fim Body -->

</html>
