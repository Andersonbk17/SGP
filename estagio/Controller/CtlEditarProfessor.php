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

<?php
    
    include_once '../DataAccess/FuncionarioDAO.php';
    include_once '../DomainModel/Funcionario.php';
    include_once '../DomainModel/Email.php';
    
	if(isset($_GET['oP'])){
		$op = $_GET['oP'];
	}else{
		$op = 1;
	}
    if($op == 1){
	
	$codfun = $_POST['codFun'];
    $nome = $_POST['nome'];
    $dataNascimento = implode("-",array_reverse(explode("/",$_POST['dataNascimento'])));
    $certidaoNascimento = $_POST['certidaoNascimento'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $sexo = $_POST['sexo'];
    
    $tituloEleitor = $_POST['titulo'];
    $estadoCivil = $_POST['estadoCivil'];
    
    
    $dataCasamento = implode("-",array_reverse(explode("/",$_POST['dataCasamento'])));
    $tipoSanguineo = $_POST['tipoSanguineo'];
    $nomePai = $_POST['nomePai'];
    $nomeMae = $_POST['nomeMae'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $numeroSiape = $_POST['numeroSiape'];
    $numeroPortaria =  $_POST['numeroPortaria'];
    //$data = implode("-",array_reverse(explode("/",$data)));
    $dataPosse = implode("-",array_reverse(explode("/",$_POST['dataPosse'])));
    $dataExercicio = implode("-",array_reverse(explode("/",$_POST['dataExercicio'])));
    $portariaFG = $_POST['portariaFG'];
    $portariaCD = $_POST['portariaCD'];
    $campus = $_POST['campus'];
    $titulacao = $_POST['titulacao'];
    $pendencias = $_POST['pendencias'];
    
    
    
    $conjugue = $_POST['conjugue'];
   
    
    if(isset($_POST['conjugue'])){
        $conjugue = $_POST['conjugue'];
    }else{
        $conjugue = "null";
    }
    
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $email = "null";
    }
    
    
    if(isset($_POST['reservista'])){
        $reservista = $_POST['reservista'];
    }else{
        $reservista = "null";
    }
    
    
    
    
    
    if(isset($_POST['certidaoCasamentoDivorcio'])){
        $certidaoDivorcio = $_POST['certidaoCasamentoDivorcio'];
    }else{
        $certidaoDivorcio = "null";
    }
    
    $funcionario = new Funcionario();
    $dao = new FuncionarioDAO();
    
    
    //$funcionario->setCertidaoCasamentoDivorcio($certidaoCasamentoDivorcio);
    $funcionario->setCertidaoNascimento($certidaoNascimento);
    if($certidaoDivorcio == ""){
        $certidaoDivorcio = "null";
        $funcionario->setCertidaoCasamentoDivorcio($certidaoDivorcio);
    }else{
        $funcionario->setCertidaoCasamentoDivorcio($certidaoDivorcio);
    }
    
    
    
    if($complemento == ""){
        $complemento = "null";
        $funcionario->setEndComplemento($complemento);
    }else{
        $funcionario->setEndComplemento($complemento);
    }
    
    if($conjugue == ""){
        $conjugue = "null";
        $funcionario->setConjugue($conjugue);
    }else{
        $funcionario->setConjugue($conjugue);
    }
    
    $funcionario->setCpf($cpf);
    if($dataCasamento == ""){
        $dataCasamento = "null";
        $funcionario->setDataCasamento($dataCasamento);
    }else {
        $funcionario->setDataCasamento($dataCasamento);
    }
    
	$funcionario->setId($codfun);
    $funcionario->setDataExercicio($dataExercicio);
    $funcionario->setDataNascimento($dataNascimento);
    $funcionario->setDataPosse($dataPosse);
    $funcionario->setEndBairro($bairro);
    $funcionario->setEndCidade($cidade);
    $funcionario->setEndNumero($numero);
    $funcionario->setEndereco($rua);
    $funcionario->setNome($nome);
    $funcionario->setNomePai($nomePai);
    $funcionario->setNomeMae($nomeMae);
    $funcionario->setNumeroSiape($numeroSiape);
    $funcionario->setPendencias($pendencias);
    $funcionario->setPortariaCD($portariaCD);
    $funcionario->setPortariaFG($portariaFG);
    $funcionario->setPortariaNomeacao($numeroPortaria);
    $funcionario->setIdTipo_Sanguineo($tipoSanguineo);
    $funcionario->setIdEstado_Civil($estadoCivil);
    $funcionario->setCep($cep);
    $funcionario->setIdCampus($campus);
    $funcionario->setIdTitulacao($titulacao);
    if($reservista == ""){
        $reservista = "null";
        $funcionario->setReservistaMilitar($reservista);
    }else{
        $funcionario->setReservistaMilitar($reservista);
    }
    $funcionario->setRg($rg);
    $funcionario->setSexo($sexo);
    $funcionario->setTituloEleitoral($tituloEleitor);
    
    $Email_ = new Email();
    $Email_->setNome($email);
    
    
    $funcionario->setEmail($Email_);
    
    if($dao->atualizar($funcionario)){
       echo '<script type="text/javascript"> alert("Erro")</script>';
    }  else {
         echo '<script type="text/javascript"> alert("Atualizado com Sucesso !"); window.location="../Presentation/main.php?pagina=frmCadastroP.php";</script>';
        
    }
	
	}else{
		$dao = new FuncionarioDAO();
		$id = $_GET['cod'];
		if($dao->Apagar($id)){
		    echo '<script type="text/javascript"> alert("Erro")</script>';
		}else {
			echo '<script type="text/javascript"> alert("Excluido com Sucesso !"); window.location="../Presentation/main.php?pagina=frmCadastroP.php";</script>';
        }
	}
	
	
?>
