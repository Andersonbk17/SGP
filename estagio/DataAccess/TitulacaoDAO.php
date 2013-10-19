<?php

	include_once ("Conexao.php");
	include_once ("../DomainModel/Titulacao.php");
	
	class TitulacaoDAO {
          
        public function Abrir($id)
        {
			$sql = sprintf("SELECT  * FROM titulacao WHERE idTitulacao = '%s' ",$id);
			//$lista = new ArrayObject();
			$novo = new Titulacao();
                        
			$resultado = mysql_query($sql) or die(mysql_error());
			while($rs = mysql_fetch_array($resultado)){
			
				$novo->setId(stripslashes($rs['idTitulacao']));
				$novo->setNome(stripslashes($rs['nome']));
				return $novo;
			}
			
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
                
                      public function Busca(Titulacao $obj,$ordem){
                          
                        $sql = sprintf("SELECT * FROM titulacao WHERE status = 1 ");

                        $filtro = "";

                        if($obj->getNome() != ""){
                            $filtro = sprintf("AND nome LIKE  '%s%s%s'  ORDER BY nome %s","%",$obj->getNome(),"%",$ordem);
                        }


                        if($obj->getId() != 0){
                            $filtro = sprintf("AND idTitulacao = '%d' ORDER BY idTitulacao %s",$obj->getId(),$ordem);
                        }

                        $sql.=$filtro;

                            $resultado = mysql_query($sql);
                            $lista = new ArrayObject();
                            while($rs = mysql_fetch_array($resultado)){

                                    $n = new Titulacao();

                                    $n->setId(stripslashes($rs['idTitulacao']));
                                    $n->setNome(stripslashes($rs['nome']));
                                    //continua ......
                                    $lista->append($n);

                            }
                            return $lista;

		}

}

?>
