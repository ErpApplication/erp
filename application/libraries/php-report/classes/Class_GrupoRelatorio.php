<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class GrupoRel {
	static function NivelGrupos($niv,$end,$grupo){ 
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
				if ($_SESSION["TipoUsu"]==3) {
					$conecta = Conexao::Conecta();
					$query2 = "SELECT GRURELCOD FROM PHPREP_GRUPRELACESSO WHERE USUCODIGO=".$_SESSION["CodUsu"]." AND GRURELCOD=".$codigo;
					$result2 = $conecta->query($query2); 
					if (MDB2::isError($result2)) die ($result2->getMessage()); 
					$rows2 = $result2->numRows(); 
					if ($rows2 > 0) {
						print "<option value=\"".$codigo."\"";
						if ($grupo==$codigo) print " selected";
						print ">".$endereco."</option>";
					}
				} else {
					print "<option value=\"".$codigo."\"";
					if ($grupo==$codigo) print " selected";
					print ">".$endereco."</option>";
				}
				GrupoRel::NivelGrupos($codigo,$endereco,$grupo);
			}
		} 
		Conexao::Desconecta($conecta);
	}
	
	static function CaixaGrupos($grupo){
		GrupoRel::NivelGrupos(0,"",$grupo);
	}
	
	static function CadGrupoRel(){
		$GruRelNome = $_POST['GruRelNome'];
		$GruRelDescricao = $_POST['GruRelDescricao'];
		$GruRelNivel = $_POST['GruRelNivel'];
		if (($GruRelNome == null) || ($GruRelDescricao == null) || ($GruRelNivel == "null")) die ("<script>alert('"._CAMPONAOPREENCHIDO."'); history.go(-1);</script>");
		$conecta = Conexao::Conecta();
		$query = "SELECT GRURELNOME FROM PHPREP_GRUPOREL WHERE GRURELNOME = '$GruRelNome' and GRURELNIVEL = $GruRelNivel";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows>0) die ("<script>alert('"._GRUPOJAEXISTE."'); history.go(-1);</script>");
		$query = "INSERT INTO PHPREP_GRUPOREL (GRURELNOME,GRURELDESCRICAO,GRURELNIVEL) VALUES ('$GruRelNome','$GruRelDescricao', $GruRelNivel)";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		Conexao::Desconecta($conecta);
		header("Location: FrGrupoRel.php?msg="._OGRUPO."$GruRelNome"._CADASTRADO);
	}
	
	static function Excluir($cod){ 
		$conecta = Conexao::Conecta();
		$query = "SELECT GRURELCOD FROM PHPREP_GRUPOREL WHERE GRURELNIVEL=$cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$cod_envia = $i->GRURELCOD;				
				$query2 = "DELETE FROM PHPREP_GRUPOREL WHERE GRURELCOD=$cod";
				$result2 = $conecta->query($query2); 
				if (MDB2::isError($result2)) die ($result2->getMessage()); 
				GrupoRel::Excluir($cod_envia);
			}
		} else {
			$query2 = "DELETE FROM PHPREP_GRUPOREL WHERE GRURELCOD=$cod";
			$result2 = $conecta->query($query2); 
			if (MDB2::isError($result2)) die ($result2->getMessage()); 
		}
		Conexao::Desconecta($conecta);
	}

	static function ExcGrupoRel($cod){
		$conecta = Conexao::Conecta();
		$query = "SELECT GRURELNOME FROM PHPREP_GRUPOREL WHERE GRURELCOD = $cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
		$GruRelNome = $i->GRURELNOME;
		Conexao::Desconecta($conecta);
		GrupoRel::Excluir($cod);
		header("Location: FrGrupoRel.php?msg="._OGRUPO."$GruRelNome"._EXCLUIDO);
	}
	
	static function EditGrupoRel(){
		$cod = $_POST['cod'];
		$GruRelNome = $_POST['GruRelNome'];
		$GruRelDescricao = $_POST['GruRelDescricao'];
		$GruRelNivel = $_POST['nivel'];
		if (($GruRelNome == null) || ($GruRelDescricao == null)) die ("<script>alert('"._CAMPONAOPREENCHIDO."'); history.go(-1);</script>");
		$conecta = Conexao::Conecta();		
		$query = "SELECT GRURELNOME FROM PHPREP_GRUPOREL WHERE GRURELNOME = '$GruRelNome' and GRURELCOD != $cod and GRURELNIVEL = '$GruRelNivel'";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 

		if ($rows>0) die ("<script>alert('"._GRUPOJAEXISTE."'); history.go(-1);</script>");
		$query = "UPDATE PHPREP_GRUPOREL SET GRURELNOME='$GruRelNome', GRURELDESCRICAO='$GruRelDescricao' WHERE GRURELCOD=$cod";
		$result = $conecta->query($query);
		if (MDB2::isError($result)) die ($result->getMessage()); 
		Conexao::Desconecta($conecta);
		header("Location: FrGrupoRel.php?msg="._OGRUPO."$GruRelNome"._EDITADO);
	}
	
	static function ListGrupoRel(){
		$cod = $_POST['cod'];
		if ($cod == "null") die ("<script>alert('"._SELECIONEUMGRUPO."'); history.go(-1);</script>");
		$conecta = Conexao::Conecta();
		$query = "SELECT GRURELDESCRICAO,GRURELNOME,GRURELNIVEL FROM PHPREP_GRUPOREL WHERE GRURELCOD='$cod'";
		$result = $conecta->query($query);
		if (MDB2::isError($result)) die ($result->getMessage());
		$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
		$GruRelNome = $i->GRURELNOME;
		$GruRelDescricao = $i->GRURELDESCRICAO;
		$GruRelNivel = $i->GRURELNIVEL;
		$vetor = array($GruRelNome, $GruRelDescricao, $GruRelNivel);
		Conexao::Desconecta($conecta);
		return $vetor;
	}

	static function VerificaRel($cod,$grupos){ 
		$conecta = Conexao::Conecta();
		$query3 = "SELECT RELNOME FROM PHPREP_RELATORIO WHERE GRURELCOD=$cod";
		$result3 = $conecta->query($query3); 
		if (MDB2::isError($result3)) die ($result3->getMessage()); 
		$rows3 = $result3->numRows(); 
		if ($rows3 > 0) {
			$query4 = "SELECT GRURELNOME FROM PHPREP_GRUPOREL WHERE GRURELCOD=$cod";
			$result4 = $conecta->query($query4); 
			if (MDB2::isError($result4)) die ($result4->getMessage()); 
			$i = $result4->fetchRow(MDB2_FETCHMODE_OBJECT);
			$nome_grupo = $i->GRURELNOME;
			if ($grupos==null) $grupos.=$nome_grupo; else $grupos.=", ".$nome_grupo;
		}

		$query = "SELECT GRURELCOD,GRURELNOME FROM PHPREP_GRUPOREL WHERE GRURELNIVEL=$cod";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$cod_envia = $i->GRURELCOD;				
				GrupoRel::VerificaRel($cod_envia,$grupos);
			}
		}
		Conexao::Desconecta($conecta);
		return $grupos;
	}

	static function VerifRel(){
		$cod = $_POST['cod'];
		if ($cod == "null") die ("<script>alert('"._SELECIONEUMGRUPO."'); history.go(-1);</script>");
		$grupos = GrupoRel::VerificaRel($cod,"");
		if ($grupos==null) GrupoRel::ExcGrupoRel($cod);
		else die("<script>alert('"._EXISTEMRELATORIOS.$grupos."'); history.go(-1);</script>");
	}

	static function NivelListaDeGrupos($niv,$end,$cont){
		$conecta = Conexao::Conecta();
		$query = "SELECT GRURELCOD,GRURELNOME,GRURELDESCRICAO FROM PHPREP_GRUPOREL WHERE GRURELNIVEL='$niv' ORDER BY GRURELNOME";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$codigo = $i->GRURELCOD;
				$nome = $i->GRURELNOME;
				$descricao = $i->GRURELDESCRICAO;
				$descricao = nl2br(htmlspecialchars($descricao, ENT_QUOTES));
				$endereco = $end." / ".$nome;
				if ($cont%2==0) print"<tr bgcolor=\"#F0F0F0\">"; else print"<tr bgcolor=\"#F8F8F8\">";
				print"
				<td>".$endereco."</td>
				<td>".$descricao."</td>
				</tr>";
				$cont++;
				GrupoRel::NivelListaDeGrupos($codigo,$endereco,$cont);
			}
		}
	}
	
	static function ListaDeGrupos(){
		print"
		<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"3\">
		<tr>
		<td><strong>"._NOME."</strong></td>
		<td><strong>"._DESCRICAO."</strong></td>
		</tr>
		";
		GrupoRel::NivelListaDeGrupos(0,"",0);
		print "</table>";
	}
}
?>