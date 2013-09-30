<?php
    include_once 'Conexao.php';
    include_once '../DomainModel/ProgressaoCarreira.php';
    
    class ProgressaoCarreiraDAO{
        
        public function Abrir($id){
					
			$sql = "SELECT * FROM progressaocarreira WHERE idProgressaoCarreira = $id AND status = 1";
		
                        $novo = new ProgressaoCarreira;
                        
                        $resultado = mysql_query($sql) or die(mysql_error());
                        while($rs = mysql_fetch_array($resultado)){
                            
                            $novo->setId($rs['idProgressaoCarreira']);
                            $novo->setDataProgressao($rs['dataProgressao']);
                            $novo->setDescricaoNivelCategoria($rs['descricaoNivelCategoria']);
                            $novo->setIdfuncionario($rs['idFuncionario']);
                            return $novo;
                        }

		}


            public function Inserir(ProgressaoCarreira $obj){
					
			$sql = sprintf("INSERT INTO progressaocarreira(dataProgressao,descricaoNivelCategoria,idFuncionario,status)
                            VALUES('%s','%s','%d',1)",$obj->getDataProgressao(),$obj->getDescricaoNivelCategoria(),$obj->getIdfuncionario());
                        
                      //  echo '<script type="text/javascript"> alert("'.$obj->getIdfuncionario().' na dao")</script>';
			mysql_query($sql) or die(mysql_error());
                     //   echo mysql_insert_id();

		}
                
                public function alterar(ProgressaoCarreira $obj){		
			$sql = sprintf("UPDATE progressaocarreira SET dataProgressao='%s',descricaoNivelCategoria='%s',idFuncionario='%s' WHERE idProgressaoCarreira = '%s' ",$obj->getDataProgressao(),$obj->getDescricaoNivelCategoria(),$obj->getIdfuncionario(),$obj->getId());
                             
			mysql_query($sql) or die(mysql_error());
         
		}
                
                public function apagar(ProgressaoCarreira $obj){		
			$sql = sprintf("UPDATE progressaocarreira SET status = 0 WHERE idProgressaoCarreira = '%s' ",$obj->getId());
                             
			mysql_query($sql) or die(mysql_error());
         
		}
                
                
                public function ListarTodos($id){
			$sql = "SELECT  * FROM progressaocarreira WHERE status = 1 AND idFuncionario = $id";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			  while ($rs = mysql_fetch_array($resultado)){
			
				$novo = new ProgressaoCarreira();
                                
                              
                                
				$novo->setId($rs['idProgressaoCarreira']);
                                $novo->setDataProgressao(implode("/",array_reverse(explode("-",$rs['dataProgressao'])))); 
                                $novo->setDescricaoNivelCategoria($rs['descricaoNivelCategoria']);
                                $novo->setIdfuncionario($rs['idFuncionario']);
				
                                $lista->append($novo);
			}
			return $lista;
		
		}
        
        
        
    }

?>
