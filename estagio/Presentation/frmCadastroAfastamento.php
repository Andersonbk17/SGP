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
         <title>Cadastro Afastamentos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style/estiloConteudo.css"> 
        <script type="text/javascript" src="script/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="script/jquery.maskedinput-1.1.4.pack.js"></script>
        
        <script type="text/javascript">
           jQuery(function($){
	       $("#dataInicio").mask("99/99/9999");
               $("#dataTermino").mask("99/99/9999");
               
               
          	       
	});
        
        $(document).ready(function(){
            $('._funcionario').hide()
            
        })
        
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
                     $('#afastamentos').show()
                 })
             }
             
             $(document).ready(function() {
                $('table#tbl tr:odd').addClass('impar');
                $('table#tbl tr:even').addClass('par');
         });
        
              
        </script>
         <script language="Javascript">
	
            function confirmacao(id) { 
                var resposta = confirm("Deseja remover esse registro?");   
                if (resposta == true) { 
                    window.location.href = "../Controller/ctlApagarAfastamento.php?op=0&id="+id; 
                } 
            } 
        </script>
        
    </head>
    
    <body>
        <form id="frmCadastroAfastamento" name="frmCadastroAfastamento" method="post" action="../Controller/CtlAfastamento.php">
            <fieldset>
                <legend> Afastamentos</legend>
                
                <!--<label name="usuario" class="_funcionario" for="funcionario" >Funcionário:</label><br class="_funcionario" /> -->
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
                
                
                <label for="dataInicio" class="labelForms">Data Inicio:</label>
                <input type="text" name="dataInicio" autofocus="" class="input-div" id="dataInicio" required="" /><br />
                <label for="dataTermino" class="labelForms">Data Término:</label>
                <input type="text" name="dataTermino" id="dataTermino" class="input-div" required="" /><br />
                
                <label for="motivo" class="labelForms">Motivo:</label>
                <textarea name="motivo" id="motivo" cols="100" rows="10" class="input-div" required=""><?php echo"";?></textarea><br /><br />
                
                <a  class="botao" name='proximo' id='proximo' href="main.php?pagina=frmCadastroProgressaoCarreira.php" style="text-decoration: none ">Próximo</a>
                <div class="btnSS">
                <input type="submit" id="enviar" class="botao"name="enviar" value="Salvar" title="salvar informações" />
                </div><br/>
              
                
            </fieldset>
            
            
            
        </form> <br />
        <br />
        
        <fieldset id="afastamentos" name="afastamentos" style="display: none">
            <legend>Afastamentos</legend>
            
            <?php
            
         
                
                
                include_once '../DataAccess/AfastamentoDAO.php';
                include_once '../DomainModel/Afastamento.php';
                
          
                
                $dao = new AfastamentoDAO();
                $afastamento = new Afastamento();
                
                if(isset($_SESSION['idFuncionario'])){
                    $idFuncionario = $_SESSION['idFuncionario'];
                  
                }
                
                $afastamento = $dao->ListarTodos($id);
                
               
                echo	"<table class='tbl' name='tbl' id='tbl' border='1' >";
			echo		"<tr>";
			echo			"<td class='nomeCampus'  ALIGN=MIDDLE WIDTH=10 ><b>ID<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=200><b>Data Inicio<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=200><b>Data Termino<b /></td>";
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=1000><b>Motivo<b /></td>";
			echo		"</tr>";
		            
                foreach ($afastamento as $a){
                       echo		"<tr class='linha-td'>";
                       echo		"<td class='linha-td' ALIGN=MIDDLE WIDTH=10>".$a->getIdAfastamento()."</td>";
                       echo		"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$a->getDataInicio()."</td>";
                       echo		"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>".$a->getDataTermino()."</td>";
                       echo		"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>".$a->getMotivo()."</td>";
                       echo		"<td class='coluna'><a href=main.php?pagina=frmEditarAfastamento.php&op=0&id=".$a->getIdAfastamento()."><img src='./image/editar.png' title='Editar informações'></a></td>";
                       echo		"<td class='coluna'><a href='javascript:func()' onclick='confirmacao(" . $a->getIdAfastamento() . ")'><img src='./image/excluir.png' title='Remover registro'></a></td>";
                        echo		"</tr>";
                        //echo '<script type="text/javascript"> alert("'.$a->getIdAfastamento().'")</script>';
                    
                }
                    
                echo	"</table>";
                
                
                ?>
            
            
            
        </fieldset>
        
        
        
        
        
        
    </body>
    
    
    
    
    
    
</html>