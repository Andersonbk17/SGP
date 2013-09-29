<?php

	class Area{
	
	//Atributos	
		private $id;
		private $nome;
		
	//Construtores
		public function __construct(){
			$this->id = 0;
			$this->nome = "";
		}
	/*	public function __construct($id,$nome){
				$this->id = $id;
				$this->nome = $nome;
			
		}
	*/
	
	//Métodos
	
		public function setId($id){
				$this->id = $id;
		}
		public function setNome($nome){
				$this->nome = $nome;
		}
		
		public function getId(){
				return $this->id;
		}
		public function getNome(){
				return $this->nome;
		}
		
		
}


?>
