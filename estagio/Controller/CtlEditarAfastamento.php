<?php

include_once '../DataAccess/AfastamentoDAO.php';
include_once '../DomainModel/Afastamento.php';

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

$retorno = $_GET['op'];

$id = $_POST['idA'];
$dataInicio = implode("-", array_reverse(explode("/", $_POST['dataInicio'])));
$dataTermino = implode("-", array_reverse(explode("/", $_POST['dataTermino'])));
$motivo = $_POST['motivo'];

if(isset($_GET['func'])){
    $idFuncionario = $_GET['func'];
}else{
    $idFuncionario = $_POST['funcionario'];
}

$dao = new AfastamentoDAO();
$afastamento = new Afastamento();

$afastamento->setIdAfastamento($id);
$afastamento->setDataInicio($dataInicio);
$afastamento->setDataTermino($dataTermino);
$afastamento->setMotivo($motivo);

if (isset($_SESSION['idFuncionario'])) {
    $idFuncionario = $_SESSION['idFuncionario'];
} else {
    $idFuncionario = $_POST['funcionario'];
}

$afastamento->setIdFuncionario($idFuncionario);


$dao->alterar($afastamento);
if($retorno == 1){
    echo '<script type="text/javascript"> alert("Alterado com Sucesso !"); 
         window.location="../Presentation/main.php?pagina=frmDetalharFuncionario.php&idFuncionario='. $idFuncionario .'";</script>';
}else{
    echo '<script type="text/javascript"> alert("Alterado com Sucesso !"); 
         window.location="../Presentation/main.php?pagina=frmCadastroAfastamento.php";</script>';
}
   

?>
