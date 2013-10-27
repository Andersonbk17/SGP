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
//  else if (isset($_SESSION['usuarioNome'])){
//     header("Location: main.php");
// }
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style/estiloConteudo.css">
        <script type="text/javascript" src="script/jquery-1.8.1.min.js"></script>


        <script type="text/javascript">
            function valida(){
                if(document.frmCadastroUsuario.senha.value != document.frmCadastroUsuario.confirmarSenha.value ){
                    alert("As senhas Estão incorretas")
                    document.frmCadastroUsuario.senha.focus()
                    document.frmCadastroUsuario.senha.value = ""
                    document.frmCadastroUsuario.confirmarSenha.value = ""
                    return false;
                }else if(document.frmCadastroUsuario.funcionario.value == 0){
                    alert("Selecione um Funcionário");
                    return false;
                }
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
                    window.location.href = "../Controller/CtlApagarUsuario.php?id="+id; 
                } 
            } 
        </script>
    </head>
    <body>
        <div>
            <h2>Cadastro de Usuários</h2>

            <fieldset>
                <legend>Cadastrar Usuário</legend>
                <form name="frmCadastroUsuario" id="frmCadastroUsuario" method="POST" 
                      action="./../Controller/CtlCadastroUsuario.php"  onsubmit="return valida(this);">

                    <label name="usuario" for="funcionario" class="labelForms">Funcionário:</label>
                    <select id="funcionario" name="funcionario"  class="input-div" required="" />
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

                                        </select><br />

                                        <label name="usuario" for="usuario" class="labelForms">Usuário:</label>
                                        <input type="text" name="usuario" id="usuario" size="50"  required="" class="input-div" placeholder="Novo Usuario"/> <br />
                                        <label name="senha" for="senha" class="labelForms">Senha:</label>
                                        <input type="password" name="senha" id="senha" size="50" required="" placeholder="Senha" class="input-div"/><br />
                                        <label name="confirmarSenha" for="confirmarSenha" class="labelForms">Confirmar Senha:</label>
                                        <input type="password" name="confirmarSenha" id="confirmarSenha" size="50" required="" placeholder="Digite Novamente" class="input-div" /> <br />
                                        <input type="submit" name="Cadastrar"  class="botao" value="Cadastrar" title="Salvar informações"/>

                                    </form>
                                </fieldset>
                               
            

                                <fieldset>
                                    <legend>Usuários Cadastrados</legend>
                    <?php
                    include_once '../DataAccess/UsuarioDAO.php';
                    include_once '../DataAccess/../DomainModel/Usuario.php';

                    $dao = new UsuarioDAO();
                    $usuario = new Usuario();

                    $usuario = $dao->ListarTodos();

                    echo "<table class='tbl' name='tbl' id='tbl' border='1' >";
                    echo "<tr>";
                    echo "<td class='colunaTop' colspan='2'><b>OPÇÃO</b></td>"; //espaço para botão editar e excluir
                    echo "<td class='nomeCampus'  ALIGN=MIDDLE WIDTH=30 ><b>ID<b /></td>";
                    echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=800><b>Usuário<b /></td>";
                    echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=200><b>Nível<b /></td>";
                    echo "</tr>";

                    foreach ($usuario as $a) {
                        echo "<tr class='linha-td'>";
                        echo "<td class='coluna'><a href=main.php?pagina=frmEditarUsuario.php&id='" . $a->getId() . "'><img src='./image/editar.png'></a></td>";
                        echo "<td class='coluna'><a href='javascript:func()' onclick='confirmacao(" . $a->getId() . ")'><img src='./image/excluir.png'></a></td>";
                        echo "<td class='linha-td' ALIGN=MIDDLE WIDTH=30>" . $a->getId() . "</td>";
                        echo "<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=800 >" . $a->getUsuario() . "</td>";
                        echo "<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=200>" . $a->getNivel() . "</td>";
                     
                        echo "</tr>";
                    }

                    echo "</table>";
                    ?>
            </fieldset>

        </div>
    </body>
</html>

