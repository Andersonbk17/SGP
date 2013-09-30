<?php

include_once 'Conexao.php';
include_once '../DomainModel/Dependente.php';

class DependenteDAO {

    public function inserir(Dependente $obj) {
        $sql = sprintf("INSERT INTO dependente(nome,dataNascimento,sexo,idFuncionario,status)VALUES('%s','%s','%s','%d',1)"
                , $obj->getNome(), $obj->getDataNascimento(), $obj->getSexo(), $obj->getIdFuncionario());
        // echo '<script type="text/javascript" >alert('.$obj->getIdFuncionario().')</script>';
        mysql_query($sql) or die(mysql_error());
    }

    public function alterar(Dependente $obj) {
        $sql = sprintf("UPDATE dependente SET nome='%s',dataNascimento='%s',sexo='%s',idFuncionario='%s' WHERE idDependente = '%s'"
                , $obj->getNome(), $obj->getDataNascimento(), $obj->getSexo(), $obj->getIdFuncionario(), $obj->getId());

        mysql_query($sql) or die(mysql_error());
    }

    public function abrir($id) {
        $sql = "SELECT  * FROM dependente WHERE status = 1 AND idDependente = $id ";
        $novo = new Dependente();

        $rs = mysql_query($sql);
        while ($resultado = mysql_fetch_array($rs)) {
            $novo->setId($resultado['idDependente']);
            $novo->setNome($resultado['nome']);
            $novo->setDataNascimento(implode("/", array_reverse(explode("-", $resultado['dataNascimento']))));
            $novo->setSexo($resultado['sexo']);
            $novo->setIdFuncionario($resultado['idFuncionario']);
            return $novo;
        }
    }

    public function apagar(Dependente $obj) {
        $sql = sprintf("UPDATE dependente SET status = 0 WHERE idDependente = '%s'", $obj->getId());

        mysql_query($sql) or die(mysql_error());
    }

    public function ListarTodos($id) {
        $sql = "SELECT  * FROM dependente WHERE status = 1 AND idFuncionario = " . $id;
        $lista = new ArrayObject();

        $resultado = mysql_query($sql);
        while ($rs = mysql_fetch_array($resultado)) {

            $novo = new Dependente();

            //echo '<script type="text/javascript"> alert("'.$rs['nome'].'")</script>';

            $novo->setId($rs['idDependente']);
            $novo->setNome($rs['nome']);
            $novo->setDataNascimento(implode("/", array_reverse(explode("-", $rs['dataNascimento']))));
            $novo->setSexo($rs['sexo']);
            $novo->setIdFuncionario($rs['idFuncionario']);

            $lista->append($novo);
        }
        return $lista;
    }

}

?>
