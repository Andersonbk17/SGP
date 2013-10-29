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

<html>
    <head>
        <title>Cadastro de Dependentes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style/estiloConteudo.css"> 
        <script type="text/javascript" src="script/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="script/jquery.maskedinput-1.1.4.pack.js"></script>
        
        <script type="text/javascript">
           jQuery(function($){
	       $("#dataNascimento").mask("99/99/9999");
               
	});
        
        $(document).ready(function(){
            $('#proximo').click(function(){
                 location.href="frmCadastroAfastamento.php";
            })
        })
        
        
         $(document).ready(function() {
                $('table#tbl tr:odd').addClass('impar');
                $('table#tbl tr:even').addClass('par');
         });
         
         
         
         var idFuncionario = <?php  if(isset($_SESSION['idFuncionario'])){
                                        echo $id = $_SESSION['idFuncionario'];
                                        
                                    }else{
                                        echo 0;
                                        //nao tem usuario na secao
                                    }
                    
                ?>;
             if(idFuncionario == 0){
                 $(document).ready(function(){
                    $('._funcionario').show()
                    $('#proximo').hide()
                   
                 })
             }
             
             if(idFuncionario >0){
                 $(document).ready(function(){
                     $('#dependentes').show()
                     $('._funcionario').hide()
                     
                     //Script para o usuario ser forçado a terminar o cadastro de usuario
                     
                     $('#mCadastros').hide(1000)
                 })
             }
         
         
         
         
         
         
         

        
        </script>
         <script language="Javascript">
	
            function confirmacao(id) { 
                var resposta = confirm("Deseja remover esse registro?");   
                if (resposta == true) { 
                    window.location.href = "../Controller/ctlApagarDependente.php?op=0&id="+id; 
                } 
            } 
        </script>
        
        
        
    </head>
    
    <body>
        <fieldset>
            <form action="../Controller/CtlDependente.php" method="post" id="frmCadastroDependentes" name="frmCadastroDependentes">
                
               <!-- <label name="usuario" class="_funcionario" for="funcionario" >Nome do Funcionário *:</label><br class="_funcionario" />-->
                  <label name="usuario" class="labelForms" for="funcionario" >Funcionário:</label>

               <select id="funcionario" class="input-div _funcionario" name="funcionario"  required="">
                        <option selected value="0">Selecione</option>
                        
                        <?php
                       
                            include_once '../DataAccess/FuncionarioDAO.php';
                            include_once '../DomainModel/Funcionario.php';

                            $tipo = new Funcionario();
                            $dao = new FuncionarioDAO();

                            $tipo = $dao->ListarTodos();

                            foreach ($tipo as $i){
                                echo "<option value=".$i->getId().">".$i->getNome()."</option> ";
                            }
                            
                          
                    ?>
                        
                    </select><br class="_funcionario"  />
                
                
                    <label for="nome" class="labelForms">Dependente:</label>
                <input type="text" id="nome" name="nome" class="input-div" required="" /><br />
                
                <label for="nome" class="labelForms">Nascimento:</label>
                <input type="text" id="dataNascimento" class="input-div" name="dataNascimento" required="" /><br />
                
                <label name="sexo" for="sexo" class="labelForms">Sexo:</label><br>
                
                <label name="sexo"  for="sexo" class="labelForms">Masculino</label>
                <input type="radio" class="input-div2" name="sexo" class="sexo" value="1" /><br/>
                <label name="sexo"  for="sexo" class="labelForms">Feminino </label> 
                <input type="radio" class="input-div2" name="sexo" class="sexo" value="2" />
        
                <!--
                <select name="sexo" id="sexo" class="input-div">
                    <option selected="" value="">Selecione...</option>
                    <option  value="1">Masculino</option>
                    <option  value="2">Feminino</option>
                    
                </select>
                -->
                
                
                
                <a  class="botao" name='avancar' id='proximo' href="main.php?pagina=frmCadastroAfastamento.php" style="text-decoration: none " title='Avançar para próxima etapa'>Avançar</a>
                <input type="submit"  class="botao" name='enviar' id='enviar' value="Salvar" title='Salvar informações'/>
                
                
                
                
            </form>
            
            
            
        </fieldset> <br />
        
        <fieldset id="dependentes" name="dependentes" style="display: none">
            <legend>Dependentes Cadastrados</legend>
                <?php
                include_once '../DataAccess/DependenteDAO.php';
                include_once '../DataAccess/../DomainModel/Dependente.php';
                
                $dao = new DependenteDAO();
                $dependente = new Dependente();
                
               $dependente = $dao->ListarTodos($_SESSION['idFuncionario']);
               
               
                echo	"<table class='tbl' name='tbl' id='tbl' border='1' >";
			echo		"<tr>";
			echo			"<td class='nomeCampus'  ALIGN=MIDDLE WIDTH=30 ><b>ID<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Nome<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Data de Nascimento<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Sexo<b /></td>";	
                      
                      
			echo		"</tr>";
		            
                foreach ($dependente as $a){
                                
                                echo		"<tr class='linha-td'>";
				echo			"<td class='linha-td' ALIGN=MIDDLE WIDTH=10>".$a->getId()."</td>";
				echo			"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$a->getNome()."</td>";
                                echo			"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$a->getDataNascimento()."</td>";
                                if($a->getSexo() == 1){
                                    $sexo = "Masculino";
                                }else{
                                    $sexo = "Feminino";
                                }
                                
                                echo			"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$sexo."</td>";
                                
				echo			"<td class='coluna'><a href='main.php?pagina=frmEditarDependente.php&op=0&id=".$a->getId()."'><img src='./image/editar.png'></a></td>";
				echo			"<td class='coluna'><a href='javascript:func()' onclick='confirmacao(" . $a->getId() . ")'><img src='./image/excluir.png'></a></td>";
				echo		"</tr>";
                    
                }
                    
                echo	"</table>";
                
                
                ?>
            
            
        </fieldset>
        
        
        
    </body>
    
</html>