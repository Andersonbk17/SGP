<?php

	include_once ("Conexao.php");
	include_once ("../DomainModel/Area.php");
	
	class AreaDAO {
          
        public function Abrir($id)
        {
			$sql = sprintf("SELECT  * FROM area WHERE idArea = %s AND status = 1",$id);
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Area();
				
				$novo->setId(stripslashes($rs['idArea']));
				$novo->setNome(stripslashes($rs['nome']));
				$lista->append($novo);
			}
			return $lista;
		}


        public function Inserir(Area $obj){
					
			$sql = sprintf("INSERT INTO area(nome,status) VALUES('%s',1)",$obj->getNome());
			mysql_query($sql);
            //   echo mysql_insert_id();

		}

		
		public function Apagar($id){
			$sql = sprintf("UPDATE area SET status = 0 WHERE idArea = %s", $id);
			
			mysql_query($sql);
		
		}
		
		public function Atualizar(Area $obj){
			$sql = sprintf("UPDATE area SET nome = '%s' WHERE idArea = '%s'",$obj->getNome(), $obj->getId());
			
			mysql_query($sql);
		
		}
		
		public function ListarTodos(){
		
			$sql = "SELECT  * FROM area WHERE status = 1";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Area();
				
				$novo->setId(stripslashes($rs['idArea']));
				$novo->setNome(stripslashes($rs['nome']));
				$lista->append($novo);
			}
			return $lista;
		
		}

}




?>
