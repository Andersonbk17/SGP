<?php

	include("../DataAccess/Conexao.php");
	/*
	$servidor= "mysql.hostinger.com.br"; //Servidor
	$usuario= "u137239921_cr7"; //Usuario do banco de dados
	$senha= "170737nara"; //Senha do banco de dados
	$banco= "u137239921_aa"; //Nome do banco de dados

	$conexao = mysql_connect($servidor,$usuario,$senha)or trigger_error(mysql_error());
	$db = mysql_select_db($banco,$conexao);
	*/
	
	/*RECEBENDO VALORES DO FORM
	 * */
	
	 $usuario = mysql_real_escape_string( $_POST['usuario']);
	 $senha = mysql_real_escape_string( $_POST['senha']);
	 //$senha = sha1($senha); // conferir depois
	
	$sql = "SELECT * FROM usuario WHERE '".$usuario."' = usuario AND '".$senha."' = senha LIMIT 1";
	$query = mysql_query($sql);
	if (mysql_num_rows($query) != 1){
		/*senha e usuario invalido*/
            echo $sql;
		header("Location: index_.php?erro= $query"); exit;
	    
	   
		
		
	}else{
		// Salva os dados encontados na variável $resultado
	    $resultado = mysql_fetch_assoc($query);
		// Se a sessão não existir, inicia uma
            echo $sql;
		if (!isset($_SESSION)) session_start();
	 
	    // Salva os dados encontrados na sessão
	    $_SESSION['usuarioNome'] = $resultado['usuario'];
	    $_SESSION['usuarioNivel'] = $resultado['nivel'];
	 
	    // Redireciona 
        header("Location: main.php"); exit;
		
		
	}
		

	



?>
