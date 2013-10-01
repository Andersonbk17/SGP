<?php

include_once 'Conexao.php';
include_once '../DomainModel/Afastamento.php';

class AfastamentoDAO {

    public function inserir(Afastamento $obj) {
        $sql = sprintf("INSERT INTO afastamento(dataInicio,dataTermino,motivo,status,idFuncionario) VALUES('%s','%s','%s',1,'%d')"
                , $obj->getDataInicio(), $obj->getDataTermino(), $obj->getMotivo(), $obj->getIdFuncionario());

        mysql_query($sql) or die(mysql_error());
    }

    public function alterar(Afastamento $obj) {
        $sql = sprintf("UPDATE afastamento SET dataInicio='%s',dataTermino='%s',motivo='%s',idFuncionario='%d' WHERE idAfastamento = '%s'"
                , $obj->getDataInicio(), $obj->getDataTermino(), $obj->getMotivo(), $obj->getIdFuncionario(), $obj->getIdAfastamento());

        mysql_query($sql) or die(mysql_error());
    }

    public function abrir($id) {
        $sql = "SELECT  * FROM afastamento WHERE status = 1 AND idAfastamento = $id ";
        $novo = new Afastamento();

        $rs = mysql_query($sql);
        while ($resultado = mysql_fetch_array($rs)) {
            $novo->setIdAfastamento(stripslashes($resultado['idAfastamento']));
            $novo->setMotivo(stripslashes($resultado['motivo']));
            $novo->setDataInicio(implode("/", array_reverse(explode("-", $resultado['dataInicio']))));
            $novo->setDataTermino(implode("/", array_reverse(explode("-", $resultado['dataTermino']))));
            $novo->setIdFuncionario($resultado['idFuncionario']);
            return $novo;
        }
    }

    public function apagar(Afastamento $obj) {
        $sql = sprintf("UPDATE afastamento SET status = 0 WHERE idAfastamento = %s", $obj->getIdAfastamento());

        mysql_query($sql) or die(mysql_error());
    }

    public function ListarTodos($id) {
        $sql = "SELECT  * FROM afastamento WHERE status = 1 AND idFuncionario = $id";
        $lista = new ArrayObject();

        $resultado = mysql_query($sql);
        while ($rs = mysql_fetch_array($resultado)) {

            $novo = new Afastamento();

            // echo '<script type="text/javascript"> alert("'.$rs['motivo'].'")</script>';

            $novo->setIdAfastamento($rs['idAfastamento']);
            $novo->setMotivo(stripslashes($rs['motivo']));
            $novo->setDataInicio(implode("/", array_reverse(explode("-", $rs['dataInicio']))));
            $novo->setDataTermino(implode("/", array_reverse(explode("-", $rs['dataTermino']))));
            $novo->setIdFuncionario($rs['idFuncionario']);

            $lista->append($novo);
        }
        return $lista;
    }

}

?>
