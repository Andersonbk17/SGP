<?php

    include_once 'Conexao.php';
    include_once '../DomainModel/Dependente.php';
    
    class DependenteDAO{
        
        
        
        public function inserir(Dependente $obj){
            $sql = sprintf("INSERT INTO dependente(nome,dataNascimento,sexo,idFuncionario)VALUES('%s','%s','%s','%d')"
                    ,$obj->getNome(),$obj->getDataNascimento(),$obj->getSexo(),$obj->getIdFuncionario());
           // echo '<script type="text/javascript" >alert('.$obj->getIdFuncionario().')</script>';
            mysql_query($sql) or die(mysql_error());
        }
        
         public function abrir($id){
                $sql = "SELECT  * FROM dependente WHERE idDependente = $id ";
                $novo = new Dependente();

                $rs = mysql_query($sql);
                while ($resultado = mysql_fetch_array($rs)) {
                    $novo->setId($resultado['idDependente']);
                    $novo->setNome($resultado['nome']);
                    $novo->setDataNascimento($resultado['dataNascimento']);
                    $novo->setSexo($resultado['sexo']);
                    $novo->setIdFuncionario($resultado['idFuncionario']);
                    return $novo;
                
                }
                
	}
        
        
		public function ListarTodos($id){
			$sql = "SELECT  * FROM dependente WHERE idFuncionario = ".$id;
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			  while ($rs = mysql_fetch_array($resultado)){
			
				$novo = new Dependente();
                                
                               //echo '<script type="text/javascript"> alert("'.$rs['nome'].'")</script>';
                                
                                $novo->setId($rs['idDependentes']);
                                $novo->setNome($rs['nome']);
                                $novo->setDataNascimento(implode("/",array_reverse(explode("-",$rs['dataNascimento'])))); 
                                $novo->setSexo($rs['sexo']);
                                $novo->setIdFuncionario($rs['idFuncionario']);
				
                                $lista->append($novo);
			}
			return $lista;
		
		}
        
        
    }
?>
