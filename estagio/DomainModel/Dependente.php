<?php

	class Dependente{
		
			//Atributos
			
			private $id;
			private $nome;
			private $dataNascimento;
			private $sexo;
			private $idFuncionario; 
			
			
			//Construtores
			
			public function __Construct(){
				$this->id = 0;
				$this->nome = "";
				$this->dataNascimento = "";
				$this->idFuncionario = 0;
			}
			
			
			
			//Métodos
			
			public function setId($id){
				$this->id = $id;
			}
			
			public function setNome($nome){
					$this->nome = addslashes($nome);
			}
			
			public function setDataNascimento ($dataNascimento){
					$this->dataNascimento = $dataNascimento;
			}
			
			public function setSexo($sexo){
					$this->sexo = addslashes($sexo);
			}
			
			public function setIdFuncionario($idFuncionario){
					$this->idFuncionario = $idFuncionario;
			}
			
			public function getId(){
                            return $this->id;
			}
			
			public function getNome(){
					return $this->nome;
			}
			
			public function getDataNascimento(){
					return $this->dataNascimento;
			}
		
			public function getSexo(){
					return $this->sexo;
			}
			
			public function getIdFuncionario(){
					return $this->idFuncionario;
			}
				
	}

?>
