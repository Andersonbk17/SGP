<?php
	class Telefone{
		
	//	ATRIBUTOS
		private $id;
		private $numero;
			
	//Construtores
		
		/*function __construct($id, $numero){
				$this->id = $id;
				$this->nome = $numero;
		}
		*/
		
		function __construct(){
				$this->id = 0;
				$this->numero = 0;
		}
		
	// Métodos
		
		public function setNumero($numero){
				$this->numero =  addslashes($numero);
		}
		
		public function setId($id){
				$this->id = addslashes($id);
		}
		
		public function getNumero(){
				return $this->nome;
		}
		
		public function getId(){
				return $this->id;
		}
}

?>
