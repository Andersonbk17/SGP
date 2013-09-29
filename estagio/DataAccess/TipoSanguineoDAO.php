<?php
	include_once 'Conexao.php';
        include_once '../DomainModel/TipoSanguineo.php';
	class TipoSanguineoDAO{
			public function ListarTodos(){
		
			$sql = "SELECT  * FROM tipo_sanguineo ";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new TipoSanguineo();
				
				$novo->setId($rs['idTipo_Sanguineo']);
				$novo->setNome(stripslashes($rs['nome']));
                                
				$lista->append($novo);
                                
			}
			return $lista;
		
		}
                
                
                public function abrir($id) {

                    $sql = "SELECT  * FROM tipo_sanguineo WHERE idTipo_Sanguineo = $id ";
                    $novo = new TipoSanguineo();

                    $resultado = mysql_query($sql);
                    while ($rs = mysql_fetch_array($resultado)) {
                        $novo->setId(stripslashes($rs['idTipo_Sanguineo']));
                        $novo->setNome(stripslashes($rs['nome']));
                        
                        return $novo;
                    }
                }


	}

?>
