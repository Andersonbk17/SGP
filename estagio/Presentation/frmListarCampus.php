<?php
// A sessao precisa ser iniciada em cada pagina diferente
if (!isset($_SESSION))
    session_start();
$nivel_necessario = 1;
// Verifica se não há a variavel da sessao que identifica o usuario
if (!isset($_SESSION['usuarioNome']) OR ($_SESSION['usuarioNivel'] < $nivel_necessario)) {
    // Destr?i a sess?o por seguran?a
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: index_.php");
    exit; // mudar depois dos testes
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
    <title>Cadastar Campus</title>
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
    
    <!-- 
    
        FORMULÀRIO DE BUSCA 
    
    -->
    
    <fieldset >
            <form action="main.php?pagina=frmListarCampus.php" method="post" name="frmListaFuncionarioBusca">
            <label for="busca" >Pesquisar: </label>
            <input type="text" name="busca" id="busca" class="input-div" size="60"/>
            
            <label for="parametro1" >Filtro: </label>
            <select name="parametro1" class="input-div" id="parametro" >
                <option value="nenhum" selected="" >Nenhum</option>
                <option value="nome"  >Nome</option>
                <option value="id" >Id</option>
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
		<a href="main.php?pagina=frmCadastroCampus.php"><img src="image/novo.png"/></a><br/>
        <fieldset>
    
   <!-- FIM DO FORMULARIO DE BUSCA 
   
   -->         
   
   
            
    <!--
    
    
            TABELA COM OS DADOS FILTRADOS
    
    
    -->
    
    
    <?php
                include_once '../DataAccess/CampusDAO.php';
                include_once '../DataAccess/../DomainModel/Campus.php';
                
                $dao = new CampusDAO();
                $Campus = new Campus();
                
                
                
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
                    $campus = $dao->ListarTodos();
                }else if($filtro == "id"){
                    $obj = new Campus();
                    $obj->setId($busca);
                    
                    $campus = $dao->Busca($obj, $ordem);
                    
                }else if($filtro == "nome"){
                    $obj = new Campus();
                    $obj->setNome($busca);
                    
                    $campus = $dao->Busca($obj, $ordem);
                    
                }



                //$funcionario = $dao->Busca($funcionario, $ordem);

                
                
                echo "<br/>";
                echo "<fieldset class='moldura2'>";
                echo "<legend>Campus Registrados</legend>";
                echo "<table class='tbl' name='tbl' id='tbl' border='1'>";
                echo "<tr>";
                echo "<td class='nomeCampus' width='30' align='middle'><b>ID</b></td>";
                echo "<td class='nomeCampus' width='600' align='middle'><b>NOME</b></td>";

                echo "</tr>";

                foreach ($campus as $i) {
                    echo "<tr class='linha-td'>";
                    echo "<td class='linha-td' width='30' align='middle'>" . $i->getId() . "</td>";
                    echo "<td class='linha-td' width='1200' align='middle'>" . $i->getNome() . "</td>";
                    echo "<td class='coluna'><a href=main.php?pagina=frmCadastroCampus.php&aux=1&codCampus=" . $i->getId() . "><img src='./image/editar.png'></a></td>";
                    echo "<td class='coluna'><a href='javascript:func()' onclick='confirmacao(" . $i->getId() . ")'><img src='./image/excluir.png'></a></td>";
                    echo "</tr>";
                    $i++;
                }
                echo "</table>";
                echo "</fieldset>";
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
               /*
                        echo	"<table class='tbl' name='tbl' id='tbl' border='1' >";
			echo		"<tr>";
			echo			"<td class='nomeCampus'  ALIGN=MIDDLE WIDTH=30 ><b>ID<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>NOME<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=150><b>CPF<b /></td>";
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=150><b>SIAPE<b /></td>";
			echo		"</tr>";
		            
                foreach ($funcionario as $a){
                                echo		"<tr class='linha-td'>";
				echo			"<td class='linha-td' ALIGN=MIDDLE WIDTH=10>".$a->getId()."</td>";
				echo			"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$a->getNome()."</td>";
                                echo			"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>".$a->getCpf()."</td>";
                                echo			"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>".$a->getNumeroSiape()."</td>";
				echo			"<td class='coluna'><a href='main.php?pagina=frmCadastroProfessor.php&aux=1&idFuncionario=".$a->getId()."'><img src='./image/editar.png'></a></td>";
				echo			"<td class='coluna'><a href='javascript:func()' onclick='confirmacao(".$a->getId().")'><img src='./image/excluir.png'></a></td>";
                                echo			"<td class='coluna'><a href='main.php?pagina=frmDetalharFuncionario.php&idFuncionario=".$a->getId()."'><img src='./image/detalhes.png'></a></td>";
				echo		"</tr>";
                    
                }
                    
                echo	"</table>";
                */
                
                ?>
            
            
            
        </fieldset>
 
    
    
    
   <!--
   ****************************************************************************
        FIM DA TABELA COM OS DADOS FILTRADOS
   
   
   ****************************************************************************
   --> 
    
    
    
    
    
    
    
    
    
    
    
   
    
    
    

    <!-- Inicio Formulario -->
    <?php
    
    /*
     * 
     * pra rermover
     *
    
    
    
    
    echo"<fieldset class='moldura1'>";
    if (isset($_GET['aux'])) {
        $aux = $_GET['aux'];
    } else {
        $aux = 0;
    }
    //Salvar Campus
    if ($aux == 0) {
        echo"<legend>Registrar Campus</legend>";
        echo"<form name='frmCadastroCampus' action='../Controller/CtlCampus.php?oP=1' method='POST'>";
        echo"<label for='nomeCampus'>Nome*</label><br/>";
        echo"<input type='text' id='nomeCampus' name='nomeCampus' required size='50' maxlength='50' class='input-div'/>";
        echo"<input type='submit' id='btnCampus' name='btnCampus' value='Salvar' class='botao' /><br/>";
        echo"</form>";


        //Atualizar Campus
    } else {
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

     
            echo"<input type='text' id='id' name='id' value='" . $editar->getId() . "' disabled size='2' class='input-div'/><br/>";
            echo"<input type='hidden' id='codCampus' name='codCampus' value='" . $editar->getId() . "' size='2'/><br/>";
            echo"<label for='nomeCampus'>Nome*</label><br/>";
            echo"<input type='text' id='nomeCampus' name='nomeCampus' value='" . $editar->getNome() . "' required size='50' maxlength='50' class='input-div'/>";
            
       
        echo"<a href=main.php?pagina=frmCadastroCampus.php&aux=0><input type='button' id='cancelar' name='cancelar' value='Cancelar' class='botao'/></a>";
        echo"<input type='submit' id='btnCampus' name='btnCampus' value='Atualizar' class='botao'/>";
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
    echo "<legend>Campus Registrados</legend>";
    echo "<table class='tbl' name='tbl' id='tbl' border='1'>";
    echo "<tr>";
    echo "<td class='nomeCampus' width='30' align='middle'><b>ID</b></td>";
    echo "<td class='nomeCampus' width='600' align='middle'><b>NOME</b></td>";

    echo "</tr>";

    foreach ($c as $i) {
        echo "<tr class='linha-td'>";
        echo "<td class='linha-td' width='30' align='middle'>" . $i->getId() . "</td>";
        echo "<td class='linha-td' width='1200' align='middle'>" . $i->getNome() . "</td>";
        echo "<td class='coluna'><a href=main.php?pagina=frmCadastroCampus.php&aux=1&codCampus=" . $i->getId() . "><img src='./image/editar.png'></a></td>";
        echo "<td class='coluna'><a href='javascript:func()' onclick='confirmacao(" . $i->getId() . ")'><img src='./image/excluir.png'></a></td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    echo "</fieldset>";
    
    
   
    ?>

    <?php
    //Mensagens de Alerta
    //Alerta para sucesso ou fracasso
    if (isset($_GET['msg'])) {
        $alerta = $_GET['msg'];
    } else {
        $alerta = 3;
    }
    //Destruindo $_GET['msg']
    unset($_GET['msg']);

    if ($alerta == 1) {
        echo "<script type='text/javascript'> 
							alert('Operação realizada com sucesso!');
				      </script>";
    } else {
        if ($alerta == 2) {
            echo "<script type='text/javascript'> 
								alert('Ocorreu um erro na operação!');
						  </script>";
        }
    }

    //Fim Alerta --------------------
    
    
    
    
    
    */
    ?>
     

</body>
<!-- Fim Body -->

</html>
