<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galv�o and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class Layout {

	static function PegarUsuario(){
		if(empty($_SESSION["login"])) $usuario = null; else $usuario = $_SESSION["login"];
		return $usuario;
	}

	static function PegarTipo(){
		if (empty($_SESSION["TipoUsu"])) $tipo = null; else $tipo = $_SESSION["TipoUsu"]; 
		return $tipo;
	}

	static function PegarIdioma(){
		if (empty($_SESSION["Idioma"])){
			$idioma = Config::$Language;
		} else {
			$idioma = $_SESSION["Idioma"];
		}
		return $idioma;
	}

	//Função para verificar e permitir o acesso as páginas
	static function AcessoPagina($pagina) {
		$tipo = Layout::PegarTipo();
		if($tipo == null)	{
			header("Location: index.php");
		} else {
			if ((($tipo == 2) && (($pagina == "Usuario")||($pagina == "GrupoRel"))) || (($tipo == 3) && (($pagina == "Usuario")||($pagina == "GrupoRel") || ($pagina == "GerarRel")))){
				header("Location: FrPrincipal.php");
			}
		}
	}
	
	static function Menu(){ //private
		$tipo = Layout::PegarTipo();
		print"
			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"menu\">
				<tr>";
					if ($tipo == 1){print "<td width=\"150\"><ul><li><a href=\"FrGrupoRel.php\" title=\""._LAYGRUPOS."\"><img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\">"._LAYGRUPOS."<img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\"></a></li></ul></td>";}
					if ($tipo == 1){print "<td width=\"150\"><ul><li><a href=\"FrUsuario.php\" title=\""._LAYUSUARIOS."\"><img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\">"._LAYUSUARIOS."<img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\"></a></li></ul></td>";}
					if (($tipo == 1) || ($tipo == 2)){print "<td width=\"150\"><ul><li><a href=\"FrGerarRel.php\" title=\""._LAYGERARREL."\"><img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\">"._LAYGERARREL."<img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\"></a></li></ul></td>";}
			 		if (($tipo == 1) || ($tipo == 2)|| ($tipo == 3)){print "<td width=\"150\"><ul><li><a href=\"FrRelatorio.php\" title=\""._LAYRELATORIOS."\"><img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\">"._LAYRELATORIOS."<img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\"></a></li></ul></td>";}
					if (($tipo == 1) || ($tipo == 2)|| ($tipo == 3)){print"<td width=\"150\"><ul><li><a href=\"FrDadosUsuario.php\" title=\""._LAYMEUSDADOS."\"><img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\">"._LAYMEUSDADOS."<img src=\"imagens/menu-spacer.gif\" width=\"1\" height=\"25\" border=\"0\" align=\"absmiddle\"></a></li></ul></td>";}
					if ($tipo != "") print "<td width=\"1\"><img src=\"imagens/menu-ultimo.gif\"></td>";
				print "</tr>
			</table>";
		
	}

	static function Cabecalho(){
		$idioma = Layout::PegarIdioma();
		$usuario = Layout::PegarUsuario();
		$tipo = Layout::PegarTipo();
		include("idiomas/Layout/".$idioma.".php");
		print"
			<html>
			<head>
			<title>PHP Report - "._TITULO;
		print"
			</title>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
			<link href=\"estilo/estilo.css\" rel=\"stylesheet\" type=\"text/css\">
 			<script language=\"Javascript\" type=\"text/javascript\" src=\"scripts/scripts.js\"></script>
			</head>
			
			<body>
			<table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td height=\"100\" valign=\"top\">
						<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
										<tr>
											<td width=\"290\"><img src=\"imagens/Head-logo.jpg\" width=\"290\" height=\"58\"></td>
			<td align=\"center\" valign=\"middle\" background=\"imagens/Head-bg.jpg\">
		";
		if ($usuario!=null) print "<img src=\"imagens/usuario-$tipo.gif\" width=\"12\" height=\"25\" align=\"absbottom\">&nbsp;".$usuario;
		print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"imagens/calendario.gif\" width=\"25\" height=\"25\" align=\"absbottom\">&nbsp;"._LAYDATE."
									  </td>
										<td width=\"150\" align=\"center\" valign=\"middle\" background=\"imagens/Head-bg.jpg\">
		";
		if ($usuario!=null) print "<a href=\"FrPrincipal.php\"><img src=\"imagens/home.gif\" alt=\""._LAYHOME."\" width=\"40\" height=\"35\" border=\"0\"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?op=logout\"><img src=\"imagens/logout.gif\" alt=\""._LAYLOGOUT."\" width=\"24\" height=\"35\" border=\"0\"></a>";
		if ($idioma=="brazilian") print "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:help();\"><img src=\"imagens/help.gif\" alt=\""._LAYAJUDA."\" width=\"22\" height=\"35\" border=\"0\"></a>";
		print"
										</td>
									</tr>
					</table>
					<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td height=\"20\"><table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
									<tr>
										<td height=\"25\" background=\"imagens/menu-bg.gif\" align=\"center\">
		";
		Layout::Menu();
		print"
								 </td></tr>
								</table></td>
					</tr>
				</table></td>
				<td width=\"8\" rowspan=\"2\" valign=\"top\" background=\"imagens/SombraDir.gif\"><img src=\"imagens/SombraCima.gif\" width=\"8\" height=\"11\"></td>
			</tr>
			<tr>
				<td>
		";
	}

	static function Rodape(){
		print"
					</td>
				</tr>
				<tr>
					<td height=\"11\" background=\"imagens/SombraBaixo.gif\"><img src=\"imagens/SombraEsq.gif\" width=\"11\" height=\"11\"></td>
					<td width=\"8\" height=\"11\" background=\"imagens/SombraMeio.gif\"></td>
				</tr>
			</table>
			<span class=\"rodape\"><center>&copy; Copyright 2005, PHP Report<br>
			"._DESENVOLVIDOPOR." Daniela Schmalz, Leonardo Galv&#227;o e Marli Carneiro</center></span>
			</body>
			</html>
		";
	}
}
?>