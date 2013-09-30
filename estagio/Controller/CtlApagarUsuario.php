<?php

include_once '../DataAccess/UsuarioDAO.php';
include_once '../DomainModel/Usuario.php';


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


$dao = new UsuarioDAO();
$user = new Usuario();

$user->setId($id);

$dao->apagar($user);
echo '<script type="text/javascript"> alert("Apagado com Sucesso !"); window.location="../Presentation/main.php?pagina=frmCadastroUsuario.php";</script>';
?>
