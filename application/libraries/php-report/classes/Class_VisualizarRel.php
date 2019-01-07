<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class VisualizarRel {
	static function SelectsFrom($id,$tabela1,$tabela2,$tipo,$conecta){
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
			if ( ($busca1==1 && (($graficox2 == 0 && $graficoy2 == 0) || $busca2==1)) || ($busca2==1 && (($graficox1 == 0 && $graficoy1 == 0) || $busca1==1)) ) {
				return 1;
			} else return 0;
		} else if ($tipo == "gra"){
			$busca1 = 0;
			$busca2 = 0;
			if ($campo1 != 0 || $filtro1 != 0 || $agrup1 != 0 || $ordena1 != 0 || $graficox1 != 0 || $graficoy1 != 0) $busca1 = 1;
			if ($campo2 != 0 || $filtro2 != 0 || $agrup2 != 0 || $ordena2 != 0 || $graficox2 != 0 || $graficoy2 != 0) $busca2 = 1;
			if ( ($busca1==1 && ($formula2==0 || $busca2==1)) || ($busca2==1 && ($formula1==0 || $busca1==1)) ) {
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
				$selects = VisualizarRel::SelectsFrom($id,$tabela1,$tabela2,$tipo,$conecta); 
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
				$cond1 = $i->CORCONDICAO1;
				$cont1 = $i->CORCONTEUDO1;
				$eou = $i->CORFILTRO;
				$cond2 = $i->CORCONDICAO2;
				$cont2 = $i->CORCONTEUDO2;
				$corrgb = $i->CORRGB;
				
				$condicao="f";
				$condicao1="f";
				switch($cond1){
					case "LIKE": if(strpos($dado,$cont1) !== false) $condicao1="t"; break;
					case "NOT LIKE": if(strpos($dado,$cont1) === false) $condicao1="t"; break;
					case ">": if ($dado>$cont1) $condicao1="t"; break;
					case ">=": if ($dado>=$cont1) $condicao1="t"; break;
					case "<": if ($dado<$cont1) $condicao1="t"; break;
					case "<=": if ($dado<=$cont1) $condicao1="t"; break;
					case "=": if ($dado==$cont1) $condicao1="t"; break;
					case "!=": if ($dado!=$cont1) $condicao1="t"; break;
				}

				if ($eou!=null) {
					$condicao2="f";
					switch($cond2){
						case "LIKE": if(strpos($dado,$cont2) !== false) $condicao2="t"; break;
						case "NOT LIKE": if(strpos($dado,$cont2) === false) $condicao2="t"; break;
						case ">": if ($dado>$cont2) $condicao2="t"; break;
						case ">=": if ($dado>=$cont2) $condicao2="t"; break;
						case "<": if ($dado<$cont2) $condicao2="t"; break;
						case "<=": if ($dado<=$cont2) $condicao2="t"; break;
						case "=": if ($dado==$cont2) $condicao2="t"; break;
						case "!=": if ($dado!=$cont2) $condicao2="t"; break;
					}
					switch($eou){
						case "AND": if(($condicao1=="t")&&($condicao2=="t")) $condicao="t"; break;
						case "OR": if(($condicao1=="t")||($condicao2=="t")) $condicao="t"; break;
					}
				} else {
					if ($condicao1=="t") $condicao="t";
				}
				if(($condicao=="t")&&($imprimiu==0)) {
					print "<font color=\"#".$corrgb."\">".$dado."</font>";
					$imprimiu=1;
				}
			}
		}
		if($imprimiu==0) print $dado;
	}
	
	static function RelatorioPrinc($id,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta,$conectaRel){
		$query = "SELECT CAMTITULO,CAMLARGURA FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." ORDER BY CAMORDEM";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$colunas = $result->numRows(); 
		if ($colunas > 0){
			print "<tr>";
			if ($template==1) $fundo1 = "CCCCCC"; else $fundo1 = "9FD9FF";
			if ($template_nume==1) print "<td bgcolor=\"#".$fundo1."\" width=\"20\">&nbsp;</td>";
			$cont = 0;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$titulo = $i->CAMTITULO;
				$largura = $i->CAMLARGURA;
				$colWidth = ($largura > 0) ? " width=\"$largura\"%" : "";
				print "<td bgcolor=\"#".$fundo1."\"$colWidth><strong>".$titulo."</strong></td>";
			}
			print "</tr>";
		}
		
		if (($sqlwhere==null)&&($addwhere==null)) $where = null;
		else if (($sqlwhere!=null)&&($addwhere!=null)) $where = $sqlwhere." AND ".$addwhere;
		else if (($sqlwhere==null)&&($addwhere!=null)) $where = " WHERE ".$addwhere; 
		else $where = $sqlwhere;
		
		$stringsql = $sqlselect.$from_rel.$where.$sqlorder;
		$result = $conectaRel->query($stringsql);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$linhas = $result->numRows();
		if ($linhas > 0){
			$j=1;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				print "<tr>";
				if ($template==1) {
					if ($j%2==0) $fundo = "F5F5F5"; else $fundo = "FFFFFF";
				} else {
					if ($j%2==0) $fundo = "D7EFFF"; else $fundo = "F4FBFF";
				}
				if ($template_nume==1) print "<td bgcolor=\"#".$fundo1."\" align=\"center\">".$j."</td>";
				for($cont=0;$cont<$colunas;$cont++){
					$pegacoluna = "COLUNA".$cont;
					$dado = $i->$pegacoluna;
					if ($dado==null) $dado="&nbsp;";
					print "<td bgcolor=\"#".$fundo."\">";
					VisualizarRel::ImprimeDado($id,$dado,$cont,$conecta);
					print "</td>";
				}
				print "</tr>";
				$j++;
			}
			print "<tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
		}
		
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
			
			$stringsql = $sqlformgrup.$from_form.$where.$sqlgroup;
			$result = $conectaRel->query($stringsql);
			if (MDB2::isError($result)) die ($result->getDebugInfo());
			$rows2 = $result->numRows();
			if ($rows2 > 0){
				$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
				for($cont=0;$cont<count($formulas);$cont++) {
					$pegatitulo = "FORMULAGRUPO".$formulas[$cont][0];
					$formula = $i->$pegatitulo;
					print "<tr><td colspan=\"".$colspan."\" align=\"right\"><strong>".$formulas[$cont][1]."</strong>: ".$formula."</td></tr><tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
				}
			}
		} 
	}

	static function RelatorioGrupo($id,$grupo,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta,$conectaRel){
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
		if (($sqlwhere==null)&&($addwhere==null)) $imp_where = null;
		else if (($sqlwhere!=null)&&($addwhere!=null)) $imp_where = $sqlwhere." AND ".$addwhere;
		else if (($sqlwhere==null)&&($addwhere!=null)) $imp_where = " WHERE ".$addwhere; 
		else $imp_where = $sqlwhere;
		
		if(($grupo==0)&&($template_tipo==2)) {
			print "<tr><td colspan=\"".$colspan."\" align=\"right\">";
			$stringsql = "SELECT ".$select." AS GRUPO".$grupo.$from_rel.$imp_where." GROUP BY ".$agrupar;
			$result = $conectaRel->query($stringsql);
			if (MDB2::isError($result)) die ($result->getDebugInfo());
			$paginas = $result->numRows();
			if(!isset($_GET["pagina"])) $pagina = 0; else $pagina = $_GET["pagina"];
			print " <input value=\" &lt; \" type=\"button\"";
			if($pagina > 0) {
				$menos = $pagina - 1;
				$url = "FrVisualizarRel1.php?id=$id&pagina=$menos";
				print " onclick=\"javascript:window.open('".$url."','_self');\"";
			}
			print "> ";
			$pag_atual = $pagina+1;
			print ""._PAGINA." ".$pag_atual." "._DE." ".$paginas;
			print " <input value=\" &gt; \" type=\"button\"";
			if($pag_atual < $paginas) {
				$mais = $pagina + 1;
				$url = "FrVisualizarRel1.php?id=$id&pagina=$mais";
				print " onclick=\"javascript:window.open('".$url."','_self');\"";
			}
			print ">";
			print "</td></tr><tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
		} else $pagina = -1;
		
		$stringsql = "SELECT ".$select." AS GRUPO".$grupo.$from_rel.$imp_where." GROUP BY ".$agrupar;
		if ($pagina > -1)
			$result = $conectaRel->limitQuery($stringsql, $pagina, 1);
		else
			$result = $conectaRel->query($stringsql);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$rows = $result->numRows();
		if ($rows > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$pegagrupo = "GRUPO".$grupo;
				$dado = $i->$pegagrupo;
				$dado = addslashes($dado);
				if ($grupo==0) $css_grupo = "grupo0"; else $css_grupo = "grupo";
				print "<tr><td colspan=\"".$colspan."\" class=\"".$css_grupo."\">";
				for ($k=0;$k<$grupo;$k++) print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				print $dado."</td></tr><tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
				$where[$grupo] = $select."='".$dado."'";
				if($grupo==($tam-1)) {
					$addwhere=null;
					for($j=0;$j<=$grupo;$j++){
						if ($j!=0) $addwhere.=" AND ";
						$addwhere.=$where[$j];
					}
					VisualizarRel::RelatorioPrinc($id,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta,$conectaRel);
				} else {
					VisualizarRel::RelatorioGrupo($id,$grupo+1,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta,$conectaRel);
				}
			}
		}
	}
	
	static function GetDadosPrincipaisRelatorio($id, $conecta)
	{
		$trataBlob = false;
		if (Config::$PhpReportServer["DBType"] != "mysql") $trataBlob = true;
		
		$query = "SELECT RELNOME,RELBASE,RELTEMPLATE,RELTEMPLATETIPO,RELTEMPLATENUME,
			RELCABECALHO,RELRODAPE,RELSQLSELECT,RELSQLFROM,RELSQLWHERE,RELSQLORDER,RELSQLGROUP,RELSQLFORMGRUP,RELSQLFORMREL
			FROM PHPREP_RELATORIO WHERE RELCODIGO=".$id;
		if ($trataBlob)
		{
			$result = $conecta->query($query, array('text','text','integer','integer','integer',
				'clob','clob','clob','clob','clob','clob','clob','clob','clob'));
		}
		else
		{
			$result = $conecta->query($query);
		}
		if (MDB2::isError($result) || !$result->valid()) die ($result->getDebugInfo());
		$rows = $result->numRows();
		if ($rows > 0){
			$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
			$nomerel = $i->RELNOME;
			$base = $i->RELBASE;
			$cabecalho = $i->RELCABECALHO;
			$rodape = $i->RELRODAPE;
			$template = $i->RELTEMPLATE;
			$template_tipo = $i->RELTEMPLATETIPO;
			$template_nume = $i->RELTEMPLATENUME;
			$sqlselect = $i->RELSQLSELECT;
			$sqlfrom = $i->RELSQLFROM;
			$sqlwhere = $i->RELSQLWHERE;
			$sqlorder = $i->RELSQLORDER;
			$sqlgroup = $i->RELSQLGROUP;
			$sqlformgrup = $i->RELSQLFORMGRUP;
			$sqlformrel = $i->RELSQLFORMREL;
			if ($sqlselect==null) die(""._ERRORELATORIO."");
		} else die(""._RELNAOENCONTRADO."");
		
		//Trata campos BLOB (testado no firebird)
		if ($trataBlob)
		{
			$sqlselect_value = '';
			if (!MDB2::isError($sqlselect) && is_resource($sqlselect))
			{
			    while (!feof($sqlselect)) {
			        $sqlselect_value.= fread($sqlselect, 8192);
			    }
			    $conecta->datatype->destroyLOB($sqlselect);
			}
			$sqlselect = $sqlselect_value;
			
			$cabecalho_value = '';
			if (!MDB2::isError($cabecalho) && is_resource($cabecalho))
			{
			    while (!feof($cabecalho)) {
			        $cabecalho_value.= fread($cabecalho, 8192);
			    }
			    $conecta->datatype->destroyLOB($cabecalho);
			}
			$cabecalho = $cabecalho_value;
			
			$rodape_value = '';
			if (!MDB2::isError($rodape) && is_resource($rodape))
			{
			    while (!feof($rodape)) {
			        $rodape_value.= fread($rodape, 8192);
			    }
			    $conecta->datatype->destroyLOB($rodape);
			}
			$rodape = $rodape_value;
			
			$sqlfrom_value = '';
			if (!MDB2::isError($sqlfrom) && is_resource($sqlfrom))
			{
			    while (!feof($sqlfrom)) {
			        $sqlfrom_value.= fread($sqlfrom, 8192);
			    }
			    $conecta->datatype->destroyLOB($sqlfrom);
			}
			$sqlfrom = $sqlfrom_value;
			
			$sqlwhere_value = '';
			if (!MDB2::isError($sqlwhere) && is_resource($sqlwhere))
			{
			    while (!feof($sqlwhere)) {
			        $sqlwhere_value.= fread($sqlwhere, 8192);
			    }
			    $conecta->datatype->destroyLOB($sqlwhere);
			}
			$sqlwhere = $sqlwhere_value;
			
			$sqlorder_value = '';
			if (!MDB2::isError($sqlorder) && is_resource($sqlorder))
			{
			    while (!feof($sqlorder)) {
			        $sqlorder_value.= fread($sqlorder, 8192);
			    }
			    $conecta->datatype->destroyLOB($sqlorder);
			}
			$sqlorder = $sqlorder_value;
			
			$sqlgroup_value = '';
			if (!MDB2::isError($sqlgroup) && is_resource($sqlgroup))
			{
			    while (!feof($sqlgroup)) {
			        $sqlgroup_value.= fread($sqlgroup, 8192);
			    }
			    $conecta->datatype->destroyLOB($sqlgroup);
			}
			$sqlgroup = $sqlgroup_value;
			
			$sqlformgrup_value = '';
			if (!MDB2::isError($sqlformgrup) && is_resource($sqlformgrup))
			{
			    while (!feof($sqlformgrup)) {
			        $sqlformgrup_value.= fread($sqlformgrup, 8192);
			    }
			    $conecta->datatype->destroyLOB($sqlformgrup);
			}
			$sqlformgrup = $sqlformgrup_value;
			
			$sqlformrel_value = '';
			if (!MDB2::isError($sqlformrel) && is_resource($sqlformrel))
			{
			    while (!feof($sqlformrel)) {
			        $sqlformrel_value.= fread($sqlformrel, 8192);
			    }
			    $conecta->datatype->destroyLOB($sqlformrel);
			}
			$sqlformrel = $sqlformrel_value;
		}
		
		$cabecalho = str_replace("[[aspas]]","\"",$cabecalho);
		$rodape = str_replace("[[aspas]]","\"",$rodape);
		
		$result->free();
		
		return array("nomerel" => $nomerel,
			"cabecalho" => $cabecalho,
			"rodape" => $rodape,
			"base" => $base,
			"template" => $template,
			"template_tipo" => $template_tipo,
			"template_nume" => $template_nume,
			"sqlselect" => $sqlselect,
			"sqlfrom" => $sqlfrom,
			"sqlwhere" => $sqlwhere,
			"sqlorder" => $sqlorder,
			"sqlgroup" => $sqlgroup,
			"sqlformgrup" => $sqlformgrup,
			"sqlformrel" => $sqlformrel);
	}
	
	static function VisualizarSalvo($id){
		
		$conecta = Conexao::Conecta();
		
		$dados = VisualizarRel::GetDadosPrincipaisRelatorio($id, $conecta);
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

		$conectaRel = Conexao::ConectaRel($base);

		//Adiciona caracter "´" nos inserts se mysql
		$char_mysql = "";
		$partes = split("¶", $base);
		$key_block = $partes[0];
		if (Config::$Servers[$key_block]["DBType"] == "mysql")
		{
			$char_mysql = "`";
		}
		
		print"<html>
		<head>
		<title>".$dados["nomerel"]."</title>
		<link href=\"estilo/visualizar.css\" rel=\"stylesheet\" type=\"text/css\">
		</head>
		<body>
		<p>".$dados["cabecalho"]."</p>
		";
		$query = "SELECT * FROM PHPREP_GRAFICO WHERE RELCODIGO=".$id;
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			$from_gra = VisualizarRel::From($id,"gra",$char_mysql,$conecta);
			$sqlwhere_gra = str_replace("'","[[aspas]]",$sqlwhere);
			print "<center><iframe width=\"550\" height=\"300\" frameborder=\"0\" scrolling=\"no\"  marginheight=\"0\" marginwidth=\"0\" src=\"GraficoRel.php?id=$id&base=$base&sqlselect=$sqlselect&from_gra=$from_gra&sqlwhere=$sqlwhere_gra\"></iframe></center><br>";
		}
		$result->free();
		
		$from_rel = VisualizarRel::From($id,"rel",$char_mysql,$conecta);
		$from_form = VisualizarRel::From($id,"form",$char_mysql,$conecta);
		
		$query = "SELECT CAMTITULO FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." ORDER BY CAMORDEM";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$colunas = $result->numRows();
		$result->free(); 
		
		if ($template_nume==1) $colspan=$colunas+1; else $colspan=$colunas;
		
		print "<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">";

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
			VisualizarRel::RelatorioGrupo($id,0,$agrupar_por,$tam,null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta,$conectaRel);
		} else VisualizarRel::RelatorioPrinc($id,null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conecta,$conectaRel);
		$result->free();
		
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
			$result->free();
			
			$stringsql = $sqlformrel.$from_form.$sqlwhere;
			$result = $conectaRel->query($stringsql);
			if (MDB2::isError($result)) die ($result->getDebugInfo());
			$rows2 = $result->numRows();
			if ($rows2 > 0){
				$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
				for($cont=0;$cont<count($formulas);$cont++) {
					$pegatitulo = "FORMULA".$formulas[$cont][0];
					$formula = $i->$pegatitulo;
					print "<tr><td colspan=\"".$colspan."\" align=\"right\"><strong>".$formulas[$cont][1]."</strong>: ".$formula."</td></tr><tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
				}
			}
		}
		$result->free();
		
		print "</table>";

		print"
		<p>".$dados["rodape"]."</p>
		</body>
		</html>";
		
		Conexao::Desconecta($conecta);
		Conexao::Desconecta($conectaRel);
	}
	
	static function DadosRel($id){
		$conecta = Conexao::Conecta();
		$query = "SELECT g.GRURELNOME,r.RELNOME,r.RELDATACRIACAO,r.RELDATAEDICAO,r.RELBASE,r.RELUSUEDICAO,r.USUCODIGO FROM PHPREP_RELATORIO r INNER JOIN PHPREP_GRUPOREL g ON(g.GRURELCOD=r.GRURELCOD) WHERE r.RELCODIGO=".$id;
		$result = $conecta->query($query);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$rows = $result->numRows();
		if ($rows > 0){
			$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
			$grupo = $i->GRURELNOME;
			$nomerel = $i->RELNOME;
			$base = $i->RELBASE;
			$data_criacao = $i->RELDATACRIACAO;
			if($_SESSION["Idioma"]=="brazilian") $data_criacao = Relatorio::InverteData($data_criacao);
			$data_edicao = $i->RELDATAEDICAO;
			if($_SESSION["Idioma"]=="brazilian") $data_edicao = Relatorio::InverteData($data_edicao);
			$usuedicao = $i->RELUSUEDICAO;
			$usucriacao = $i->USUCODIGO;

			$query2 = "SELECT USUUSUARIO FROM PHPREP_USUARIO WHERE USUCODIGO=".$usucriacao;
			$result2 = $conecta->query($query2);
			if (MDB2::isError($result2)) die ($result2->getDebugInfo());
			$rows2 = $result2->numRows();
			if ($rows2 > 0){
				$j = $result2->fetchRow(MDB2_FETCHMODE_OBJECT);
				$usucriacao = $j->USUUSUARIO;
			} else $usucriacao=""._USUNAOENCONTRADO."";
			$query2 = "SELECT USUUSUARIO FROM PHPREP_USUARIO WHERE USUCODIGO=".$usuedicao;
			$result2 = $conecta->query($query2);
			if (MDB2::isError($result2)) die ($result2->getDebugInfo());
			$rows2 = $result2->numRows();
			if ($rows2 > 0){
				$j = $result2->fetchRow(MDB2_FETCHMODE_OBJECT);
				$usuedicao = $j->USUUSUARIO;
			} else $usuedicao=""._USUNAOENCONTRADO."";
			
			print"<table width=\"50%\" border=\"0\" cellpadding=\"2\" cellspacing=\"4\" bgcolor=\"#FFFFFF\">
			  <tr bgcolor=\"#F8F8F8\">
				<td colspan=\"2\" align=\"center\"><h4>$nomerel</h4></td>
			  </tr>
				<tr bgcolor=\"#F8F8F8\">
				<td width=\"30%\" align=\"right\"><strong>"._GRUPO."</strong></td>
				<td width=\"70%\">$grupo</td>
			  </tr>
				<tr bgcolor=\"#F8F8F8\">
				<td align=\"right\"><strong>"._DATACRIACAO."</strong></td>
				<td>$data_criacao</td>
			  </tr>
				<tr bgcolor=\"#F8F8F8\">
				<td align=\"right\"><strong>"._USUCRIACAO."</strong></td>
				<td>$usucriacao</td>
			  </tr>
				<tr bgcolor=\"#F8F8F8\">
				<td align=\"right\"><strong>"._DATAEDICAO."</strong></td>
				<td>$data_edicao</td>
			  </tr>
				<tr bgcolor=\"#F8F8F8\">
				<td align=\"right\"><strong>"._USUEDICAO."</strong></td>
				<td>$usuedicao</td>
			  </tr>
				<tr bgcolor=\"#F8F8F8\">
				<td align=\"right\"><strong>"._BASEDADOS."</strong></td>
				<td>$base</td>
			  </tr>
			  </table><br><br>";
		}
	}
	
	static function VisuImprimeDado($id,$dado,$coluna){		
		$imprimiu=0;	
		for ($j=0;$j<3;$j++){
			if (isset($_POST["cond1".$j."_cor".$coluna])) {
				$cond1 = $_POST["cond1".$j."_cor".$coluna];
				$cont1 = $_POST["cont1".$j."_cor".$coluna];
				$eou = $_POST["eou".$j."_cor".$coluna];
				$corrgb = $_POST["cor".$j."_cor".$coluna];
				$condicao="f";
				$condicao1="f";
				switch($cond1){
					case "LIKE": if(strpos($dado,$cont1) !== false) $condicao1="t"; break;
					case "NOT LIKE": if(strpos($dado,$cont1) === false) $condicao1="t"; break;
					case ">": if ($dado>$cont1) $condicao1="t"; break;
					case ">=": if ($dado>=$cont1) $condicao1="t"; break;
					case "<": if ($dado<$cont1) $condicao1="t"; break;
					case "<=": if ($dado<=$cont1) $condicao1="t"; break;
					case "=": if ($dado==$cont1) $condicao1="t"; break;
					case "!=": if ($dado!=$cont1) $condicao1="t"; break;
				}
				if ($_POST["eou".$j."_cor".$coluna]!="null") {
					$cond2 = $_POST["cond2".$j."_cor".$coluna];
					$cont2 = $_POST["cont2".$j."_cor".$coluna];
					$condicao2="f";
					switch($cond2){
						case "LIKE": if(strpos($dado,$cont2) !== false) $condicao2="t"; break;
						case "NOT LIKE": if(strpos($dado,$cont2) === false) $condicao2="t"; break;
						case ">": if ($dado>$cont2) $condicao2="t"; break;
						case ">=": if ($dado>=$cont2) $condicao2="t"; break;
						case "<": if ($dado<$cont2) $condicao2="t"; break;
						case "<=": if ($dado<=$cont2) $condicao2="t"; break;
						case "=": if ($dado==$cont2) $condicao2="t"; break;
						case "!=": if ($dado!=$cont2) $condicao2="t"; break;
					}
					switch($eou){
						case "AND": if(($condicao1=="t")&&($condicao2=="t")) $condicao="t"; break;
						case "OR": if(($condicao1=="t")||($condicao2=="t")) $condicao="t"; break;
					}
				} else {
					if ($condicao1=="t") $condicao="t";
				}
				if(($condicao=="t")&&($imprimiu==0)) {
					print "<font color=\"#".$corrgb."\">".$dado."</font>";
					$imprimiu=1;
				}
			}
		}
		if($imprimiu==0) print $dado;
	}
	
	static function VisuRelatorioPrinc($id,$primeiraEntrada,$titulo_grupo,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conectaRel){
		$ordena_campos = GerarRel::OrdenarCampos2();
		$colunas = count($ordena_campos);
		if ($primeiraEntrada)
		{
			print "<thead><tr id=\"colunas\">";
			
			if ($template==1) $fundo1 = "CCCCCC"; else $fundo1 = "9FD9FF";
			if ($template_nume==1) print "<th bgcolor=\"#".$fundo1."\">&nbsp;</th>";
	
			for($i=0;$i<$colunas;$i++) {
				$titulo = $ordena_campos[$i][1];
				print "<th id=\"coluna".$i."\" bgcolor=\"#".$fundo1."\"><strong>".$titulo."</strong></th>";
			}
			print "</thead><tbody>";
			
			print "<tr>";
			for($cont=0;$cont<$colunas;$cont++) print "<td>&nbsp;</td>";
			print "</tr>";
			
			print $titulo_grupo;
		}
		
		if (($sqlwhere==null)&&($addwhere==null)) $where = null;
		else if (($sqlwhere!=null)&&($addwhere!=null)) $where = " ".$sqlwhere." AND ".$addwhere;
		else if (($sqlwhere==null)&&($addwhere!=null)) $where = " WHERE ".$addwhere; 
		else $where = " ".$sqlwhere;
		$stringsql = $sqlselect.$from_rel.$where.$sqlorder;
		$result = $conectaRel->query($stringsql);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$linhas = $result->numRows();
		if ($linhas > 0){
			$j=1;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				print "<tr>";
				if ($template==1) {
					if ($j%2==0) $fundo = "F5F5F5"; else $fundo = "FFFFFF";
				} else {
					if ($j%2==0) $fundo = "D7EFFF"; else $fundo = "F4FBFF";
				}
				if ($template_nume==1) print "<td bgcolor=\"#".$fundo1."\" width=\"20\" align=\"center\">".$j."</td>";
				for($cont=0;$cont<$colunas;$cont++){
					$pegacoluna = "COLUNA".$cont;
					$dado = $i->$pegacoluna;
					if ($dado==null) $dado="&nbsp;";
					print "<td bgcolor=\"#".$fundo."\">";
					VisualizarRel::VisuImprimeDado($id,$dado,$cont);
					print "</td>";
				}
				print "</tr>";
				$j++;
			}
			print "<tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
		}
		
		//imprime formulas do grupo
		if ($sqlformgrup != null){
			$formulas=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(7);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_formrel".$i]))&&($_POST["tab_formrel".$i]!="null")) {
					if($_POST["uti_formrel".$i]=="g"){
						$formulas[] = array($_POST["cam_formrel".$i],$_POST["tit_formrel".$i]);
					 }
				}
			}
			$stringsql = $sqlformgrup.$from_form.$where.$sqlgroup;
			$result = $conectaRel->query($stringsql);
			if (MDB2::isError($result)) die ($result->getDebugInfo());
			$rows2 = $result->numRows();
			if ($rows2 > 0){
				$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
				for($cont=0;$cont<count($formulas);$cont++) {
					$pegatitulo = "FORMULAGRUPO".$formulas[$cont][0];
					$formula = $i->$pegatitulo;
					print "<tr><td colspan=\"".$colspan."\" align=\"right\"><strong>".$formulas[$cont][1]."</strong>: ".$formula."</td></tr><tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
				}
			}
		}
	}

	static function VisuRelatorioGrupo($id,$grupo,$primeiraEntrada,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conectaRel){
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
		if (($sqlwhere==null)&&($addwhere==null)) $imp_where = null;
		else if (($sqlwhere!=null)&&($addwhere!=null)) $imp_where = $sqlwhere." AND ".$addwhere;
		else if (($sqlwhere==null)&&($addwhere!=null)) $imp_where = " WHERE ".$addwhere; 
		else $imp_where = $sqlwhere;

		if(($grupo==0)&&($template_tipo==2)) {
			print "<tr><td colspan=\"".$colspan."\" align=\"right\">";
			$stringsql = "SELECT ".$select." AS GRUPO".$grupo.$from_rel.$imp_where." GROUP BY ".$agrupar;
			$result = $conectaRel->query($stringsql);
			if (MDB2::isError($result)) die ($result->getDebugInfo());
			$paginas = $result->numRows();
			if(!isset($_GET["pagina"])) $pagina = 0; else $pagina = $_GET["pagina"];
			print " <input value=\" &lt; \" type=\"button\"";
			if($pagina > 0) {
				$menos = $pagina - 1;
				$url = "FrVisualizarRel.php?pagina=$menos&ver=1";
				print " onclick=\"javascript:EnviarForm('".$url."',document.form2);\"";
			}
			print "> ";
			$pag_atual = $pagina+1;
			print ""._PAGINA." ".$pag_atual." "._DE." ".$paginas;
			print " <input value=\" &gt; \" type=\"button\"";
			if($pag_atual < $paginas) {
				$mais = $pagina + 1;
				$url = "FrVisualizarRel.php?pagina=$mais&ver=1";
				print " onclick=\"javascript:EnviarForm('".$url."',document.form2);\"";
			}
			print ">";
			print "</td></tr><tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
		} else $pagina = -1;

		$stringsql = "SELECT ".$select." AS GRUPO".$grupo.$from_rel.$imp_where." GROUP BY ".$agrupar;
		if ($pagina > -1)
			$result = $conectaRel->limitQuery($stringsql, $pagina, 1);
		else
			$result = $conectaRel->query($stringsql);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$rows = $result->numRows();
		if ($rows > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$pegagrupo = "GRUPO".$grupo;
				$dado = $i->$pegagrupo;
				$dado = addslashes($dado);
				if ($grupo==0) $css_grupo = "grupo0"; else $css_grupo = "grupo";
				$titulo_grupo = "<tr><td colspan=\"".$colspan."\" class=\"".$css_grupo."\">";
				for ($k=0;$k<$grupo;$k++) $titulo_grupo .=  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				$titulo_grupo .=  $dado."</td></tr><tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
				if (!$primeiraEntrada) print $titulo_grupo;
				$where[$grupo] = $select."='".$dado."'";
				if($grupo==$tam-1) {
					$addwhere=null;
					for($j=0;$j<=$grupo;$j++){
						if ($j!=0) $addwhere.=" AND ";
						$addwhere.=$where[$j];
					}
					VisualizarRel::VisuRelatorioPrinc($id,$primeiraEntrada,$titulo_grupo,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conectaRel);
					$primeiraEntrada = false;
				} else if ($grupo<$tam) {
					VisualizarRel::VisuRelatorioGrupo($id,$primeiraEntrada,$grupo+1,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$colspan,$conectaRel);
				}
			}
		}
	}
	
	static function Visualizar($id){
		$base = $_POST["db"];
		$cabecalho = isset($_POST["cabecalho"]) ? $_POST["cabecalho"] : "";
		$cabecalho = str_replace("[[aspas]]","\"",$cabecalho);
		$rodape = isset($_POST["rodape"]) ? $_POST["rodape"] : "";
		$rodape = str_replace("[[aspas]]","\"",$rodape);
		$template = $_POST["template"];
		$template_tipo = $_POST["template_tipo"];
		$template_nume = $_POST["template_nume"];
		
		$conectaRel = Conexao::ConectaRel($base);
		
		//Adiciona caracter "´" nos inserts se mysql
		$char_mysql = "";
		$partes = split("¶", $base);
		$key_block = $partes[0];
		if (Config::$Servers[$key_block]["DBType"] == "mysql")
			$char_mysql = "`";
		
		$passo2 = "SELECT";
		$relacionam_from_rel=null;
			$ordena_campos = GerarRel::OrdenarCampos2();
			$colunas = count($ordena_campos);
			for($i=0;$i<$colunas;$i++) {
				$cam_tab = $ordena_campos[$i][0];
				list ($tabela, $campo) = split(",,,",$cam_tab);
				if ($i!=0) $passo2.=",";
				$passo2.=" $char_mysql".$tabela."$char_mysql.$char_mysql".$campo."$char_mysql AS COLUNA".$i;
				if ($relacionam_from_rel==null || !in_array($tabela,$relacionam_from_rel)) $relacionam_from_rel[] = $tabela;
			}

		if ($template_nume==1) $colspan=$colunas+1; else $colspan=$colunas;

		$passo11 = null;
		
		$passo3 = null;
			$qtd_campos = GerarRel::PegaQtdLinhas(3);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_filt".$i]))&&($_POST["tab_filt".$i]!="null")) {
					if ($relacionam_from_rel==null || !in_array($_POST["tab_filt".$i],$relacionam_from_rel)) $relacionam_from_rel[] = $_POST["tab_filt".$i];
					if ($passo3!=null) $passo3.= " AND";
					if (($_POST["cond1_filt".$i]=="LIKE")||($_POST["cond1_filt".$i]=="NOT LIKE")) $conteudo1="%".$_POST["cont1_filt".$i]."%"; else $conteudo1=$_POST["cont1_filt".$i];
					$passo3.= " ($char_mysql".$_POST["tab_filt".$i]."$char_mysql.$char_mysql".$_POST["cam_filt".$i]."$char_mysql ".$_POST["cond1_filt".$i]." '".$conteudo1."'";
					if ($_POST["eou_filt".$i]!="null") {
						$passo3.= " ".$_POST["eou_filt".$i];
						$eou = $_POST["eou_filt".$i];
						$cond2 = $_POST["cond2_filt".$i];
						$cont2 = $_POST["cont2_filt".$i];
						if (($cond2=="LIKE")||($cond2=="NOT LIKE")) $conteudo2="%".$cont2."%"; else $conteudo2=$cont2;
						$passo3.= " $char_mysql".$_POST["tab_filt".$i]."$char_mysql.$char_mysql".$_POST["cam_filt".$i]."$char_mysql ".$cond2." '".$conteudo2."'";
					} else {
						$eou = null;
						$cond2 = null;
						$conteudo2 = null;
					}
					$passo3.= ")";
				}
			}
		if ($passo3!=null) $passo3=" WHERE".$passo3;
		
		$passo5=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(5);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_agrup".$i]))&&($_POST["tab_agrup".$i]!="null")) {
					if ($relacionam_from_rel==null || !in_array($_POST["tab_agrup".$i],$relacionam_from_rel)) $relacionam_from_rel[] = $_POST["tab_agrup".$i];
					if ($passo5!=null) $passo5.=",";
					$passo5.= " $char_mysql".$_POST["tab_agrup".$i]."$char_mysql.$char_mysql".$_POST["cam_agrup".$i]."$char_mysql";
				}
			}
		if ($passo5!=null) $passo5=" GROUP BY".$passo5;
		
		$passo6=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(6);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_ord".$i]))&&($_POST["tab_ord".$i]!="null")) {
					if ($relacionam_from_rel==null || !in_array($_POST["tab_ord".$i],$relacionam_from_rel)) $relacionam_from_rel[] = $_POST["tab_ord".$i];
					if ($passo6!=null) $passo6.=",";
					$passo6.= " $char_mysql".$_POST["tab_ord".$i]."$char_mysql.$char_mysql".$_POST["cam_ord".$i]."$char_mysql ".$_POST["tipo_ord".$i];
				}
			}
		if ($passo6!=null) $passo6=" ORDER BY".$passo6;

		$passo7grup=null;
		$relacionam_from_form = null;
			$qtd_campos = GerarRel::PegaQtdLinhas(7);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_formrel".$i]))&&($_POST["tab_formrel".$i]!="null")) {
					if ($relacionam_from_form==null || !in_array($_POST["tab_formrel".$i],$relacionam_from_form)) $relacionam_from_form[] = $_POST["tab_formrel".$i];
					if($_POST["uti_formrel".$i]=="g"){
						if($passo7grup!=null) $passo7grup.=",";
						$passo7grup.=" ".$_POST["tip_formrel".$i]."($char_mysql".$_POST["tab_formrel".$i]."$char_mysql.$char_mysql".$_POST["cam_formrel".$i]."$char_mysql) AS FORMULAGRUPO".$_POST["cam_formrel".$i];
					 }
				}
			}
			if($passo7grup!=null) {
				$passo7grup="SELECT".$passo7grup;
			}

			$relacionam_from_gra = null;
			if (isset($_POST["tab_graf1"])) {
				if (($_POST["tab_graf1"] != null) || ($_POST["tab_graf2"] != null)) {
					$relacionam_from_gra[] = $_POST["tab_graf1"];
					if ($_POST["tab_graf1"] != $_POST["tab_graf2"]) $relacionam_from_gra[] = $_POST["tab_graf2"];
				}
			}

			$qtd_campos = GerarRel::PegaQtdLinhas(11);
			$relacionam_tabela = null;
			$relacionam_usados=null;
			$relacionam_usados2=null;
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_relac1".$i])) && ($_POST["tab_relac1".$i]!="null") && ($_POST["tab_relac2".$i]!="null")){
					if ( (in_array($_POST["tab_relac1".$i],$relacionam_from_rel) && ((($relacionam_from_form==null || !in_array($_POST["tab_relac2".$i],$relacionam_from_form)) && ($relacionam_from_gra==null || !in_array($_POST["tab_relac2".$i],$relacionam_from_gra))) || in_array($_POST["tab_relac2".$i],$relacionam_from_rel))) || (in_array($_POST["tab_relac2".$i],$relacionam_from_rel) && ((($relacionam_from_form==null || !in_array($_POST["tab_relac1".$i],$relacionam_from_form)) && ($relacionam_from_gra==null || !in_array($_POST["tab_relac1".$i],$relacionam_from_gra))) || in_array($_POST["tab_relac1".$i],$relacionam_from_rel))) ){
						if ($relacionam_tabela==null || !in_array($_POST["tab_relac1".$i],$relacionam_tabela)) {
							$relacionam_tabela[] = $_POST["tab_relac1".$i];
							$relacionam_usados[] = "$char_mysql".$_POST["tab_relac1".$i]."$char_mysql.$char_mysql".$_POST["cam_relac1".$i]."$char_mysql";
							$relacionam_usados2[] = "$char_mysql".$_POST["tab_relac2".$i]."$char_mysql.$char_mysql".$_POST["cam_relac2".$i]."$char_mysql";
						}
						if ($relacionam_tabela==null || !in_array($_POST["tab_relac2".$i],$relacionam_tabela)) {
							$relacionam_tabela[] = $_POST["tab_relac2".$i];
							$relacionam_usados[] = "$char_mysql".$_POST["tab_relac2".$i]."$char_mysql.$char_mysql".$_POST["cam_relac2".$i]."$char_mysql";
							$relacionam_usados2[] = "$char_mysql".$_POST["tab_relac1".$i]."$char_mysql.$char_mysql".$_POST["cam_relac1".$i]."$char_mysql";
						}
					}
				}
			}
			if ($relacionam_tabela==null){
				$cam_tab = $ordena_campos[0][0];
				list ($tabela, $campo) = split(",,,",$cam_tab);
				$relacionam_tabela[] = $tabela;
			}
		$from_rel=null;
		$tam = count($relacionam_usados);
		if ($tam>=0) {
			for($i=1;$i<$tam;$i++) {
				$from_rel.=" INNER JOIN $char_mysql".$relacionam_tabela[$i]."$char_mysql ON(".$relacionam_usados[$i]."=".$relacionam_usados2[$i].")";
			}
		} 
		$from_rel=" FROM $char_mysql".$relacionam_tabela[0]."$char_mysql".$from_rel;
		
		$from_form=null;
		if ($relacionam_from_form!=null) {
			$relacionam_tabela = null;
			$relacionam_usados=null;
			$relacionam_usados2=null;
			for($i=0;$i<$qtd_campos;$i++) {
				if ($_POST["tab_relac1".$i]!="null" && $_POST["tab_relac2".$i]!="null"){
					if ( ((in_array($_POST["tab_relac1".$i],$relacionam_from_rel) || in_array($_POST["tab_relac1".$i],$relacionam_from_form)) && (($relacionam_from_gra==null || !in_array($_POST["tab_relac2".$i],$relacionam_from_gra)) || in_array($_POST["tab_relac2".$i],$relacionam_from_rel) || in_array($_POST["tab_relac2".$i],$relacionam_from_form))) || ((in_array($_POST["tab_relac2".$i],$relacionam_from_rel) || in_array($_POST["tab_relac2".$i],$relacionam_from_form)) && (($relacionam_from_gra==null || !in_array($_POST["tab_relac1".$i],$relacionam_from_gra)) || in_array($_POST["tab_relac1".$i],$relacionam_from_rel) || in_array($_POST["tab_relac1".$i],$relacionam_from_form))) ){
						if ($relacionam_tabela==null || !in_array($_POST["tab_relac1".$i],$relacionam_tabela)) {
							$relacionam_tabela[] = $_POST["tab_relac1".$i];
							$relacionam_usados[] = "$char_mysql".$_POST["tab_relac1".$i]."$char_mysql.$char_mysql".$_POST["cam_relac1".$i]."$char_mysql";
							$relacionam_usados2[] = "$char_mysql".$_POST["tab_relac2".$i]."$char_mysql.$char_mysql".$_POST["cam_relac2".$i]."$char_mysql";
						}
						if ($relacionam_tabela==null || !in_array($_POST["tab_relac2".$i],$relacionam_tabela)) {
							$relacionam_tabela[] = $_POST["tab_relac2".$i];
							$relacionam_usados[] = "$char_mysql".$_POST["tab_relac2".$i]."$char_mysql.$char_mysql".$_POST["cam_relac2".$i]."$char_mysql";
							$relacionam_usados2[] = "$char_mysql".$_POST["tab_relac1".$i]."$char_mysql.$char_mysql".$_POST["cam_relac1".$i]."$char_mysql";
						}
					}
				}
			}
			if ($relacionam_tabela==null){
				$cam_tab = $ordena_campos[0][0];
				list ($tabela, $campo) = split(",,,",$cam_tab);
				$relacionam_tabela[] = $tabela;
			}

			$tam = count($relacionam_usados);
			if ($tam>=0) {
				for($i=1;$i<$tam;$i++) {
					$from_form.=" INNER JOIN $char_mysql".$relacionam_tabela[$i]."$char_mysql ON(".$relacionam_usados[$i]."=".$relacionam_usados2[$i].")";
				}
				$from_form=" FROM $char_mysql".$relacionam_tabela[0]."$char_mysql".$from_form;
			}
		}

		$from_gra="";
		if ($relacionam_from_gra!=null) {
			$relacionam_tabela = null;
			$relacionam_usados=null;
			$relacionam_usados2=null;
			for($i=0;$i<$qtd_campos;$i++) {
				if ($_POST["tab_relac1".$i]!="null" && $_POST["tab_relac2".$i]!="null"){
					if ( ((in_array($_POST["tab_relac1".$i],$relacionam_from_rel) || in_array($_POST["tab_relac1".$i],$relacionam_from_gra)) && (($relacionam_from_form==null || !in_array($_POST["tab_relac2".$i],$relacionam_from_form)) || in_array($_POST["tab_relac2".$i],$relacionam_from_rel) || in_array($_POST["tab_relac2".$i],$relacionam_from_gra))) || ((in_array($_POST["tab_relac2".$i],$relacionam_from_rel) || in_array($_POST["tab_relac2".$i],$relacionam_from_gra)) && (($relacionam_from_form==null || !in_array($_POST["tab_relac1".$i],$relacionam_from_form)) || in_array($_POST["tab_relac1".$i],$relacionam_from_rel) || in_array($_POST["tab_relac1".$i],$relacionam_from_gra))) ){
						if ($relacionam_tabela==null || !in_array($_POST["tab_relac1".$i],$relacionam_tabela)) {
							$relacionam_tabela[] = $_POST["tab_relac1".$i];
							$relacionam_usados[] = "$char_mysql".$_POST["tab_relac1".$i]."$char_mysql.$char_mysql".$_POST["cam_relac1".$i]."$char_mysql";
							$relacionam_usados2[] = "$char_mysql".$_POST["tab_relac2".$i]."$char_mysql.$char_mysql".$_POST["cam_relac2".$i]."$char_mysql";
						}
						if ($relacionam_tabela==null || !in_array($_POST["tab_relac2".$i],$relacionam_tabela)) {
							$relacionam_tabela[] = $_POST["tab_relac2".$i];
							$relacionam_usados[] = "$char_mysql".$_POST["tab_relac2".$i]."$char_mysql.$char_mysql".$_POST["cam_relac2".$i]."$char_mysql";
							$relacionam_usados2[] = "$char_mysql".$_POST["tab_relac1".$i]."$char_mysql.$char_mysql".$_POST["cam_relac1".$i]."$char_mysql";
						}
					}
				}
			}
			if ($relacionam_tabela==null){
				$cam_tab = $ordena_campos[0][0];
				list ($tabela, $campo) = split(",,,",$cam_tab);
				$relacionam_tabela[] = $tabela;
			}

			$tam = count($relacionam_usados);
			if ($tam>=0) {
				for($i=1;$i<$tam;$i++) {
					$from_gra.=" INNER JOIN $char_mysql".$relacionam_tabela[$i]."$char_mysql ON(".$relacionam_usados[$i]."=".$relacionam_usados2[$i].")";
				}
				$from_gra=" FROM $char_mysql".$relacionam_tabela[0]."$char_mysql".$from_gra;
			}
		}
		
		print "
		<script type=\"text/javascript\" src=\"scripts/jquery-1.6.2.js\"></script>
		<script type=\"text/javascript\" src=\"scripts/jquery.ingrid.js\"></script>
		<link rel=\"stylesheet\" href=\"estilo/ingrid.css\" type=\"text/css\" media=\"screen\" />
		
		<script type=\"text/javascript\">
		$(document).ready(
			function() {
				regNumW = ".(($template_nume==1)?"25":"0")."
				qtdCol = ".$colunas.";
				colWidth = parseInt((viewportwidth-80-regNumW)/qtdCol);
				colWidths = new Array();
		";

		if ($template_nume==1)
		{
			print"
				colWidths.push(25);
			";
		}
		
		for ($i = 0; $i < $colunas; $i++)
		{
			print"
				colWidths.push(colWidth);
			";
		}	
		print"
				$(\"#table1\").ingrid({ 
					height: 350,
					colWidths: colWidths,
					resizableCols: true,
					paging: false,
					sorting: false
				});
			}
		);
		
		
		function EnviarFormVisualiza(salva)
		{
			if (salva == 1)
				document.form1.action = 'FrGerarRelSalvar.php';
			else
				document.form1.action = 'FrGerarRel11.php';
			
			var larguras = new Array();
";
for ($i = 0; $i < $colunas; $i++)
{
	print "
			larguras.push($('#coluna".$i."').width());
	";
}
print "
			document.form1.Salvar.value = salva;
			document.form1.ColunasLargura.value = larguras.join(',');
			document.form1.ColunasLarguraTotal.value = $('#colunas').width();
			document.form1.submit();
		}
		</script>
		";
		
		print"<p>$cabecalho</p>";

		if (isset($_POST["tab_graf1"])) {
			if (($_POST["tab_graf1"] != null) || ($_POST["tab_graf2"] != null)) {
				$sqlwhere_gra = str_replace("'","[[aspas]]",$passo3);
				print "<center><iframe width=\"550\" height=\"300\" frameborder=\"0\" scrolling=\"no\"  marginheight=\"0\" marginwidth=\"0\" src=\"GraficoRelVisu.php?base=".$base."&sqlselect=".$passo2."&from_gra=".$from_gra."&sqlwhere=".$sqlwhere_gra."&tipo=".$_POST["tip_graf"]."&titulo=".$_POST["tit_graf"]."&tabelax=".$_POST["tab_graf1"]."&campox=".$_POST["cam_graf1"]."&tabelay=".$_POST["tab_graf2"]."&campoy=".$_POST["cam_graf2"]."&legendax=".$_POST["leg_graf1"]."&legenday=".$_POST["leg_graf2"]."\"></iframe></center><br>";
			}
		}

		print "<table id=\"table1\">";
		//print "<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">";
		if ($passo5 != null){
			$agrupar_por=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(5);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_agrup".$i]))&&($_POST["tab_agrup".$i]!="null")) {
					$agrupar_por[]="$char_mysql".$_POST["tab_agrup".$i]."$char_mysql.$char_mysql".$_POST["cam_agrup".$i]."$char_mysql";
				}
			}
			VisualizarRel::VisuRelatorioGrupo($id,0,true,$agrupar_por,count($agrupar_por),null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$passo2,$passo11,$passo3,$passo6,$passo5,$passo7grup,$colspan,$conectaRel);
		} else VisualizarRel::VisuRelatorioPrinc($id,true,null,null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$passo2,$passo11,$passo3,$passo6,$passo5,$passo7grup,$colspan,$conectaRel);

		//imprime formulas do relatorio geral
		$passo7=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(7);
			$formulas=null;
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_formrel".$i]))&&($_POST["tab_formrel".$i]!="null")) {
					if($_POST["uti_formrel".$i]=="r"){
						if($passo7!=null) $passo7.=",";
						$passo7.=" ".$_POST["tip_formrel".$i]."($char_mysql".$_POST["tab_formrel".$i]."$char_mysql.$char_mysql".$_POST["cam_formrel".$i]."$char_mysql) AS FORMULA".$_POST["cam_formrel".$i];
						$formulas[] = array($_POST["cam_formrel".$i],$_POST["tit_formrel".$i]);
					 }
				}
			}
			if($passo7!=null) {
				$passo7="SELECT".$passo7;
			}

		if ($passo7 != null){
			$stringsql = $passo7.$from_form.$passo3;
			$result = $conectaRel->query($stringsql);
			if (MDB2::isError($result)) die ($result->getDebugInfo());
			$rows2 = $result->numRows();
			if ($rows2 > 0){
				$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
				for($cont=0;$cont<count($formulas);$cont++) {
					$pegatitulo = "FORMULA".$formulas[$cont][0];
					$formula = $i->$pegatitulo;
					print "<tr><td colspan=\"".$colspan."\" align=\"right\"><strong>".$formulas[$cont][1]."</strong>: ".$formula."</td></tr><tr><td colspan=\"".$colspan."\">&nbsp;</td></tr>";
				}
			}
		}
		print "</tbody></table>";
		print"<p>&nbsp;</p>";
		print"<p>$rodape</p>";
		
		Conexao::Desconecta($conectaRel);
	}
}
?>