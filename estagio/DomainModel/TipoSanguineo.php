<?php

	class TipoSanguineo{
		
	//	ATRIBUTOS
		private $id;
		private $nome;
		
	
	//Construtores
		
		/*public function __construct($id, $nome){
				$this->id = $id;
				$this->nome = $nome;
		}
		*/
		
		public function __construct(){
				$this->id = 0;
				$this->nome = "";
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
		
	
		
}


?>
