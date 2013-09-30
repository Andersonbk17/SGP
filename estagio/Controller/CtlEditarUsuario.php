<?php
    include_once '../DomainModel/Usuario.php';
    include_once '../DataAccess/UsuarioDAO.php';
    
    $id = $_POST['idU'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $idFuncionario = $_POST['funcionario'];
    
    $usuarioS = new Usuario();
    
    $usuarioS->setId($id);
    $usuarioS->setUsuario($usuario);
    $usuarioS->setSenha($senha);
    $usuarioS->setNivel(1);
    $usuarioS->setIdFuncionario($idFuncionario);
    
    
    $usuarioDAO = new UsuarioDAO();
    
    if($usuarioDAO->atualizar($usuarioS)){
        echo '<script type="text/javascript"> alert("Erro ao Atualizar")</script>';
    }  else {
        
        echo '<script type="text/javascript"> alert("Atualizado com Sucesso !"); window.location="../Presentation/main.php?pagina=frmCadastroUsuario.php";</script>';
    }


?>
