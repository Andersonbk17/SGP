<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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
        
            var idFuncionario = <?php
if (isset($_SESSION['idFuncionario'])) {
    echo $id = $_SESSION['idFuncionario'];
} else {
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
                     
        })
    }
             
    $(document).ready(function() {
        $('table#tbl tr:odd').addClass('impar');
        $('table#tbl tr:even').addClass('par');
    });
             
             
        
              
        </script>

    </head>
    <?php
    include_once '../DataAccess/ProgressaoCarreiraDAO.php';
    include_once '../DomainModel/ProgressaoCarreira.php';

    $daoPr = new ProgressaoCarreiraDAO();
    $novo = new ProgressaoCarreira();

    $id = $_GET['id'];

    $novo = $daoPr->Abrir($id);
    ?>

    <body >
        <form id="frmCadastroProgressaoCarreira" name="frmCadastroProgressaoCarreira" method="post" action="../Controller/CtlEditarProgressaoCarreira.php">
            <fieldset>
                <legend> Progressões Carreira</legend>
                <input type="hidden" name="idPr" id="idPr"value="<?php echo $novo->getId(); ?>"
                       <label name="usuario" class="_funcionario" for="funcionario" >Nome do Funcionário *:</label><br class="_funcionario" />
                <select id="funcionario" class="input-div _funcionario" name="funcionario2"  required="">
                    <option selected value="0">Selecione</option>

                <?php
                include_once '../DataAccess/FuncionarioDAO.php';
                include_once '../DomainModel/Funcionario.php';

                $tipo = new Funcionario();
                $dao = new FuncionarioDAO();

                $tipo = $dao->ListarTodos();

                foreach ($tipo as $i) {
                    echo "<option value=" . $i->getId() . ">" . $i->getNome() . "</option> ";
                }
                ?>

                </select><br class="_funcionario"  />


                <label for="dataProgressao">Data da Progressão *</label><br />
                <input type="text" name="dataProgressao" autofocus="" value="<?php echo $novo->getDataProgressao(); ?>" class="input-div" id="dataProgressao" required="" /><br />
                <label for="descricaoNivelCategoria">Descrição/Nível/Categoria *</label><br />
                <input type="text" name="descricaoNivelCategoria" id="descricaoNivelCategoria" value="<?php echo $novo->getDescricaoNivelCategoria(); ?>" class="input-div" required="" /><br />
                <input type='hidden' name='funcionario' id='funcionario1' value='' />
                
                <input type="submit" id="enviar" class="botao"name="enviar" value="Salvar" />


            </fieldset>
        </form> 
    </body>

</html>