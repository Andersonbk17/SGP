<?php
    include_once 'Conexao.php';
    include_once '../DomainModel/Cidade.php';
    
    class CidadeDAO{
        public function Abrir($id){
            $sql = "SELECT  * FROM cidade WHERE idCidade = $id ";
            $novo = new Cidade();

            $resultado = mysql_query($sql);
            while($rs = mysql_fetch_array($resultado)){
                $novo->setId(stripslashes($rs['idCidade']));
                $novo->setNome(stripslashes($rs['nome']));
                $novo->setIdEstado($rs['idEstado']);
                return $novo;
            }
                      
        }
        
        public function ListarTodos(){
            $sql = "SELECT  * FROM cidade ORDER BY nome";
            $lista = new ArrayObject();

            $resultado = mysql_query($sql);
            while ($rs = mysql_fetch_array($resultado)) {

                $novo = new Cidade();
                
                

                $novo->setId(stripslashes($rs['idCidade']));
                $novo->setNome(stripslashes($rs['nome']));
                $novo->setIdEstado(stripslashes($rs['idEstado']));
                $lista->append($novo);
            }
            return $lista;
        }
            
        
        
    }
?>
