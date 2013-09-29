<?php
    class Estado{
        
        //Atributos
        private $nome;
        private $id;
        private $sigla;
        
	
	//Construtores
		
		/*public function __construct($id, $nome,$sigla){
				$this->id = $id;
				$this->nome = $nome;
				$this->sigla = $sigla;
		}
		*/
		
		public function __construct(){
				$this->id = 0;
				$this->nome = "";
				$this->sigla = "";
		}
		
	// Métodos
		
		public function setNome($nome){
				$this->nome =  addslashes($nome);
		}
		
		public function setId($id){
				$this->id = addslashes($id);
		}
		
		public function setSigla($sigla){
				$this->sigla = addslashes($sigla);
		}
		
		public function getNome(){
		
				return $this->nome;
		}
		
		public function getId(){
			
				return $this->id;
		}
		
		public function getSigla(){
			
				return $this->sigla;
		}
        
        
        
    }
?>
