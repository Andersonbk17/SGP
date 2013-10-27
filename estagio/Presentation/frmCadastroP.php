<?php


?>

<html>
    
    <head>
        <title>Cadastro Professores</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style/estiloConteudo.css"> 
        <script type="text/javascript" src="script/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="script/jquery.maskedinput-1.1.4.pack.js"></script>
        
        <script type="text/javascript">
        
        $(document).ready(function() {
                $('table#tbl tr:odd').addClass('impar');
                $('table#tbl tr:even').addClass('par');
         });

        
        </script>
		<script language="Javascript">
	
			function confirmacao(id) { 
				var resposta = confirm("Deseja remover esse registro?");   
				if (resposta == true) { 
					window.location.href = "../Controller/CtlEditarProfessor.php?oP=2&cod="+id; 
				} 
			} 
		</script>
        
    </head>
    
    <body>
        
        <fieldset >
            <form action="main.php?pagina=frmCadastroP.php" method="post" name="frmListaFuncionarioBusca">
                <label for="busca" class="labelFiltro">Pesquisar: </label>
            <input type="text" name="busca" id="busca" class="input-div-filtro" size="60"/>
            
            <label for="parametro1" class="labelFiltro">Filtro: </label>
            <select name="parametro1" class="input-div-filtro" id="parametro" >
                <option value="nenhum" selected="" >Nenhum</option>
                <option value="nome"  >Nome</option>
                <option value="cpf" >Cpf</option>
                <!--<option value="id" >Id</option> -->
                
            </select>
            
            <label for="parametro2" class="labelFiltro" >Ordenação: </label>
            <select name="parametro2" class="input-div-filtro" id="parametro2" >
                
                <option value="crescente" selected="" >Crescente</option>
                <option value="decrescente"  >Decrescente</option>
                
            </select>
            <input type="submit" id="Buscar" name="Buscar" class="botao" title="Filtrar registro"/>
        </fieldset> <br />
        </form>
		<!--<a href="main.php?pagina=frmCadastroProfessor.php"><img src="image/novo.png"/></a><br/>-->
                 <a href="main.php?pagina=frmCadastroProfessor.php">        
                    <input type="submit" id="btnNovo" name="btnNovo" value='Novo' class='botaoNovo' title="Adicionar novo"/>
                </a>
        <fieldset>
            
            <?php
                include_once '../DataAccess/FuncionarioDAO.php';
                include_once '../DataAccess/../DomainModel/Funcionario.php';
                
                $dao = new FuncionarioDAO();
                $funcionario = new Funcionario();
                
                
                
                /*#######          ###BUSCAS##    ##################*/
                
                if(isset($_POST['parametro1'])){
                        $filtro = $_POST['parametro1']; //filtro
                }else{
                    $filtro = "nenhum";
                }
                
                if(isset($_POST['parametro2'])){
                    $ordem = $_POST['parametro2']; //ordem
                }else{
                    $ordem = "crescente";
                 
                }
                
                
                 if($ordem == "crescente"){
                     $ordem = "ASC";
                    
                 }else if($ordem == "decrescente") {
                    $ordem = "DESC";
                    
                 }

                if(!isset($_POST['busca'])){
                    $busca = "";

                }else{
                    $busca = $_POST['busca'];
                }

                
                
                if($filtro == "nenhum"){ //se nenhum filtro busca tudo
                    $funcionario = $dao->ListarTodos();
                }else if($filtro == "cpf"){
                    $obj = new Funcionario();
                    $obj->setCpf($busca);
                    
                    $funcionario = $dao->Busca($obj, $ordem);
                    
                }else if($filtro == "nome"){
                    $obj = new Funcionario();
                    $obj->setNome($busca);
                    
                    $funcionario = $dao->Busca($obj, $ordem);
                    
                }



                //$funcionario = $dao->Busca($funcionario, $ordem);

                
               
                        echo	"<table class='tbl' name='tbl' id='tbl' border='1' >";
			echo		"<tr>";
                        echo "<td class='colunaTop' colspan='3'><b>OPÇÃO</b></td>"; //espaço para botão editar e excluir
			echo			"<td class='nomeCampus'  ALIGN=MIDDLE WIDTH=30 ><b>ID<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>NOME<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=150><b>CPF<b /></td>";
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=150><b>SIAPE<b /></td>";
			echo		"</tr>";
		            
                foreach ($funcionario as $a){
                                echo		"<tr class='linha-td'>";
                                
                                echo			"<td class='coluna'><a href='main.php?pagina=frmCadastroProfessor.php&aux=1&idFuncionario=".$a->getId()."'><img src='./image/editar.png' title='Editar registro'></a></td>";
				echo			"<td class='coluna'><a href='javascript:func()' onclick='confirmacao(".$a->getId().")'><img src='./image/excluir.png' title='Remover registro'></a></td>";
                                echo			"<td class='coluna'><a href='main.php?pagina=frmDetalharFuncionario.php&idFuncionario=".$a->getId()."'><img src='./image/detalhes.png' title='Detalhar registro'></a></td>";
                                
                                
				echo			"<td class='linha-td' ALIGN=MIDDLE WIDTH=10>".$a->getId()."</td>";
				echo			"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$a->getNome()."</td>";
                                echo			"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>".$a->getCpf()."</td>";
                                echo			"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>".$a->getNumeroSiape()."</td>";
				
				echo		"</tr>";
                    
                }
                    
                echo	"</table>";
                
                
                ?>
            
            
            
        </fieldset>
        
        
        
        
    </body>
</html>
