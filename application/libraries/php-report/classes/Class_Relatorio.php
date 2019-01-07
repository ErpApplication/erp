<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class Relatorio {
	static function InverteData($data){
		$dia = substr($data, 8, 2);
		$mes = substr($data, 5, 2);
		$ano = substr($data, 0, 4);
		$nova_data = $dia."-".$mes."-".$ano;
		return $nova_data;
	}
	
	static function NivelGrupos($niv,$end,$where){ 
		$conecta = Conexao::Conecta();
		$query = "SELECT GRURELCOD,GRURELNOME FROM PHPREP_GRUPOREL WHERE GRURELNIVEL=$niv ORDER BY GRURELNOME";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$codigo = $i->GRURELCOD;
				$nome = $i->GRURELNOME;
				$endereco = $end."/".$nome;
				
				$exibe_grupo = 0;
				if ($_SESSION["TipoUsu"]==3) {
					$conecta = Conexao::Conecta();
					$query2 = "SELECT GRURELCOD FROM PHPREP_GRUPRELACESSO WHERE USUCODIGO=".$_SESSION["CodUsu"]." AND GRURELCOD=".$codigo;
					$result2 = $conecta->query($query2); 
					if (MDB2::isError($result2)) die ($result2->getMessage()); 
					$rows2 = $result2->numRows(); 
					if ($rows2 > 0) $exibe_grupo = 1;
				} else $exibe_grupo = 1;
				
				if ($exibe_grupo==1) {
					
					$acessosBase = Usuario::GetUsuarioBases($_SESSION["CodUsu"]);
					
					$conecta = Conexao::Conecta();
					$query2 = "SELECT r.RELCODIGO,r.RELNOME,r.RELDATAEDICAO,r.RELBASE,u.USUUSUARIO FROM PHPREP_RELATORIO r INNER JOIN PHPREP_USUARIO u ON(u.USUCODIGO=r.RELUSUEDICAO) WHERE r.GRURELCOD=$codigo".$where." ORDER BY r.RELNOME";
					$result2 = $conecta->query($query2); 
					if (MDB2::isError($result2)) die ($result2->getMessage()); 
					$rows2 = $result2->numRows(); 
					if ($rows2 > 0){
						$cont=0;
						print"
							<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"3\">
							<tr bgcolor=\"#E9E9E9\">
								<td height=\"23\" colspan=\"4\"><strong>&nbsp;&nbsp;&nbsp;".$endereco."</strong></td>
							</tr>
							<tr>
							<td width=\"80\">&nbsp;</td>
							<td><strong>"._RELATORIO."</strong></td>
							<td width=\"85\"><strong>"._USUARIO."</strong></td>
							<td width=\"70\"><strong>"._DATA."</strong></td>
						</tr>
						";
						while ($j = $result2->fetchRow(MDB2_FETCHMODE_OBJECT)) {
							$cod_rel = $j->RELCODIGO;
							$nome_rel = $j->RELNOME;
							$data = $j->RELDATAEDICAO;
							if($_SESSION["Idioma"]=="brazilian") $data = Relatorio::InverteData($data);
							$usuario = $j->USUUSUARIO;
							$base = $j->RELBASE;
							if ($cont%2==0) print"<tr bgcolor=\"#F0F0F0\">"; else print"<tr bgcolor=\"#F8F8F8\">";
							print"<td align=\"center\"><a href=\"FrVisualizarRel.php?id=".$cod_rel."\"><img src=\"imagens/rel-ver.gif\" width=\"18\" height=\"18\" border=\"0\" alt=\""._VISUALIZAR."\"></a>";
							if ($_SESSION["TipoUsu"]!=3) {
								if (($_SESSION["TipoUsu"]!=2) || (in_array($base, $acessosBase))) {
									print" &nbsp;&nbsp;<a href=\"FrGerarRel1.php?id=".$cod_rel."\"><img src=\"imagens/rel-editar.gif\" width=\"18\" height=\"18\" border=\"0\" alt=\""._EDITAR."\"></a> &nbsp;<a href=\"#\" onclick=\"javascript:EnviarConf('FrRelatorio.php?del=".$cod_rel."','"._DESEJAEXCLUIR.$nome_rel."?');\"><img src=\"imagens/rel-excluir.gif\" width=\"18\" height=\"18\" border=\"0\" alt=\""._EXCLUIR."\"></a>";
								}
							}
							print"
								</td>
								<td>".$nome_rel."</td>
								<td>".$usuario."</td>
								<td>".$data."</td>
							</tr>";
							$cont++;
						}
						 print "</table><br>";
					}
				}
				Relatorio::NivelGrupos($codigo,$endereco,$where);
			}
		} 
	}
	
	static function ListRelatorio(){
		if(isset($_POST["Buscar"])){
			$grupo = $_POST["RelGrupo"];
			$usuario = $_POST["RelUsuario"];
			$dia1 = $_POST["dia1"];
			$mes1 = $_POST["mes1"];
			$ano1 = $_POST["ano1"];
			$dia2 = $_POST["dia2"];
			$mes2 = $_POST["mes2"];
			$ano2 = $_POST["ano2"];
			if (($dia1!="null")||($mes1!="null")||($dia2!="null")||($mes2!="null")){
				if (($dia1=="null")||($mes1=="null")||($dia2=="null")||($mes2=="null")) die ("<script>alert('"._PREENCHAMODIFICACAO."'); history.go(-1);</script>");
				if ((strlen($ano1)!=4)||(strlen($ano2)!=4)) die ("<script>alert('"._PREENCHAANO."'); history.go(-1);</script>");
			}
			$where = null;
			if ($grupo!="null") $where.=" AND r.GRURELCOD=".$grupo;
			if ($usuario!="null") $where.=" AND r.RELUSUEDICAO=".$usuario;
			if ($dia1!="null") $where.=" AND r.RELDATAEDICAO >= '".$ano1."-".$mes1."-".$dia1."' AND r.RELDATAEDICAO <= '".$ano2."-".$mes2."-".$dia2."'";
		} else $where=null;
		Relatorio::NivelGrupos(0,"",$where);
	}
	
	static function CaixaUsuarios($usuario){
		$conecta = Conexao::Conecta();
		$query = "SELECT USUCODIGO,USUUSUARIO FROM PHPREP_USUARIO WHERE USUTIPO!=3 ORDER BY USUUSUARIO";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while ($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$UsuCodigo = $i->USUCODIGO;
				$UsuUsuario = $i->USUUSUARIO;
				print "<option value=\"".$UsuCodigo."\"";
				if ($usuario==$UsuCodigo) print " selected";
				print" >".$UsuUsuario."</option>";
			}
		}
		Conexao::Desconecta($conecta);
	}

}
?>