<?php
	if (!isset($_SESSION)) session_start();
	 $nivel_necessario = 1;
	// Verifica se não há a variavel da sessao que identifica o usuario
	if (!isset($_SESSION['usuarioNome']) OR ($_SESSION['usuarioNivel'] < $nivel_necessario)) {
 	// Destr?i a sess?o por seguran?a
	    session_destroy();
	// Redireciona o visitante de volta pro login
	    header("Location: index_.php"); exit; // mudar depois dos testes
	}
        //else if (isset($_SESSION['usuarioNome'])){
         //   header("Location: main.php");
           
       // }



unset($_SESSION['idFuncionario']);

echo '<script type="text/javascript"> alert("Funcionario Cadastrado com Sucesso !"); window.location="../Presentation/main.php?pagina=frmCadastroP.php";</script>';

?>
