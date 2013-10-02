<?php
include_once '../DataAccess/FuncionarioDAO.php';
    include_once '../DomainModel/Funcionario.php';
    include_once '../DataAccess/EstadoCivilDAO.php';
    include_once '../DataAccess/TipoSanguineoDAO.php';
    include_once '../DataAccess/CidadeDAO.php';
    include_once '../DomainModel/Cidade.php';
    include_once '../DataAccess/EstadoDAO.php';
    include_once '../DomainModel/Estado.php';
    include_once '../DataAccess/CampusDAO.php';
    include_once '../DomainModel/Campus.php';
    include_once '../DataAccess/TitulacaoDAO.php';
    include_once '../DomainModel/Titulacao.php';
    include_once '../DataAccess/DependenteDAO.php';
    include_once '../DomainModel/Dependente.php';
    include_once '../DataAccess/AfastamentoDAO.php';
    include_once '../DomainModel/Afastamento.php';
    include_once '../DataAccess/ProgressaoCarreiraDAO.php';
    include_once '../DomainModel/ProgressaoCarreira.php';
    
    
    $idFucnionario = $_GET['idFuncionario'];
    
    $dao = new FuncionarioDAO();
    $funcionario = new Funcionario();
    
    $funcionario = $dao->Abrir($idFucnionario);
   // echo $funcionario->getNome();
    
    

// ##########  Joins de outras tabelas  ######
    
    $daoEstadoCivil = new EstadoCivilDAO();
    $estadoCivil = new EstadoCivil();
    
    $estadoCivil = $daoEstadoCivil->abrir($funcionario->getIdEstado_Civil());
    
    if($funcionario->getSexo() == 1 && $estadoCivil->getNome() == "Solteiro (a)"){ // se for homem
        $estadoCivilNome = "Solteiro";
    }else if($funcionario->getSexo() == 1 && $estadoCivil->getNome() == "Divorciado (a)"){
        $estadoCivilNome = "Divorciado";
    }else if($funcionario->getSexo() == 1 && $estadoCivil->getNome() == "Casado (a)"){
        $estadoCivilNome = "Casado";
    }else if($funcionario->getSexo() == 2 && $estadoCivil->getNome() == "Solteiro (a)"){ // se for Mulher
        $estadoCivilNome = "Solteira";
    }else if($funcionario->getSexo() == 2 && $estadoCivil->getNome() == "Divorciado (a)"){
        $estadoCivilNome = "Divorciada";
    }else if($funcionario->getSexo() == 2 && $estadoCivil->getNome() == "Casado (a)"){
        $estadoCivilNome = "Casada";
    }
    
    // ##### Tipo SAnguineo #########
    
    $daoTipoSanguineo = new TipoSanguineoDAO();
    $tpoSanguineo = new TipoSanguineo();
    
    $tipoSanguineo = $daoTipoSanguineo->abrir($funcionario->getIdTipo_Sanguineo());
    
    
    // ##### Cidade #########
    
    $daoCidade = new CidadeDAO();
    $cidade = new Cidade();
    
    $cidade = $daoCidade->Abrir($funcionario->getEndCidade());
    

    // ##### Estado #########
    
    $daoEstado = new EstadoDAO();
    $estado = new Estado();
    
    $estado = $daoEstado->abrir($cidade->getIdEstado());
    
    
     // ##### Campus #########
    
    $daoCampus = new CampusDAO();
    $campus = new Campus();
    
    $campus = $daoCampus->Abrir($funcionario->getIdCampus());
    
    
    // ##### Campus #########
    
    $daoTitulacao = new TitulacaoDAO();
    $titulacao = new Titulacao();
    
    $titulacao = $daoTitulacao->abrir($funcionario->getIdTitulacao());
    
    
    // ##### Dependentes #########
    
    $daoDependentes = new DependenteDAO();
    $dependentes = new Dependente();
    
    $dependentes = $daoDependentes->ListarTodos($funcionario->getId());
    
    
     // ##### Afastamentos #########
    
    $daoAfastamento = new AfastamentoDAO();
    $afastamento = new Afastamento();
    
    $afastamento = $daoAfastamento->ListarTodos($funcionario->getId());
    
    // ##### Progressoes #########
    
    $daoProgressoes = new ProgressaoCarreiraDAO();
    $progressaoCarreira = new ProgressaoCarreira();
    
    $progressaoCarreira = $daoProgressoes->ListarTodos($funcionario->getId());
?>



<html>

    <head>

        <title>Cadastro  de Progressão Carreira</title>
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
	
            function confirmacao(id,idF) { 
                var resposta = confirm("Deseja remover esse registro?");
                if (resposta == true) { 
                    var local = "../Controller/CtlApagarDependente.php?id="+id+"&idF="+idF;
         
                    window.location.href = local; 
                } 
            } 
        </script>
        <script language="Javascript">
	
            function confirmacao2(id,idF) { 
                var resposta = confirm("Deseja remover esse registro?");   
                if (resposta == true) { 
                    window.location.href = "../Controller/CtlApagarAfastamento.php?id="+id+"&idF="+idF; 
                } 
            } 
        </script>
         <script language="Javascript">
	
            function confirmacao3(id,idF) { 
                var resposta = confirm("Deseja remover esse registro?");   
                if (resposta == true) { 
                    window.location.href = "../Controller/CtlApagarProgressao.php?id="+id+"&idF="+idF; 
                } 
            } 
        </script>
    </head>

    <body>

        <fieldset>
            <legend>Dados do Funcionário</legend>

            <label for="nome" class="dados" >Nome do Funcionário :</label>
            <label name="nome"  ><?php echo $funcionario->getNome();?> </label> <br />
            
            <label for="dataNascimento" class="dados">Data de Nascimento :</label>
            <label name="dataNascimento"  ><?php echo $funcionario->getDataNascimento();?> </label> <br />
            
            <label for="certidaoNascimento" class="dados">Certidão de Nascimento :</label>
            <label name="certidaoNascimento"  ><?php echo $funcionario->getCertidaoNascimento();?> </label> <br />
            
            <label for="rg" class="dados">RG :</label>
            <label name="rg"  ><?php echo $funcionario->getRg();?> </label> <br />
            
            <label for="cpf" class="dados">CPF :</label>
            <label name="cpf"  ><?php echo $funcionario->getCpf();?> </label> <br />
            
            <label for="sexo" class="dados"  >SEXO :</label>
            <label name="sexo" ><?php  if($funcionario->getSexo() == 1) echo "Masculino "; else echo "Feminino"?> </label> <br />
            
            <?php
                if($funcionario->getReservistaMilitar() != "null"){
                    echo "<label for='reservista' class='dados' >Numero da Reservista Militar :</label>";
                    echo "<label name='reservista' > ".$funcionario->getReservistaMilitar(); ".</label> ";
                    echo "<br />";
                }
            ?>
           
            <label for="tituloEleitoral" class="dados">Título Eleitoral :</label>
            <label name="tituloEleitoral" ><?php  echo $funcionario->getTituloEleitoral(); ?> </label> <br />

            <label for="tipoSanguineo"class="dados" >Tipo Sanguíneo :</label>
            <label name="tipoSanguineo" ><?php echo $tipoSanguineo->getNome(); ?> </label> <br />
            
            <label for="nome" class="dados">Estado Civil :</label>
            <label name=nome ><?php echo $estadoCivilNome; ?> </label> <br />
            
            <label for="nome"class="dados" >Conjugue :</label>
            <?php
                if($funcionario->getConjugue() != "null"){
                    echo "<label name='nome' >".$funcionario->getConjugue()."</label> <br />";
                }else{
                    echo "<br />";
                }
            ?>
            
            
            <label for="nome" class="dados">Certidão de Casamento / Divórcio :</label>
            
            <?php
                if($funcionario->getCertidaoCasamentoDivorcio() !="null"){
                    echo "<label name='certidaoCasamentoDivorcio'  >".$funcionario->getCertidaoCasamentoDivorcio()."</label> <br />";
                }
            ?>
            
            
            <label for="dataCasamento" class="dados">Data Casamento / Divórcio :</label>
            <label name="dataCasamento" ><?php echo $funcionario->getDataCasamento(); ?> </label> <br />
            
            <label for="nomePai" class="dados">Nome do Pai :</label>
            <label name="nomePai" ><?php echo $funcionario->getNomePai(); ?> </label> <br />
            
            <label for="nomeMae" class="dados">Nome da Mãe :</label>
            <label name="nomeMae" ><?php echo $funcionario->getNomeMae(); ?> </label> <br />
            
            <label for="enderecoRua" class="dados">Endereço Rua :</label>
            <label name="enderecoRua" ><?php echo $funcionario->getEndereco(); ?> </label> <br />
            
            <label for="bairro" class="dados">Bairro  :</label>
            <label name="bairro" ><?php echo $funcionario->getEndBairro(); ?> </label> <br />
            
            <label for="complemento" class="dados">Complemento  :</label>
            <?php
            
                if($funcionario->getEndComplemento() != "null")
                    echo "<label name='complemento' >".$funcionario->getEndComplemento()." </label>";
                    echo "<br />";
            
            ?>
            
            <label for="cidade" class="dados">Cidade  :</label>
            <label name="cidade" ><?php echo $cidade->getNome(); ?> </label> <br />
            
            <label for="estado" class="dados">Estado  :</label>
            <label name="estado" ><?php echo $estado->getNome(); ?> </label> <br />
            
            <label for="cep" class="dados">CEP  :</label>
            <label name="cep" ><?php echo $funcionario->getCep(); ?> </label> <br />
            
            <label for="numeroSiape" class="dados">Numero Siape  :</label>
            <label name="numeroSiape" ><?php echo $funcionario->getNumeroSiape(); ?> </label> <br />
            
            <label for="numeroPortaria" class="dados">Numero Portaria/Nomeação  :</label>
            <label name="numeroPortaria" ><?php echo $funcionario->getPortariaNomeacao(); ?> </label> <br />
            
            <label for="dataPosse" class="dados">Data da Posse  :</label>
            <label name="dataPosse" ><?php echo $funcionario->getDataPosse(); ?> </label> <br />
            
            <label for="dataExercicio" class="dados">Data de Exercício  :</label>
            <label name="dataExercicio" ><?php echo $funcionario->getDataExercicio(); ?> </label> <br />
            
            <label for="portariaFG" class="dados">PortariaFG  :</label>
            <label name="portariaFG" ><?php echo $funcionario->getPortariaFG(); ?> </label> <br />
            
            <label for="portariaCd" class="dados">PortariaCD  :</label>
            <label name="portariaCD" ><?php echo $funcionario->getPortariaCD(); ?> </label> <br />
            
            <label for="campus" class="dados">Campus  :</label>
            <label name="campus" ><?php echo $campus->getNome(); ?> </label> <br />
            
            <label for="titulacao" class="dados">Titulação  :</label>
            <label name="titulacao" ><?php echo $titulacao->getNome(); ?> </label> <br />
            
            <label for="pendencias" class="dados">Pendências  :</label>
            <label name="pendencias" ><?php echo $funcionario->getPendencias(); ?> </label> <br />

            <a href="main.php?pagina=frmCadastroP.php"><input type="button" class="botao"  value="Voltar"/></a>


        </fieldset>

        <fieldset>
            <legend>Dependentes</legend>
            <?php
            echo "<table class='tbl' name='tbl' id='tbl' border='1' >";
            echo "<tr>";
            echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Nome<b /></td>";
            echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Data de Nascimento<b /></td>";
            echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Sexo<b /></td>";


            echo "</tr>";

            foreach ($dependentes as $a) {

                echo "<tr class='linha-td'>";
                echo "<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >" . $a->getNome() . "</td>";
                echo "<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >" . $a->getDataNascimento() . "</td>";
                if ($a->getSexo() == 1) {
                    $sexo = "Masculino";
                } else {
                    $sexo = "Feminino";
                }

                echo "<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >" . $sexo . "</td>";
                echo "<td class='coluna'><a href=main.php?pagina=frmEditarDependente.php&id='".$a->getId()."'&idFuncionario=".$idFucnionario."><img src='./image/editar.png'></a></td>";
                echo "<td class='coluna'><a href='javascript:func()' onclick='confirmacao(".$a->getId().",".$idFucnionario.")'><img src='./image/excluir.png'></a></td>";

                echo "</tr>";
            }

            echo "</table>";
            ?>


        </fieldset>

        <fieldset>
            <legend>Históricos de Afastamentos</legend>

<?php
echo "<table class='tbl' name='tbl' id='tbl' border='1' >";
echo "<tr>";

echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=200><b>Data Inicio<b /></td>";
echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=200><b>Data Termino<b /></td>";
echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=1000><b>Motivo<b /></td>";
echo "</tr>";

foreach ($afastamento as $a) {
    echo "<tr class='linha-td'>";

    echo "<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >" . $a->getDataInicio() . "</td>";
    echo "<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>" . $a->getDataTermino() . "</td>";
    echo "<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>" . $a->getMotivo() . "</td>";
    
    
    echo "<td class='coluna'><a href=main.php?pagina=frmEditarAfastamento.php&id='" . $a->getIdAfastamento()."'&idFuncionario=".$idFucnionario."><img src='./image/editar.png'></a></td>";
    echo "<td class='coluna'><a href='javascript:func()' onclick='confirmacao2(".$a->getIdAfastamento().",".$idFucnionario.")'><img src='./image/excluir.png'></a></td>";
    echo "</tr>";
}

echo "</table>";
?>

        </fieldset>

        <fieldset>
            <legend>Histórico de Progressões na Carreira</legend>
            <?php
            echo "<table class='tbl' name='tbl' id='tbl' border='1' >";
            echo "<tr>";

            echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=500><b>Data Progressão<b /></td>";
            echo "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=800><b>Descrição/ Nível/Categoria<b /></td>";

            echo "</tr>";

            foreach ($progressaoCarreira as $a) {
                echo "<tr class='linha-td'>";
//frmEditarDependente.php&id='".$a->getId()."'&idFuncionario=".$idFucnionario."><img src='./image/editar.png'></a></td>";
                echo "<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=500 >" . $a->getDataProgressao() . "</td>";
                echo "<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=800>" . $a->getDescricaoNivelCategoria() . "</td>";
                echo "<td class='coluna'><a href=main.php?pagina=frmEditarProgressaoCarreira.php&id=".$a->getId()."&idFuncionario=".$idFucnionario."><img src='./image/editar.png'></a></td>";
                echo "<td class='coluna'><a href='javascript:func()' onclick='confirmacao3(".$a->getId().",".$idFucnionario.")'><img src='./image/excluir.png'></a></td>";
                echo "</tr>";
            }

            echo "</table>";
            ?>


        </fieldset>

    </body>

</html>

