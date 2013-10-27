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
    public function AtualizarCurso($cur,$dis) {
        $sql = sprintf("UPDATE disciplina_curso SET idCurso='%s' WHERE idDisciplina='%s'",$cur,$dis);
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
    
    
    
                public function Busca(Disciplina $obj,$ordem){
                    $sql = sprintf("SELECT * FROM disciplina WHERE status = 1 ");
                    
                    $filtro = "";
                    
                               
                    
                    if($obj->getNome() != ""){
                        $filtro = sprintf("AND nome LIKE  '%s%s%s'  ORDER BY nome %s","%",$obj->getNome(),"%",$ordem);
                    }
                    
                    
                    if($obj->getId() != 0){
                        $filtro = sprintf("AND idDisciplina = '%d' ORDER BY idDisciplina %s",$obj->getId(),$ordem);
                    }
                    
                    if($obj->getSigla() != ""){
                        $filtro = sprintf("AND sigla LIKE  '%s%s%s'  ORDER BY sigla %s","%",$obj->getSigla(),"%",$ordem);
                    }
                    
                    
                    $sql.=$filtro;
                    
                                     
                    
                        $resultado = mysql_query($sql);
			$lista = new ArrayObject();
			while($rs = mysql_fetch_array($resultado)){
				$novo = new Disciplina();

                                $novo->setId(stripslashes($rs['idDisciplina']));
                                $novo->setNome(stripslashes($rs['nome']));
                                $novo->setSigla(stripslashes($rs['sigla']));
                                $novo->setCargaHoraria(stripslashes($rs['cargaHoraria']));
                                                    //continua ......
                                $lista->append($novo);
				
			}
			return $lista;
                        
		}

}

?>
