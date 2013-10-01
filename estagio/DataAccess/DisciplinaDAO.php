<?php

include_once ("Conexao.php");
include_once ("../DomainModel/Disciplina.php");

class DisciplinaDAO {

    public function Abrir($id) {
        $sql = sprintf("SELECT * FROM disciplina WHERE idDisciplina = %s AND status = 1", $id);
        $lista = new ArrayObject();

        $resultado = mysql_query($sql);
        while ($rs = mysql_fetch_array($resultado)) {

            $novo = new Disciplina();

            $novo->setId(stripslashes($rs['idDisciplina']));
            $novo->setNome(stripslashes($rs['nome']));
            $novo->setSigla(stripslashes($rs['sigla']));
            $novo->setCargaHoraria(stripslashes($rs['cargaHoraria']));
            $lista->append($novo);
        }
        return $lista;
    }

    //Função para salvar relacionamento N para N de Disciplina Curso
    public function SalvarCurso($cur) {
        $sql = sprintf("INSERT INTO disciplina_curso(idDisciplina,idCurso) VALUES(LAST_INSERT_ID(),'%s')", $cur);
        mysql_query($sql);
    }

    //Função atualizar N para N
    public function AtualizarCurso($dis, $cur) {
        $sql = sprintf("UPDATE disciplina_curso SET idDisciplina='%s',idCurso='%s' WHERE idCurso='%s' AND idDisciplina='%s'", $dis, $cur);
        mysql_query($sql);
    }

    public function Inserir(Disciplina $obj) {

        $sql = sprintf("INSERT INTO disciplina(nome,sigla,cargaHoraria,status) VALUES('%s','%s','%s',1)", $obj->getNome(), $obj->getSigla(), $obj->getCargaHoraria());
        mysql_query($sql);
        //   echo mysql_insert_id();
    }

    public function Apagar($id) {
        $sql = sprintf("UPDATE disciplina SET status = 0 WHERE idDisciplina = %s", $id);

        mysql_query($sql);
    }

    public function Atualizar(Disciplina $obj) {
        $sql = sprintf("UPDATE disciplina SET nome='%s', sigla='%s', cargaHoraria='%s' WHERE idDisciplina = %s", $obj->getNome(), $obj->getSigla(), $obj->getCargaHoraria(), $obj->getId());

        mysql_query($sql);
    }

    public function ListarTodos() {

        $sql = "SELECT * FROM disciplina WHERE status = 1";
        $lista = new ArrayObject();

        $resultado = mysql_query($sql);
        while ($rs = mysql_fetch_array($resultado)) {

            $novo = new Disciplina();

            $novo->setId(stripslashes($rs['idDisciplina']));
            $novo->setNome(stripslashes($rs['nome']));
            $novo->setSigla(stripslashes($rs['sigla']));
            $novo->setCargaHoraria(stripslashes($rs['cargaHoraria']));
            $lista->append($novo);
        }
        return $lista;
    }

}

?>
