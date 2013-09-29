<?php
	class Email{
		
	//	ATRIBUTOS
		private $id;
		private $nome;
                private $idFuncionario;
		
	
	//Construtores
		
		/*function __construct($id, $nome){
				$this->id = $id;
				$this->nome = $nome;
		}
		*/
		
		function __construct(){
				$this->id = 0;
				$this->nome = "";
                                $this->idFuncionario = 0;
		}
		
	// Métodos
		
		public function setNome($nome){
				$this->nome =  addslashes($nome);
		}
		
		public function setId($id){
				$this->id = $id;
		}
		
		public function getNome(){
		
				return $this->nome;
		}
		
		public function getId(){
			
				return $this->id;
		}
                
                public function getIdFuncionario() {
                    return $this->idFuncionario;
                }

                public function setIdFuncionario($idFuncionario) {
                    $this->idFuncionario = $idFuncionario;
                }


}




?>
