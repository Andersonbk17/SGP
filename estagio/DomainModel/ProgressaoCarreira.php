<?php
	class ProgressaoCarreira{
		
			//Atributos
			
			private $id;
			private $dataProgressao;
			private $descricaoNivelCategoria;
			private $idfuncionario; // verificar
			
			//Construtores
			
			public function ProgressaoCarreira(){
					$this->id = 0;
					$this->dataProgressao = "";
					$this->descricaoNivelCategoria = "";
					$this->idfuncionario = 0;
			}
			
			
			public function setId($id){
					$this->id = addslashes($id);
			}
			
			public function setDataProgressao($dataProgressao){
					$this->dataProgressao = $dataProgressao;
			}
			public function setDescricaoNivelCategoria($descricaoNivelCategoria){
					$this->descricaoNivelCategoria = addslashes($descricaoNivelCategoria);
			}
			
			public function getId(){
					return $this->id;
			}
			
			public function getDataProgressao(){
					return $this->dataProgressao;
			}
			
			public function getDescricaoNivelCategoria(){
				return stripslashes($this->descricaoNivelCategoria);
			}
			public function getIdfuncionario() {
                            return $this->idfuncionario;
                        }

                        public function setIdfuncionario($idfuncionario) {
                            $this->idfuncionario = $idfuncionario;
                        }


	
	}

?>
