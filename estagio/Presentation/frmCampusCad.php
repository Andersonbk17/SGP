<!DOCTYPE html>

	<?php
		
	?>
	<!-- Inicio Head -->
	<head>
		<title>Cadrastar Campus</title>
		<link rel="stylesheet" type="text/css" href="style/style-form.css"/>
	</head>
	<!-- Fim Head -->
	
	<!-- Inicio Body -->
	<body>
		
		<!-- Inicio Formulario -->
		<fieldset class="moldura1">
			<legend>Registrar Campus</legend>
			<form name="frmCampusCad" action="../Controller/Campus.php" method="POST">
				<label for="nomeCampus">Campus*</label>
				<input type="text" id="nomeCampus" name="nomeCampus" required size="50" maxlength="50"/>
				<input type="submit" id="btnCampus" name="btnCampus" value="Salvar" /><br/>
			</form>
		</fieldset>
		<!-- Fim Formulario -->
		
		<!-- Inicio Tabela -->
		<?php
		
			//
			include_once ("../DataAccess/CampusDAO.php");
			include_once ("../DomainModel/Campus.php");
			
			$dao = new CampusDAO();
			$c = new Campus();
			 
			$c = $dao->ListarTodos();
			
			
			//
			
			echo "<br/><br/>";
			echo "<fieldset class='moldura2'>";
			echo	"<legend>Campus Registrados</legend>";
			echo	"<table class='tabela' border='1'>";
			echo		"<tr>";
			echo			"<td class='nomeCampus' colspan='4'>Campus Registrados</td>";	
			echo		"</tr>";
			
			foreach ($c as $i){
				echo		"<tr>";
				echo			"<td class='opcaoED'>".$i->getId()."</td>";
				echo			"<td class='nomeCampus2'>".$i->getNome()."</td>";
				echo			"<td class='opcaoED'><a href='#'><img src='./image/editar.png'></a></td>";
				echo			"<td class='opcaoED'><a href='#'><img src='./image/excluir.png'></a></td>";
				echo		"</tr>";
				$i++;
		    }
			echo	"</table>";
			echo "</fieldset>";
			
		?>
		
	
	</body>
	<!-- Fim Body -->

</html>
