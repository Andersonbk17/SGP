<?php

	include_once ("Conexao.php");
	include_once ("../DomainModel/Campus.php");
	
	class CampusDAO {
          
        public function Abrir($id)
        {
			$sql = sprintf("SELECT  * FROM campus WHERE idCampus = %s AND status = 1",$id);
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Campus();
				
				$novo->setId(stripslashes($rs['idCampus']));
				$novo->setNome(stripslashes($rs['nome']));
				$lista->append($novo);
			}
			return $lista;
			
			
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

}




?>
