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

$id = $_GET['id'];

if(isset($_GET['idF'])){
    $idF = $_GET['idF'];
}

$dao = new AfastamentoDAO();
$afastamento = new Afastamento();

$afastamento->setIdAfastamento($id);

$dao->apagar($afastamento);
if(isset($_GET['op'])){
    echo '<script type="text/javascript"> alert("Apagado com Sucesso !");
        window.location="../Presentation/main.php?pagina=frmCadastroAfastamento.php";</script>';
    
}else{
    echo '<script type="text/javascript"> alert("Apagado com Sucesso !");
        window.location="../Presentation/main.php?pagina=frmDetalharFuncionario.php&idFuncionario='. $idF .'";</script>';
}
    
?>

