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
<html>

    <?php
    include_once ("../DataAccess/CursoDAO.php");
    include_once ("../DomainModel/Curso.php");
    include_once ("../DataAccess/AreaDAO.php");
    include_once ("../DomainModel/Area.php");
    include_once ("../DataAccess/CampusDAO.php");
    include_once ("../DomainModel/Campus.php");

    $dao = new CursoDAO();
    ?>
    <!-- Inicio Head -->
    <head>
        <title>Cadastrar Curso</title>
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
                    window.location.href = "../Controller/CtlCurso.php?oP=3&codCurso="+id; 
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
    if (isset($_GET['aux'])) {
        $aux = $_GET['aux'];
    } else {
        $aux = 0;
    }
    //Salvar Campus
    if ($aux == 0) {
        echo"<legend>Registrar Curso</legend>";
        echo"<form name='frmCadastroCurso' action='../Controller/CtlCurso.php?oP=1' method='POST'>";
        echo"<label for='nomeCurso'>Nome*</label><br/>";
        echo"<input type='text' id='nomeCurso' name='nomeCurso' required size='40' maxlength='50' class='input-div'/><br/>";
        echo"<label for='siglaCurso'>Sigla*</label><br/>";
        echo"<input type='text' id='siglaCurso' name='siglaCurso' required size='40' maxlength='50' class='input-div'/><br/>";

        echo"<label for='Area' class='label'>Area*</label><br/>";
        echo"<select name='areaCurso' id='areaCurso' required style='width: 160px' class='input-div'>";

        $daoArea = new AreaDAO();
        $a = new Area();
        $a = $daoArea->ListarTodos();

        //Valor padrão
        echo("<option selected='selected' value=''>Selecione</option>");
        //Fazendo o looping para exibição de todos registros que contiverem em nomedatabela
        foreach ($a as $i) {
            echo("<option value='" . $i->getId() . "'>" . $i->getNome() . "</option>");
            $i++;
        }
        echo"</select><br/>";
        

        echo"<label for='campusCurso' class='label'>Campus*</label><br/>";
        echo"<select name='campusCurso' id='campusCurso' required style='width: 160px' class='input-div'>";

        $daoCampus = new CampusDAO();
        $c = new Campus();
        $c = $daoCampus->ListarTodos();

        //Valor padrão
        echo("<option selected='selected' value=''>Selecione</option>");
        //Fazendo o looping para exibição de todos registros que contiverem em nomedatabela
        foreach ($c as $cc) {
            echo("<option value='" . $cc->getId() . "'>" . $cc->getNome() . "</option>");
            $cc++;
        }
        echo"</select>";


        echo"<input type='submit' id='btnCurso' name='btnCurso' value='Salvar' class='botao' /><br/>";
        echo"</form>";


        //Atualizar Campus
    } else {
        //Pegando $_GET['CodCampus'];
        $id = $_GET['cod'];

        //Destruindo o $_GET['aux'];
        unset($_GET['aux']);

        //----
        $editar = new Curso();
        //----
        $editar = $dao->Abrir($id);

        echo"<legend>Editar Curso</legend>";
        echo"<form name=frmCadastroCurso' action='../Controller/CtlCurso.php?oP=2' method='POST'>";

        echo"<label for='codigo'>Código </label><br/>";


        echo"<input type='text' id='id' name='id' value='" . $editar->getId() . "' disabled size='2' class='input-div'/>";
        echo"<input type='hidden' id='codCurso' name='codCurso' value='" . $editar->getId() . "' size='2'/><br/>";
        echo"<label for='nomeDisciplina'>Nome*</label><br/>";
        echo"<input type='text' id='nomeCurso' name='nomeCurso' value='" . $editar->getNome() . "' required size='40' maxlength='50' class='input-div'/><br/>";
        echo"<label for='siglaCurso'>Sigla*</label><br/>";
        echo"<input type='text' id='siglaCurso' name='siglaCurso' value='" . $editar->getSigla() . "'required size='40' maxlength='50' class='input-div'/><br/>";
        echo"<label for='Area' class='label'>Area*</label><br/>";
        echo"<select name='areaCurso' id='areaCurso' style='width: 160px' class='input-div'>";

    $daoArea = new AreaDAO();
            $a = new Area();
            $a = $daoArea->ListarTodos();

            //Valor padrão
            echo("<option selected='selected' value=''>Selecione</option>");
            //Fazendo o looping para exibição de todos registros que contiverem em nomedatabela
            foreach ($a as $i) {
                echo("<option value='" . $i->getId() . "'>" . $i->getNome() . "</option>");
                $i++;
            }

            echo"</select><br/>";
          echo"<script type='text/javascript'> $(document).ready(function(){  $('#areaCurso').val(".$editar->getArea().")      }) </script>"; //select ok


            echo"<label for='campusCurso' class='label'>Campus*</label><br/>";
            echo"<select name='campusCurso' id='campusCurso' style='width: 160px' class='input-div'>";

            $daoCampus = new CampusDAO();
            $c = new Campus();
            $c = $daoCampus->ListarTodos();

            //Valor padrão
            echo("<option selected='selected' value=''>Selecione</option>");
            //Fazendo o looping para exibição de todos registros que contiverem em nomedatabela
            foreach ($c as $cc) {
                echo("<option value='" . $cc->getId() . "'>" . $cc->getNome() . "</option>");
                $cc++;
            }
            echo"</select>";
            
            //Pegando Valor do campus_curso n:n
            
            $sql = "SELECT * FROM curso_campus WHERE idCurso =".$editar->getId();
            $resultado = mysql_query($sql);
            while($rs = mysql_fetch_array($resultado)){
                $idCampus = $rs['idCampus'];
            }
            
            echo"<script type='text/javascript'> $(document).ready(function(){  $('#campusCurso').val(".$idCampus.")      }) </script>"; //select ok
            
            $i++;
       
        echo"<a href=main.php?pagina=frmCadastrarCurso.php&aux=0><input type='button' id='cancelar' name='cancelar' value='Cancelar' class='botao'/></a>";
        echo"<input type='submit' id='btnDisciplina' name='btnDisciplina' value='Atualizar' class='botao'/>";
        echo"</form>";
    }

    echo"</fieldset>";
    ?>
    <!-- Fim Formulario -->

    <!-- Inicio Tabela -->
    <?php
    //----
    $d = new Curso();

    $d = $dao->ListarTodos();

    //----
    echo "<br/>";
    echo "<fieldset class='moldura2'>";
    echo "<legend>Cursos Registrados</legend>";
    echo "<table class='tbl' name='tbl' id='tbl' border='1'>";
    echo "<tr>";
    echo "<td class='nomeCampus' width='30' align='middle'><b>ID</b></td>";
    echo "<td class='nomeCampus'  width='900' align='middle'><b>NOME</b></td>";
    echo "<td class='nomeCampus'  width='300' align='middle'><b>SIGLA</b></td>";
    echo "</tr>";

    foreach ($d as $i) {
        echo "<tr class='linha-td'>";
        echo "<td class='linha-td' width='30' align='middle'>" . $i->getId() . "</td>";
        echo "<td class='linha-td' width='900' align='middle'>" . $i->getNome() . "</td>";
        echo "<td class='linha-td' width='300' align='middle'>" . $i->getSigla() . "</td>";
        echo "<td class='coluna'><a href=main.php?pagina=frmCadastrarCurso.php&aux=1&cod=" . $i->getId() . "><img src='./image/editar.png'></a></td>";
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
            $alerta = 3;
            echo "<script type='text/javascript'> 
                                                            alert('Operação realizada com sucesso!');
                                          </script>";
        } else {
            if ($alerta == 2) {
                $alerta = 3;
                echo "<script type='text/javascript'> 
                                                                    alert('Ocorreu um erro na operação!');
                                                      </script>";
            }
        }
        //Fim Alerta --------------------
    ?>
        


    </body>

</html>