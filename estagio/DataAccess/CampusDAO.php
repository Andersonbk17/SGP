<?php

	include_once ("Conexao.php");
	include_once ("../DomainModel/Campus.php");
	
	class CampusDAO {
          
        public function Abrir($id)
        {
			$sql = sprintf("SELECT  * FROM campus WHERE idCampus = %s",$id);
			//$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Campus();
				
				$novo->setId(stripslashes($rs['idCampus']));
				$novo->setNome(stripslashes($rs['nome']));
				return $novo;
			}
			
			
			
			/*
			$sql = sprintf("SELECT  * FROM campus WHERE idCampus = '%s' ", $id);
			$novo = new Campus();
			
			$resultado = mysql_query($sql);
			if($resultado){
				$novo->setId(stripslashes($resultado['idCampus']));
				$novo->setNome(stripslashes($resultado['nome']));
				return $novo;
			}else{
				return null;
			}
			*/
		}


        public function Inserir(Campus $obj){
					
			$sql = sprintf("INSERT INTO campus(nome,status) VALUES('%s',1)",$obj->getNome());
			mysql_query($sql);
                     //   echo mysql_insert_id();

		}

		
		public function Apagar($id){
			$sql = sprintf("UPDATE campus SET status = 0 WHERE idCampus = %s", $id);
			
			mysql_query($sql);
		
		}
		
		public function Atualizar(Campus $obj){
			$sql = sprintf("UPDATE campus SET nome = '%s' WHERE idCampus = '%s'",$obj->getNome(), $obj->getId());
			
			mysql_query($sql);
		
		}
		
		public function ListarTodos(){
		
			$sql = "SELECT  * FROM campus WHERE status = 1";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Campus();
				
				$novo->setId(stripslashes($rs['idCampus']));
				$novo->setNome(stripslashes($rs['nome']));
				$lista->append($novo);
			}
			return $lista;
		
		}
                
                
                public function Busca(Campus $obj,$ordem){
                    $sql = sprintf("SELECT * FROM campus WHERE status = 1 ");
                    
                    $filtro = "";
                    
                               
                    
                    if($obj->getNome() != ""){
                        $filtro = sprintf("AND nome LIKE  '%s%s%s'  ORDER BY nome %s","%",$obj->getNome(),"%",$ordem);
                    }
                    
                    
                    if($obj->getId() != 0){
                        $filtro = sprintf("AND idCampus = '%d' ORDER BY idCampus %s",$obj->getId(),$ordem);
                    }
                    
                    $sql.=$filtro;
                    
                                     
                    
                        $resultado = mysql_query($sql);
			$lista = new ArrayObject();
			while($rs = mysql_fetch_array($resultado)){
				
				$n = new Campus();
				
				$n->setId(stripslashes($rs['idCampus']));
				$n->setNome(stripslashes($rs['nome']));
                                //continua ......
                                $lista->append($n);
				
			}
			return $lista;
                        
		}
		

}




?>
