<?php

	include_once ("Conexao.php");
	include_once ("../DomainModel/Titulacao.php");
	
	class TitulacaoDAO {
          
        public function Abrir($id)
        {
			$sql = sprintf("SELECT  * FROM titulacao WHERE idTitulacao = %s AND status = 1",$id);
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Titulacao();
				
				$novo->setId(stripslashes($rs['idTitulacao']));
				$novo->setNome(stripslashes($rs['nome']));
				$lista->append($novo);
			}
			return $lista;
		}


        public function Inserir(Titulacao $obj){
					
			$sql = sprintf("INSERT INTO titulacao(nome,status) VALUES('%s',1)",$obj->getNome());
			mysql_query($sql);
            //   echo mysql_insert_id();

		}

		
		public function Apagar($id){
			$sql = sprintf("UPDATE titulacao SET status = 0 WHERE idTitulacao = %s", $id);
			
			mysql_query($sql);
		
		}
		
		public function Atualizar(Titulacao $obj){
			$sql = sprintf("UPDATE titulacao SET nome = '%s' WHERE idTitulacao = '%s'",$obj->getNome(), $obj->getId());
			
			mysql_query($sql);
		
		}
		
		public function ListarTodos(){
		
			$sql = "SELECT  * FROM titulacao WHERE status = 1";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Titulacao();
				
				$novo->setId(stripslashes($rs['idTitulacao']));
				$novo->setNome(stripslashes($rs['nome']));
				$lista->append($novo);
			}
			return $lista;
		
		}

}




?>
