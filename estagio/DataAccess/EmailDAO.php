<?php
	include_once 'Conexao.php';
        include_once '../DomainModel/Email.php';
	class EmailDAO{
            public function Abrir($id){
					
			$sql = "SELECT * FROM Email WHERE idEmail = $id AND status = 1";
			$resultado = mysql_query($sql);
                        if($resultado){
                            $novo = new Campus();
                            $novo->setId(stripslashes($rs['idEmail']));
                            $novo->setNome(stripslashes($rs['nome']));
                            
                           
                        }
                     //   echo mysql_insert_id();

		}


            public function Inserir(Email $obj){
					
			$sql = sprintf( "INSERT INTO email(nome,idFuncionario,status) VALUES('%s','%d',1)",$obj->getNome(),
                                $obj->getIdFuncionario());
			mysql_query($sql)or die(mysql_error());
            }

		
		public function Apagar(Campus $obj){
			$sql = sprintf("UPDATE Campus SET status = 0 WHERE idCampus = '%s'", $obj->getId());
			
			mysql_query($sql);
		
		}
		
		public function Atualizar(Campus $obj){
			$sql = sprintf("UPDATE Campus SET nome = '%s' WHERE idCampus = '%s'",$obj->getNome(), $obj->getId());
			
			mysql_query($sql);
		
		}
		
		public function ListarTodos(){
		
			$sql = "SELECT  * FROM Campus WHERE status = 1";
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
