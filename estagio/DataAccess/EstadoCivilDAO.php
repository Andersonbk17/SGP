<?php
	include_once 'Conexao.php';
        include_once '../DomainModel/EstadoCivil.php';
	class EstadoCivilDAO{
			
            
        public function abrir($id) {

            $sql = "SELECT  * FROM Estado_Civil WHERE idEstado_Civil = $id ";
            $novo = new EstadoCivil();

            $resultado = mysql_query($sql);
            while($rs = mysql_fetch_array($resultado)){
               $novo->setId(stripslashes($rs['idEstado_Civil']));
               $novo->setNome(stripslashes($rs['nome']));
               return $novo;
            
            }
        
        }
            
            public function ListarTodos(){
		
			$sql = "SELECT  * FROM estado_civil ";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new EstadoCivil();
				
				$novo->setId(stripslashes($rs['idEstado_Civil']));
				$novo->setNome(stripslashes($rs['nome']));
				$lista->append($novo);
                                
			}
			return $lista;
		
		}


	}

?>
