<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class ExportarRelCSV {
	static function RelatorioPrinc($id,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conecta,$conectaRel){
		$query = "SELECT CAMTITULO FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." ORDER BY CAMORDEM";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$colunas = $result->numRows(); 
		print "\n";
		if ($colunas > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$titulo = $i->CAMTITULO;
				print "".$titulo.";";
			}
			print "\n";
		}

		if (($sqlwhere==null)&&($addwhere==null)) $where = null;
		else if (($sqlwhere!=null)&&($addwhere!=null)) $where = $sqlwhere." AND ".$addwhere;
		else if (($sqlwhere==null)&&($addwhere!=null)) $where = " WHERE ".$addwhere; 
		else $where = $sqlwhere;
		$stringsql = $sqlselect.$from_rel.$where.$sqlorder;
		$result = $conectaRel->query($stringsql);
				if (MDB2::isError($result)) die ($result->getDebugInfo());
				$linhas = $result->numRows();
				if ($linhas > 0) {
					while($j = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {		
						for($id_coluna=0;$id_coluna<$colunas;$id_coluna++){
							
							$pegacoluna = "COLUNA".$id_coluna;
							$dado = $j->$pegacoluna;
							$query = "SELECT CAMCAMPO FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." AND CAMORDEM=".$id_coluna;
							$result1 = $conecta->query($query); 
							if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
							$i = $result1->fetchRow(MDB2_FETCHMODE_OBJECT);
							$titulo = $i->CAMCAMPO;
							if ($dado!=null) print "".$dado.";";
						}
						print "\n";
					}
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
					print "$pegatitulo : ".$formula.";\n\n";
				}
			}
		} 
	}

	static function RelatorioGrupo($id,$grupo,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conecta,$conectaRel){
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
		print "\n";
		$stringsql = "SELECT ".$select." AS GRUPO".$grupo.$from_rel.$imp_where." GROUP BY ".$agrupar;
		$result = $conectaRel->query($stringsql);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$rows = $result->numRows();
		if ($rows > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$pegagrupo = "GRUPO".$grupo;
				$dado = $i->$pegagrupo;
				
				print "".$dado."\n";
				
				$where[$grupo] = $select."='".$dado."'";
				if($grupo==$tam-1) {
					$addwhere=null;
					for($j=0;$j<=$grupo;$j++){
						if ($j!=0) $addwhere.=" AND ";
						$addwhere.=$where[$j];
					}
					ExportarRelCSV::RelatorioPrinc($id,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conecta,$conectaRel);
				} else if ($grupo<$tam) {
					ExportarRelCSV::RelatorioGrupo($id,$grupo+1,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conecta,$conectaRel);
				}
				print "\n";
			}
		}
	}
	
	static function VisualizarSalvo($id)
	{
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
			$char_mysql = "`";
		
		$from_rel = VisualizarRel::From($id,"rel",$char_mysql,$conecta);
		$from_form = VisualizarRel::From($id,"form",$char_mysql,$conecta);
		
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
			ExportarRelCSV::RelatorioGrupo($id,0,$agrupar_por,count($agrupar_por),null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conecta,$conectaRel);
		} else ExportarRelCSV::RelatorioPrinc($id,null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conecta,$conectaRel);

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
			
			$stringsql = $sqlformrel.$from_form.$sqlwhere;
			$result = $conectaRel->query($stringsql);
			if (MDB2::isError($result)) die ($result->getDebugInfo());
			$rows2 = $result->numRows();
			if ($rows2 > 0){
				$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
				for($cont=0;$cont<count($formulas);$cont++) {
					$pegatitulo = "FORMULA".$formulas[$cont][0];
					$formula = $i->$pegatitulo;
					print "".$pegatitulo." : ".$formula.";\n\n";
				}
			}
		}
		
		Conexao::Desconecta($conecta);
		Conexao::Desconecta($conectaRel);
	}

}
?>