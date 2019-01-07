<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class Usuario { 
	static function ValidaSenha($UsuSenha, $UsuRepSenha){
		if ($UsuSenha != $UsuRepSenha) die ("<script>alert('"._SENHASIGUAIS."'); history.go(-1);</script>");
		if ((strlen($UsuSenha)<6) || (strlen($UsuSenha)>8)) die ("<script>alert('"._SENHADE6A8CARACTERES."'); history.go(-1);</script>");
	}
	
	static function ValidaCadastro($UsuTipo, $UsuUsuario, $UsuNome, $UsuEmail, $UsuBaseDados, $UsuGrupoRel) {
		if(($UsuTipo == "null") || ($UsuUsuario == null) || ($UsuNome == null) || ($UsuEmail == null)) die ("<script>alert('"._CAMPONAOPREENCHIDO."'); history.go(-1);</script>");
		if($UsuTipo == "2"){
			$aux = count($UsuBaseDados);
			if($aux == 0) die ("<script>alert('"._CAMPONAOPREENCHIDO."'); history.go(-1);</script>");
		}
		if($UsuTipo == "3"){
			$aux = count($UsuGrupoRel);
			if($aux == 0) die ("<script>alert('"._CAMPONAOPREENCHIDO."'); history.go(-1);</script>");
		}
		$email = (ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $UsuEmail)); 
		if ($email == false) die ("<script>alert('"._EMAILINVALIDO."'); history.go(-1);</script>");
		
	}
	
	static function VerificaAcesso($UsuTipo,$cod){
		$conecta = Conexao::Conecta();
		if ($UsuTipo == 2){
			$UsuBaseDados = $_POST['UsuBaseDados'];
			$base = count($UsuBaseDados);
			for ($i=0; $i < $base; $i++) { 
				$query = "INSERT INTO PHPREP_DBACESSO (USUCODIGO,BASNOME) VALUES ($cod,'".$UsuBaseDados[$i]."')";
				$result = $conecta->query($query); 
				if (MDB2::isError($result)) die ($result->getMessage()); 
			}
		} elseif ($UsuTipo == 3)	{
			$UsuGrupoRel = $_POST['UsuGrupoRel'];
			$grupo = count($UsuGrupoRel);
			for ($i=0; $i < $grupo; $i++) { 
				$query = "INSERT INTO PHPREP_GRUPRELACESSO (USUCODIGO,GRURELCOD) VALUES ($cod,'".$UsuGrupoRel[$i]."')";
				$result = $conecta->query($query); 
				if (MDB2::isError($result)) die ($result->getMessage()); 
			}
		}
		Conexao::Desconecta($conecta);
	}
	
	static function LimpaAcesso($cod){
		$conecta = Conexao::Conecta();
		$query = "DELETE FROM PHPREP_DBACESSO WHERE USUCODIGO = $cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$query = "DELETE FROM PHPREP_GRUPRELACESSO WHERE USUCODIGO = $cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		Conexao::Desconecta($conecta);
	}

	static function CaixaUsuarios(){
		$conecta = Conexao::Conecta();
		$query = "SELECT USUCODIGO,USUUSUARIO,USUNOME FROM PHPREP_USUARIO ORDER BY USUUSUARIO";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$UsuCodigo = $i->USUCODIGO;
				$UsuUsuario = $i->USUUSUARIO;
				$UsuNome = $i->USUNOME;
				if($UsuNome != "GOD") print "<option value=\"".$UsuCodigo."\">".$UsuUsuario."</option>";
			}
		}
		Conexao::Desconecta($conecta);
	}
	
	static function CadUsuario(){
		$UsuTipo = $_POST['UsuTipo'];
		$UsuUsuario = $_POST['UsuUsuario'];
		$UsuSenha = $_POST['UsuSenha'];
		$UsuRepSenha = $_POST['UsuRepSenha'];
		$UsuNome = $_POST['UsuNome'];
		$UsuEmail = $_POST['UsuEmail'];
		if(isset($_POST['UsuBaseDados'])) $UsuBaseDados = $_POST['UsuBaseDados']; else ($UsuBaseDados = null);
		if(isset($_POST['UsuGrupoRel'])) $UsuGrupoRel = $_POST['UsuGrupoRel']; else ($UsuGrupoRel = null);
		$conecta = Conexao::Conecta();
		Usuario::ValidaCadastro($UsuTipo, $UsuUsuario, $UsuNome, $UsuEmail, $UsuBaseDados, $UsuGrupoRel);
		if($UsuSenha == null) die ("<script>alert('"._CAMPONAOPREENCHIDO."'); history.go(-1);</script>");
		$query = "SELECT USUUSUARIO FROM PHPREP_USUARIO WHERE USUUSUARIO = '$UsuUsuario'";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
			$rows = $result->numRows(); 
		if ($rows>0) die ("<script>alert('"._USUARIOJAEXISTE."'); history.go(-1);</script>");
		Usuario::ValidaSenha($UsuSenha,$UsuRepSenha);
		$UsuSenha = md5($UsuSenha);
		$query = "INSERT INTO USUARIO (USUTIPO,USUNOME,USUEMAIL,USUUSUARIO,USUSENHA) VALUES ($UsuTipo,'$UsuNome','$UsuEmail','$UsuUsuario', '$UsuSenha')";
		$result = $conecta->query($query); 	
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$UsuCodigo = Query::lastID($conecta, Config::$PhpReportServer["dbType"], "USUARIO", "USUCODIGO");
		if(($UsuTipo == 2) ||($UsuTipo == 3)) Usuario::VerificaAcesso($UsuTipo, $UsuCodigo);
		Conexao::Desconecta($conecta);
		header("Location: FrUsuario.php?msg="._OUSUARIO."$UsuUsuario"._CADASTRADO);
	}
	
	static function ExcUsuario(){
		$cod = $_POST['cod'];
		if ($cod == "null") die ("<script>alert('"._SELECIONEUMUSUARIO."'); history.go(-1);</script>");
		$conecta = Conexao::Conecta();
		$query = "SELECT USUUSUARIO FROM PHPREP_USUARIO WHERE USUCODIGO = $cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage());
		$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
		$UsuUsuario = $i->USUUSUARIO;
		$query = "DELETE FROM PHPREP_USUARIO WHERE USUCODIGO = $cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		Usuario::LimpaAcesso($cod);
		Conexao::Desconecta($conecta);
		header("Location: FrUsuario.php?msg="._OUSUARIO."$UsuUsuario"._EXCLUIDO);
	}
	
	static function EditUsuario(){
		$cod = $_POST['cod'];
		$UsuTipo = $_POST['UsuTipo'];
		$UsuUsuario = $_POST['UsuUsuario'];
		$UsuSenha = $_POST['UsuSenha'];
		$UsuRepSenha = $_POST['UsuRepSenha'];
		$UsuNome = $_POST['UsuNome'];
		$UsuEmail = $_POST['UsuEmail'];
		if(isset($_POST['UsuBaseDados'])) $UsuBaseDados = $_POST['UsuBaseDados']; else ($UsuBaseDados = null);
		if(isset($_POST['UsuGrupoRel'])) $UsuGrupoRel = $_POST['UsuGrupoRel']; else ($UsuGrupoRel = null);
		Usuario::ValidaCadastro($UsuTipo, $UsuUsuario, $UsuNome, $UsuEmail, $UsuBaseDados, $UsuGrupoRel);
		$conecta = Conexao::Conecta();
		$query = "SELECT USUUSUARIO FROM PHPREP_USUARIO WHERE USUUSUARIO = '$UsuUsuario' and USUCODIGO != $cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows>0) die ("<script>alert('"._USUARIOJAEXISTE."'); history.go(-1);</script>");
		if(($UsuSenha != null) || ($UsuRepSenha != null)) Usuario::ValidaSenha($UsuSenha,$UsuRepSenha);
		Usuario::LimpaAcesso($cod);
		$conecta = Conexao::Conecta();
		$query = "UPDATE PHPREP_USUARIO SET USUTIPO=$UsuTipo, USUUSUARIO='$UsuUsuario', USUNOME='$UsuNome', USUEMAIL='$UsuEmail' WHERE USUCODIGO = $cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage());
		if($UsuSenha !=	 null) {
			$UsuSenha = md5($UsuSenha);
			$query = "UPDATE PHPREP_USUARIO SET USUSENHA='$UsuSenha' WHERE USUCODIGO = $cod";
			$result = $conecta->query($query); 
			if (MDB2::isError($result)) die ($result->getMessage()); 
		}
		Usuario::VerificaAcesso($UsuTipo,$cod);
		Conexao::Desconecta($conecta);
		header("Location: FrUsuario.php?msg="._OUSUARIO." $UsuUsuario"._EDITADO);
	}
	
	static function ListaUsuarios(){
		$cod = $_POST['cod'];
		if ($cod == "null") die ("<script>alert('"._SELECIONEUMUSUARIO."'); history.go(-1);</script>");
		$conecta = Conexao::Conecta();
		$query = "SELECT USUTIPO,USUNOME,USUEMAIL,USUUSUARIO FROM PHPREP_USUARIO WHERE USUCODIGO= $cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
		$UsuNome = $i->USUNOME;
		$UsuEmail = $i->USUEMAIL;
		$UsuTipo = $i->USUTIPO;
		$UsuUsuario = $i->USUUSUARIO;
		$vetor = array($UsuNome,$UsuEmail,$UsuUsuario,$UsuTipo);
		Conexao::Desconecta($conecta);
		return $vetor;			
	}

	static function ListarDb($usuario)
	{
		$bases = Query::GetDataBases();
		
		if ($usuario!=null)
			$acessosBase = self::GetUsuarioBases($usuario);
		
		foreach ($bases as $key => $nome)
		{
			print "<option value=\"$key\"";
			if (($usuario!=null) && (in_array($key, $acessosBase)))
			{
				print " selected";
			}
			print ">$nome</option>";
		}
	}

	static function NivelGrupos($niv,$acum,$end,$usuario){ 
		$conecta = Conexao::Conecta();
		$query = "SELECT GRURELCOD,GRURELNOME FROM PHPREP_GRUPOREL WHERE GRURELNIVEL='$niv' ORDER BY GRURELNOME";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$codigo = $i->GRURELCOD;
				$nome = $i->GRURELNOME;
				$endereco = $end."/".$nome;
				print "<option value=\"".$codigo."\"";
				if($usuario!=null) {
					$conecta = Conexao::Conecta();
					$query2 = "SELECT GRURELCOD FROM PHPREP_GRUPRELACESSO WHERE GRURELCOD='$codigo' AND USUCODIGO=$usuario";
					$result2 = $conecta->query($query2); 
					if (MDB2::isError($result2)) die ($result2->getMessage()); 
					$rows2 = $result2->numRows(); 
					if($rows2>0) print " selected";
				}
				print ">".$endereco."</option>";
				Usuario::NivelGrupos($codigo,$acum,$endereco,$usuario);
			}
		} 
		Conexao::Desconecta($conecta);
	}
	
	static function CaixaGrupos($usuario){
		Usuario::NivelGrupos(0,"","",$usuario);
	}
	
	static function ListaAcesso($tipo,$usuario){
		if($tipo==2){
			$acessosBase = self::GetUsuarioBases($usuario);
			if ($acessosBase.length > 0) print ""._BASEDADOS.":";
			foreach ($acessosBase as $base)
			{
				print "<br>- " . str_replace("¶", " - ", $base);
			}
		} else if($tipo==3){
			$conecta = Conexao::Conecta();
			$query = "SELECT g.GRURELNOME FROM PHPREP_GRUPRELACESSO a INNER JOIN PHPREP_GRUPOREL g ON(g.GRURELCOD=a.GRURELCOD) WHERE a.USUCODIGO=$usuario";
			$result = $conecta->query($query); 
			if (MDB2::isError($result)) die ($result->getMessage()); 
			$rows = $result->numRows(); 
			if($rows>0){
				print ""._GRUPORELATORIO.":";
				while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
					$grupo = $i->GRURELNOME;
					print "<br>- ".$grupo;
				}
			}
		}
	}
	
	static function ListaDeUsuarios(){
		$conecta = Conexao::Conecta();
		$query = "SELECT USUCODIGO,USUTIPO,USUNOME,USUEMAIL,USUUSUARIO FROM PHPREP_USUARIO ORDER BY USUUSUARIO";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			$cont=0;
			print"
			<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"3\">
			<tr>
			<td>&nbsp;</td>
			<td><strong>"._USUARIO."</strong></td>
			<td><strong>"._NOME."</strong></td>
			<td><strong>"._EMAIL."</strong></td>
			<td><strong>"._ACESSO."</strong></td>
			</tr>
			";
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$UsuCodigo = $i->USUCODIGO;
				$UsuNome = $i->USUNOME;
				$UsuEmail = $i->USUEMAIL;
				$UsuTipo = $i->USUTIPO;
				$UsuUsuario = $i->USUUSUARIO;
				if ($UsuTipo==1) $tipo=""._ADMINISTRADOR.""; else if ($UsuTipo==2) $tipo=""._ELABORADOR.""; else $tipo=""._VISUALIZADOR."";
				
				if ($cont%2==0) print"<tr bgcolor=\"#F0F0F0\">"; else print"<tr bgcolor=\"#F8F8F8\">";
				print"
				<td align=\"center\"><img src=\"imagens/usuario-".$UsuTipo.".gif\" width=\"12\" height=\"25\" align=\"absbottom\" alt=\"".$tipo."\"></td>
				<td>".$UsuUsuario."</td>
				<td>".$UsuNome."</td>
				<td>".$UsuEmail."</td>
				<td>";
				Usuario::ListaAcesso($UsuTipo,$UsuCodigo);
				print "</td>
				</tr>";
				$cont++;
			}
		}
		print "</table>";
	}
	
	static function GetUsuarioBases($usuario)
	{
		$bases = array();
		
		$conecta = Conexao::Conecta();
		$query = "SELECT BASNOME FROM PHPREP_DBACESSO WHERE USUCODIGO=$usuario";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if($rows>0){
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$bases[] = $i->BASNOME;
			}
		}
		Conexao::Desconecta($conecta);
		
		return $bases;
	}
	
	static function VerificaAcessoUsuarioBase($usuario, $base)
	{
		$conecta = Conexao::Conecta();
		$query = "SELECT BASNOME FROM PHPREP_DBACESSO WHERE BASNOME='$base' AND USUCODIGO=".$usuario;
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows();
		Conexao::Desconecta($conecta);
		return ($rows > 0);
	}
}
?>