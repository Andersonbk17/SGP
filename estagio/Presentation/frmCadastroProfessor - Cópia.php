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
        //else if (isset($_SESSION['usuarioNome'])){
         //   header("Location: main.php");
           
       // }


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro de Professor</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <link rel="stylesheet" type="text/css" href="style/estiloConteudo.css">
        <script type="text/javascript" src="script/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="script/jquery.maskedinput-1.1.4.pack.js"></script>
         
        <script type="text/javascript">

	jQuery(function($){
	       $("#dataCasamento").mask("99/99/9999");
               $("#dataPosse").mask("99/99/9999");
               $("#dataExercicio").mask("99/99/9999");
               $("#dataNascimento").mask("99/99/9999");
               $("#cpf").mask("999.999.999-99");
               $("#cep").mask("99999-999");
	       
	});

        $(document).ready(function (){
            $(".sexo").click(function(){
                var valor = $("input.sexo:checked").val();
                
                if(valor == 1){
                      $(".reservista").fadeIn(1400)
                }else{
                    $(".reservista").hide(1100)
                }
            })
        
            
            
        })
        $(document).ready(function(){
            $("#estadoCivil").click(function(){
                var valor = $("#estadoCivil option:selected").val();
                
                
                    if(valor == 1){
                        $(".casado").fadeIn(1400)
                        $(".divorcio").hide(1100)
                    }
                    else if(valor == 2){
                       $(".casado").hide(1100)
                       $(".divorcio").hide(1100)
                    }
                   else if(valor == 3){
                       //conferir
                       $(".casado").hide(1100)
                       $(".divorcio").fadeIn(1400)
                       $("#conjugue").fadeIn(1400)
                       $("#dataCasamento").fadeIn(1400)
                       
                   }else{
                       $(".casado").hide(1100)
                       $(".divorcio").hide(1100)
                   }
                    
                
                
            })
            
            
        })

        
        $(document).ready(function(){
            $('#estado').change(function(){
                    if( $(this).val() ) {
                            $('#cidade').hide();
                            $('.carregando').show();
                            $.getJSON('../Controller/CtlCidadeAjax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
                                    var options = '<option value=""></option>';	
                                    for (var i = 0; i < j.length; i++) {
                                            options += '<option value="' + j[i].idCidade + '">' + j[i].nome + '</option>';
                                    }	
                                    $('#cidade').html(options).show();
                                    $('.carregando').hide();
                            });
                    } else {
                            $('#cidade').html('<option value="">-- Escolha um estado --</option>');
                    }
            });
        });
        
        $(document).ready(function(){
        
            $('#enviar').click(function(){
                $('#reservista').show()
                $('#certidaoCasamentoDivorcio').show()
                $('#conjugue').show()
                
                $('#reservista').val("null")
                
                $('#certidaoCasamentoDivorcio').val("null")
                $('#conjugue').val("null")

            })
        
        })
        
        
        </script>
    </head>
    <body>
        
       
        <form name="frmCadProfessor" method="post" action="../Controller/CtlCadastroProfessor.php" >
            <fieldset >
                <legend>Dados Pessoais</legend>
                <label name="nome" for="nome">Nome do professor *:</label><br />
                <input type="text" id="nome" class="input-div" name="nome" autofocus="" placeholder="Nome" required="" size="100" /><br />
                
                <label name="dataNascimento" for="dataNascimento">Data Nascimento *:</label><br />
                <input type="text" class="input-div" name="dataNascimento" id="dataNascimento" placeholder="DD/MM/AAAA" size="24"/><br />
                
                <label name="certidaoNascimento" for="certidaoNascimento">Certidão de Nascimento:</label><br />
                <input type="text" class="input-div" id="certidaoNascimento" name="certidaoNascimento" placeholder="Número" required="" size="24" /> <br />
                <label name="rg" for="rg">RG *:</label><br />
                <input type="text" class="input-div" id="rg" name="rg" placeholder="RG" required="" size="24" /> <br />
                <label name="cpf" for="cpf">CPF *:</label><br />
                <input type="text" class="input-div" id="cpf" name="cpf" placeholder="CPF" required="" size="24" /> <br />
                <label name="email" for="email">CPF *:</label><br />
                <input type="email" class="input-div" id="email" name="email" placeholder="EMAIL" required="" size="24" /> <br />
                
                <label name="sexo" for="sexo">Sexo * :</label><br /> 
                <label name="sexo" for="sexo">Masculino</label>
                <input type="radio"  name="sexo" class="sexo input-div" value="1" /><br />
                <label name="sexo" for="sexo">Feminino</label> 
                <input type="radio"  name="sexo" class="sexo input-div" value="2" /><br />
                
                   
                                     
               
                
                <label name="reservista" for="reservista"  class="reservista" style="display: none"  >Número da Reservista Militar:</label><br class="reservista" style="display: none" />
                <input type="text"  id="reservista" name="reservista" placeholder="" class="reservista input-div" required="" style="display: none" size="24" /> <br class="reservista" style="display: none" />
                <label name="titulo" for="titulo">Título Eleitoral *:</label><br />
                <input type="text" class="input-div" id="titulo" name="titulo" placeholder="" required="" size="24" /> <br />
                
                
                
                
                <label name="estadoCivil" for="estadoCivil">Estado Civil *:</label><br />
                <select id="estadoCivil" class="input-div" name="estadoCivil" required="">
                   <option selected value="0">Selecione</option>
                    <?php
                        include_once '../DataAccess/EstadoCivilDAO.php';
                        include_once '../DomainModel/EstadoCivil.php';
                        
                        $estado = new EstadoCivil();
                        $dao = new EstadoCivilDAO();
                        
                        $estado = $dao->ListarTodos();
                        
                           foreach ($estado as $i){
                               echo "<option value='".$i->getId()."'>".$i->getNome()."</option>";// verificar ddddddddddddddddddddd
                           }
                             
                            
                    ?>
                                     
               </select>
                
                <label name="tipoSanguineo" for="tipoSanguineo">Tipo Sanguineo *:</label>
                <select id="tipoSanguineo" class="input-div" name="tipoSanguineo" required="">
                   <option selected value="0">Selecione</option>
                    <?php
                    include_once '../DataAccess/TipoSanguineoDAO.php';
                    include_once '../DomainModel/TipoSanguineo.php';
                    
                    $tipo = new TipoSanguineo();
                    $dao = new TipoSanguineoDAO();
                    
                    $tipo = $dao->ListarTodos();
                    
                    foreach ($tipo as $i){
                        echo "<option value=".$i->getId().">".$i->getNome()."</option> ";
                    }
                        
                            
                    ?>
                                     
               </select><br />
                
                
                
               <br class="casado" style="display: none" /><label name="conjugue" for="conjugue" class="casado" style="display: none">Conjugue :</label><br class="casado" style="display: none" />
                <input type="text"  id="conjugue" name="conjugue" placeholder="Nome " style="display: none" required="" class="casado input-div"  size="100"/> <br class="casado" style="display: none" />
                
                <label name="certidaoCasamentoDivorcio" for="certidaoCasamentoDivorcio" class="casado" style="display: none">Certidão de Casamento :</label><br class="casado" style="display: none" />
                <input type="text" class="casado input-div" id="certidaoCasamentoDivorcio"  name="certidaoCasamentoDivorcio" placeholder="Numero " size="24" style="display: none" required="" class="casado" /> <br class="casado" style="display: none" />
                
                
                <label name="dataCasamento" for="dataCasamento"  style="display: none" class="casado" >Data Casamento :</label><br class="casado" style="display: none" />
                <label name="dataCasamento" for="dataCasamento" style="display: none" class="divorcio" >Data Divórcio :</label><br class="divorcio" style="display: none" />
                <input type="text" class="input-div casado" id="dataCasamento" name="dataCasamento" class="casado" style="display: none" size="24" name="dataCasamento" placeholder="DD/MM/AAAA" /><br class="casado" style="display: none" /> 
                
               
                
                
                <label name="nomePai" for="nomePai">Nome do Pai *:</label><br />
                <input type="text" class="input-div" id="nomePai" name="nomePai" placeholder="Nome " required="" size="100" /> <br />
                <label name="nomeMae" for="nomeMae">Nome da Mãe *:</label><br />
                <input type="text" class="input-div" id="nomeMae" name="nomeMae" placeholder="Nome " required="" size="100" /> <br />
                
                <label name="endereco" for="rua">Endereço *:</label><br />
                <input type="text" class="input-div" id="rua" name="rua" placeholder="Rua " required="" size="60" /> 
                <label name="bairro" for="bairro">Bairro *:</label>
                <input type="text" class="input-div" id="bairro" name="bairro" placeholder="Bairro " required="" size="30" /> 
                <label name="numero" for="numero">Número *:</label>
                <input type="text" class="input-div" id="numero" name="numero" placeholder="Número " required="" /> <br />
                <label name="complemento" for="complemento">Complemento :</label> <br />
                <input type="text" class="input-div" id="complemento" name="complemento" placeholder="ex: apt,condominio " size="60"/> <br />
                
                
               
               <label name="estado" for="estado">Estado *:</label><br />
                <select id="estado" class="input-div" name="estado" required="">
                   <option selected value="0">Selecione</option>
                    <?php
                    //header('Content-Type: text/html; charset=ISO-8859-1');
                    
                    ini_set( 'default_charset', 'utf-8');

                    include_once '../DataAccess/EstadoDAO.php';
                    include_once '../DomainModel/Estado.php';
                    
                    $tipo = new Estado();
                    $dao = new EstadoDAO();
                    
                    $tipo = $dao->ListarTodos();
                    
                    foreach ($tipo as $i){
                        echo "<option value=".$i->getId().">".$i->getNome()."</option> ";
                    }
                        
                            
                    ?>
                                     
                </select>
               
               <label name="cidade" for="cidade">Cidade *:</label>
               <span class="carregando" style="color:#666;
				display:none;">Aguarde, carregando...</span>
                <select id="cidade" class="input-div" name="cidade" required="">
                   <option selected value="0">-- Escolha um estado --</option>
                   
                                     
               </select><br />
               <label name="cep" for="cep">Cep *:</label><br />
               <input type="text" class="input-div" id="cep" name="cep" placeholder="cep" size="24" required="" /><br />
               
                
            </fieldset>   <br/>     
          
              <fieldset>
                  <legend>Dados do Funcionário</legend>
                   
                  <label name="numeroSiape" for="numeroSiape">Numero Siape *:</label><br />
                  <input type="text" class="input-div" id="numeroSiape" name="numeroSiape" placeholder="" required="" size="24"/> <br />
                  <label name="numeroPortaria" for="numeroPortaria">Numero Portaria/Nomeação *:</label><br />
                  <input type="text" class="input-div" id="numeroPortaria" name="numeroPortaria" placeholder="" required="" size="24" /> <br />
                  <label name="dataPosse" for="dataPosse">Data da Posse *:</label><br />
                  <input type="text" class="input-div" id="dataPosse" name="dataPosse" placeholder="DD/MM/AAAA" required="" size="24" /> <br />
                  <label name="dataExercicio" for="dataExercicio">Data de Exercício *:</label><br />
                  
                  <input type="text" class="input-div" id="dataExercicio" name="dataExercicio" placeholder="DD/MM/AAAA" required="" size="24"/> <br />
                  <label name="portariaFG"  for="portariaFG">Portaria FG *:</label><br />
                  <input type="text" class="input-div" id="portariaFG" name="portariaFG" placeholder="" required="" size="24" /> <br />
                  <label name="portariaCD" for="portariaCD">Portaria CD *:</label><br />
                  <input type="text" class="input-div" id="portariaCD" name="portariaCD" placeholder="" required=""  size="24"/> <br />
                  
                  <label name="campus" for="campus">Campus *:</label>
                   <select id="campus" class="input-div" name="campus" required="">
                    <option selected value="0">Selecione</option>
                     <?php
                     //header('Content-Type: text/html; charset=ISO-8859-1');
                     //ini_set( 'default_charset', 'utf-8');

                     include_once '../DataAccess/CampusDAO.php';
                     include_once '../DomainModel/Campus.php';

                     $tipo = new Campus();
                     $dao = new CampusDAO();

                     $tipo = $dao->ListarTodos();
                     
                     foreach ($tipo as $i){
                         echo "<option value=".$i->getId().">".$i->getNome()."</option> ";
                     }

                    ?>
                                     
               </select>
               
               <label name="titulacao" for="titulacao">Titulação *:</label>
                   <select id="titulacao" class="input-div" name="titulacao" required="">
                    <option selected value="0">Selecione</option>
                     <?php
                     //header('Content-Type: text/html; charset=ISO-8859-1');
                     //ini_set( 'default_charset', 'utf-8');

                     include_once '../DataAccess/TitulacaoDAO.php';
                     include_once '../DomainModel/Titulacao.php';

                     $tipo = new Titulacao();
                     $dao = new TitulacaoDAO();

                     $tipo = $dao->ListarTodos();
                     
                     foreach ($tipo as $i){
                         echo "<option value=".$i->getId().">".$i->getNome()."</option> ";
                     }

                    ?>
                                     
               </select><br />
               <label name="pendencias" for="pendencias">Pendências :</label><br/>
               <textarea id="pendencias" class="input-div" name="pendencias" cols="125" rows="20">
                <?php echo "";?>

               </textarea><br />
               
               
                    <input type="submit" id="enviar" class="botao" name="enviar" value="Salvar" />       
               </fieldset>
            
      </form>
            
            
        
        
        
    </body>
</html>
