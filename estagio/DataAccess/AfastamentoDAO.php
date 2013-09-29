<?php
 include_once 'Conexao.php';
 include_once '../DomainModel/Afastamento.php';
 
    class AfastamentoDAO{
        
        public function inserir(Afastamento $obj){
            $sql = sprintf("INSERT INTO afastamento(dataInicio,dataTermino,motivo,status,idFuncionario) VALUES('%s','%s','%s',1,'%d')"
                    ,$obj->getDataInicio(),$obj->getDataTermino(),$obj->getMotivo(),$obj->getIdFuncionario());
            
            mysql_query($sql) or die(mysql_error());
            
            
        }
        
         public function abrir(Afastamento $id){
                $sql = "SELECT  * FROM afastamento WHERE idAfastamento = $id ";
                $novo = new Afastamento();

                $resultado = mysql_query($sql);
                if($resultado) {
                    $novo->setIdAfastamento(stripslashes($resultado['idAfastamento']));
                    $novo->setMotivo(stripslashes($resultado['motivo']));
                    $novo->setDataInicio($resultado['dataInicio']);
                    $novo->setDataTermino($resultado['dataTermino']);
                    $novo->setIdFuncionario($resultado['idFuncionario']);
                    return $novo;
                }else{
                    return null;
                }
                
	}
        
        
		public function ListarTodos($id){
			$sql = "SELECT  * FROM afastamento WHERE status = 1 AND idFuncionario = $id";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			  while ($rs = mysql_fetch_array($resultado)){
			
				$novo = new Afastamento();
                                
                               // echo '<script type="text/javascript"> alert("'.$rs['motivo'].'")</script>';
                                
				$novo->setIdAfastamento($rs['idAfastamento']);
                                $novo->setMotivo(stripslashes($rs['motivo']));
                                $novo->setDataInicio(implode("/",array_reverse(explode("-",$rs['dataInicio'])))); 
                                $novo->setDataTermino(implode("/",array_reverse(explode("-",$rs['dataTermino'])))); 
                                $novo->setIdFuncionario($rs['idFuncionario']);
				
                                $lista->append($novo);
			}
			return $lista;
		
		}
    }
?>
