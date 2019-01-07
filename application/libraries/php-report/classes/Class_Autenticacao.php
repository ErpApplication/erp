<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class Autenticacao { 
		static function VerificaUsu(){
		$UsuUsuario = $_POST['UsuUsuario'];
		$UsuSenha = md5($_POST['UsuSenha']);
		$conecta = Conexao::Conecta();
		$query = "SELECT USUCODIGO,USUUSUARIO,USUTIPO,USUIDIOMA FROM PHPREP_USUARIO where USUUSUARIO like '$UsuUsuario' AND USUSENHA like '$UsuSenha'";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		$usuario = null;
		if ($rows > 0){ 
				while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
					$UsuCod = $i->USUCODIGO; 
					$UsuTipo = $i->USUTIPO; 
					$usuario = $i->USUUSUARIO;
					$idioma = $i->USUIDIOMA;
					Conexao::Desconecta($conecta);
					session_start();
					$_SESSION["login"] = $usuario;
					$_SESSION["TipoUsu"] = $UsuTipo;
					$_SESSION["CodUsu"] = $UsuCod;
					if ($idioma==null){
						$_SESSION["Idioma"] = Config::$Language;
					} else {
						$_SESSION["Idioma"] = $idioma;
					}
					header("Location: FrPrincipal.php");
				}
			} else { 
				$op = "";
				die ("<script>alert('"._ACESSONEGADO."'); history.go(-1);</script>"); 
			}
		}
		
	static function logout($op){
		if ($op == "logout") { 
			//unset($_SESSION["login"]);
			//unset($_SESSION["TipoUsu"]);
			unset($_SESSION);
			session_destroy();
		}
	}
}
?>