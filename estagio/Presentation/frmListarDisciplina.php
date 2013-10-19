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
		
            
    
    <!-- 
    
        FORMULÀRIO DE BUSCA 
    
    -->
    
    <fieldset >
            <form action="main.php?pagina=frmListarDisciplina.php" method="post" name="frmListaFuncionarioBusca">
            <label for="busca" >Pesquisar: </label>
            <input type="text" name="busca" id="busca" class="input-div" size="60"/>
            
            <label for="parametro1" >Filtro: </label>
            <select name="parametro1" class="input-div" id="parametro" >
                <option value="nenhum" selected="" >Nenhum</option>
                <option value="nome"  >Nome</option>
                <option value="id" >Id</option>
                <option value="sigla" >Sigla</option>
                <!--<option value="id" >Id</option> -->
                
            </select>
            
            <label for="parametro2" >Ordenação: </label>
            <select name="parametro2" class="input-div" id="parametro2" >
                
                <option value="crescente" selected="" >Crescente</option>
                <option value="decrescente"  >Decrescente</option>
                
            </select>
            <input type="submit" id="Buscar" name="Buscar" class="botao" />
        </fieldset> <br />
        </form>
		<a href="main.php?pagina=frmCadastroDisciplina.php"><img src="image/novo.png"/></a><br/>
        <fieldset>
    
   <!-- FIM DO FORMULARIO DE BUSCA 
   
   -->         
   
   
            
    <!--
    
    
            TABELA COM OS DADOS FILTRADOS
    
    
    -->
    
    
    <?php
              
                
              //  $dao = new TitulacaoDAO();
                $disciplina = new Disciplina();
                
                
                
                /*#######          ###BUSCAS##    ##################*/
                
                if(isset($_POST['parametro1'])){
                        $filtro = $_POST['parametro1']; //filtro
                }else{
                    $filtro = "nenhum";
                }
                
                if(isset($_POST['parametro2'])){
                    $ordem = $_POST['parametro2']; //ordem
                }else{
                    $ordem = "crescente";
                 
                }
                
                
                 if($ordem == "crescente"){
                     $ordem = "ASC";
                    
                 }else if($ordem == "decrescente") {
                    $ordem = "DESC";
                    
                 }

                if(!isset($_POST['busca'])){
                    $busca = "";

                }else{
                    $busca = $_POST['busca'];
                }

                
                
                if($filtro == "nenhum"){ //se nenhum filtro busca tudo
                    $disciplina = $dao->ListarTodos();
                }else if($filtro == "id"){
                    $obj = new Disciplina();
                    $obj->setId($busca);
                    
                    $disciplina = $dao->Busca($obj, $ordem);
                    
                }else if($filtro == "nome"){
                    $obj = new Disciplina();
                    $obj->setNome($busca);
                    
                    $disciplina = $dao->Busca($obj, $ordem);
                    
                }else if($filtro == "sigla"){
                    $obj = new Disciplina();
                    $obj->setSigla($busca);
                    
                    $disciplina = $dao->Busca($obj, $ordem);
                    
                }

            
            //tabela
                
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
			
			foreach ($disciplina as $i){
				echo		"<tr class='linha-td'>";
				echo			"<td class='linha-td' width='30' align='middle'>".$i->getId()."</td>";
				echo			"<td class='linha-td'width='600' align='middle'>".$i->getNome()."</td>";
				echo			"<td class='linha-td' width='300' align='middle'>".$i->getSigla()."</td>";
				echo			"<td class='linha-td' width='300' align='middle'>".$i->getCargaHoraria()."</td>";
				echo			"<td class='coluna'><a href=main.php?pagina=frmCadastroDisciplina.php&aux=1&cod=".$i->getId()."><img src='./image/editar.png'></a></td>";
				echo			"<td class='coluna'><a href='javascript:func()' onclick='confirmacao(".$i->getId().")'><img src='./image/excluir.png'></a></td>";
				echo		"</tr>";
				
		    }
			echo	"</table>";
			
			echo "</fieldset>";
                        ?>
            
            
            
            
            
	</body>
	<!-- Fim Body -->

</html>
