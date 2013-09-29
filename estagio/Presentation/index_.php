<?php
 
	// A sessao precisa ser iniciada em cada pagina diferente
		if (!isset($_SESSION)) session_start();
	 $nivel_necessario = 1;
	// Verifica se não há a variavel da sessao que identifica o usuario
	if (!isset($_SESSION['usuarioNome']) OR ($_SESSION['usuarioNivel'] < $nivel_necessario)) {
 	// Destr?i a sess?o por seguran?a
	    session_destroy();
	// Redireciona o visitante de volta pro login
	   // header("Location: index_.php"); exit; // mudar depois dos testes
	}
        else if (isset($_SESSION['usuarioNome'])){
            header("Location: main.php");
           
        }
        
	 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>LOGIN</title>

<style> @import url(./style/estilo.css);</style>
<script type="text/javascript" src="./script/jquery-1.8.1.min.js"></script>
<?php
	
	if(isset($erro)){
		echo"<script type='text/javascript'> $(function(){ $('#mensagem').show(1200).hide(2000) })</script>";
		//echo"adasdad";
	}
		
?>
<script type="text/javascript">
	$(
		function(){
			$('.login').show(2000);
			
			
			
			}
	
	
	
	);

	
</script>


  
</head>
<body>
    <form action="login.php" method="post">
		<div id="mensagem">USUÁRIO OU SENHA INVÁLIDOS</div>
	  <div id="login-box" class="login">
		
		<div id="login-box-interno" class="login">
		  
		  <div id="login-box-label" class="login">
			Login 
		  </div>
		  
		  <div class="input-div" id="input-usuario">
			<input type="text" name="usuario" value="" placeholder="Usuário ou Email" required/>
		  </div>
		  
		  <div class="input-div" id="input-senha">
			<input type="password" name="senha" value="" placeholder="senha" required/>
		  </div>
		
		  <div id="botoes" class="login">
				<input type="submit"  id="botao" name="Logar"  value="Logar">
			<div id="lembrar-senha" class="login"><input type="checkbox"/> Lembrar minha senha</div>
			
		  </div>
		</div>
	  </div>
	  <div id="esqueceu-senha" class="login">
		<b>Esqueceu a senha?</b> Clique aqui para enviar por email.
	  </div>
  </form>
  
</body>
</html>
