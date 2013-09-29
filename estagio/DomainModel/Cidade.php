<?php
	class Cidade{
			
		//	ATRIBUTOS
			private $id;
			private $nome;
			private $idEstado; 
			
		
		//Construtores
			
		/*	function __construct($id, $nome){
					$this->id = $id;
					$this->nome = $nome;
			}
		*/
			function __construct(){
					$this->id = 0;
					$this->nome = "";
                                        $this->idEstado = 0;
			}
			
		// Métodos
			
			public function setNome($nome){
					$this->nome =  addslashes($nome);
			}
                        
                        public function setIdEstado($id){
					$this->idEstado = $id;
			}
			
			public function setId($id){
					$this->id = addslashes($id);
			}
			
			public function getNome(){
			
					return $this->nome;
			}
			
			public function getId(){
				
					return $this->id;
			}
                        
                        public function getIdEstado(){
				
					return $this->idEstado;
			}
                        
                        
                        
}





?>
