<?php

	// A sessao precisa ser iniciada em cada pagina diferente
		if (!isset($_SESSION)) session_start();
	 $nivel_necessario = 1;
	// Verifica se não há a variavel da sessao que identifica o usuario
	if (!isset($_SESSION['usuarioNome']) OR ($_SESSION['usuarioNivel'] < $nivel_necessario)) {
 	// Destr?i a sess?o por seguran?a
	    session_destroy();
	// Redireciona o visitante de volta pro login
	    header("Location: index_.php"); exit; // mudar depois dos testes
	}
        
?>

<?php
header( 'Cache-Control: no-cache' );
header( 'Content-type: application/xml; charset="utf-8"', true );
include_once '../DataAccess/Conexao.php';

$cod_estados = mysql_real_escape_string( $_GET['cod_estados'] );

$cidades = array();

$sql = "SELECT * FROM cidade
		WHERE idEstado=$cod_estados
		ORDER BY nome";
$res = mysql_query( $sql );
while ( $row = mysql_fetch_assoc( $res ) ) {
	$cidades[] = array(
		'nome'			=> $row['nome'],
                'idCidade'              => $row['idCidade']
	);
}

echo( json_encode( $cidades ) );
?>
