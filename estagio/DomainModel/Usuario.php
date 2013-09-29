<?php

class Usuario {
    private $id;
    private $usuario;
    private $senha;
    private $nivel;
    private $idFuncionario;
    
    function __construct() {
        $this->id = 0;
        $this->usuario = "";
        $this->senha = "";
        $this->nivel = 0;
        $this->idFuncionario = 0;
    }

    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = addslashes($id);
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = addslashes($usuario);
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = addslashes($senha);
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function setNivel($nivel) {
        $this->nivel = addslashes($nivel);
    }

    public function getIdFuncionario() {
        return $this->idFuncionario;
    }

    public function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = addslashes($idFuncionario);
    }


}

?>
