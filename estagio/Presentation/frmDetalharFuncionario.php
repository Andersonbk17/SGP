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
	
			function confirmacao(id) { 
				var resposta = confirm("Deseja remover esse registro?");   
				if (resposta == true) { 
					window.location.href = "../Controller/CtlApagarDependente.php?id="+id; 
				} 
			} 
		</script>
    </head>
    
    <body>
        
        <fieldset>
            <legend>Dados do Funcionário</legend>
            
            <label for="nome" >Nome do Funcionário :</label>
            <label name=nome ><?php echo $funcionario->getNome();?> </label> <br />
            
            <label for="nome" >Data de Nascimento :</label>
            <label name=nome ><?php echo $funcionario->getDataNascimento();?> </label> <br />
            
            <label for="nome" >Certidão de Nascimento :</label>
            <label name=nome ><?php echo $funcionario->getCertidaoNascimento();?> </label> <br />
            
            <label for="nome" >RG :</label>
            <label name=nome ><?php echo $funcionario->getRg();?> </label> <br />
            
            <label for="nome" >CPF :</label>
            <label name=nome ><?php echo $funcionario->getCpf();?> </label> <br />
            
            <label for="nome" >SEXO :</label>
            <label name=nome ><?php  if($funcionario->getSexo() == 1) echo "Masculino "; else echo "Feminino"?> </label> <br />
            
            <?php
                if($funcionario->getReservistaMilitar() != null){
                    echo "<label for='nome' >Numero da Reservista Militar :</label>";
                    echo "<label name='nome' > ".$funcionario->getReservistaMilitar(); ".</label> <br />";
                }
            ?>
           
            <label for="nome" >Título Eleitoral :</label>
            <label name=nome ><?php  echo $funcionario->getTituloEleitoral(); ?> </label> <br />

            <label for="nome" >Tipo Sanguíneo :</label>
            <label name=nome ><?php echo $tipoSanguineo->getNome(); ?> </label> <br />
            
            <label for="nome" >Estado Civil :</label>
            <label name=nome ><?php echo $estadoCivilNome; ?> </label> <br />
            
            <label for="nome" >Conjugue :</label>
            <label name=nome ><?php echo $funcionario->getConjugue(); ?> </label> <br />
            
            <label for="nome" >Certidão de Casamento / Divórcio :</label>
            <label name=nome ><?php echo $funcionario->getCertidaoCasamentoDivorcio(); ?> </label> <br />
            
            <label for="nome" >Data Casamento / Divórcio :</label>
            <label name=nome ><?php echo $funcionario->getDataCasamento(); ?> </label> <br />
            
            <label for="nome" >Nome do Pai :</label>
            <label name=nome ><?php echo $funcionario->getNomePai(); ?> </label> <br />
            
            <label for="nome" >Nome da Mãe :</label>
            <label name=nome ><?php echo $funcionario->getNomeMae(); ?> </label> <br />
            
            <label for="nome" >Endereço Rua :</label>
            <label name=nome ><?php echo $funcionario->getEndereco(); ?> </label> <br />
            
            <label for="nome" >Bairro  :</label>
            <label name=nome ><?php echo $funcionario->getEndBairro(); ?> </label> <br />
            
            <label for="nome" >Cidade  :</label>
            <label name=nome ><?php echo $cidade->getNome(); ?> </label> <br />
            
            <label for="nome" >Estado  :</label>
            <label name=nome ><?php echo $estado->getNome(); ?> </label> <br />
            
            <label for="nome" >CEP  :</label>
            <label name=nome ><?php echo $funcionario->getCep(); ?> </label> <br />
            
            <label for="nome" >Numero Siape  :</label>
            <label name=nome ><?php echo $funcionario->getNumeroSiape(); ?> </label> <br />
            
            <label for="nome" >Numero Portaria/Nomeação  :</label>
            <label name=nome ><?php echo $funcionario->getPortariaNomeacao(); ?> </label> <br />
            
            <label for="nome" >Data da Posse  :</label>
            <label name=nome ><?php echo $funcionario->getDataPosse(); ?> </label> <br />
            
            <label for="nome" >Data de Exercício  :</label>
            <label name=nome ><?php echo $funcionario->getDataExercicio(); ?> </label> <br />
            
            <label for="nome" >PortariaFG  :</label>
            <label name=nome ><?php echo $funcionario->getPortariaFG(); ?> </label> <br />
            
            <label for="nome" >PortariaCD  :</label>
            <label name=nome ><?php echo $funcionario->getPortariaCD(); ?> </label> <br />
            
            <label for="nome" >Campus  :</label>
			
            <label name=nome ><?php foreach($campus as $cam){echo $cam->getNome();$cam++;} ?> </label> <br />
            
            <label for="nome" >Titulação  :</label>
            <label name=nome ><?php foreach($titulacao as $ti){ echo $ti->getNome();$ti++;} ?> </label> <br />
            
            <label for="nome" >Pendências  :</label>
            <label name=nome ><?php echo $funcionario->getPendencias(); ?> </label> <br />
			
			<a href="main.php?pagina=frmCadastroP.php"><input type="button" class="botao"  value="Voltar"/></a>
            
            
        </fieldset>
        
        <fieldset>
            <legend>Dependentes</legend>
            <?php
            echo	"<table class='tbl' name='tbl' id='tbl' border='1' >";
			echo		"<tr>";
			echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Nome<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Data de Nascimento<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=600><b>Sexo<b /></td>";	
                      
                      
			echo		"</tr>";
		            
                foreach ($dependentes as $a){
                                
                                echo		"<tr class='linha-td'>";
				echo			"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$a->getNome()."</td>";
                                echo			"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$a->getDataNascimento()."</td>";
                                if($a->getSexo() == 1){
                                    $sexo = "Masculino";
                                }else{
                                    $sexo = "Feminino";
                                }
                                
                                echo			"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$sexo."</td>";
					  echo     "<td class='coluna'><a href=main.php?pagina=frmEditarDependente.php&id='".$a->getId()."'><img src='./image/editar.png'></a></td>";
                      echo			"<td class='coluna'><a href='javascript:func()' onclick='confirmacao(".$a->getId().")'><img src='./image/excluir.png'></a></td>";
                                
				echo		"</tr>";
                    
                }
                    
                echo	"</table>";
            
            
            
            ?>
            
            
        </fieldset>
        
        <fieldset>
            <legend>Históricos de Afastamentos</legend>
            
            <?php
            
            echo	"<table class='tbl' name='tbl' id='tbl' border='1' >";
			echo		"<tr>";
			
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=200><b>Data Inicio<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=200><b>Data Termino<b /></td>";
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=1000><b>Motivo<b /></td>";
			echo		"</tr>";
		            
                foreach ($afastamento as $a){
                       echo		"<tr class='linha-td'>";
                      
                       echo		"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=200 >".$a->getDataInicio()."</td>";
                       echo		"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>".$a->getDataTermino()."</td>";
                       echo		"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=10>".$a->getMotivo()."</td>";
					   echo     "<td class='coluna'><a href='#'><img src='./image/editar.png'></a></td>";
                      echo			"<td class='coluna'><a href='main.php?'><img src='./image/excluir.png'></a></td>";
                        echo		"</tr>";
                      
                    
                }
                    
                echo	"</table>";
            
            
            
            ?>
            
        </fieldset>
        
        <fieldset>
            <legend>Histórico de Progressões na Carreira</legend>
                <?php
                
                echo	"<table class='tbl' name='tbl' id='tbl' border='1' >";
			echo		"<tr>";
			
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=500><b>Data Progressão<b /></td>";	
                        echo                        "<td class='nomeCampus' colspan='70' ALIGN=MIDDLE WIDTH=800><b>Descrição/ Nível/Categoria<b /></td>";
                       
			echo		"</tr>";
		            
                foreach ($progressaoCarreira as $a){
                       echo		"<tr class='linha-td'>";
                       
                       echo		"<td class='linha-td'  colspan='70' ALIGN=MIDDLE WIDTH=500 >".$a->getDataProgressao()."</td>";
                       echo		"<td class='linha-td' colspan='70' ALIGN=MIDDLE WIDTH=800>".$a->getDescricaoNivelCategoria()."</td>";
					    echo     "<td class='coluna'><a href='#'><img src='./image/editar.png'></a></td>";
                      echo			"<td class='coluna'><a href='#'><img src='./image/excluir.png'></a></td>";
                        echo		"</tr>";
                       
                    
                }
                    
                echo	"</table>";
                
                
                
                
                
                ?>
            
            
        </fieldset>
        
        
        
        
        
    </body>
    
    
    
</html>

