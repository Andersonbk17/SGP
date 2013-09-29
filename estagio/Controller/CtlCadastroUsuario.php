<?php
    include_once '../DomainModel/Usuario.php';
    include_once '../DataAccess/UsuarioDAO.php';
    
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $idFuncionario = $_POST['funcionario'];
    
    $usuarioS = new Usuario();
    
     $usuarioS->setUsuario($usuario);
     $usuarioS->setSenha($senha);
     $usuarioS->setNivel(1);
     $usuarioS->setIdFuncionario($idFuncionario);
    
    
    $usuarioDAO = new UsuarioDAO();
    
    if($usuarioDAO->inserir($usuarioS)){
        echo '<script type="text/javascript"> alert("Erro ao Inserir")</script>';
    }  else {
        
        echo '<script type="text/javascript"> alert("Inserido com Sucesso !"); window.location="../Presentation/main.php?pagina=frmCadastroUsuario.php";</script>';
    }


?>
