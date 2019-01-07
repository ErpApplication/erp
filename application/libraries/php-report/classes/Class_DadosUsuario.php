<? 
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class DadosUsuario{
	static function ValidaSenha($UsuSenha, $UsuRepSenha){
		if ($UsuSenha != $UsuRepSenha) die ("<script>alert('"._SENHASIGUAIS."'); history.go(-1);</script>");
		if ((strlen($UsuSenha)<6) || (strlen($UsuSenha)>8)) die ("<script>alert('"._SENHADE6A8CARACTERES."'); history.go(-1);</script>");
	}
	
	static function ValidaCadastro($UsuUsuario, $UsuNome, $UsuEmail, $UsuIdioma) {
		if(($UsuUsuario == null) || ($UsuNome == null) || ($UsuEmail == null) || ($UsuIdioma == "null")) die ("<script>alert('"._CAMPONAOPREENCHIDO."'); history.go(-1);</script>");
		$email = (ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $UsuEmail)); 
		if ($email == false) die ("<script>alert('"._EMAIL."'); history.go(-1);</script>");
		
	}

	static function ExibeDados(){
		$conecta = Conexao::Conecta();
		$query = "SELECT USUNOME,USUEMAIL,USUUSUARIO,USUIDIOMA FROM PHPREP_USUARIO WHERE USUCODIGO= '".$_SESSION['CodUsu']."'";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
		$UsuNome = $i->USUNOME;
		$UsuEmail = $i->USUEMAIL;
		$UsuUsuario = $i->USUUSUARIO;
		$UsuIdioma = $i->USUIDIOMA;
		$vetor = array($UsuNome, $UsuEmail, $UsuUsuario, $UsuIdioma);
		Conexao::Desconecta($conecta);
		return $vetor;
	}

	static function EditDadosUsuario(){
		$UsuUsuario = $_POST['UsuUsuario'];
		$UsuSenha = $_POST['UsuSenha'];
		$UsuRepSenha = $_POST['UsuRepSenha'];
		$UsuNome = $_POST['UsuNome'];
		$UsuEmail = $_POST['UsuEmail'];
		$UsuIdioma = $_POST['UsuIdioma'];
		DadosUsuario::ValidaCadastro($UsuUsuario, $UsuNome, $UsuEmail, $UsuIdioma);
		$conecta = Conexao::Conecta();
		$query = "SELECT USUUSUARIO FROM PHPREP_USUARIO WHERE USUUSUARIO = '$UsuUsuario' and USUCODIGO != '".$_SESSION['CodUsu']."'";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
			$rows = $result->numRows(); 
		if ($rows>0) die ("<script>alert('"._USUARIOJAEXISTE."'); history.go(-1);</script>");
		if(($UsuSenha != null) || ($UsuRepSenha != null)) DadosUsuario::ValidaSenha($UsuSenha,$UsuRepSenha);
		$query = "UPDATE PHPREP_USUARIO SET  USUUSUARIO='$UsuUsuario', USUNOME='$UsuNome', USUEMAIL='$UsuEmail', USUIDIOMA='$UsuIdioma' WHERE USUCODIGO = '".$_SESSION['CodUsu']."'";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		if($UsuSenha !=	 null) {
			$UsuSenha = md5($UsuSenha);
			$query = "UPDATE PHPREP_USUARIO SET USUSENHA='$UsuSenha' WHERE USUCODIGO = '".$_SESSION['CodUsu']."'";
			$result = $conecta->query($query); 
			if (MDB2::isError($result)) die ($result->getMessage()); 
		}		
		Conexao::Desconecta($conecta);
		header("Location: FrDadosUsuario.php?msg="._OUSUARIO."$UsuUsuario"._CADASTRADO);
	}

	static function ListaIdiomas($usu_idioma){
		$dir = opendir("idiomas/Layout");
		while (false !== ($arquivo = readdir($dir))) { 
			if (substr($arquivo,-4) == ".php") {
				$arquivo = substr_replace($arquivo, '', -4);
				print"<option value=\"$arquivo\"";
				if($usu_idioma==$arquivo) print" selected";
				print">$arquivo</option>";
			}
		}
	}
}
 ?>