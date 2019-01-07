<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class ExportarRelPHP {
	static function SelectsFrom($id,$tabela1,$tabela2,$tipo,$conecta)
	{
		$query1 = "SELECT CAMTABELA FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." AND CAMTABELA='".$tabela1."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$campo1 = $result1->numRows(); 
		$query1 = "SELECT FILTABELA FROM PHPREP_FILTRO WHERE RELCODIGO=".$id." AND FILTABELA='".$tabela1."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$filtro1 = $result1->numRows(); 
		$query1 = "SELECT AGRTABELA FROM PHPREP_AGRUPAMENTO WHERE RELCODIGO=".$id." AND AGRTABELA='".$tabela1."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$agrup1 = $result1->numRows(); 
		$query1 = "SELECT ORDTABELA FROM PHPREP_ORDENACAO WHERE RELCODIGO=".$id." AND ORDTABELA='".$tabela1."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$ordena1 = $result1->numRows(); 
		$query1 = "SELECT FORTABELA FROM PHPREP_FORMULA WHERE RELCODIGO=".$id." AND FORTABELA='".$tabela1."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$formula1 = $result1->numRows(); 
		$query1 = "SELECT GRAXTABELA FROM PHPREP_GRAFICO WHERE RELCODIGO=".$id." AND GRAXTABELA='".$tabela1."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$graficox1 = $result1->numRows(); 
		$query1 = "SELECT GRAYTABELA FROM PHPREP_GRAFICO WHERE RELCODIGO=".$id." AND GRAYTABELA='".$tabela1."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$graficoy1 = $result1->numRows(); 
		$query1 = "SELECT CAMTABELA FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." AND CAMTABELA='".$tabela2."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$campo2 = $result1->numRows(); 
		$query1 = "SELECT FILTABELA FROM PHPREP_FILTRO WHERE RELCODIGO=".$id." AND FILTABELA='".$tabela2."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$filtro2 = $result1->numRows(); 
		$query1 = "SELECT AGRTABELA FROM PHPREP_AGRUPAMENTO WHERE RELCODIGO=".$id." AND AGRTABELA='".$tabela2."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$agrup2 = $result1->numRows(); 
		$query1 = "SELECT ORDTABELA FROM PHPREP_ORDENACAO WHERE RELCODIGO=".$id." AND ORDTABELA='".$tabela2."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$ordena2 = $result1->numRows(); 
		$query1 = "SELECT FORTABELA FROM PHPREP_FORMULA WHERE RELCODIGO=".$id." AND FORTABELA='".$tabela2."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$formula2 = $result1->numRows(); 
		$query1 = "SELECT GRAXTABELA FROM PHPREP_GRAFICO WHERE RELCODIGO=".$id." AND GRAXTABELA='".$tabela2."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$graficox2 = $result1->numRows(); 
		$query1 = "SELECT GRAYTABELA FROM PHPREP_GRAFICO WHERE RELCODIGO=".$id." AND GRAYTABELA='".$tabela2."'";
		$result1 = $conecta->query($query1); 
		if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
		$graficoy2 = $result1->numRows(); 
		if ($tipo == "rel"){
			$busca1 = 0;
			$busca2 = 0;
			if ($campo1 != 0 || $filtro1 != 0 || $agrup1 != 0 || $ordena1 != 0) $busca1 = 1;
			if ($campo2 != 0 || $filtro2 != 0 || $agrup2 != 0 || $ordena2 != 0) $busca2 = 1;
			if ( ($busca1==1 && (($formula2==0  && $graficox2 == 0 && $graficoy2 == 0) || $busca2==1)) || ($busca2==1 && (($formula1==0  && $graficox1 == 0 && $graficoy1 == 0) || $busca1==1)) ) {
				return 1;
			} else return 0;
		} else if ($tipo == "form"){
			$busca1 = 0;
			$busca2 = 0;
			if ($campo1 != 0 || $filtro1 != 0 || $agrup1 != 0 || $ordena1 != 0 || $formula1 != 0) $busca1 = 1;
			if ($campo2 != 0 || $filtro2 != 0 || $agrup2 != 0 || $ordena2 != 0 || $formula2 != 0) $busca2 = 1;
			if ( ($busca1==1 && (($graficox2 == 0 && $graficoy2 == 0) || $busca2==1)) && ($busca2==1 && (($graficox1 == 0 && $graficoy1 == 0) || $busca1==1)) ) {
				return 1;
			} else return 0;
		} else if ($tipo == "gra"){
			$busca1 = 0;
			$busca2 = 0;
			if ($campo1 != 0 || $filtro1 != 0 || $agrup1 != 0 || $ordena1 != 0 || $graficox1 != 0 || $graficoy1 != 0) $busca1 = 1;
			if ($campo2 != 0 || $filtro2 != 0 || $agrup2 != 0 || $ordena2 != 0 || $graficox2 != 0 || $graficoy2 != 0) $busca2 = 1;
			if ( ($busca1==1 && ($formula2==0 || $busca2==1)) || ($busca2==1 && ($formula1==0  || $busca1==1)) ) {
				return 1;
			} else return 0;
		}
	}

	static function From($id,$tipo,$char_mysql,$conecta){
		$relacionam_tabela=null;
		$relacionam_usados=null;
		$relacionam_usados2=null;
		$query = "SELECT RTOTABELA1,RTOCAMPO1,RTOTABELA2,RTOCAMPO2 FROM PHPREP_RELACIONAM WHERE RELCODIGO=".$id;
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$rows = $result->numRows();
		if ($rows > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$tabela1 = $i->RTOTABELA1;
				$campo1 = $i->RTOCAMPO1;
				$tabela2 = $i->RTOTABELA2;
				$campo2 = $i->RTOCAMPO2;
				$relac1 = "$char_mysql".$tabela1."$char_mysql.$char_mysql".$campo1."$char_mysql";
				$relac2 = "$char_mysql".$tabela2."$char_mysql.$char_mysql".$campo2."$char_mysql"; 
				$selects = ExportarRelPHP::SelectsFrom($id,$tabela1,$tabela2,$tipo,$conecta); 
				if ($selects == 1) {
					if (($relacionam_tabela==null)||(!in_array($tabela1,$relacionam_tabela))) {
						$relacionam_tabela[] = $tabela1;
						$relacionam_usados[] = $relac1;
						$relacionam_usados2[] = $relac2;
					} 
					if (($relacionam_tabela==null)||(!in_array($tabela2,$relacionam_tabela))) {
						$relacionam_tabela[] = $tabela2;
						$relacionam_usados[] = $relac2;
						$relacionam_usados2[] = $relac1;
					}
				}
			}
		} 
		
		$from_rel=null;
		$tam = count($relacionam_usados);
		if ($tam>0) {
			for($i=1;$i<$tam;$i++) {
				$from_rel.=" INNER JOIN $char_mysql".$relacionam_tabela[$i]."$char_mysql ON(".$relacionam_usados[$i]."=".$relacionam_usados2[$i].")";
			}
			$from_rel=" FROM $char_mysql".$relacionam_tabela[0]."$char_mysql".$from_rel;
		} else {
			$query = "SELECT CAMTABELA FROM PHPREP_CAMPO WHERE RELCODIGO=".$id;
			$result = $conecta->query($query); 
			if (MDB2::isError($result)) die ($result->getDebugInfo()); 
			$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
			$tabela = $i->CAMTABELA;
			$from_rel=" FROM $char_mysql".$tabela."$char_mysql";
		}

		return $from_rel;
	}
	
	static function ImprimeDado($id,$dado,$coluna,$conecta){
		$query = "SELECT CORCONDICAO1,CORCONTEUDO1,CORFILTRO,CORCONDICAO2,CORCONTEUDO2,CORRGB FROM PHPREP_CAMPO cam INNER JOIN PHPREP_CORCAMPO cor ON (cam.RELCODIGO=cor.RELCODIGO AND cam.CAMCAMPO=cor.CORCAMPO AND cam.CAMTABELA=cor.CORTABELA) WHERE cam.RELCODIGO=".$id." AND cam.CAMORDEM=".$coluna;
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$rows = $result->numRows(); 
		$imprimiu=0;
		if ($rows > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
			if ($imprimiu==0) {
				$cond1 = $i->CORCONDICAO1;
				$cont1 = $i->CORCONTEUDO1;
				$eou = $i->CORFILTRO;
				$cond2 = $i->CORCONDICAO2;
				$cont2 = $i->CORCONTEUDO2;
				$corrgb = $i->CORRGB;
				
				$condicao="f";
				$condicao1="f";
				if ($eou!=null) {
print'
if(
';
				} else {
print'
if
';
				}
				switch($cond1){
					case "LIKE": 
					print'(strpos($dado,'.$cont1.') !== false)';
					break;
					case "NOT LIKE": 
					print'(strpos($dado,'.$cont1.') === false)';
					break;
					case ">": 
					print'($dado>'.$cont1.')';
					break;
					case ">=": 
					print'($dado>='.$cont1.')';
					break;
					case "<": 
					print'($dado<'.$cont1.')';
					break;
					case "<=": 
					print'($dado<='.$cont1.')';
					break;
					case "=": 
					print'($dado=='.$cont1.')';
					break;
					case "!=": 
					print'($dado!='.$cont1.')';
					break;
				}

				if ($eou!=null) {
					switch($eou){
						case "AND": print' && '; break;
						case "OR": print' || '; break;
					}
					switch($cond2){
						case "LIKE": print'(strpos($dado,'.$cont2.') !== false)){'; break;
						case "NOT LIKE": print'(strpos($dado,'.$cont2.') === false)){'; break;
						case ">": print'($dado>'.$cont2.')){'; break;
						case ">=": print'($dado>='.$cont2.')){'; break;
						case "<": print'($dado<'.$cont2.')){'; break;
						case "<=": print'($dado<='.$cont2.')){'; break;
						case "=": print'($dado=='.$cont2.')){'; break;
						case "!=": print'($dado!='.$cont2.')){'; break;
					}
				} else print '{';
				$imprimiu=1;
			}
			}
		} 
		if ($imprimiu==1){
print '
		print "<font color="#'.$corrgb.'>$dado</font>";
';
		} else {
print '
		print $dado;
';
		}
	}
	
	static function RelatorioPrinc($id,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta){
print '
function Relatorio($addwhere,$dsn){
$conecta = MDB2::connect($dsn); 
if (MDB2::isError($conecta)) die ($conecta->getMessage()); 
';
		$query = "SELECT CAMTITULO FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." ORDER BY CAMORDEM";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$colunas = $result->numRows(); 
		if ($colunas > 0){
print '
print "<tr>";
';
			if ($template==1) $fundo1 = "CCCCCC"; else $fundo1 = "9FD9FF";
			if ($template_nume==1) {
print '
print "<td bgcolor=\"#'.$fundo1.'\">&nbsp;</td>";
';
			}
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$titulo = $i->CAMTITULO;
print '
print "<td bgcolor=\"#'.$fundo1.'\"><strong>'.$titulo.'</strong></td>";
';
			}
print '
print "</tr>";
';
		}
		if ($sqlwhere==null){
print '
	if ($addwhere==null) $where = null;
	else $where = " WHERE ".$addwhere;
';
		} else {
print '
	if ($addwhere==null) $where = "'.$sqlwhere.'";
	else $where = "'.$sqlwhere.' AND ".$addwhere;
';
		}
print'
$stringsql = "'.$sqlselect.$from_rel.'".$where."'.$sqlorder.'";
$result = $conecta->query($stringsql);
if (MDB2::isError($result)) die ($result->getDebugInfo());
$linhas = $result->numRows();
if ($linhas > 0){
	$j=1;
	while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
		print "<tr>";
';
				if ($template_nume==1) {
print 'print "<td bgcolor=\"#'.$fundo1.'\" width=\"20\" align=\"center\">$j</td>";
';
				}
				if ($template==1) {
print '
		if ($j%2==0) $fundo = "F5F5F5"; else $fundo = "FFFFFF";
';
				} else {
print '
		if ($j%2==0) $fundo = "D7EFFF"; else $fundo = "F4FBFF";
';				
				}
				for($cont=0;$cont<$colunas;$cont++){
					$pegacoluna = "COLUNA".$cont;
					$dado = $i->$pegacoluna;
					if ($dado==null) $dado="&nbsp;";
print '
		$dado = $i->'.$pegacoluna.';
		if ($dado==null) $dado="&nbsp;";
';
print '
		print "<td bgcolor=\"#$fundo\">";
';
					ExportarRelPHP::ImprimeDado($id,$dado,$cont,$conecta);
print '
		print "</td>";
';
				}
print '
		print "</tr>";
';
print '
		$j++;
	}
	print "<tr><td colspan=\"'.$colspan.'\">&nbsp;</td></tr>";
}
';
		
		//imprime formulas do grupo
		$query = "SELECT FORCAMPO,FORTITULO FROM PHPREP_FORMULA WHERE RELCODIGO=".$id." AND FORAPLICACAO='g' ORDER BY FORORDEM";
		$result = $conecta->query($query);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$rows = $result->numRows();
		if ($rows > 0){
			$formulas=null;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$campo = $i->FORCAMPO;
				$titulo = $i->FORTITULO;
				$formulas[] = array($campo,$titulo);
			}
print '
$stringsql = "'.$sqlformgrup.$from_form.'".$where."'.$sqlgroup.'";
$result = $conecta->query($stringsql);
if (MDB2::isError($result)) die ($result->getDebugInfo());
$rows = $result->numRows();
if ($rows > 0){
	$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
';			
				
				for($cont=0;$cont<count($formulas);$cont++) {
					$pegatitulo = "FORMULAGRUPO".$formulas[$cont][0];
					
print '
	$formula = $i->'.$pegatitulo.';
	print "<tr><td colspan=\"'.$colspan.'\" align=\"right\"><strong>'.$formulas[$cont][1].'</strong>: $formula</td></tr><tr><td colspan=\"'.$colspan.'\">&nbsp;</td></tr>";
';
				}
print '
}
';
		} 
print '
}
';
	}

	static function RelatorioGrupo($id,$grupo,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan){
print '
function Grupo($grupo,$where,$dsn) {
	$agrupar_por = array(\'';
	for ($i=0;$i<$tam;$i++) {
		if($i!=0) print'\',\'';
		print $agrupar_por[$i];
	}
print '\');
	$tam = count($agrupar_por);
	$conecta = MDB2::connect($dsn); 
	if (MDB2::isError($conecta)) die ($conecta->getMessage()); 
	$agrupar = null;
	for ($i=0;$i<=$grupo;$i++) {
		if($i!=0) $agrupar .= ", ";
		$agrupar .= $agrupar_por[$i];
	}
	$select = $agrupar_por[$grupo];
	
	$addwhere = null;
	for($j=0;$j<$grupo;$j++){
		if ($j!=0) $addwhere.=" AND ";
		$addwhere.=$where[$j];
	}
';
		if ($sqlwhere==null){
print '
	if ($addwhere==null) $imp_where = null;
	else $imp_where = " WHERE ".$addwhere;
';
		} else {
print '
	if ($addwhere==null) $imp_where = "'.$sqlwhere.'";
	else $imp_where = "'.$sqlwhere.' AND ".$addwhere;
';
		}
print '
	$stringsql = "SELECT ".$select." AS GRUPO".$grupo."'.$from_rel.'".$imp_where." GROUP BY ".$agrupar;
';
		if(($grupo==0)&&($template_tipo==2)) {
print '
	print "<tr><td colspan=\"'.$colspan.'\" align=\"left\">";
	$stringsql = "SELECT ".$select." AS GRUPO".$grupo."'.$from_rel.'".$imp_where." GROUP BY ".$agrupar;
	$result = $conecta->query($stringsql);
	if (MDB2::isError($result)) die ($result->getDebugInfo());
	$paginas = $result->numRows();
	if(!isset($_GET["pagina"])) $pagina = 0; else $pagina = $_GET["pagina"];
	print " <input value=\" &lt; \" type=\"button\"";
	if($pagina > 0) {
		$menos = $pagina - 1;
		$url = $PHP_SELF."?pagina=$menos";
		print " onclick=\"javascript:window.open(\"$url\",\"_self\");\"";
	}
	print "> ";
	$pag_atual = $pagina+1;
	print ""._PAGINA." ".$pag_atual." "._DE." ".$paginas;
	print " <input value=\" &gt; \" type=\"button\"";
	if($pagina < $paginas) {
		$mais = $pagina + 1;
		$url = $PHP_SELF."?pagina=$mais";
		print " onclick=\"javascript:window.open(\"$url\",\"_self\");\"";
	}
	print ">";
	print "</td></tr><tr><td colspan=\"'.$colspan.'\">&nbsp;</td></tr>";
	
	$result = $conecta->limitQuery($stringsql, $pagina, 1);
';
		} else {
print'
	$result = $conecta->query($stringsql);
';
		}
print'
	if (MDB2::isError($result)) die ($result->getDebugInfo());
	$rows = $result->numRows();
	if ($rows > 0){
		while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
			$pegagrupo = "GRUPO".$grupo;
			$dado = $i->$pegagrupo;
			$dado = addslashes($dado);
			print "<tr><td colspan=\"'.$colspan.'\" class=\"grupo\">";
			for ($k=0;$k<$grupo;$k++) print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			print $dado."</td></tr><tr><td colspan=\"'.$colspan.'\">&nbsp;</td></tr>";
			$where[$grupo] = $select."=\'".$dado."\'";
			if($grupo==($tam-1)) {
				$addwhere=null;
				for($j=0;$j<=$grupo;$j++){
					if ($j!=0) $addwhere.=" AND ";
					$addwhere.=$where[$j];
				}
				Relatorio($addwhere,$dsn);
			} else {
				Grupo($grupo+1,$where,$dsn);
			}
		}
	}
}
';
	}

	static function VisualizarSalvo($id)
	{
		$conecta = Conexao::Conecta();
		
		$dados = VisualizarRel::GetDadosPrincipaisRelatorio($id, $conecta);
		$nomerel = $dados["nomerel"];
		$cabecalho = $dados["cabecalho"];
		$rodape = $dados["rodape"];
		$base = $dados["base"];
		$template = $dados["template"];
		$template_tipo = $dados["template_tipo"];
		$template_nume = $dados["template_nume"];
		$sqlselect = $dados["sqlselect"];
		$sqlfrom = $dados["sqlfrom"];
		$sqlwhere = $dados["sqlwhere"];
		$sqlorder = $dados["sqlorder"];
		$sqlgroup = $dados["sqlgroup"];
		$sqlformgrup = $dados["sqlformgrup"];
		$sqlformrel = $dados["sqlformrel"];
		
		//Adiciona caracter "´" nos inserts se mysql
		$char_mysql = "";
		$partes = split("¶", $base);
		$key_block = $partes[0];
		if (Config::$Servers[$key_block]["DBType"] == "mysql")
			$char_mysql = "`";
			
		$dbName = (Config::$Servers[$key_block]["DBName"] != "")
			? Config::$Servers[$key_block]["DBName"]
			: $partes[1];
		
		$from_rel = ExportarRelPHP::From($id,"rel",$char_mysql,$conecta);
		$from_form = ExportarRelPHP::From($id,"form",$char_mysql,$conecta);
		
print '
<?
$DBHostName = "'.Config::$Servers[$key_block]["DBHostName"].'"; //Host
$DBUserName = "'.Config::$Servers[$key_block]["DBUserName"].'"; //User
$DBPassword = "'.Config::$Servers[$key_block]["DBPassword"].'"; //Password
$DBName = "'.$dbName.'"; //Database
$DBType	= "'.Config::$Servers[$key_block]["DBType"].'";

require_once \'./MDB2.php\';
$dsn = "$DBType://$DBUserName:$DBPassword@$DBHostName/$DBName"; 
';
		$query = "SELECT CAMTITULO FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." ORDER BY CAMORDEM";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$colunas = $result->numRows(); 
		if ($template_nume==1) $colspan=$colunas+1; else $colspan=$colunas;
		
		$query = "SELECT AGRTABELA,AGRCAMPO FROM PHPREP_AGRUPAMENTO WHERE RELCODIGO=".$id." ORDER BY AGRNIVEL";
		$result = $conecta->query($query);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$grupos = $result->numRows();
		if ($grupos > 0){
			$agrupar_por=null;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$grup_tab = $i->AGRTABELA;
				$grup_cam = $i->AGRCAMPO;
				$agrupar_por[]="$char_mysql".$grup_tab."$char_mysql.$char_mysql".$grup_cam."$char_mysql";
			}
			$tam = count($agrupar_por);
			ExportarRelPHP::RelatorioPrinc($id,null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta);
			ExportarRelPHP::RelatorioGrupo($id,0,$agrupar_por,$tam,null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan);
		} else ExportarRelPHP::RelatorioPrinc($id,null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta);

print'
?>
<html>
<head>
<title>'.$nomerel.'</title>
<style type="text/css">
<!--
td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
.grupo {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
	font-weight: bold;
}
body {
	background-color: #FFFFFF;
	margin-top: 10px;
	margin-left: 10px;
	margin-bottom: 10px;
	margin-right: 10px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
-->
</style>
</head>
<body>
<p>'.$cabecalho.'</p>
<?
';

$query = "SELECT * FROM PHPREP_GRAFICO WHERE RELCODIGO=".$id;
$result = $conecta->query($query); 
if (MDB2::isError($result)) die ($result->getDebugInfo()); 
$rows = $result->numRows(); 
if ($rows > 0){
	$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
	$tipo = $i->GRATIPO;
	$titulo = $i->GRATITULO;
	$tabelax = $i->GRAXTABELA;
	$campox = $i->GRAEIXOX;
	$tabelay = $i->GRAYTABELA;
	$campoy = $i->GRAEIXOY;
	$legendax = $i->GRAXLEGENDA;
	$legenday = $i->GRAYLEGENDA;
	$from_gra = VisualizarRel::From($id,"gra",$char_mysql,$conecta);
	$host = $_SERVER['HTTP_REFERER']; 
	$pag = pathinfo($host);
	$pagina = $pag["dirname"]."/";
	$sqlwhere_gra = str_replace("'","[[aspas]]",$sqlwhere);
print '
	print "<center><iframe width=\"550\" height=\"300\" frameborder=\"0\" scrolling=\"no\"  marginheight=\"0\" marginwidth=\"0\" src=\"'.$pagina.'GraficoRelVisu.php?base='.$base.'&sqlselect='.$sqlselect.'&from_gra='.$from_gra.'&sqlwhere='.$sqlwhere_gra.'&tipo='.$tipo.'&titulo='.$titulo.'&tabelax='.$tabelax.'&campox='.$campox.'&tabelay='.$tabelay.'&campoy='.$campoy.'&legendax='.$legendax.'&legenday='.$legenday.'\"></iframe></center><br>";
';
}
print '
print "<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">";
';
if ($grupos > 0){
print '
Grupo(0,null,$dsn);
';
} else {
print '
Relatorio(null,$dsn);
';
}
		//imprime formulas do relatorio geral
		$query = "SELECT FORCAMPO,FORTITULO FROM PHPREP_FORMULA WHERE RELCODIGO=".$id." AND FORAPLICACAO='r' ORDER BY FORORDEM";
		$result = $conecta->query($query);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$rows = $result->numRows();
		if ($rows > 0){
			$formulas=null;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$campo = $i->FORCAMPO;
				$titulo = $i->FORTITULO;
				$formulas[] = array($campo,$titulo);
			}
print '
$stringsql = "'.$sqlformrel.$from_form.$sqlwhere.'";
$result = $conecta->query($stringsql);
if (MDB2::isError($result)) die ($result->getDebugInfo());
$rows = $result->numRows();
if ($rows > 0){
	$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
';
				for($cont=0;$cont<count($formulas);$cont++) {
					$pegatitulo = "FORMULA".$formulas[$cont][0];
print '
	$formula = $i->'.$pegatitulo.';
	print "<tr><td colspan=\"'.$colspan.'\" align=\"right\"><strong>'.$formulas[$cont][1].'</strong>: $formula</td></tr><tr><td colspan=\"'.$colspan.'\">&nbsp;</td></tr>";
';
				}
		}
print '
print "</table>";
?>
<p>'.$rodape.'</p>
</body>
</html>
';

Conexao::Desconecta($conecta);

	}
}
?>