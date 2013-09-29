<?php
	include_once 'Conexao.php';
	include_once "../DomainModel/Funcionario.php";
        include_once 'TipoSanguineoDAO.php';
        include_once 'EmailDAO.php';
        include_once '../DomainModel/Email.php';
	
        
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
        

	class FuncionarioDAO{
		
            //mysql_insert_id() pegar o ultimo ID
            
		//Inserir
		public function Inserir(Funcionario $obj){
			$sql = sprintf("INSERT INTO Funcionario (nome,rg,reservistaMilitar,tituloEleitoral,dataNascimento,dataCasamento,
                            certidaoNascimento,certidaoCasamentoDivorcio,pendencias,nomePai,nomeMae,cpf,conjuge,idTipo_Sanguineo,idEstado_Civil,
                            sexo,portariaNomeacao,dataPosse,dataExercicio,portariaFG,portariaCD,numeroSiape,idCampus,idTitulacao,endereco,
                            endNumero,endBairro,endComplemento,endCep,idCidade,status
                            ) VALUES('%s','%s','%s','%s','%s','%s','%s','%s',
                            '%s','%s','%s','%s','%s','%d','%d','%s','%s','%s','%s','%s','%s','%s','%d','%d',
                            '%s','%s','%s','%s','%s','%d','%d')",
			$obj->getNome(),
			$obj->getRg(),
			$obj->getReservistaMilitar(),
			$obj->getTituloEleitoral(),
			$obj->getDataNascimento(),
			$obj->getDataCasamento(),
			$obj->getCertidaoNascimento(),
			$obj->getCertidaoCasamentoDivorcio(),
			$obj->getPendencias(),
			$obj->getNomePai(),
			$obj->getNomeMae(),
			$obj->getCpf(),
			$obj->getConjugue(),
			$obj->getIdTipo_Sanguineo(), //FOREING KEY
			$obj->getIdEstado_Civil(), //FOREING KEY
			$obj->getSexo(),
                        $obj->getPortariaNomeacao(),
                        $obj->getDataPosse(),
			$obj->getDataExercicio(),
			$obj->getPortariaFG(),
                        $obj->getPortariaCD(),
			$obj->getNumeroSiape(),
                        $obj->getIdCampus(), //FOREING KEY
			$obj->getIdTitulacao(), //FOREING KEY
			$obj->getEndereco(),
			$obj->getEndNumero(),
			$obj->getEndBairro(),
			$obj->getEndComplemento(),
			$obj->getCep(),
                        $obj->getEndCidade(),
                        1
			);
			
                   //echo $obj->getIdTitulacao();
                   echo $obj->getIdTitulacao();
                        
			mysql_query($sql) or die(mysql_error());
                        
                        $id = mysql_insert_id();
                        $_SESSION['idFuncionario'] = $id;
                        
                        $emailDAO = new EmailDAO();
                        $email = new Email();
                        
                        $email = $obj->getEmail();
                        $email->setIdFuncionario($id);
                        $emailDAO->Inserir($email);
		}
		
		//Atualizar
		public function atualizar(Funcionario $obj){
			$sql = sprintf("UPDATE funcionario SET 
								nome='%s',
								rg='%s',
								reservistaMilitar='%s',
								tituloEleitoral='%s',
								dataNascimento='%s',
								dataCasamento='%s',
								certidaoNascimento='%s',
								certidaoCasamentoDivorcio='%s',
								pendencias='%s',
								nomePai='%s',
								nomeMae='%s',
								cpf='%s',
								conjuge='%s',
								idTipo_Sanguineo='%s',
								idEstado_Civil='%s',
								sexo='%s',
								portariaNomeacao='%s',
								dataPosse='%s',
								dataExercicio='%s',
								portariaFG='%s',
								portariaCD='%s',
								numeroSiape='%s',
								idCampus='%s',
								idTitulacao='%s',
								endereco='%s',
								endNumero='%s',
								endBairro='%s',
								endComplemento='%s',
								endCep='%s',
								idCidade='%s'
							WHERE idFuncionario='%s'",
			
			$obj->getNome(),
			$obj->getRg(),
			$obj->getReservistaMilitar(),
			$obj->getTituloEleitoral(),
			$obj->getDataNascimento(),
			$obj->getDataCasamento(),
			$obj->getCertidaoNascimento(),
			$obj->getCertidaoCasamentoDivorcio(),
			$obj->getPendencias(),
			$obj->getNomePai(),
			$obj->getNomeMae(),
			$obj->getCpf(),
			$obj->getConjugue(),
			$obj->getIdTipo_Sanguineo(), //FOREING KEY
			$obj->getIdEstado_Civil(), //FOREING KEY
			$obj->getSexo(),
            $obj->getPortariaNomeacao(),
            $obj->getDataPosse(),
			$obj->getDataExercicio(),
			$obj->getPortariaFG(),
            $obj->getPortariaCD(),
			$obj->getNumeroSiape(),
            $obj->getIdCampus(), //FOREING KEY
			$obj->getIdTitulacao(), //FOREING KEY
			$obj->getEndereco(),
			$obj->getEndNumero(),
			$obj->getEndBairro(),
			$obj->getEndComplemento(),
			$obj->getCep(),
            $obj->getEndCidade(),
			$obj->getId()
			);
			
			mysql_query($sql) or die(mysql_error());
		}
		
		//Abrir
		public function Abrir($id){
			$sql = "SELECT * FROM funcionario WHERE idFuncionario = $id";
			
			$rs = mysql_query($sql) or die(mysql_error());
			
			while($resultado = mysql_fetch_array($rs)){
				
				$novo = new Funcionario();
				
                                $novo->setCep($resultado['endCep']) ;
                                $novo->setCertidaoCasamentoDivorcio($resultado['certidaoCasamentoDivorcio']);
                                $novo->setCertidaoNascimento($resultado['certidaoNascimento']);
                                $novo->setConjugue($resultado['conjuge']);
                                $novo->setCpf($resultado['cpf']);
                                $novo->setDataCasamento(implode("/",array_reverse(explode("-",$resultado['dataCasamento']))));  
                                $novo->setDataExercicio(implode("/",array_reverse(explode("-",$resultado['dataExercicio']))));
                                $novo->setDataNascimento(implode("/",array_reverse(explode("-",$resultado['dataNascimento']))));
                                $novo->setDataPosse(implode("/",array_reverse(explode("-",$resultado['dataPosse']))));
                                
                                
                                //$novo->setEmail(stripslashes($resultado['email']));
                                $novo->setEndBairro(stripslashes($resultado['endBairro']));
                                $novo->setEndCidade($resultado['idCidade']);
                                $novo->setEndComplemento(stripslashes($resultado['endComplemento']));
                                $novo->setEndNumero(stripslashes($resultado['endNumero']));
                                $novo->setEndereco(stripslashes($resultado['endereco']));
                                $novo->setId($id);
                                $novo->setIdCampus($resultado['idCampus']);
                                $novo->setIdEstado_Civil($resultado['idEstado_Civil']);
                                $novo->setIdTipo_Sanguineo($resultado['idTipo_Sanguineo']);
                                $novo->setIdTitulacao($resultado['idTitulacao']);
                                $novo->setNome(stripslashes($resultado['nome']));
                                $novo->setNomeMae(stripslashes($resultado['nomeMae']));
                                $novo->setNomePai(stripslashes($resultado['nomePai']));
                                $novo->setNumeroSiape(stripslashes($resultado['numeroSiape']));
                                $novo->setPendencias(stripslashes($resultado['pendencias']));
                                $novo->setPortariaCD(stripslashes($resultado['portariaCD']));
                                $novo->setPortariaFG(stripslashes($resultado['portariaFG']));
                                $novo->setPortariaNomeacao(stripslashes($resultado['portariaNomeacao']));
                                $novo->setReservistaMilitar(stripslashes($resultado['reservistaMilitar']));
                                $novo->setRg(stripslashes($resultado['rg']));
                                $novo->setSexo(stripslashes($resultado['sexo']));
                                $novo->setTituloEleitoral(stripslashes($resultado['tituloEleitoral']));
                                
				return $novo;
				
			//}else{
			//	return null;
			}
		}
		
		//Abrir Todos
		public function ListarTodos(){
			$sql = "SELECT * FROM funcionario WHERE status = 1";
			$resultado = mysql_query($sql) or die(mysql_error());;
			$lista = new ArrayObject();
			while($rs = mysql_fetch_array($resultado)){
				
				$n = new Funcionario();
				
				$n->setId(stripslashes($rs['idFuncionario']));
				$n->setNome(stripslashes($rs['nome']));
                                $n->setCpf(stripslashes($rs['cpf']));
                                $n->setNumeroSiape(stripslashes($rs['numeroSiape']));
				
				$lista->append($n);
				
			}
			return $lista;
		}
		
		//Apagar
		public function Apagar($id){
			$sql = sprintf("UPDATE funcionario SET status = 0  WHERE idFuncionario = '%s' ",$id);
			mysql_query($sql) or die(mysql_error());;
		}
                
                
                public function Busca(Funcionario $obj,$ordem){
                    $sql = sprintf("SELECT * FROM funcionario WHERE status = 1 ");
                    
                    $filtro = "";
                    
                               
                    
                    if($obj->getNome() != ""){
                        $filtro = sprintf("AND nome LIKE  '%s%s%s'  ORDER BY nome %s","%",$obj->getNome(),"%",$ordem);
                    }
                    
                    if($obj->getCpf() != ""){
                        $filtro = sprintf("AND cpf = '%s' ORDER BY cpf %s",$obj->getCpf(),$ordem);
                    }
                    
                    if($obj->getId() != 0){
                        $filtro = sprintf("AND idFuncionario = '%d' ORDER BY id %s",$obj->getId(),$ordem);
                    }
                    
                    $sql.=$filtro;
                    
                                     
                    
                        $resultado = mysql_query($sql);
			$lista = new ArrayObject();
			while($rs = mysql_fetch_array($resultado)){
				
				$n = new Funcionario();
				
				$n->setId(stripslashes($rs['idFuncionario']));
				$n->setNome(stripslashes($rs['nome']));
                                $n->setCpf(stripslashes($rs['cpf']));
                                $n->setNumeroSiape(stripslashes($rs['numeroSiape']));
                                
                                //continua ......
                                $lista->append($n);
				
			}
			return $lista;
                        
		}
		
		
	
	}
        
?>
