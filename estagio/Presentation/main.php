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



<!DOCTYPE html>
	<!-- Script google analytics-->      
	<?xml version="1.0" encoding="utf-8"?>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br" dir="ltr" >
	<!-- Inicio Cabeçalho-->
	
	<head>
		<meta content="a48fec2b6408b751a761af6d5b34d25513e11d23a3700fd249ac3c4cdf1c2555" name="asa.br"/> 
		<base href="">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="IFNMG, Federal, Educação, Ensino, Técnico, Médio, Superior" />
		<meta name="description" content="Portal do Instituto Federal do Norte de Minas Gerais IFNMG. Ensino medio, técnico e Superior oferecidos por todo o grande Norte de Minas" />
		<meta name="generator" content="Joomla! - Open Source Content Management" />
		<title>Inicio</title>
		<link href="http://www.ifnmg.edu.br/templates/ifnmg2.0/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		<link href="http://www.ifnmg.edu.br/component/search/?Itemid=283&amp;format=opensearch" rel="search" title="Buscar Portal IFNMG" type="application/opensearchdescription+xml" />
	
		<meta property="og:url" content="http://www.ifnmg.edu.br/januaria/historico"/>
		<meta property="og:title" content="Breve hist&oacute;rico Campus Janu&aacute;ria"/>
		<meta property="og:description" content="Portal do Instituto Federal do Norte de Minas Gerais IFNMG. Ensino medio, técnico e Superior oferecidos por todo o grande Norte de Minas"/>
		<meta property="og:locale" content="pt_BR"/>
		<meta property="og:site_name" content="Portal IFNMG"/>
		<meta property="fb:admins" content=""/>
		<meta property="fb:app_id" content=""/>

		<link rel="stylesheet" href="http://www.ifnmg.edu.br/templates/ifnmg2.0/css/template.css" type="text/css" />   
		<link rel="alternate stylesheet" href="http://www.ifnmg.edu.br/templates/ifnmg2.0/css/template-contraste.css" type=" text/css" title="Contraste"/>      
		<script type="text/javascript" src="http://www.ifnmg.edu.br/templates/ifnmg2.0/javascript/acessibilidade.js"></script>  
		<script type="text/javascript" src="http://www.ifnmg.edu.br/templates/ifnmg2.0/javascript/jquery.js"></script>  
		<script type="text/javascript" src="http://www.ifnmg.edu.br/templates/ifnmg2.0/javascript/menu.js"></script>
		<script type="text/javascript" src="http://www.ifnmg.edu.br/templates/ifnmg2.0/javascript/jquery-1.5-min.js"></script>
		<script type="text/javascript" src="http://www.ifnmg.edu.br/templates/ifnmg2.0/javascript/jquery-ui-1.8-min.js"></script>
		<script type="text/javascript" src="http://www.ifnmg.edu.br/templates/ifnmg2.0/javascript/jquery.accordion.js"></script>
		<script type="text/javascript" src="http://www.ifnmg.edu.br/templates/ifnmg2.0/javascript/jquery.cycle.lite.js"></script>     
	<script language="JavaScript" type="text/javascript">        
     $(function() {  
        $('.bannergroup_central').cycle({ 
            fx:     'fade', 
            speed:  1000, 
            timeout: 3000,
            pause:  1    });
        $('#pauseBotao').click(function() {
            $('.bannergroup_central').cycle('pause');
        });
        $('#nextBotao').click(function() {
            $('.bannergroup_central').cycle('next');
        });
        $('#prevBotao').click(function() {
            $('.bannergroup_central').cycle('prev');
        });


       $('.bannergroup_lateral').cycle({ 
            fx:     'fade', 
            speed:  1000,
            timeout: 5000,
            pause:  1    });
        $('#pauseBotao').click(function() {
            $('.bannergroup_lateral').cycle('pause');
        });
        $('#nextBotao').click(function() {
            $('.bannergroup_lateral').cycle('next');
        });
        $('#prevBotao').click(function() {
            $('.bannergroup_lateral').cycle('prev');
        });

     });                
  </script>
  <!-- Inicio Script google analytics--> 
   
              <script type="text/javascript" >
                var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-21301401-1']);
      _gaq.push(['_trackPageview']);
      (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
            </script>
          <!-- Fim Script google analytics-->  
    </head>
<!-- Fim Cabeçalho-->
<!-- Inicio Corpo do Site-->
    <body>  
     <!-- Inicio Portal-->            
        <div class="portal"  align="center">       
            <!-- Inicio barra do Governo-->   
            <div id="barra-brasil-v3">
              <div id="barra-brasil">
                <div class="barra">
                  <ul>
                    <li><a href="http://www.acessoainformacao.gov.br" class="ai" title="Acesso à informação"></a><span style="display:none;">Acesso à informação</span></li>
                    <li><a href="http://www.brasil.gov.br" class="brasilgov" title="Portal de Estado do Brasil"></a><span style="display:none;">Portal de Estado do Brasil</span></li>
                  </ul>
                </div>
              </div>         
            </div>
            <!-- Fim barra do Governo-->  
            <!-- Inicio Topo--> 
            <div id="topo">  
            <!-- Inicio Barra de Acessibilidade-->
                <div id="topo-acess">
                    <ul id="acess">
                        <li id="aumentar-letra"> <a href="#" title="Aumentar letra" id="fonte-maior" onclick="changeFontSize(2); return false;">Aumentar letra</a> </li>
                        <li id="diminuir-letra"> <a href="#" title="Diminuir letra" id="fonte-menor" onclick="changeFontSize(-2); return false;">Diminuir letra</a> </li>
                        <li id="tamanho-normal"> <a href="#" title="Tamanho normal" id="fonte-normal" onclick="revertStyles(); return false;">Tamanho normal</a>  </li>
                        <li id="alto-contraste"> <a href="#" title="Mudar contraste" id="contraste" onclick="contraste(); return false;">Mudar contraste</a>  </li>     
                    </ul>            
                </div>
            <!-- Fim Barra de Acessibilidade-->
            <div id="topo-logo">
                <img src="http://www.ifnmg.edu.br/templates/ifnmg2.0/images/logo-ifnmg.png">
            </div>
           
            <!-- Inicio Menu-->                               
            <div id="nav">          
				<ul class="layouts level-1 menuDinamico">
					<li class="open"><a href="#" >Home</a></li>
					<!-- Inicio Menu Dinamico -->
					<li class="open">
						<a class=" menuDinamico" href="" >Cadastros</a>
						<ul class="layouts level-2">
                                                    
							<li class="open"><a href="main.php?pagina=frmCadastroAfastamento.php" >Afastamentos</a></li>
                                                        <li class="open"><a href="main.php?pagina=frmCadastroArea.php" >Áreas</a></li>
                                                        <li class="open"><a href="main.php?pagina=frmCadastroCampus.php" >Campus</a></li>
                                                        <li class="open"><a href="main.php?pagina=frmCadastroCurso.php" >Curso</a></li>
														<li class="open"><a href="main.php?pagina=frmCadastroTitulacao.php" >Titulação</a></li>
                                                        <li class="open"><a href="main.php?pagina=frmCadastroDisciplina.php" >Disciplina</a></li>
                                                        <li class="open"><a href="main.php?pagina=frmCadastroDependente.php" >Dependente</a></li>
                                                        <li class="open"><a href="main.php?pagina=frmCadastroP.php" >Professor</a></li>
                                                         <li class="open"><a href="main.php?pagina=frmCadastroProgressaoCarreira.php">Progressão Carreira</a></li>
                                                        <li class="open"><a href="main.php?pagina=frmCadastroUsuario.php">Usuários</a></li>
                                                       
						</ul>
					</li>
					<!-- Fim Menu Dinamico -->
					<!-- Inicio Menu Dinamico -->
					<!--
                                        <li class="open">
						<a class=" menuDinamico" href="" >Listagens</a>
						<ul class="layouts level-2">
							<li class="open"><a href="#" ></a></li>
							<li class="open"><a href="#" >Sub Item 2.2</a></li>
							<li class="open"><a href="#" >Sub Item 2.3</a></li>
							<li class="open"><a href="#" >Sub Item 2.4</a></li>
						</ul>
					</li>
                                        -->
					
					<!-- Fim Menu Dinamico -->
					<!-- Inicio Menu Dinamico -->
					<li class="open">
                                            <a  href="logout.php" >Sair</a>
						<!--<ul class="layouts level-2">
							<li class="open"><a href="#" >Sub Item 10.1</a></li>
							<li class="open"><a href="#" >Sub Item 10.2</a></li>
							<li class="open"><a href="#" >Sub Item 10.3</a></li>
							<li class="open"><a href="#" >Sub Item 10.4</a></li>
						</ul>
                                               -->
					</li>
					<!-- Fim Menu Dinamico -->
				</ul>
            </div>  
            <!-- Fim Menu--> 
            </div>         
        <!-- Fim Topo--> 
        
		<!-- inicio corpo-->    
        <div id="conteudo">  

            <!-- inicio menu vertical -->
            <!--
            <div id="menu" class="nav-menu" >    
				<ul class="layouts level-1 menuDinamico">
					<li class="open"><a class="open menuDinamico" href="#" >Item Menu 8</a>
					<ul class="layouts level-2">
						<li class="open"><a href="#" >Sub Item Menu 8</a></li>
						<li class="open"><a href="#" >Sub Item Menu 8</a></li>
						<li class="open"><a href="#" >Sub Item Menu 8</a></li>
						<li class="open"><a href="#" >Sub Item Menu 8</a></li>
						<li class="open"><a href="#" >Sub Item Menu 8</a></li>
					</ul>
					
					<li class="open"><a class="nivel_1_sem_seta" href="#" >Item Menu 9</a>
					<li class="open"><a class="nivel_1_sem_seta" href="#" >Item Menu 10</a>
					<li class="open"><a class="nivel_1_sem_seta" href="#" >Item Menu 11</a>
				
					<li class="open"><a class="open menuDinamico" href="#" >Item Menu 12</a>
						<ul class="layouts level-2">
							<li class="open"><a href="#" >Sub Item Menu 12</a></li>
							<li class="open"><a href="#" >Sub Item Menu 12</a></li>
							<li class="open"><a href="#" >Sub Item Menu 12</a></li>
							<li class="open"><a href="#" >Sub Item Menu 12</a></li>
							<li class="open"><a href="#" >Sub Item Menu 12</a></li>
						</ul>
				</ul>	
            </div>  
            -->
            <!-- Fim menu vertical -->
                
            <!-- Inicio localização -->
        
				<div class="colunaMeio">
					<div id="fundoColunaMeio">   
						<div class="moduletable">					
							<div class="breadcrumbs">
								<span class="showHere">Você está aqui: </span>
                                                                  <span class="showHere">Usuário [ <b><?php echo $_SESSION['usuarioNome']?> </b>] você está aqui: </span>
								<a href="#" class="pathway">Início</a>
								<img src="http://www.ifnmg.edu.br/media/system/images/arrow.png" alt=""/>
								<span>Inicio</span>
							</div>
						</div>
					</div>                               
				</div>
           
            <!-- Fim localização -->
                   
            <!-- Inicio Conteudo-->  
            <style type="text/txt">
            #Est{
				float: left;
				width:-550px;
				height:-500px;
				margin-top:-255px;
				margin-left:-250px;
				margin-right:-250px;
			}
            </style>
             
            <div class="Est">             
                  <?php
                        
                    if(isset($_GET['pagina'])){
                        //$pagina = $_GET['pagina'];
                        include $_GET['pagina'];
                        
                    }
                  
                  ?>
                         
            </div>
            <!-- Fim Conteudo-->  
                                
        </div>                              
        <!-- Fim Corpo--> 
             
        <!-- Inicio do Acesso Rapido-->
                    <div id="acessoRapido">  
						<div class="custom"  >
							<p style="text-align: center;">
								<a title="CNPq" href="http://www.cnpq.br/">
									<img title="CNPq" alt="CNPq" src="http://www.ifnmg.edu.br/arquivos/2012/reitoria/Estrutura/0000009677-cnpq.png" height="57" width="148" />
								</a>
								<a title="Domínio Público" href="http://www.dominiopublico.gov.br/pesquisa/PesquisaObraForm.jsp">
									<img title="Dominio Público" alt="Dominio Público" src="http://www.ifnmg.edu.br/arquivos/2012/reitoria/Estrutura/0000009677-dominio_publico.png" height="57" width="148" /></a>
								<a title="Periodicos" href="http://www.periodicos.capes.gov.br/">
									<img title="Periodicos" alt="Periodicos" src="http://www.ifnmg.edu.br/arquivos/2012/reitoria/Estrutura/0000009677-periodicos.png" height="57" width="148" /></a>
								<a title="Portal da Transparência" href="http://www3.transparencia.gov.br/TransparenciaPublica/index.jsp?CodigoOrgao=26410&amp;TipoOrgao=2&amp;consulta=0">
									<img title="Portal da Transparência" alt="Portal da Transparência" src="http://www.ifnmg.edu.br/arquivos/2012/reitoria/Estrutura/0000009677-Portal_transparencia.png" height="57" width="148" /></a>
								<a title="Siape Net" href="http://www.siapenet.gov.br/Portal/Servico/Apresentacao.asp">
									<img title="Siape.net" alt="Siape.net" src="http://www.ifnmg.edu.br/arquivos/2012/reitoria/Estrutura/0000009677-siape.png" height="57" width="148" /></a>
								<a title="Melhores Práticas" href="http://melhorespraticas.mec.gov.br/">
									<img title="Melhores Práticas" alt="Melhores Práticas" src="http://www.ifnmg.edu.br/arquivos/2012/reitoria/Estrutura/0000009677-melhores_praticas.png" height="57" width="148" /></a>
							</p>
						</div>
                    </div>    
             <!-- Fim do Acesso Rapido-->
                
             <!-- Inicio do rodapé-->
                    <div id="rodape">
                        <ul>
                            <li>
								<div class="custom"  >
									<p style="text-align: center;">
										Fazenda São Geraldo, S/N Km 06 - 39480-000 - Januária /MG<br />Fone: (38) 3629-4600 - E-mail: 
									</p>
								</div>
                            </li>               
                        </ul>                            
                    </div>            
              <!-- Fim do rodapé-->  
              </div>
            <!-- fim  Coluna Meio -->        
            </div>
        <!-- fim  Conteudo -->
        </div>
    <!-- Fim Portal-->
    </body>
<!-- Fim Corpo do Site-->
</html>
