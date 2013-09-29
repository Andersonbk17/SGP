<?php
    include_once 'Conexao.php';
    include_once '../DomainModel/Estado.php';
    //header("Content-Type: text/html; charset=ISO-8859-1", true);
    header('Content-Type: text/html; charset=utf-8');
class EstadoDAO {

    public function abrir($id) {

        $sql = "SELECT  * FROM Estado WHERE idEstado = $id ";
        $novo = new Estado();

        $resultado = mysql_query($sql);
         while($rs = mysql_fetch_array($resultado)){
           $novo->setId(stripslashes($rs['idEstado']));
           $novo->setNome(stripslashes($rs['nome']));
           return $novo;
        
        }
        
    }
    
    
    
    
    public function ListarTodos() {

        $sql = "SELECT  * FROM Estado ORDER BY nome";
        $lista = new ArrayObject();

        $resultado = mysql_query($sql);
        while ($rs = mysql_fetch_array($resultado)) {

            $novo = new Estado();

            $novo->setId(stripslashes($rs['idEstado']));
            $novo->setNome(stripslashes($rs['nome']));
            $lista->append($novo);
        }
        return $lista;
    }

}

?>
