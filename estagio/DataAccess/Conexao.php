<?php
	

	$usuario = "root";
	$senha   = "";
	$banco   = "mydb";
	$servidor = "localhost";
	
	$conexao = mysql_connect($servidor,$usuario,$senha);
	$db = mysql_select_db($banco,$conexao);




?>
