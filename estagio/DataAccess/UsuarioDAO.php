<?php
 include_once 'Conexao.php';
 include_once '../DomainModel/Usuario.php';
class UsuarioDAO {
    
    function __construct(){
		
		}
   public function abrir( $id){
                $sql = "SELECT  * FROM usuario WHERE idUsuario = $id ";
                $novo = new Usuario();

                $resultado = mysql_query($sql);
                if($resultado) {
                    $novo->setId(stripslashes($resultado['idUsuario']));
                    $novo->setUsuario(stripslashes($resultado['usuario']));
                    $novo->setSenha(stripcslashes($resultado['senha']));
                    $novo->setNivel(stripcslashes($resultado['nivel']));
                    return $novo;
                }else{
                    return null;
                }
                
	}
        
    
          public function inserir($obj){
			$sql = sprintf("INSERT INTO usuario(usuario,senha,nivel,idFuncionario,status) VALUES('%s','%s','%d','%d',1)",$obj->getUsuario(),
                                $obj->getSenha(),$obj->getNivel(),$obj->getIdFuncionario());
			mysql_query($sql)
                        OR die(mysql_error());
                        
        }
        
        public function ListarTodos(){
		
			$sql = "SELECT  * FROM usuario WHERE status = 1";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
                        
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Usuario();
				
				$novo->setId(stripslashes($rs['idUsuario']));
				$novo->setUsuario(stripslashes($rs['usuario']));
                                $novo->setSenha(stripslashes($rs['senha']));
                                $novo->setNivel(stripslashes($rs['nivel']));
				$lista->append($novo);
			}
			return $lista;
		
		}
        
    
}

?>
