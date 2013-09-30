<?php

    include_once 'Conexao.php';
    include_once '../DomainModel/Usuario.php';

    class UsuarioDAO {

        function __construct() {

        }

        public function abrir($id) {
            $sql = "SELECT  * FROM usuario WHERE status = 1 AND idUsuario =  $id ";
            $novo = new Usuario();

            $rs = mysql_query($sql);
            while ($resultado = mysql_fetch_array($rs)) {
                $novo->setId(stripslashes($resultado['idUsuario']));
                $novo->setUsuario(stripslashes($resultado['usuario']));
                $novo->setSenha(stripcslashes($resultado['senha']));
                $novo->setNivel(stripcslashes($resultado['nivel']));
                $novo->setIdFuncionario($resultado['idFuncionario']);
                return $novo;
            }
        }

        public function inserir($obj) {
            $sql = sprintf("INSERT INTO usuario(usuario,senha,nivel,idFuncionario,status) VALUES('%s','%s','%d','%d',1)", $obj->getUsuario(), $obj->getSenha(), $obj->getNivel(), $obj->getIdFuncionario());
            mysql_query($sql)
                    OR die(mysql_error());
        }

        public function atualizar(Usuario $obj) {
            $sql = sprintf("UPDATE usuario SET usuario='%s',senha='%s',nivel='%s',idFuncionario='%s' WHERE idUsuario = '%s' ", $obj->getUsuario(), $obj->getSenha(), $obj->getNivel(), $obj->getIdFuncionario(), $obj->getId());
            mysql_query($sql)
                    OR die(mysql_error());
        }

        public function apagar(Usuario $obj) {
            $sql = sprintf("UPDATE usuario SET status = 0 WHERE idUsuario = '%s' ", $obj->getId());
            mysql_query($sql)
                    OR die(mysql_error());
        }

        public function ListarTodos() {

            $sql = "SELECT  * FROM usuario WHERE status = 1";
            $lista = new ArrayObject();

            $resultado = mysql_query($sql);

            while ($rs = mysql_fetch_array($resultado)) {

                $novo = new Usuario();

                $novo->setId(stripslashes($rs['idUsuario']));
                $novo->setUsuario(stripslashes($rs['usuario']));
                $novo->setSenha(stripslashes($rs['senha']));
                $novo->setNivel(stripslashes($rs['nivel']));
                $lista->append($novo);
            }
            return $lista;
        }

    }

?>
