<?php
// A sessao precisa ser iniciada em cada pagina diferente
if (!isset($_SESSION))
    session_start();
$nivel_necessario = 1;
// Verifica se não há a variavel da sessao que identifica o usuario
if (!isset($_SESSION['usuarioNome']) OR ($_SESSION['usuarioNivel'] < $nivel_necessario)) {
    // Destr?i a sess?o por seguran?a
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: index_.php");
    exit; // mudar depois dos testes
}
?>


<html>
    <head>
         <title>Cadastro  de Progressão Carreira</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style/estiloConteudo.css"> 
        <script type="text/javascript" src="script/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="script/jquery.maskedinput-1.1.4.pack.js"></script>
        
        <script type="text/javascript">
           jQuery(function($){
	       $("#dataProgressao").mask("99/99/9999");
               
	});
        
        $(document).ready(function(){
            $('._funcionario').hide()
            
        })
        
        var idFuncionario = <?php  if(isset($_SESSION['idFuncionario'])){
                                        echo $id = $_SESSION['idFuncionario'];
                                    }else{
                                        echo 0;
                                    }
                    
                ?>;
             if(idFuncionario == 0){
                 $(document).ready(function(){
                 $('._funcionario').show()
                 $('#proximo').hide()
                 $('#funcionario').change(function(){
                     $('#funcionario1').val($('#funcionario option:selected').val())
                 })        
            
            })
             }
             if(idFuncionario > 0){
                 $('document').ready(function(){
                    // $('#funcionario1').show()
                     $('#funcionario1').val(idFuncionario)
                     $('#progressoes').show()
                     
                     //Script para o usuario ser forçado a terminar o cadastro de usuario
                     
                     $('#mCadastros').hide(1000)
                     
                 })
             }
             
             function mostrarMenuCadastros(){
                 //Script para mostrar o menu Cadastros ao terminar a edição
                     
                     $('#mCadastros').show(1000)
                 
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
                    window.location.href = "../Controller/ctlApagarProgressao.php?op=0&id="+id; 
                } 
            } 
        </script>
        
    </head>
    
    <body >
        <form id="frmCadastroProgressaoCarreira" name="frmCadastroProgressaoCarreira" method="post" action="../Controller/CtlProgressaoCarreira.php">
            <fieldset>
                <legend> Progressões Carreira</legend>
                
                <label name="usuario" class="labelForms _funcionario" for="funcionario" class="labelForms">Funcionário:</label>
                    <select id="funcionario" class="input-div-select _funcionario" name="funcionario2"  required="">
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
                
                
                <label for="dataProgressao" class="labelForms">Data Progressão:</label>
                <input type="text" name="dataProgressao" autofocus="" class="input-div" id="dataProgressao" required="" /><br />
                <label for="descricaoNivelCategoria" class="labelForms">Nível/Categoria:</label>
                <input type="text" name="descricaoNivelCategoria" id="descricaoNivelCategoria" class="input-div" required="" /><br />
                <input type='hidden' name='funcionario' id='funcionario1' value='' />
                
                <a  class="botao" name='proximo' id='proximo' onclick="mostrarMenuCadastros();" href="../Controller/CtlFinalizarCadastroFuncionario.php" style="text-decoration: none ">Finalizar</a>
                <input type="submit" id="enviar" class="botao"name="enviar" value="Salvar" />
              
                
            </fieldset>
            
            
            
        </form> <br />
        <br />
        
        <fieldset id='progressoes' style="display: none">
            <legend>Progressões</legend>
            
            <?php
                include_once '../DataAccess/ProgressaoCarreiraDAO.php';
                include_once '../DomainModel/ProgressaoCarreira.php';
                
                $dao = new ProgressaoCarreiraDAO();
                $progressao = new ProgressaoCarreira();
                
                $progressao = $dao->ListarTodos($_SESSION['idFuncionario']);
               
                echo	"<table class='tbl' name='tbl' id='tbl' border='1' >";
			echo		"<tr>";
			echo			"<td class='nomeCampus'  ALIGN=MIDDLE WIDTH=30 ><b>ID<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=500><b>Data Progressão<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=500><b>Descrição/ Nível/Categoria<b /></td>";
                        
			echo		"</tr>";
		            
                foreach ($progressao as $a){
                       echo		"<tr class='linha-td'>";
                       echo		"<td class='linha-td' ALIGN=MIDDLE WIDTH=30>".$a->getId()."</td>";
                       echo		"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=500 >".$a->getDataProgressao()."</td>";
                       echo		"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=5000>".$a->getDescricaoNivelCategoria()."</td>";
                       echo		"<td class='coluna'><a href=main.php?pagina=frmEditarProgressaoCarreira.php&op=0&id=".$a->getId()."><img src='./image/editar.png'></a></td>";
                       echo		"<td class='coluna'><a href='javascript:func()' onclick='confirmacao(" . $a->getId() . ")'><img src='./image/excluir.png'></a></td>";
                        echo		"</tr>";
                       
                    
                }
                    
                echo	"</table>";
                
                
                ?>
            
            
            
        </fieldset>
        
        
        
        
        
        
    </body>
    
    
    
    
    
    
</html>
