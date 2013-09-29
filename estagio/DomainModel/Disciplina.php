<?php
	class Disciplina{
		
		//	Atributos
			private $id;
			private $nome;
			private $sigla;
			private $cargaHoraria;

		//Construtores
		
		/*function __construct($id, $numero,$sigla,$caraHoraria){
				$this->id = $id;
				$this->nome = $numero;
				$this->sigla = $sigla;
				$this->cargaHoraria = $cargaHoraria;
		}
		*/
		
		function __construct(){
				$this->id = 0;
				$this->nome = 0;
				$this->sigla = "";
				$this->cargaHoraria = "";
		}
		
		//Métodos
		
		public function setId($id){
				$this->id = $id;
		}
		
		public function setNome($nome){
				$this->nome = addslashes($nome);
		}
		
		public function setSigla($sigla){
				$this->sigla = addslashes($sigla);
		}
		
		public function setCargaHoraria($cargaHoraria){
				$this->cargaHoraria = addslashes($cargaHoraria);
		}
		
		public function getId(){
				return $this->id;
		}
		
		public function getNome(){
				return $this->nome;
		}
		
		public function getSigla(){
				return $this->sigla;
		}
		
		public function getCargaHoraria(){
				return $this->cargaHoraria;
		}
		
	}

?>
