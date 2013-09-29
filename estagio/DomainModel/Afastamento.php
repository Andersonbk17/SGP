<?php
    class Afastamento{
        
        private $idAfastamento;
        private $dataInicio;
        private $dataTermino;
        private $motivo;
        private $idFuncionario;
        
        
        public function __construct(){
			$this->idAfastamento =0;
			$this->dataInicio = "";
                        $this->dataTermino = "";
                        $this->motivo = "";
                        $this->idFuncionario = 0;
	}
        
        public function getIdAfastamento() {
            return $this->idAfastamento;
        }

        public function setIdAfastamento($idAfastamento) {
            $this->idAfastamento = $idAfastamento;
        }

        public function getDataInicio() {
            return $this->dataInicio;
        }

        public function setDataInicio($dataInicio) {
            $this->dataInicio = $dataInicio;
        }

        public function getDataTermino() {
            return $this->dataTermino;
        }

        public function setDataTermino($dataTermino) {
            $this->dataTermino = $dataTermino;
        }

        public function getMotivo() {
            return stripslashes($this-> motivo);
        }

        public function setMotivo($motivo) {
            $this->motivo = $motivo;
        }

        public function getIdFuncionario() {
            return $this->idFuncionario;
        }

        public function setIdFuncionario($idFuncionario) {
            $this->idFuncionario = $idFuncionario;
        }


        
    }
?>
