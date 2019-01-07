<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class SalvarRel {
	static function NivelGrupos($niv,$acum,$end,$grupo){ 
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
				$acum="<option value=\"".$codigo."\"";
				if ($codigo==$grupo) $acum.=" selected";
				$acum.=">".$endereco."</option>";
				print $acum;
				SalvarRel::NivelGrupos($codigo,$acum,$endereco,$grupo);
			}
		} 
		Conexao::Desconecta($conecta);
	}
	
	static function CaixaGrupos($id){
		if ($id!="null"){
			$conecta = Conexao::Conecta();
			$query = "SELECT GRURELCOD FROM PHPREP_RELATORIO WHERE RELCODIGO='$id'";
			$result = $conecta->query($query); 
			if (MDB2::isError($result)) die ($result->getMessage()); 
			$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
			$grupo = $i->GRURELCOD;
		} else $grupo = null;
		SalvarRel::NivelGrupos(0,"","",$grupo);
	}
	
	static function NomeRel($id){
		$conecta = Conexao::Conecta();
		$query = "SELECT RELNOME FROM PHPREP_RELATORIO WHERE RELCODIGO='$id'";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
		return $i->RELNOME;
	}
	
	static function Salvar(){
		$data = strftime("%Y-%m-%d");
		$db = $_POST["db"];
		$id = $_POST["id"];
		if (($_POST["RelNome"] == null) || ($_POST["GrupoRel"] == "null")) die ("<script>alert('"._PREENCHATODOS."'); history.go(-1);</script>");
		
		if ($id == "null") $id = "¶ID_RELATORIO¶";
		$sql_inserts = array();
		
		//Adiciona caracter "´" nos inserts se mysql
		$partes = split("¶", $db);
		$key_block = $partes[0];
		if (Config::$Servers[$key_block]["DBType"] == "mysql")
		{
			$char_mysql = "`";
			$aspas_sql = "\'";
		}
		else
		{
			$char_mysql = "";
			$aspas_sql = "''";
		}

		$passo2 = "SELECT";
			$ordena_campos = GerarRel::OrdenarCampos2();
			$tam = count($ordena_campos);
			
			$larguras = null;
			
			if (isset($_POST["ColunasLargura"]))
				$larguras = split(",", $_POST["ColunasLargura"]);
				
			if (isset($_POST["ColunasLarguraTotal"]))
				$larguraTotal = $_POST["ColunasLarguraTotal"];
			
			for($i=0;$i<$tam;$i++) {
				$cam_tab = $ordena_campos[$i][0];
				list ($tabela, $campo) = split(",,,",$cam_tab);
				if ($i!=0) $passo2.=",";
				$passo2.=" $char_mysql".$tabela."$char_mysql.$char_mysql".$campo."$char_mysql AS COLUNA".$i;
				if (is_null($larguras))
					$largura = "null";
				else
					$largura = intval(($larguras[$i]*100) / $larguraTotal);
				$sql_inserts[] = "INSERT INTO PHPREP_CAMPO (RELCODIGO,CAMTABELA,CAMCAMPO,CAMTITULO,CAMORDEM,CAMLARGURA) VALUES ($id,'$tabela','$campo','".$ordena_campos[$i][1]."',$i,$largura)";
			}

		$passo11 = null;
			$qtd_campos = GerarRel::PegaQtdLinhas(11);
			$relacionam_tabelas = null;
			for($i=0;$i<$qtd_campos;$i++) {
				if (isset($_POST["tab_relac1".$i]) && $_POST["tab_relac1".$i]!="null" && isset($_POST["tab_relac2".$i]) && $_POST["tab_relac2".$i]!="null"){
					$sql_inserts[] = "INSERT INTO PHPREP_RELACIONAM (RELCODIGO,RTOTABELA1,RTOCAMPO1,RTOTABELA2,RTOCAMPO2) VALUES ($id,'".$_POST["tab_relac1".$i]."','".$_POST["cam_relac1".$i]."','".$_POST["tab_relac2".$i]."','".$_POST["cam_relac2".$i]."')";
					if (($relacionam_tabelas==null)||(!in_array($_POST["tab_relac1".$i],$relacionam_tabelas))) $relacionam_tabelas[] = $_POST["tab_relac1".$i];
					if (($relacionam_tabelas==null)||(!in_array($_POST["tab_relac2".$i],$relacionam_tabelas)))$relacionam_tabelas[] = $_POST["tab_relac2".$i];
				}
			}

			$tam = count($relacionam_tabelas);
			$relacionam_usados=null;
			for($i=1;$i<$tam;$i++) {
				$passo11.=" INNER JOIN";
				$tabela = $relacionam_tabelas[$i];
				$passo11.=" $char_mysql".$tabela."$char_mysql";
				for($j=0;$j<$tam-1;$j++) {
					$relacionam = array($_POST["tab_relac1".$j], $_POST["cam_relac1".$j], $_POST["tab_relac2".$j], $_POST["cam_relac2".$j]);
					$busca = array_search($tabela,$relacionam);
					if (($busca !== false)&&($busca!=1)&&($busca!=3)) {
						if (($relacionam_usados==null)||(!in_array($j,$relacionam_usados))) { 
							$relacionam_usados[]=$j;
							$chave = $j;
							//debug old echo "ch:".$chave.$_POST["tab_relac1".$j]." ".$_POST["cam_relac1".$j]." ".$_POST["tab_relac2".$j]." ".$_POST["cam_relac2".$j]."<p>";
							$j = $tam;
						}
					}
				}
				$passo11.=" ON($char_mysql".$_POST["tab_relac1".$chave]."$char_mysql.$char_mysql".$_POST["cam_relac1".$chave]."$char_mysql=$char_mysql".$_POST["tab_relac2".$chave]."$char_mysql.$char_mysql".$_POST["cam_relac2".$chave]."$char_mysql)";
			}
		$passo11=" FROM $char_mysql".$relacionam_tabelas[0]."$char_mysql".$passo11;
		
		$passo3 = null;
			$qtd_campos = GerarRel::PegaQtdLinhas(3);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_filt".$i]))&&($_POST["tab_filt".$i]!="null")) {
					if ($passo3!=null) $passo3.= " AND";
					if (($_POST["cond1_filt".$i]=="LIKE")||($_POST["cond1_filt".$i]=="NOT LIKE")) $conteudo1="%".$_POST["cont1_filt".$i]."%"; else $conteudo1=$_POST["cont1_filt".$i];
					$passo3.= " ($char_mysql".$_POST["tab_filt".$i]."$char_mysql.$char_mysql".$_POST["cam_filt".$i]."$char_mysql ".$_POST["cond1_filt".$i]." '".$conteudo1."'";
					if ($_POST["eou_filt".$i]!="null") {
						$passo3.= " ".$_POST["eou_filt".$i];
						$eou = "'".$_POST["eou_filt".$i]."'";
						$cond2 = "'".$_POST["cond2_filt".$i]."'";
						$cont2 = "'".$_POST["cont2_filt".$i]."'";
						if (($cond2=="LIKE")||($cond2=="NOT LIKE")) $conteudo2="%".$cont2."%"; else $conteudo2=$cont2;
						$passo3.= " $char_mysql".$_POST["tab_filt".$i]."$char_mysql.$char_mysql".$_POST["cam_filt".$i]."$char_mysql ".$cond2." '".$conteudo2."'";
					} else {
						$eou = 'null';
						$cond2 = 'null';
						$conteudo2 = 'null';
					}
					$passo3.= ")";
					$sql_inserts[] = "INSERT INTO PHPREP_FILTRO (RELCODIGO,FILTABELA,FILCAMPO,FILCONDICAO1,FILCONTEUDO1,FILFILTRO,FILCONDICAO2,FILCONTEUDO2) 
						VALUES ($id,'".$_POST["tab_filt".$i]."','".$_POST["cam_filt".$i]."','".$_POST["cond1_filt".$i]."','".$conteudo1."',".$eou.",".$cond2.",".$conteudo2.")";
				}
			}
		if ($passo3!=null) $passo3=" WHERE".$passo3;

		//passo4
			$ordena_campos = GerarRel::OrdenarCampos2();
			$tam = count($ordena_campos);
			for($i=0;$i<$tam;$i++) {
				$cam_tab = $ordena_campos[$i][0];
				list ($tabela, $campo) = split(",,,",$cam_tab);
				for ($j=0;$j<3;$j++){
					if (isset($_POST["cond1".$j."_cor".$i])) {
						if ($_POST["cont1".$j."_cor".$i]!=null) {
							if ($_POST["eou".$j."_cor".$i]!="null") $eou = $_POST["eou".$j."_cor".$i]; else $eou=null;
							$sql_inserts[] = "INSERT INTO PHPREP_CORCAMPO (RELCODIGO,CORTABELA,CORCAMPO,CORCONDICAO1,CORCONTEUDO1,CORFILTRO,CORCONDICAO2,CORCONTEUDO2,CORRGB) 
								VALUES ($id,'".$tabela."','".$campo."','".$_POST["cond1".$j."_cor".$i]."','".$_POST["cont1".$j."_cor".$i]."','".$eou."','".$_POST["cond2".$j."_cor".$i]."','".$_POST["cont2".$j."_cor".$i]."','".$_POST["cor".$j."_cor".$i]."')";
						}
					}
				}
			}

		$passo5=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(5);
			$cont = 0;
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_agrup".$i]))&&($_POST["tab_agrup".$i]!="null")) {
					if ($passo5!=null) $passo5.=",";
					$passo5.= " $char_mysql".$_POST["tab_agrup".$i]."$char_mysql.$char_mysql".$_POST["cam_agrup".$i]."$char_mysql";
					$sql_inserts[] = "INSERT INTO PHPREP_AGRUPAMENTO (RELCODIGO,AGRNIVEL,AGRTABELA,AGRCAMPO) 
						VALUES ($id,$cont,'".$_POST["tab_agrup".$i]."','".$_POST["cam_agrup".$i]."')";
					$cont++;
				}
			}
		if ($passo5!=null) $passo5=" GROUP BY".$passo5;
		
		$passo6=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(6);
			$cont = 0;
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_ord".$i]))&&($_POST["tab_ord".$i]!="null")) {
					if ($passo6!=null) $passo6.=",";
					$passo6.= " $char_mysql".$_POST["tab_ord".$i]."$char_mysql.$char_mysql".$_POST["cam_ord".$i]."$char_mysql ".$_POST["tipo_ord".$i];
					$sql_inserts[] = "INSERT INTO PHPREP_ORDENACAO (RELCODIGO,ORDTABELA,ORDCAMPO,ORDNIVEL,ORDORDEM) 
						VALUES ($id,'".$_POST["tab_ord".$i]."','".$_POST["cam_ord".$i]."',$cont,'".$_POST["tipo_ord".$i]."')";
					$cont++;
				}
			}
		if ($passo6!=null) $passo6=" ORDER BY".$passo6;
		
		$passo7grup=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(7);
			$cont = 0;
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_formrel".$i]))&&($_POST["tab_formrel".$i]!="null")) {
					if($_POST["uti_formrel".$i]=="g"){
						if($passo7grup!=null) $passo7grup.=",";
						$passo7grup.=" ".$_POST["tip_formrel".$i]."($char_mysql".$_POST["tab_formrel".$i]."$char_mysql.$char_mysql".$_POST["cam_formrel".$i]."$char_mysql) AS FORMULAGRUPO".$_POST["cam_formrel".$i];
						$sql_inserts[] = "INSERT INTO PHPREP_FORMULA (RELCODIGO,FORTIPO,FORTABELA,FORCAMPO,FORTITULO,FORAPLICACAO,FORORDEM) 
							VALUES ($id,'".$_POST["tip_formrel".$i]."','".$_POST["tab_formrel".$i]."','".$_POST["cam_formrel".$i]."','".$_POST["tit_formrel".$i]."','".$_POST["uti_formrel".$i]."',$cont)";
					 }
					 $cont++;
				}
			}
			if($passo7grup!=null) {
				$passo7grup="SELECT".$passo7grup;
			}


		$passo7=null;
			$qtd_campos = GerarRel::PegaQtdLinhas(7);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_formrel".$i]))&&($_POST["tab_formrel".$i]!="null")) {
					if($_POST["uti_formrel".$i]=="r"){
						if($passo7!=null) $passo7.=",";
						$passo7.=" ".$_POST["tip_formrel".$i]."($char_mysql".$_POST["tab_formrel".$i]."$char_mysql.$char_mysql".$_POST["cam_formrel".$i]."$char_mysql) AS FORMULA".$_POST["cam_formrel".$i];
						$sql_inserts[] = "INSERT INTO PHPREP_FORMULA (RELCODIGO,FORTIPO,FORTABELA,FORCAMPO,FORTITULO,FORAPLICACAO,FORORDEM) 
							VALUES ($id,'".$_POST["tip_formrel".$i]."','".$_POST["tab_formrel".$i]."','".$_POST["cam_formrel".$i]."','".$_POST["tit_formrel".$i]."','".$_POST["uti_formrel".$i]."',$cont)";
					 }
					 $cont++;
				}
			}
			if($passo7!=null) {
				$passo7="SELECT".$passo7;
			}

		//passo8
			if (isset($_POST["tab_graf1"])) {
				if (($_POST["tab_graf1"] != null) || ($_POST["tab_graf2"] != null)) {
					$sql_inserts[] = "INSERT INTO PHPREP_GRAFICO (RELCODIGO,GRATIPO,GRATITULO,GRAXTABELA,GRAEIXOX,GRAYTABELA,GRAEIXOY,GRAXLEGENDA,GRAYLEGENDA) 
					VALUES ($id,".$_POST["tip_graf"].",'".$_POST["tit_graf"]."','".$_POST["tab_graf1"]."','".$_POST["cam_graf1"]."','".$_POST["tab_graf2"]."','".$_POST["cam_graf2"]."','".$_POST["leg_graf1"]."','".$_POST["leg_graf2"]."')";
				}
			}

		//$stringsql = $passo2.$passo11.$passo3.$passo5.$passo6;
		
		$passo2 = str_replace("'",$aspas_sql,$passo2);
		$passo11 = str_replace("'",$aspas_sql,$passo11);
		$passo3 = str_replace("'",$aspas_sql,$passo3);
		$passo5 = str_replace("'",$aspas_sql,$passo5);
		$passo6 = str_replace("'",$aspas_sql,$passo6);
		$passo7grup = str_replace("'",$aspas_sql,$passo7grup);
		$passo7 = str_replace("'",$aspas_sql,$passo7);
		
		//Grava informações do relatório
		$conecta = Conexao::Conecta();
		
		if($id != "¶ID_RELATORIO¶"){
			SalvarRel::DelPartesRel($id, $conecta);
			$query = "UPDATE PHPREP_RELATORIO SET GRURELCOD=".$_POST["GrupoRel"].",RELNOME='".$_POST["RelNome"]."',
			RELDATAEDICAO='".$data."',RELUSUEDICAO='".$_SESSION["CodUsu"]."',RELCABECALHO='".$_POST["cabecalho"]."',
			RELRODAPE='".$_POST["rodape"]."',RELTEMPLATE=".$_POST["template"].",
			RELTEMPLATETIPO=".$_POST["template_tipo"].",RELTEMPLATENUME=".$_POST["template_nume"].",
			RELSQLSELECT='".$passo2."',RELSQLFROM='".$passo11."',RELSQLWHERE='".$passo3."',RELSQLORDER='".$passo6."',
			RELSQLGROUP='".$passo5."',RELSQLFORMGRUP='".$passo7grup."',RELSQLFORMREL='".$passo7."' 
			WHERE RELCODIGO=".$id;
			$result = $conecta->query($query); 
			if (MDB2::isError($result)) die ($result->getMessage());
		} else {
			$query = "INSERT INTO PHPREP_RELATORIO (GRURELCOD,USUCODIGO,RELNOME,RELDATACRIACAO,RELDATAEDICAO,RELUSUEDICAO,
			RELBASE,RELCABECALHO,RELRODAPE,RELTEMPLATE,RELTEMPLATETIPO,RELTEMPLATENUME,RELSQLSELECT,RELSQLFROM,
			RELSQLWHERE,RELSQLORDER,RELSQLGROUP,RELSQLFORMGRUP,RELSQLFORMREL) 
			VALUES (".$_POST["GrupoRel"].",".$_SESSION["CodUsu"].",'".$_POST["RelNome"]."','".$data."','".$data."',
			".$_SESSION["CodUsu"].",'".$db."','".$_POST["cabecalho"]."','".$_POST["rodape"]."',".$_POST["template"].",
			".$_POST["template_tipo"].",".$_POST["template_nume"].",'".$passo2."','".$passo11."','".$passo3."',
			'".$passo6."','".$passo5."','".$passo7grup."','".$passo7."')";
			$result = $conecta->query($query);
			if (MDB2::isError($result)) die ($result->getMessage());
			$newId = Query::lastID($conecta, Config::$PhpReportServer["DBType"], "PHPREP_RELATORIO", "RELCODIGO");
		}
		
		foreach ($sql_inserts as $sql_insert)
		{
			if ($id == "¶ID_RELATORIO¶")
				$sql_insert = str_replace("¶ID_RELATORIO¶", $newId, $sql_insert);
			
			$result = $conecta->query($sql_insert); 
			if (MDB2::isError($result)) die ($result->getMessage());
		}
		
		Conexao::Desconecta($conecta);
		
		$abre = ($id == "¶ID_RELATORIO¶") ? $newId : $id;
		
		header("Location: FrVisualizarRel.php?id=$abre");
	}
	
	static function DelPartesRel($id, $conecta){
		$query = "DELETE FROM PHPREP_RELACIONAM WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$query = "DELETE FROM PHPREP_FILTRO WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$query = "DELETE FROM PHPREP_CORCAMPO WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$query = "DELETE FROM PHPREP_AGRUPAMENTO WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$query = "DELETE FROM PHPREP_ORDENACAO WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$query = "DELETE FROM PHPREP_FORMULA WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$query = "DELETE FROM PHPREP_GRAFICO WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$query = "DELETE FROM PHPREP_CAMPO WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
	}
	
	static function DeletarRel($id)
	{
		$conecta = Conexao::Conecta();
		
		SalvarRel::DelPartesRel($id, $conecta);
		
		if($_SESSION["TipoUsu"]==2)
			$acessosBase = Usuario::GetUsuarioBases($_SESSION["CodUsu"]);

		$query = "SELECT RELNOME,RELBASE FROM PHPREP_RELATORIO WHERE RELCODIGO=$id";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage());
		$rows = $result->numRows(); 
		if ($rows>0) {
			$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
			$nome = $i->RELNOME;
			$base = $i->RELBASE;
			if($_SESSION["TipoUsu"]==2){
				if (!in_array($base, $acessosBase)) die("<script>alert('"._ACESSOBD."'); history.go(-1);</script>"); 
			}

			$query = "DELETE FROM PHPREP_RELATORIO WHERE RELCODIGO=$id";
			$result = $conecta->query($query); 
			if (MDB2::isError($result)) die ($result->getMessage()); 
			header("Location: FrRelatorio.php?msg="._ORELATORIO.$nome._FOIEXCLUIDO);
		}
		Conexao::Desconecta($conecta);
	}
}
?>