<?php
    include_once 'Conexao.php';
    include_once '../DomainModel/ProgressaoCarreira.php';
    
    class ProgressaoCarreiraDAO{
        
        public function Abrir($id){
					
			$sql = "SELECT * FROM progressaocarreira WHERE idProgressaoCarreira = $id AND status = 1";
			$resultado = mysql_query($sql);
                        if($resultado){
                            $novo = new ProgressaoCarreira;
                            
                            $novo->setId($rs['idProgressaoCarreira']);
                            $novo->setDataProgressao($rs['dataProgressao']);
                            $novo->setDescricaoNivelCategoria($rs['descricaoNivelCategoria']);
                            $novo->setIdfuncionario($rs['idFuncionario']);
                           
                        }
                        return $novo;
                     //   echo mysql_insert_id();

		}


            public function Inserir(ProgressaoCarreira $obj){
					
			$sql = sprintf("INSERT INTO progressaocarreira(dataProgressao,descricaoNivelCategoria,idFuncionario,status)
                            VALUES('%s','%s','%d',1)",$obj->getDataProgressao(),$obj->getDescricaoNivelCategoria(),$obj->getIdfuncionario());
                        
                      //  echo '<script type="text/javascript"> alert("'.$obj->getIdfuncionario().' na dao")</script>';
			mysql_query($sql) or die(mysql_error());
                     //   echo mysql_insert_id();

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
