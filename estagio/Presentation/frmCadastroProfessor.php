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
                    $('#reservista').val("null")
                }
            })
        
            
            
        })
        $(document).ready(function(){
            $("#estadoCivil").click(function(){
                var valor = $("#estadoCivil option:selected").val();
                
                
                    if(valor == 1){//casado
                        $(".casado").fadeIn(1400)
                        $(".divorcio").hide(1100)
                        $('.emComum').fadeIn(1400)
                    }
                    else if(valor == 2){//solteiro
                       $(".casado").hide(1100)
                       $(".divorcio").hide(1100)
                       $('.emComum').hide(1100)
                    }
                   else if(valor == 3){//divorciado
                       //conferir
                       $(".casado").hide(1100)
                       $(".divorcio").fadeIn(1400)
                        $('.emComum').fadeIn(1400)
                       //$("#conjugue").fadeIn(1400)
                       //$("#dataCasamento").fadeIn(1400)
                       
                   }else{
                       $(".casado").hide(1100)
                       $(".divorcio").hide(1100)
                       $('.emComum').hide(1100)
                   }
                    
                
                
            })
            
            
        })
        
        
        
        //$(document).ready(function(){    $('#estado').val('1')     $('#estado').val(".$tmp->getIdEstado().")      })
        //$(document).ready(function (){
          //  $('#estado').val('1').show(100)
            //$('#estado').val(".$tmp->getIdEstado().")
        //})
        
        
        
        
        
        
        

        
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
                
                
                
                if($('#estadoCivil').val() == 2){//se o estado civil = solteiro mostra todos os valores e seta null
                    $('#certidaoCasamentoDivorcio').show()
                    $('#conjugue').show()
                    $('#dataCasamento').show()
                    
                    $('#certidaoCasamentoDivorcio').val("null")
                    $('#conjugue').val("null")
                    $('#dataCasamento').val("null")
                    $('#casadoDivorciado').val(0)
                    
                }else if($('#estadoCivil').val() == 3){//se estado civil = divorciado seta 2 em casadodivorciado
                    $('#casadoDivorciado').val(2)
                }else if($('#estadoCivil').val() == 2){//se estado civil = casado seta 1 em casadodivorciado
                    $('#casadoDivorciado').val(1)
                }
               

            })
        
        })
        
        
        
        
        </script>
        
    </head>
    <body>
        
        <?php
         echo"<fieldset >"; 
			 //---------------
			  if(isset($_GET['aux'])){
					$aux = $_GET['aux'];
			  }else{
					$aux = 0;
			  }
			 //---------------
			 if($aux == 0){
				 echo"<legend>Dados Pessoais</legend>";
				 //ENVIAR POR PARAMETRO UMA VARIAVEL oP = 1, ISSO SIGNIFICA QUE NA CTLCADASTRO PROFESSOR O QUE
				 //SERÁ EXECULTADO É O IF PARA PERSISTIR OS DADOS NO BD
				 echo "<form name='frmCadProfessor' method='post' action='../Controller/CtlCadastroProfessor.php' >";
			   
					echo"<label name='nome' for='nome' class='labelForms'>Nome:</label>";
					echo"<input type='text' id='nome' class='input-div' name='nome' autofocus='' placeholder='Nome' required='' size='70' /><br />";
						
					echo"<label name='dataNascimento' for='dataNascimento' class='labelForms'>Nascimento:</label>";
					echo"<input type='text' class='input-div' name='dataNascimento' id='dataNascimento' placeholder='DD/MM/AAAA' size='24'/><br />";
						
					echo"<label name='certidaoNascimento' for='certidaoNascimento' class='labelForms'>Cert. Nasc.:</label>";
					echo"<input type='text' class='input-div' id='certidaoNascimento' name='certidaoNascimento' placeholder='Número' required='' size='24' /> <br />";
					echo"<label name='rg' for='rg' class='labelForms'>RG:</label>";
					echo"<input type='text' class='input-div' id='rg' name='rg' placeholder='RG' required='' size='24' /> <br />";
					echo"<label name='cpf' for='cpf' class='labelForms'>CPF:</label>";
					echo"<input type='text' class='input-div' id='cpf' name='cpf' placeholder='CPF' required='' size='24' /> <br />";
					echo"<label name='email' for='email' class='labelForms'>E-mail:</label>";
					echo"<input type='email' class='input-div' id='email' name='email' placeholder='EMAIL' required='' size='24' /> <br />";
						
					echo"<label name='sexo' for='sexo' class='labelForms'>Sexo:</label>";
					echo"<label name='sexo' for='sexo'>Masculino</label>";
					echo"<input type='radio'  name='sexo' class='sexo input-div' value='1' /><br />";
					echo"<label name='sexo' for='sexo'>Feminino</label>";
					echo"<input type='radio'  name='sexo' class='sexo input-div' value='2' /><br />";
					
					
					//echo"<label name='reservista' for='reservista'  class='reservista labelForms' style='display: none'  >Reservista Militar:</label><br class='reservista' style='display: none' />";
					echo"<label name='reservista' for='reservista'  class='reservista labelForms' style='display: none'  >Reservista:</label>";
                                        echo"<input type='text'  id='reservista' name='reservista' placeholder='' class='reservista input-div' required='' style='display: none' size='24' /> <br class='reservista' style='display: none' />";
					echo"<label name='titulo' for='titulo' class='labelforms'>Título Eleitoral:</label>";
					echo"<input type='text' class='input-div' id='titulo' name='titulo' placeholder='' required='' size='24' /> <br />";
					
			 
					echo"<label name='estadoCivil' for='estadoCivil' class='labelforms'>Estado Civil:</label>";
					echo"<select id='estadoCivil' class='input-div' name='estadoCivil' required=''>";
					   echo"<option selected value='0'>Selecione</option>";
					   
							include_once '../DataAccess/EstadoCivilDAO.php';
							include_once '../DomainModel/EstadoCivil.php';
							
							$estado = new EstadoCivil();
							$dao = new EstadoCivilDAO();
							
							$estado = $dao->ListarTodos();
							
							foreach ($estado as $i){
								echo "<option value='".$i->getId()."'>".$i->getNome()."</option>";// verificar ddddddddddddddddddddd
							}
								 
								
								
				   echo"</select><br/>";
                                   
					
					   echo"<label name='tipoSanguineo' for='tipoSanguineo' class='labelforms'>Tipo Sanguineo:</label>";
					   echo"<select id='tipoSanguineo' class='input-div' name='tipoSanguineo' required=''>";
					   echo"<option selected value='0'>Selecione</option>";
					   
					   include_once '../DataAccess/TipoSanguineoDAO.php';
					   include_once '../DomainModel/TipoSanguineo.php';
						
					   $tipo = new TipoSanguineo();
					   $dao = new TipoSanguineoDAO();
						
					   $tipo = $dao->ListarTodos();
						
					   foreach ($tipo as $i){
							echo "<option value='".$i->getId()."'>'".$i->getNome()."'</option>";
					   }
										   
				   echo"</select><br />";
					
					
				//Casado
                                   echo"<br class='divorcio' style='display: none' /><label name='conjugue' for='conjugue' class='divorcio' style='display: none'>Conjugue :</label><br class='divorcio' style='display: none' />";
				   echo"<br class='casado' style='display: none' /><label name='conjugue' for='conjugue' class='casado' style='display: none'>Conjugue :</label><br class='casado' style='display: none' />";
				   
                                   echo"<input type='text'  id='conjugue' name='conjugue' placeholder='Nome ' style='display: none' required='' class='emComum input-div'  size='100'/> <br class='emComum' style='display: none' />";
					
                                   echo"<label name='certidaoCasamentoDivorcio' for='certidaoCasamentoDivorcio' class='divorcio' style='display: none'>Certidão de Divorcio :</label><br class='divorcio' style='display: none' />";
				   echo"<label name='certidaoCasamentoDivorcio' for='certidaoCasamentoDivorcio' class='casado' style='display: none'>Certidão de Casamento :</label><br class='casado' style='display: none' />";
				   
                                   echo"<input type='text' class='emComum input-div' id='certidaoCasamentoDivorcio'  name='certidaoCasamentoDivorcio' placeholder='Numero ' size='24' style='display: none' required='' class='casado' /> <br class='emComum' style='display: none' />";
					
				   echo"<label name='dataCasamento' for='dataCasamento'  style='display: none' class='divorcio' >Data Divorcio :</label><br class='divorcio' style='display: none' />";
				   echo"<label name='dataCasamento' for='dataCasamento'  style='display: none' class='casado' >Data Casamento :</label><br class='casado' style='display: none' />";
				   
				   echo"<input type='text' class='input-div emComum' id='dataCasamento' name='dataCasamento'  style='display: none' size='24' name='dataCasamento' placeholder='DD/MM/AAAA' /><br class='emComum' style='display: none' /> ";
                                   echo "<input type='hidden' id='casadoDivorciado' value='' name='casadoDivorciado' />";//verificar
				
                                   
                                   
				   echo"<label name='nomePai' for='nomePai'>Nome do Pai *:</label><br />";
				   echo"<input type='text' class='input-div' id='nomePai' name='nomePai' placeholder='Nome ' required='' size='70' /> <br />";
				   echo"<label name='nomeMae' for='nomeMae'>Nome da Mãe *:</label><br />";
				   echo"<input type='text' class='input-div' id='nomeMae' name='nomeMae' placeholder='Nome ' required='' size='70' /> <br />";
					
				   echo"<label name='endereco' for='rua'>Endereço *:</label><br />";
				   echo"<input type='text' class='input-div' id='rua' name='rua' placeholder='Rua ' required='' size='60' /> ";
				   echo"<label name='bairro' for='bairro'>Bairro *:</label>";
				   echo"<input type='text' class='input-div' id='bairro' name='bairro' placeholder='Bairro ' required='' size='30' /> ";
				   echo"<label name='numero' for='numero'>Número *:</label>";
				   echo"<input type='text' class='input-div' id='numero' name='numero' placeholder='Número ' required='' /> <br />";
				   echo"<label name='complemento' for='complemento'>Complemento :</label> <br />";
				   echo"<input type='text' class='input-div' id='complemento' name='complemento' placeholder='ex: apt,condominio ' size='60'/> <br />";
					
					
				   
				   echo"<label name='estado' for='estado'>Estado *:</label><br />";
				   echo"<select id='estado' class='input-div' name='estado' required=''>";
					   echo"<option selected value='0'>Selecione</option>";
						
						//header('Content-Type: text/html; charset=ISO-8859-1');
						
						ini_set( 'default_charset', 'utf-8');

						include_once '../DataAccess/EstadoDAO.php';
						include_once '../DomainModel/Estado.php';
						
						$tipo = new Estado();
						$dao = new EstadoDAO();
						
						$tipo = $dao->ListarTodos();
						
						foreach ($tipo as $i){
							echo "<option value='".$i->getId()."'>".$i->getNome()."</option>";
						}
							
								
					   
										 
				   echo"</select>";
				   
				   echo"<label name='cidade' for='cidade'>Cidade *:</label>";
				   echo"<span class='carregando' style='color:#666;display:none;'>Aguarde, carregando...</span>";
				   echo"<select id='cidade' class='input-div' name='cidade' required=''>";
					   echo"<option selected value='0'>-- Escolha um estado --</option>";
						 
				   echo"</select><br />";
				   echo"<label name='cep' for='cep'>Cep *:</label><br />";
				   echo"<input type='text' class='input-div' id='cep' name='cep' placeholder='cep' size='24' required='' /><br />";
				   
					
				echo"</fieldset><br/>";
			  
				  echo"<fieldset>";
					  echo"<legend>Dados do Funcionário</legend>";
					   
					  echo"<label name='numeroSiape' for='numeroSiape'>Numero Siape *:</label><br />";
					  echo"<input type='text' class='input-div' id='numeroSiape' name='numeroSiape' placeholder='' required='' size='24'/> <br />";
					  echo"<label name='numeroPortaria' for='numeroPortaria'>Numero Portaria/Nomeação *:</label><br />";
					  echo"<input type='text' class='input-div' id='numeroPortaria' name='numeroPortaria' placeholder='' required='' size='24' /> <br />";
					  echo"<label name='dataPosse' for='dataPosse'>Data da Posse *:</label><br />";
					  echo"<input type='text' class='input-div' id='dataPosse' name='dataPosse' placeholder='DD/MM/AAAA' required='' size='24' /> <br />";
					  echo"<label name='dataExercicio' for='dataExercicio'>Data de Exercício *:</label><br />";
					  
					  echo"<input type='text' class='input-div' id='dataExercicio' name='dataExercicio' placeholder='DD/MM/AAAA' required='' size='24'/> <br />";
					  echo"<label name='portariaFG'  for='portariaFG'>Portaria FG *:</label><br />";
					  echo"<input type='text' class='input-div' id='portariaFG' name='portariaFG' placeholder='' required='' size='24' /> <br />";
					  echo"<label name='portariaCD' for='portariaCD'>Portaria CD *:</label><br />";
					  echo"<input type='text' class='input-div' id='portariaCD' name='portariaCD' placeholder='' required=''  size='24'/> <br />";
					  
					  echo"<label name='campus' for='campus'>Campus *:</label>";
					  echo"<select id='campus' class='input-div' name='campus' required=''>";
						 echo"<option selected value='0'>Selecione</option>";
					 
						 //header('Content-Type: text/html; charset=ISO-8859-1');
						 //ini_set( 'default_charset', 'utf-8');

						 include_once '../DataAccess/CampusDAO.php';
						 include_once '../DomainModel/Campus.php';

						 $tipo = new Campus();
						 $dao = new CampusDAO();

						 $tipo = $dao->ListarTodos();
						 
						 foreach ($tipo as $i){
							 echo "<option value='".$i->getId()."'>".$i->getNome()."</option>";
						 }

					
										 
				   echo"</select>";
				   
				   echo"<label name='titulacao' for='titulacao'>Titulação *:</label>";
					   echo"<select id='titulacao' class='input-div' name='titulacao' required=''>";
						echo"<option selected value='0'>Selecione</option>";
					   
						 //header('Content-Type: text/html; charset=ISO-8859-1');
						 //ini_set( 'default_charset', 'utf-8');

						 include_once '../DataAccess/TitulacaoDAO.php';
						 include_once '../DomainModel/Titulacao.php';

						 $tipo = new Titulacao();
						 $dao = new TitulacaoDAO();

						 $tipo = $dao->ListarTodos();
						 
						 foreach ($tipo as $i){
							 echo "<option value='".$i->getId()."'>".$i->getNome()."</option> ";
						 }
						
				   echo"</select><br />";
				   echo"<label name='pendencias' for='pendencias'>Pendências :</label><br/>";
				   echo"<textarea id='pendencias' class='input-div' name='pendencias' cols='125' rows='20'>";
						echo "";
				   echo "</textarea><br />";
			 
				   echo "<input type='submit' id='enviar' class='botao' name='enviar' value='Salvar' />";     
				  
				echo "</form>";
		}
		if($aux == 1){
				 include_once ("../DataAccess/FuncionarioDAO.php");
				 include_once ("../DomainModel/Funcionario.php");
		
				 $dao = new FuncionarioDAO();
				 
				 //Pegando $_GET['CodCampus'];
				 $id = $_GET['idFuncionario'];
					
				 //Destruindo o $_GET['aux'];
				 unset($_GET['aux']);
					
				 //----
				 $edit = new Funcionario();
				 //----
				 $edit = $dao->Abrir($id);
				 
				 echo"<legend>Dados Pessoais</legend>";
				 //ENVIAR POR PARAMETRO UMA VARIAVEL oP = 2, ISSO SIGNIFICA QUE NA CTLCADASTRO PROFESSOR O QUE
				 //SERÁ EXECULTADO É O IF DE EDICAO
				 echo "<form name='frmCadProfessor' method='post' action='../Controller/CtlEditarProfessor.php' >";
			  
			  
			    // foreach($editar as $edit){
			     
					echo"<label name='nome' for='nome'>Nome do professor *:</label><br />";
					echo"<input type='text' id='nome' class='input-div' name='nome' value='".$edit->getNome()."'autofocus='' placeholder='Nome' required='' size='100' /><br />";
				    echo"<input type='hidden' id='codFun' name='codFun' value='".$edit->getId()."' size='2'/><br/>";
					echo"<label name='dataNascimento' for='dataNascimento'>Data Nascimento *:</label><br />";
					echo"<input type='text' class='input-div' name='dataNascimento' id='dataNascimento' value='".$edit->getDataNascimento()."' placeholder='DD/MM/AAAA' size='24'/><br />";
						
					echo"<label name='certidaoNascimento' for='certidaoNascimento'>Certidão de Nascimento:</label><br />";
					echo"<input type='text' class='input-div' id='certidaoNascimento' name='certidaoNascimento' value='".$edit->getCertidaoNascimento()."' placeholder='Número' required='' size='24' /> <br />";
					echo"<label name='rg' for='rg'>RG *:</label><br />";
					echo"<input type='text' class='input-div' id='rg' name='rg' value='".$edit->getRg()."' placeholder='RG' required='' size='24' /> <br />";
					echo"<label name='cpf' for='cpf'>CPF *:</label><br />";
					echo"<input type='text' class='input-div' id='cpf' name='cpf' value='".$edit->getCpf()."' placeholder='CPF' required='' size='24' /> <br />";
					echo"<label name='email' for='email'>Email *:</label><br />";
					echo"<input type='email' class='input-div' id='email' name='email' value='".$edit->getEmail()."' placeholder='EMAIL' required='' size='24' /> <br />";
						
					echo"<label name='sexo' for='sexo'>Sexo * :</label><br />";
                                        
                                        
                                        if($edit->getSexo()==1){
                                            echo"<label name='sexo'  for='sexo'>Masculino</label>";
                                            echo"<input type='radio' class='input-div' name='sexo' class='sexo' value='1' checked='checked' /><br />";
                                            echo"<label name='sexo'  for='sexo'>Feminino </label>";
                                            echo"<input type='radio' class='input-div' name='sexo' class='sexo' value='2' /><br />";
                                        }else{
                                            echo"<label name='sexo'  for='sexo'>Masculino</label>";
                                            echo"<input type='radio' class='input-div' name='sexo' class='sexo' value='1' /><br />";
                                            echo"<label name='sexo'  for='sexo'>Feminino </label>";
                                            echo"<input type='radio' class='input-div' name='sexo' class='sexo' value='2' checked='checked'/><br />";

                                        }
                                        
                                        
                                        
					echo"<label name='reservista' for='reservista'  class='reservista' style='display: none'  >Número da Reservista Militar:</label><br class='reservista' style='display: none' />";
					echo"<input type='text'  id='reservista' name='reservista' value='".$edit->getReservistaMilitar()."' placeholder='' class='reservista input-div' required='' style='display: none' size='24' /> <br class='reservista' style='display: none' />";
					echo"<label name='titulo' for='titulo'>Título Eleitoral *:</label><br />";
					echo"<input type='text' class='input-div' id='titulo' name='titulo' value='".$edit->getTituloEleitoral()."' placeholder='' required='' size='24' /> <br />";
					
			 
					echo"<label name='estadoCivil' for='estadoCivil'>Estado Civil *:</label><br />";
					echo"<select id='estadoCivil' class='input-div' name='estadoCivil' required=''>";
					echo"<option selected value='0'>Selecione</option>";
					   
							include_once '../DataAccess/EstadoCivilDAO.php';
							include_once '../DomainModel/EstadoCivil.php';
							
							$estado = new EstadoCivil();
							$dao = new EstadoCivilDAO();
							
							$estado = $dao->ListarTodos();
							
							foreach ($estado as $i){
								echo "<option value='".$i->getId()."'>".$i->getNome()."</option>";// verificar ddddddddddddddddddddd
							}
								 
								
								
				   echo"</select>";
                                   
                                    //selecionar Automaticamente o combobox estadoCivil
                                   echo"<script type='text/javascript'> $(document).ready(function(){  $('#estadoCivil').val(".$edit->getIdEstado_Civil().")      }) </script>";//select ok
					
					   echo"<label name='tipoSanguineo' for='tipoSanguineo'>Tipo Sanguineo *:</label>";
					   echo"<select id='tipoSanguineo' class='input-div' name='tipoSanguineo' required=''>";
					   echo"<option selected value='0'>Selecione</option>";
					   
					   include_once '../DataAccess/TipoSanguineoDAO.php';
					   include_once '../DomainModel/TipoSanguineo.php';
						
					   $tipo = new TipoSanguineo();
					   $dao = new TipoSanguineoDAO();
						
					   $tipo = $dao->ListarTodos();
						
					   foreach ($tipo as $i){
							echo "<option value='".$i->getId()."'>'".$i->getNome()."'</option>";
					   }
										   
				   echo"</select><br />";
			
                                   //selecionar o combobox TipoSanguineo
                                    echo"<script type='text/javascript'> $(document).ready(function(){  $('#tipoSanguineo').val(".$edit->getIdTipo_Sanguineo().")      }) </script>";//select ok
				
                                    
                                    echo"<br class='divorcio' style='display: none' /><label name='conjugue' for='conjugue' class='divorcio' style='display: none'>Conjugue :</label><br class='divorcio' style='display: none' />";
				   echo"<br class='casado' style='display: none' /><label name='conjugue' for='conjugue' class='casado' style='display: none'>Conjugue :</label><br class='casado' style='display: none' />";
				   
                                   echo"<input type='text'  id='conjugue' name='conjugue' placeholder='Nome ' value='".$edit->getConjugue()."' style='display: none' required='' class='emComum input-div'  size='100'/> <br class='emComum' style='display: none' />";
					
                                   echo"<label name='certidaoCasamentoDivorcio' for='certidaoCasamentoDivorcio' class='divorcio' style='display: none'>Certidão de Divorcio :</label><br class='divorcio' style='display: none' />";
				   echo"<label name='certidaoCasamentoDivorcio' for='certidaoCasamentoDivorcio' class='casado' style='display: none'>Certidão de Casamento :</label><br class='casado' style='display: none' />";
				   
                                   echo"<input type='text' class='emComum input-div' id='certidaoCasamentoDivorcio' value='".$edit->getCertidaoCasamentoDivorcio()."' name='certidaoCasamentoDivorcio' placeholder='Numero ' size='24' style='display: none' required='' class='casado' /> <br class='emComum' style='display: none' />";
					
				   echo"<label name='dataCasamento' for='dataCasamento'  style='display: none' class='divorcio' >Data Divorcio :</label><br class='divorcio' style='display: none' />";
				   echo"<label name='dataCasamento' for='dataCasamento'  style='display: none' class='casado' >Data Casamento :</label><br class='casado' style='display: none' />";
				   
				   echo"<input type='text' class='input-div emComum' value='".$edit->getDataCasamento()."' id='dataCasamento' name='dataCasamento'  style='display: none' size='24' name='dataCasamento' placeholder='DD/MM/AAAA' /><br class='emComum' style='display: none' /> ";
                                   echo "<input type='hidden' id='casadoDivorciado' value='".$edit->getCasadoDivorciado()."' name='casadoDivorciado' />";//verificar 
                                    
                                    
                                    
                                    
                                    
                                    /*
                                    
				   echo"<br class='casado' style='display: none' /><label name='conjugue' for='conjugue' class='casado' style='display: none'>Conjugue :</label><br class='casado' style='display: none' />";
				   echo"<input type='text'  id='conjugue' name='conjugue' value='".$edit->getConjugue()."' placeholder='Nome ' style='display: none' required='' class='casado input-div'  size='100'/> <br class='casado' style='display: none' />";
					
				   echo"<label name='certidaoCasamentoDivorcio' for='certidaoCasamentoDivorcio' class='casado' style='display: none'>Certidão de Casamento :</label><br class='casado' style='display: none' />";
				   echo"<input type='text' class='casado input-div' id='certidaoCasamentoDivorcio'  name='certidaoCasamentoDivorcio' value='".$edit->getCertidaoCasamentoDivorcio()."' placeholder='Numero ' size='24' style='display: none' required='' class='casado' /> <br class='casado' style='display: none' />";
					
					
				   echo"<label name='dataCasamento' for='dataCasamento'  style='display: none' class='casado' >Data Casamento :</label><br class='casado' style='display: none' />";
				   echo"<label name='dataCasamento' for='dataCasamento' style='display: none' class='divorcio' >Data Divórcio :</label><br class='divorcio' style='display: none' />";
				   echo"<input type='text' class='input-div casado' id='dataCasamento' name='dataCasamento' value='".$edit->getDataCasamento()."' class='casado' style='display: none' size='24' name='dataCasamento' placeholder='DD/MM/AAAA' /><br class='casado' style='display: none' /> ";
					
				   */
					
					
				   echo"<label name='nomePai' for='nomePai'>Nome do Pai *:</label><br />";
				   echo"<input type='text' class='input-div' id='nomePai' name='nomePai' value='".$edit->getNomePai()."' placeholder='Nome ' required='' size='100' /> <br />";
				   echo"<label name='nomeMae' for='nomeMae'>Nome da Mãe *:</label><br />";
				   echo"<input type='text' class='input-div' id='nomeMae' name='nomeMae' value='".$edit->getNomeMae()."' placeholder='Nome ' required='' size='100' /> <br />";
					
				   echo"<label name='endereco' for='rua'>Endereço *:</label><br />";
				   echo"<input type='text' class='input-div' id='rua' name='rua' value='".$edit->getEndereco()."' placeholder='Rua ' required='' size='60' /> ";
				   echo"<label name='bairro' for='bairro'>Bairro *:</label>";
				   echo"<input type='text' class='input-div' id='bairro' name='bairro' value='".$edit->getEndBairro()."' placeholder='Bairro ' required='' size='30' /> ";
				   echo"<label name='numero' for='numero'>Número *:</label>";
				   echo"<input type='text' class='input-div' id='numero' name='numero' value='".$edit->getEndNumero()."' placeholder='Número ' required='' /> <br />";
				   echo"<label name='complemento' for='complemento'>Complemento :</label> <br />";
				   echo"<input type='text' class='input-div' id='complemento' name='complemento' value='".$edit->getEndComplemento()."' placeholder='ex: apt,condominio ' size='60'/> <br />";
					
					
				   
				   echo"<label name='estado' for='estado'>Estado *:</label><br />";
				   echo"<select id='estado' class='input-div' name='estado' required=''>";
					   echo"<option selected value='0'>Selecione</option>";
						
						//header('Content-Type: text/html; charset=ISO-8859-1');
						
						ini_set( 'default_charset', 'utf-8');

						include_once '../DataAccess/EstadoDAO.php';
						include_once '../DomainModel/Estado.php';
						
						$tipo = new Estado();
						$dao = new EstadoDAO();
						
						$tipo = $dao->ListarTodos();
						
						foreach ($tipo as $i){
							echo "<option value='".$i->getId()."'>".$i->getNome()."</option>";
						}
							
								
					   
										 
				   echo"</select>";
                                   $edit->getEndCidade(); //pega o id da cidade
                                   include_once '../DataAccess/CidadeDAO.php';
                                   
                                   $cid = new CidadeDAO();
                                   $tmp = new Cidade();
                                   $tmp = $cid->Abrir($edit->getEndCidade());
                                           
                                   //selecionar o combobox Estado
                                    echo"<script type='text/javascript'> $(document).ready(function(){  $('#estado').val(".$tmp->getIdEstado().")  }) </script>";//select ok
				   
                                    // CARREGAR CIDADE POIS O METODO AJAX NAO SUPORTA O CARREGAMENTO AUTOMATICO NA EDICAO
                                    
                                    //$cidadeTmp = new Cidade();
                                    
                                    

                                    $sql = "SELECT * FROM cidade
                                                    WHERE idEstado=".$tmp->getIdEstado()." ORDER BY nome";
                                    $resultado = mysql_query($sql);
                                    $lista = new ArrayObject();
                                    while ($rs = mysql_fetch_array($resultado)) {

                                        $novo = new Cidade();
      
                                        $novo->setId(stripslashes($rs['idCidade']));
                                        $novo->setNome(stripslashes($rs['nome']));
                                        $novo->setIdEstado(stripslashes($rs['idEstado']));
                                        $lista->append($novo);
                                    }
        
        
                                    
                                    
                                    
                                    
                                    
                                    
                                    //Fim do CARREGAMENTO DAS CIDADES
                                    
				   echo"<label name='cidade' for='cidade'>Cidade *:</label>";
				   echo"<span class='carregando' style='color:#666;display:none;'>Aguarde, carregando...</span>";
				   echo"<select id='cidade' class='input-div' name='cidade' required=''>";
					   echo"<option selected value='0'>-- Escolha um estado --</option>";
                                           foreach ($lista as $es){
                                                echo "<option value='".$es->getId()."'>".$es->getNome()."</option>";
                                           }
						 
				   echo"</select><br />";
                                   
                                   echo"<script type='text/javascript'> $(document).ready(function(){  $('#cidade').val(".$edit->getEndCidade().")      }) </script>";//select ok
				   echo"<label name='cep' for='cep'>Cep *:</label><br />";
				   echo"<input type='text' class='input-div' id='cep' name='cep' value='".$edit->getCep()."' placeholder='cep' size='24' required='' /><br />";
				   
					
				echo"</fieldset><br/>";
			  
				  echo"<fieldset>";
					  echo"<legend>Dados do Funcionário</legend>";
					   
					  echo"<label name='numeroSiape' for='numeroSiape'>Numero Siape *:</label><br />";
					  echo"<input type='text' class='input-div' id='numeroSiape' name='numeroSiape' value='".$edit->getNumeroSiape()."' placeholder='' required='' size='24'/> <br />";
					  echo"<label name='numeroPortaria' for='numeroPortaria'>Numero Portaria/Nomeação *:</label><br />";
					  echo"<input type='text' class='input-div' id='numeroPortaria' name='numeroPortaria' placeholder='' value=".$edit->getPortariaNomeacao()." required='' size='24' /> <br />";
					  echo"<label name='dataPosse' for='dataPosse'>Data da Posse *:</label><br />";
					  echo"<input type='text' class='input-div' id='dataPosse' name='dataPosse' placeholder='DD/MM/AAAA'  value='".$edit->getDataPosse()."' required='' size='24' /> <br />";
					  echo"<label name='dataExercicio' for='dataExercicio'>Data de Exercício *:</label><br />";
					  
					  echo"<input type='text' class='input-div' id='dataExercicio' name='dataExercicio' value='".$edit->getDataExercicio()."' placeholder='DD/MM/AAAA' required='' size='24'/> <br />";
					  echo"<label name='portariaFG'  for='portariaFG'>Portaria FG *:</label><br />";
					  echo"<input type='text' class='input-div' id='portariaFG' name='portariaFG' value='".$edit->getPortariaFG()."' placeholder='' required='' size='24' /> <br />";
					  echo"<label name='portariaCD' for='portariaCD'>Portaria CD *:</label><br />";
					  echo"<input type='text' class='input-div' id='portariaCD' name='portariaCD' value='".$edit->getPortariaCD()."' placeholder='' required=''  size='24'/> <br />";
					  
					  echo"<label name='campus' for='campus'>Campus *:</label>";
					  echo"<select id='campus' class='input-div' name='campus' required=''>";
						 echo"<option selected value='0'>Selecione</option>";
					 
						 //header('Content-Type: text/html; charset=ISO-8859-1');
						 //ini_set( 'default_charset', 'utf-8');

						 include_once '../DataAccess/CampusDAO.php';
						 include_once '../DomainModel/Campus.php';

						 $tipo = new Campus();
						 $dao = new CampusDAO();

						 $tipo = $dao->ListarTodos();
						 
						 foreach ($tipo as $i){
							 echo "<option value='".$i->getId()."'>".$i->getNome()."</option>";
						 }

					
										 
				   echo"</select>";
                                   
                                   //selecionar o combobox Campus
                                    echo"<script type='text/javascript'> $(document).ready(function(){  $('#campus').val(".$edit->getIdCampus().")      }) </script>";//select ok
				   
				   echo"<label name='titulacao' for='titulacao'>Titulação *:</label>";
					   echo"<select id='titulacao' class='input-div' name='titulacao' required=''>";
						echo"<option selected value='0'>Selecione</option>";
					   
						 //header('Content-Type: text/html; charset=ISO-8859-1');
						 //ini_set( 'default_charset', 'utf-8');

						 include_once '../DataAccess/TitulacaoDAO.php';
						 include_once '../DomainModel/Titulacao.php';

						 $tipo = new Titulacao();
						 $dao = new TitulacaoDAO();

						 $tipo = $dao->ListarTodos();
						 
						 foreach ($tipo as $i){
							 echo "<option value='".$i->getId()."'>".$i->getNome()."</option> ";
						 }
						
				   echo"</select><br />";
                                   
                                   //selecionar o combobox Campus
                                    echo"<script type='text/javascript'> $(document).ready(function(){  $('#titulacao').val(".$edit->getIdTitulacao().")      }) </script>";//select ok
				   echo"<label name='pendencias' for='pendencias'>Pendências :</label><br/>";
				   echo"<textarea id='pendencias' class='input-div' name='pendencias' value='".$edit->getPendencias()."' cols='125' rows='20'>";
						echo "";
				   echo "</textarea><br />";
			 
				   echo"<input type='submit' id='enviar' class='botao' name='enviar' value='Salvar' />";   
				   echo"<a href=main.php?pagina=frmCadastroP.php&aux=0><input type='button' id='cancelar' name='cancelar' value='Cancelar' class='botao'/></a>";
				
				
				//$edit++;
				//}
				echo "</form>";
		
		}
      echo"</fieldset>";
      ?>
      
      <?php
			//Mensagens de Alerta
			
			//Alerta para sucesso ou fracasso
			if(isset($_GET['msg'])){
				$alerta = $_GET['msg'];
			}else{
				$alerta = 3;
			}
			//Destruindo $_GET['msg']
		    unset($_GET['msg']);
					
			if($alerta == 1){
				$alerta = 3;
				echo "<script type='text/javascript'> 
							alert('Operação realizada com sucesso!');
				      </script>";
			}else{
				if($alerta == 2){
					$alerta = 3;
					echo "<script type='text/javascript'> 
								alert('Ocorreu um erro na operação!');
						  </script>";
				}
		    }
		    //Fim Alerta --------------------
		     
		?>
     
    </body>
</html>
