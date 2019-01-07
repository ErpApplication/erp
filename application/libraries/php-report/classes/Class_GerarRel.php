<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galv�o and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class GerarRel {
	static function PegarDb($ver_acesso){
		if (isset($_POST['db'])){
			$base = $_POST['db'];
		} else {
			if (isset($_POST["duplicar"])) {
				$relatorio = $_POST["duplicar"]; 
			} else if (isset($_GET["id"])) {
				$relatorio = $_GET["id"]; 
			}
			$conecta = Conexao::Conecta();
			$query = "SELECT RELBASE FROM PHPREP_RELATORIO WHERE RELCODIGO=".$relatorio;
			$result = $conecta->query($query); 
			if (MDB2::isError($result)) die ($result->getMessage()); 
			$rows = $result->numRows();
			Conexao::Desconecta($conecta);
			if ($rows > 0){
				$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
				$base = $i->RELBASE;
			} else header("Location: FrGerarRel.php");
		}
		if ($ver_acesso==1){
			if($_SESSION["TipoUsu"]==2){
				$temAcesso = Usuario::VerificaAcessoUsuarioBase($_SESSION["CodUsu"], $base);
				if (!$temAcesso) die("<script>alert('"._ACESSOBD."'); history.go(-1);</script>");
			}
		}

		return $base;
	}

	static function ListarDb()
	{
		$bases = Query::GetDataBases();
		
		if($_SESSION["TipoUsu"]==2)
			$acessosBase = Usuario::GetUsuarioBases($_SESSION["CodUsu"]);
		
		foreach ($bases as $key => $nome)
		{
			$temAcesso = true;
			if($_SESSION["TipoUsu"]==2)
			{
				if (in_array($key, $acessosBase)) 
					$temAcesso = true;
				else 
					$temAcesso = false;
			}
			if($temAcesso)	print "<option value=\"$key\">$nome</option>";
		}
	}
	
	static function PegarTabelasECampos($ver_acesso)
	{
		$db = self::PegarDb($ver_acesso);
		
		if (!isset($_SESSION[$db]))
		{
			$conecta = Conexao::ConectaRel($db);
			$objQuery = new Query($db);
			$query = $objQuery->ShowTables();
			$result = $conecta->query($query);
			if (MDB2::isError($result)) die ($result->getMessage());
			$tabelas = array();
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$nome_tabela = $objQuery->GetTableName($i);
				$tabelas[$nome_tabela] = array();
				$query2 = $objQuery->ShowColumns($nome_tabela);
				$result2 = $conecta->query($query2); 
				if (MDB2::isError($result2)) die ($result2->getMessage()); 
				while ($j = $result2->fetchRow(MDB2_FETCHMODE_OBJECT)) {
					$nome_coluna = $objQuery->GetFieldName($j);
					$coluna_tipo = $objQuery->GetFieldType($j);
					$numerico = $objQuery->isColumnNumeric($coluna_tipo);
					$chave_primaria = $objQuery->isPrimaryKey($j);
					$chave_estrangeira = $objQuery->isForeignKey($j);
					$coluna = array("nome" => $nome_coluna, 
										"numerico" => $numerico, 
										"chave_primaria" => $chave_primaria,
										"chave_estrangeira" => $chave_estrangeira);
					$tabelas[$nome_tabela][] = $coluna;
				}
			}
			$_SESSION[$db] = $tabelas;
		}
		
		return $_SESSION[$db];
	}

	static function ListarRelatorios(){
		if($_SESSION["TipoUsu"]==2){
			$acessosBase = Usuario::GetUsuarioBases($_SESSION["CodUsu"]);
			$acum=null;
			foreach ($acessosBase as $base)
			{
				if ($acum!=null) $acum.=" OR";
				$acum.=" RELBASE='".$base."'";
			}
			$query = "SELECT RELCODIGO,RELNOME FROM PHPREP_RELATORIO".$acum." ORDER BY RELNOME";
		} else $query = "SELECT RELCODIGO,RELNOME FROM PHPREP_RELATORIO ORDER BY RELNOME";
		$conecta = Conexao::Conecta();
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$cod = $i->RELCODIGO;
				$nome = $i->RELNOME;
				print "<option value=\"$cod\">$nome</option>";
			}
		}
		Conexao::Desconecta($conecta);
	}
	
	static function DuplicarPassos(){
		if (isset($_POST["duplicar"])) {
			$relatorio = $_POST["duplicar"]; 
		} else if (isset($_GET["id"])) {
			$relatorio = $_GET["id"]; 
		} else {
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=FrGerarRel.php\">";
		}
		$conecta = Conexao::Conecta();
		
		$dados = VisualizarRel::GetDadosPrincipaisRelatorio($relatorio, $conecta);
		$base = $dados["base"];
		$template = $dados["template"];
		$template_tipo = $dados["template_tipo"];
		$template_nume = $dados["template_nume"];
		$cabecalho = $dados["cabecalho"];
		$rodape = $dados["rodape"];

		print "<input name=\"db\" type=\"hidden\" value=\"".$base."\">\n";
		if (isset($_GET["id"])) $id = $_GET["id"]; else $id = "null"; 
		print "<input name=\"id\" type=\"hidden\" value=\"".$id."\">\n";
		
		print"<input name=\"cabecalho\" type=\"hidden\" value=\"".$cabecalho."\">\n";
		print"<input name=\"rodape\" type=\"hidden\" value=\"".$rodape."\">\n";
		print"<input name=\"template\" type=\"hidden\" value=\"".$template."\">\n";
		print"<input name=\"template_tipo\" type=\"hidden\" value=\"".$template_tipo."\">\n";
		print"<input name=\"template_nume\" type=\"hidden\" value=\"".$template_nume."\">\n";

		//passo2
		$query = "SELECT CAMTABELA,CAMCAMPO,CAMTITULO FROM PHPREP_CAMPO WHERE RELCODIGO=".$relatorio." ORDER BY CAMORDEM";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			$cont = 0;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$tabela = $i->CAMTABELA;
				$campo = $i->CAMCAMPO;
				$titulo = $i->CAMTITULO;
				print "<input name=\"cam_list".$cont."\" type=\"hidden\" value=\"".$tabela.",,,".$campo."\">
					  <input name=\"tit_".$tabela.",,,".$campo."\" type=\"hidden\" value=\"".$titulo."\">
				";
				
				//passo4
				$query2 = "SELECT CORCONDICAO1,CORCONTEUDO1,CORFILTRO,CORCONDICAO2,CORCONTEUDO2,CORRGB FROM PHPREP_CORCAMPO WHERE RELCODIGO=".$relatorio." AND CORTABELA='".$tabela."' AND CORCAMPO='".$campo."'";
				$result2 = $conecta->query($query2); 
				if (MDB2::isError($result2)) die ($result2->getMessage()); 
				$rows = $result2->numRows(); 
				if ($rows > 0){
					$contador2 = 0;
					while($j = $result2->fetchRow(MDB2_FETCHMODE_OBJECT)) {
						$cond1 = $j->CORCONDICAO1;
						$cont1 = $j->CORCONTEUDO1;
						$eou = $j->CORFILTRO;
						$cond2 = $j->CORCONDICAO2;
						$cont2 = $j->CORCONTEUDO2;
						$cor = $j->CORRGB;
						print"<input name=\"cond1".$contador2."_cor".$cont."\" type=\"hidden\" value=\"".$cond1."\">\n";
						print"<input name=\"cont1".$contador2."_cor".$cont."\" type=\"hidden\" value=\"".$cont1."\">\n";
						print"<input name=\"cor".$contador2."_cor".$cont."\" type=\"hidden\" value=\"".$cor."\">\n";
						if ($eou!=null) {
							print"<input name=\"eou".$contador2."_cor".$cont."\" type=\"hidden\" value=\"".$eou."\">\n";
							print"<input name=\"cond2".$contador2."_cor".$cont."\" type=\"hidden\" value=\"".$cond2."\">\n";
							print"<input name=\"cont2".$contador2."_cor".$cont."\" type=\"hidden\" value=\"".$cont2."\">\n";
						} else print"<input name=\"eou".$contador2."_cor".$cont."\" type=\"hidden\" value=\"null\">\n";
						$contador2++;
					}
				}
				$cont++;
			}
		}

		//passo3
		$query = "SELECT FILTABELA,FILCAMPO,FILCONDICAO1,FILCONTEUDO1,FILFILTRO,FILCONDICAO2,FILCONTEUDO2 FROM PHPREP_FILTRO WHERE RELCODIGO=".$relatorio;
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			$cont=0;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$tabela = $i->FILTABELA;
				$campo = $i->FILCAMPO;
				$cond1 = $i->FILCONDICAO1;
				$cont1 = $i->FILCONTEUDO1;
				$eou = $i->FILFILTRO;
				$cond2 = $i->FILCONDICAO2;
				$cont2 = $i->FILCONTEUDO2;
				$cont1 = str_replace("%","",$cont1);
				$cont2 = str_replace("%","",$cont2);
				print"<input name=\"tab_filt".$cont."\" type=\"hidden\" value=\"".$tabela."\">\n";
				print"<input name=\"cam_filt".$cont."\" type=\"hidden\" value=\"".$campo."\">\n";
				print"<input name=\"cond1_filt".$cont."\" type=\"hidden\" value=\"".$cond1."\">\n";
				print"<input name=\"cont1_filt".$cont."\" type=\"hidden\" value=\"".$cont1."\">\n";
				if ($eou!=null) {
					print"<input name=\"eou_filt".$cont."\" type=\"hidden\" value=\"".$eou."\">\n";
					print"<input name=\"cond2_filt".$cont."\" type=\"hidden\" value=\"".$cond2."\">\n";
					print"<input name=\"cont2_filt".$cont."\" type=\"hidden\" value=\"".$cont2."\">\n";
				} else print"<input name=\"eou_filt".$cont."\" type=\"hidden\" value=\"null\">\n";
				$cont++;
			}
		}
		if ($rows>3) $qtd_campos = $rows; else $qtd_campos = 3;
		print"<input name=\"qtd_campos3\" type=\"hidden\" value=\"".$qtd_campos."\">";


		//passo5
		$query = "SELECT AGRTABELA,AGRCAMPO FROM PHPREP_AGRUPAMENTO WHERE RELCODIGO=".$relatorio." ORDER BY AGRNIVEL";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			$cont=0;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$tabela = $i->AGRTABELA;
				$campo = $i->AGRCAMPO;
				print"<input name=\"tab_agrup".$cont."\" type=\"hidden\" value=\"".$tabela."\">\n";
				print"<input name=\"cam_agrup".$cont."\" type=\"hidden\" value=\"".$campo."\">\n";
				$cont++;
			}
		} 
		if ($rows>3) $qtd_campos = $rows; else $qtd_campos = 3;
		print"<input name=\"qtd_campos5\" type=\"hidden\" value=\"".$qtd_campos."\">";
		
		//passo6
		$query = "SELECT ORDTABELA,ORDCAMPO,ORDORDEM FROM PHPREP_ORDENACAO WHERE RELCODIGO=".$relatorio." ORDER BY ORDNIVEL";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			$cont=0;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$tabela = $i->ORDTABELA;
				$campo = $i->ORDCAMPO;
				$tipo = $i->ORDORDEM;
				print"<input name=\"tab_ord".$cont."\" type=\"hidden\" value=\"".$tabela."\">\n";
				print"<input name=\"cam_ord".$cont."\" type=\"hidden\" value=\"".$campo."\">\n";
				print"<input name=\"tipo_ord".$cont."\" type=\"hidden\" value=\"".$tipo."\">\n";
				$cont++;
			}
		}
		if ($rows>3) $qtd_campos = $rows; else $qtd_campos = 3;
		print"<input name=\"qtd_campos6\" type=\"hidden\" value=\"".$qtd_campos."\">";
		
		//passo7
		$query = "SELECT FORTIPO,FORTABELA,FORCAMPO,FORTITULO,FORAPLICACAO FROM PHPREP_FORMULA WHERE RELCODIGO=".$relatorio." ORDER BY FORORDEM";
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			$cont=0;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$titulo = $i->FORTITULO;
				$tabela = $i->FORTABELA;
				$campo = $i->FORCAMPO;
				$tipo = $i->FORTIPO;
				$utilizacao = $i->FORAPLICACAO;
				print"<input name=\"tit_formrel".$cont."\" type=\"hidden\" value=\"".$titulo."\">\n";
				print"<input name=\"tab_formrel".$cont."\" type=\"hidden\" value=\"".$tabela."\">\n";
				print"<input name=\"cam_formrel".$cont."\" type=\"hidden\" value=\"".$campo."\">\n";
				print"<input name=\"tip_formrel".$cont."\" type=\"hidden\" value=\"".$tipo."\">\n";
				print"<input name=\"uti_formrel".$cont."\" type=\"hidden\" value=\"".$utilizacao."\">\n";
				$cont++;
			}
		}
		if ($rows>3) $qtd_campos = $rows; else $qtd_campos = 3;
		print"<input name=\"qtd_campos7\" type=\"hidden\" value=\"".$qtd_campos."\">";
		
		//passo8
		$query = "SELECT GRATIPO,GRATITULO,GRAXTABELA,GRAEIXOX,GRAYTABELA,GRAEIXOY,GRAXLEGENDA,GRAYLEGENDA FROM PHPREP_GRAFICO WHERE RELCODIGO=".$relatorio;
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$tipo = $i->GRATIPO;
				$titulo = $i->GRATITULO;
				$tabela1 = $i->GRAXTABELA;
				$campo1 = $i->GRAEIXOX;
				$tabela2 = $i->GRAYTABELA;
				$campo2 = $i->GRAEIXOY;
				$legenda1 = $i->GRAXLEGENDA;
				$legenda2 = $i->GRAYLEGENDA;
				print"<input name=\"tip_graf\" type=\"hidden\" value=\"".$tipo."\">\n";
				print"<input name=\"tit_graf\" type=\"hidden\" value=\"".$titulo."\">\n";
				print"<input name=\"tab_graf1\" type=\"hidden\" value=\"".$tabela1."\">\n";
				print"<input name=\"cam_graf1\" type=\"hidden\" value=\"".$campo1."\">\n";
				print"<input name=\"tab_graf2\" type=\"hidden\" value=\"".$tabela2."\">\n";
				print"<input name=\"cam_graf2\" type=\"hidden\" value=\"".$campo2."\">\n";
				print"<input name=\"leg_graf1\" type=\"hidden\" value=\"".$legenda1."\">\n";
				print"<input name=\"leg_graf2\" type=\"hidden\" value=\"".$legenda2."\">\n";
			}
		}
		
		//passo11
		$query = "SELECT RTOTABELA1,RTOCAMPO1,RTOTABELA2,RTOCAMPO2 FROM PHPREP_RELACIONAM WHERE RELCODIGO=".$relatorio;
		$result = $conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getMessage()); 
		$rows = $result->numRows(); 
		if ($rows > 0){
			$cont=0;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {
				$tabela1 = $i->RTOTABELA1;
				$campo1 = $i->RTOCAMPO1;
				$tabela2 = $i->RTOTABELA2;
				$campo2 = $i->RTOCAMPO2;
				print"<input name=\"tab_relac1".$cont."\" type=\"hidden\" value=\"".$tabela1."\">\n";
				print"<input name=\"cam_relac1".$cont."\" type=\"hidden\" value=\"".$campo1."\">\n";
				print"<input name=\"tab_relac2".$cont."\" type=\"hidden\" value=\"".$tabela2."\">\n";
				print"<input name=\"cam_relac2".$cont."\" type=\"hidden\" value=\"".$campo2."\">\n";
				$cont++;
			}
		}
		if ($rows>6) $qtd_campos = $rows; else $qtd_campos = 6;
		print"<input name=\"qtd_campos11\" type=\"hidden\" value=\"".$qtd_campos."\">";
		
		Conexao::Desconecta($conecta);
	}
	
/****************************************************************************
Method: PegarPassos
Description: Get all the content of the report, except for the present step,
 and put into hidden inputs
****************************************************************************/
	static function PegarPassos($passo){
		print "<input name=\"db\" type=\"hidden\" value=\"".$_POST["db"]."\">\n";
		if (isset($_POST["id"])) $id = $_POST["id"]; else $id = "null"; 
		print "<input name=\"id\" type=\"hidden\" value=\"".$id."\">\n";
		
		if (isset($_POST["ColunasLargura"]))
			print "<input name=\"ColunasLargura\" type=\"hidden\" value=\"".$_POST["ColunasLargura"]."\">\n";
		if (isset($_POST["ColunasLarguraTotal"]))
			print "<input name=\"ColunasLarguraTotal\" type=\"hidden\" value=\"".$_POST["ColunasLarguraTotal"]."\">\n";
			
		if($passo!=1) {
			$coloca_titulo = GerarRel::PegarCampos1();
			$tam = count($coloca_titulo);
			if ($tam == 0) die ("<script>alert('"._MINIMO1CAMPO."'); history.go(-1);</script>");
			for($i=0;$i<$tam;$i++) print"<input name=\"".$coloca_titulo[$i]."\" value=\"true\" type=\"hidden\">\n";
		}
		
		if($passo!=2) {
			$ordena_campos = GerarRel::OrdenarCampos2();
			$tam = count($ordena_campos);
	
			for($i=0;$i<$tam;$i++) {
				print "<input name=\"cam_list".$i."\" type=\"hidden\" value=\"".$ordena_campos[$i][0]."\">
					  <input name=\"tit_".$ordena_campos[$i][0]."\" type=\"hidden\" value=\"".$ordena_campos[$i][1]."\">
				";
			}
		}
		
		if($passo!=3) {
			$qtd_campos = GerarRel::QtdLinhas(3);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_filt".$i]))&&($_POST["tab_filt".$i]!="null")) {
					if ($_POST["cont1_filt".$i]!=null) {
						print"<input name=\"tab_filt".$i."\" type=\"hidden\" value=\"".$_POST["tab_filt".$i]."\">\n";
						print"<input name=\"cam_filt".$i."\" type=\"hidden\" value=\"".$_POST["cam_filt".$i]."\">\n";
						print"<input name=\"cond1_filt".$i."\" type=\"hidden\" value=\"".$_POST["cond1_filt".$i]."\">\n";
						print"<input name=\"cont1_filt".$i."\" type=\"hidden\" value=\"".$_POST["cont1_filt".$i]."\">\n";
						print"<input name=\"eou_filt".$i."\" type=\"hidden\" value=\"".$_POST["eou_filt".$i]."\">\n";
						if ($_POST["eou_filt".$i]!="null") {
							if ($_POST["cont2_filt".$i]!=null) {
								print"<input name=\"cond2_filt".$i."\" type=\"hidden\" value=\"".$_POST["cond2_filt".$i]."\">\n";
								print"<input name=\"cont2_filt".$i."\" type=\"hidden\" value=\"".$_POST["cont2_filt".$i]."\">\n";
							} else die ("<script>alert('"._CONTEUDOCOND."'); history.go(-1);</script>");
						}
					} else die ("<script>alert('"._CONTEUDOCOND."'); history.go(-1);</script>"); 
				}
			}
		}

		if($passo!=4) {
			$ordena_campos = GerarRel::OrdenarCampos2();
			$tam = count($ordena_campos);
			for($i=0;$i<$tam;$i++) {
			
				$pos = $i;
				if ($passo=="2"){
					if ( ((isset($_GET['s']))&&($_GET['s']==$i)) || ((isset($_GET['d']))&&(($_GET['d']+1)==$i)) ){
						$pos= $i-1;
					}
					if ( ((isset($_GET['s']))&&(($_GET['s']-1)==$i)) || ((isset($_GET['d']))&&($_GET['d']==$i)) ){
						$pos = $i+1;
					}
				}
			
				for ($j=0;$j<3;$j++){
					if (isset($_POST["cond1".$j."_cor".$pos])) {
						if ($_POST["cont1".$j."_cor".$pos]!=null) {
							print"<input name=\"cond1".$j."_cor".$i."\" type=\"hidden\" value=\"".$_POST["cond1".$j."_cor".$pos]."\">\n";
							print"<input name=\"cont1".$j."_cor".$i."\" type=\"hidden\" value=\"".$_POST["cont1".$j."_cor".$pos]."\">\n";
							print"<input name=\"eou".$j."_cor".$i."\" type=\"hidden\" value=\"".$_POST["eou".$j."_cor".$pos]."\">\n";
							print"<input name=\"cor".$j."_cor".$i."\" type=\"hidden\" value=\"".$_POST["cor".$j."_cor".$pos]."\">\n";
						} 
						if ($_POST["eou".$j."_cor".$pos]!="null") {
							if ($_POST["cont1".$j."_cor".$pos]==null) die ("<script>alert('"._CONTEUDOCOND."'); history.go(-1);</script>");
							if ($_POST["cont2".$j."_cor".$pos]!=null) {
								print"<input name=\"cond2".$j."_cor".$i."\" type=\"hidden\" value=\"".$_POST["cond2".$j."_cor".$pos]."\">\n";
								print"<input name=\"cont2".$j."_cor".$i."\" type=\"hidden\" value=\"".$_POST["cont2".$j."_cor".$pos]."\">\n";
							} else die ("<script>alert('"._CONTEUDOCOND."'); history.go(-1);</script>");
						}
					}
				}
			}
		}

		if($passo!=5) {
			$qtd_campos = GerarRel::QtdLinhas(5);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_agrup".$i]))&&($_POST["tab_agrup".$i]!="null")) {
					print"<input name=\"tab_agrup".$i."\" type=\"hidden\" value=\"".$_POST["tab_agrup".$i]."\">\n";
					print"<input name=\"cam_agrup".$i."\" type=\"hidden\" value=\"".$_POST["cam_agrup".$i]."\">\n";
				}
			}
		}
		
		if($passo!=6) {
			$qtd_campos = GerarRel::QtdLinhas(6);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_ord".$i]))&&($_POST["tab_ord".$i]!="null")) {
					print"<input name=\"tab_ord".$i."\" type=\"hidden\" value=\"".$_POST["tab_ord".$i]."\">\n";
					print"<input name=\"cam_ord".$i."\" type=\"hidden\" value=\"".$_POST["cam_ord".$i]."\">\n";
					print"<input name=\"tipo_ord".$i."\" type=\"hidden\" value=\"".$_POST["tipo_ord".$i]."\">\n";
				}
			}
		}

		if($passo!=7) {
			$qtd_campos = GerarRel::QtdLinhas(7);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_formrel".$i]))&&($_POST["tab_formrel".$i]!="null")) {
					print"<input name=\"tit_formrel".$i."\" type=\"hidden\" value=\"".$_POST["tit_formrel".$i]."\">\n";
					print"<input name=\"tab_formrel".$i."\" type=\"hidden\" value=\"".$_POST["tab_formrel".$i]."\">\n";
					print"<input name=\"cam_formrel".$i."\" type=\"hidden\" value=\"".$_POST["cam_formrel".$i]."\">\n";
					print"<input name=\"tip_formrel".$i."\" type=\"hidden\" value=\"".$_POST["tip_formrel".$i]."\">\n";
					print"<input name=\"uti_formrel".$i."\" type=\"hidden\" value=\"".$_POST["uti_formrel".$i]."\">\n";
				}
			}
		}

		if($passo!=8) {
			if (isset($_POST["tab_graf1"])) {
				if (($_POST["tab_graf1"] != "null") || ($_POST["tab_graf2"] != "null")) {
					if (!isset($_POST["cam_graf1"]) || !isset($_POST["cam_graf2"])) die ("<script>alert('"._EIXOSGRAFICO."'); history.go(-1);</script>");
					print"<input name=\"tip_graf\" type=\"hidden\" value=\"".$_POST["tip_graf"]."\">\n";
					print"<input name=\"tit_graf\" type=\"hidden\" value=\"".$_POST["tit_graf"]."\">\n";
					print"<input name=\"tab_graf1\" type=\"hidden\" value=\"".$_POST["tab_graf1"]."\">\n";
					print"<input name=\"cam_graf1\" type=\"hidden\" value=\"".$_POST["cam_graf1"]."\">\n";
					print"<input name=\"tab_graf2\" type=\"hidden\" value=\"".$_POST["tab_graf2"]."\">\n";
					print"<input name=\"cam_graf2\" type=\"hidden\" value=\"".$_POST["cam_graf2"]."\">\n";
					print"<input name=\"leg_graf1\" type=\"hidden\" value=\"".$_POST["leg_graf1"]."\">\n";
					print"<input name=\"leg_graf2\" type=\"hidden\" value=\"".$_POST["leg_graf2"]."\">\n";
				}
			}
		}

		if($passo!=9) {
			if (isset($_POST["cabecalho"])) {
				$cabecalho = str_replace("\\\"","[[aspas]]",$_POST["cabecalho"]);
				$cabecalho = str_replace("'","",$cabecalho);
				$rodape = str_replace("\\\"","[[aspas]]",$_POST["rodape"]);
				$rodape = str_replace("'","",$rodape);
				print"<input name=\"cabecalho\" type=\"hidden\" value=\"".$cabecalho."\">\n";
				print"<input name=\"rodape\" type=\"hidden\" value=\"".$rodape."\">\n";
			}
		}
		
		if($passo!=10) {
			if (isset($_POST["template"])) {
				$template = $_POST["template"];
				$template_tipo = $_POST["template_tipo"];
				$template_nume = $_POST["template_nume"];
			} else {
				$template = 1;
				$template_tipo = 1;
				$template_nume = 2;
			}
			print"<input name=\"template\" type=\"hidden\" value=\"".$template."\">\n";
			print"<input name=\"template_tipo\" type=\"hidden\" value=\"".$template_tipo."\">\n";
			print"<input name=\"template_nume\" type=\"hidden\" value=\"".$template_nume."\">\n";
		}
		
		if($passo!=11) {
			$qtd_campos = GerarRel::QtdLinhas(11);
			for($i=0;$i<$qtd_campos;$i++) {
				if ((isset($_POST["tab_relac1".$i]))&&(isset($_POST["tab_relac2".$i]))){
					if (($_POST["tab_relac1".$i]!="null")||($_POST["tab_relac2".$i]!="null")){
						if (($_POST["tab_relac1".$i]!="null")&&($_POST["tab_relac2".$i]!="null")){
							if ($_POST["tab_relac1".$i]==$_POST["tab_relac2".$i]){
								if (!isset($_GET["volta"])) die ("<script>alert('"._RELACIONMSMTABELA."'); history.go(-1);</script>");
							}
							for($j=0;$j<$qtd_campos;$j++) {
								if ($i!=$j){
									if ((($_POST["tab_relac1".$i]==$_POST["tab_relac1".$j])&&($_POST["tab_relac2".$i]==$_POST["tab_relac2".$j])) || (($_POST["tab_relac1".$i]==$_POST["tab_relac2".$j])&&($_POST["tab_relac2".$i]==$_POST["tab_relac1".$j]))){
										if (!isset($_GET["volta"])) die ("<script>alert('"._RELACIONDUPLICADO."'); history.go(-1);</script>");
									}
								}
							}
							print"<input name=\"tab_relac1".$i."\" type=\"hidden\" value=\"".$_POST["tab_relac1".$i]."\">\n";
							print"<input name=\"cam_relac1".$i."\" type=\"hidden\" value=\"".$_POST["cam_relac1".$i]."\">\n";
							print"<input name=\"tab_relac2".$i."\" type=\"hidden\" value=\"".$_POST["tab_relac2".$i]."\">\n";
							print"<input name=\"cam_relac2".$i."\" type=\"hidden\" value=\"".$_POST["cam_relac2".$i]."\">\n";
						} else {
							if (!isset($_GET["volta"])) die ("<script>alert('"._PREENCHARELACION."'); history.go(-1);</script>");
						}
					}
				}
			}
		}
	}

	static function QtdLinhas($passo){
		if ($passo==11) $campos_ini = 6; else $campos_ini = 3;
		if ($passo==11) $maximo = 30; else $maximo = 10;
		if (isset($_POST['qtd_campos'.$passo]))	$qtd_campos = $_POST['qtd_campos'.$passo]; else $qtd_campos = $campos_ini;
		if(isset($_POST['envia_campos'.$passo])) {		
			$qtd_campos+=$_POST['adi_campos'.$passo];
			if ($qtd_campos > $maximo) {
				$qtd_campos = $maximo;
			}
		}
		print"<input name=\"qtd_campos".$passo."\" type=\"hidden\" value=\"".$qtd_campos."\">";
		return $qtd_campos;
	}
	
	static function PegaQtdLinhas($passo){
		if ($passo==11) $campos_ini = 6; else $campos_ini = 3;
		if ($passo==11) $maximo = 30; else $maximo = 10;
		if (isset($_POST['qtd_campos'.$passo]))	$qtd_campos = $_POST['qtd_campos'.$passo]; else $qtd_campos = $campos_ini;
		return $qtd_campos;
	}
	
	
	static function GuiaPasso($passo){
		print"
		<table width=\"100%\" border=\"0\" cellpadding=\"4\" cellspacing=\"0\">
		  <tr>
		  ";
		for ($i=1;$i<12;$i++){
			switch ($i)
			{
				case 1:
					$define = _PASSO1;
					$title = _DESCRICAO1;
					break;
				case 2:
					$define = _PASSO2;
					$title = _DESCRICAO2;
					break;
				case 3:
					$define = _PASSO3;
					$title = _DESCRICAO3;
					break; 
				case 4:
					$define = _PASSO4;
					$title = _DESCRICAO4;
					break; 
				case 5:
					$define = _PASSO5;
					$title = _DESCRICAO5;
					break; 
				case 6:
					$define = _PASSO6;
					$title = _DESCRICAO6;
					break;
				case 7:
					$define = _PASSO7;
					$title = _DESCRICAO7;
					break;
				case 8:
					$define = _PASSO8;
					$title = _DESCRICAO8;
					break;
				case 9:
					$define = _PASSO9;
					$title = _DESCRICAO9;
					break;
				case 10:
					$define = _PASSO10;
					$title = _DESCRICAO10;
					break;
				case 11:
					$define = _PASSO11;
					$title = _DESCRICAO11;
					break;
			}
			if ($passo==11)  $pagina = "FrGerarRel".$i.".php?volta=1"; else $pagina = "FrGerarRel".$i.".php";
			if ($passo==$i) print"<td bgcolor=\"#CBDBF8\" align=\"center\">";
			else print"<td style=\"cursor:pointer;cursor:hand\" align=\"center\" title=\"".$title."\" onclick=\"javascript:EnviarForm('".$pagina."',document.form1);\" onmouseover=\"this.className='passoon'\" onmouseout=\"this.className='passooff'\" class=\"passooff\">";
			print $define."</td>";
		}
		print"
		  </tr>
		</table><br>
		";
	}
/****************************************************************************
funções para criar javascript
****************************************************************************/
	static function JSPreencheCampos(){
		print"
		<SCRIPT LANGUAGE=\"JavaScript\">
		function PreencheCampos(formulario, tabela, campo, field1, field2, campohidden, bodyload) {
		if ((bodyload==\"0\")||((campohidden!=null)&&(formulario[campohidden].value!=\"-1\"))) {
			if (formulario[tabela].value==\"null\") {
				for(i = formulario[campo].length; i>= 0; i--){
					formulario[campo].options[i] = null;
				}
				formulario[campo].selectedIndex = 0;
				formulario[campo].disabled = true;
				if (field1!=null){
					formulario[field1].selectedIndex = 0;
					formulario[field1].disabled = true;
				}
				if (field2!=null){
					formulario[field2].selectedIndex = 0;
					formulario[field2].disabled = true;
				}
				if (campohidden!=null) formulario[campohidden].value = \"-1\";
			} 
		";
		
		$dados = self::PegarTabelasECampos(0);
		
		if (count($dados) > 0)
		{
			foreach ($dados as $nome_tabela => $colunas)
			{
				print "if (formulario[tabela].value==\"$nome_tabela\") {";
				if (count($colunas) > 0)
				{
					print "
						for(i = formulario[campo].length; i>= 0; i--){
							formulario[campo].options[i] = null;
						}
						ids = new Array(";
					$entra_while = 1;
					foreach ($colunas as $coluna)
					{
						$nome_coluna = $coluna["nome"];
						if ($entra_while == 1) print "\"$nome_coluna\""; else  print ", \"$nome_coluna\"";
						$entra_while = 0;
					}
					print ");";
				}
				print"
						formulario[campo].disabled = false;
						if (field1!=null)	formulario[field1].disabled = false;
						if (field2!=null)	formulario[field2].disabled = false;
						for(i=0; i<ids.length; i++) {
							formulario[campo].options[formulario[campo].length] = new Option(ids[i], ids[i]);
						}
					}
				";
			}
			print"
					if ((bodyload==\"0\")&&(formulario[tabela].value!=\"null\")) {
						if(campohidden!=null) formulario[campohidden].value = 0;
						formulario[campo].focus();
					}
					if (bodyload==\"1\") formulario[campo].selectedIndex = formulario[campohidden].value; 
			";
		}		

		print"
		}
		}
		</script>
		";
	}

	static function JSPreencheCamposPasso3(){
		print"
		<SCRIPT LANGUAGE=\"JavaScript\">
		function PreencheCamposPasso3(formulario, onde, bodyload) {
		
		campohidden = \"cam_filt_hidden\"+onde;
		tabela = \"tab_filt\"+onde;
		campo = \"cam_filt\"+onde;
		cond1 = \"cond1_filt\"+onde;
		cont1 = \"cont1_filt\"+onde;
		eou = \"eou_filt\"+onde;
		cond2 = \"cond2_filt\"+onde;
		cont2 = \"cont2_filt\"+onde;
		
		if ((bodyload==\"0\")||(formulario[campohidden].value!=\"-1\")) {
			if (formulario[tabela].value==\"null\") {
				for(i = formulario[campo].length; i>= 0; i--){
					formulario[campo].options[i] = null;
				}
				formulario[campo].selectedIndex = 0;
				formulario[campo].disabled = true;
				formulario[cond1].selectedIndex = 0;
				formulario[cond1].disabled = true;
				formulario[cont1].value = \"\";
				formulario[cont1].disabled = true;
				formulario[eou].selectedIndex = 0;
				formulario[eou].disabled = true;		
				formulario[cond2].selectedIndex = 0;
				formulario[cond2].disabled = true;
				formulario[cont2].value = \"\";
				formulario[cont2].disabled = true;
				formulario[campohidden].value = \"-1\";
			} 
		";
		
		$dados = self::PegarTabelasECampos(0);
	
		if (count($dados) > 0)
		{
			foreach ($dados as $nome_tabela => $colunas)
			{
				print "if (formulario[tabela].value==\"$nome_tabela\") {";
				if (count($colunas) > 0)
				{
					print "
						for(i = formulario[campo].length; i>= 0; i--){
							formulario[campo].options[i] = null;
						}
						ids = new Array(";
					$entra_while = 1;
					foreach ($colunas as $coluna)
					{
						$nome_coluna = $coluna["nome"];
						if ($entra_while == 1) print "\"$nome_coluna\""; else  print ", \"$nome_coluna\"";
						$entra_while = 0;
					}
					print ");";
				}
				print"
						formulario[campo].disabled = false;
						formulario[cond1].disabled = false;
						formulario[cont1].disabled = false;
						formulario[eou].disabled = false;
						for(i=0; i<ids.length; i++) {
							formulario[campo].options[formulario[campo].length] = new Option(ids[i], ids[i]);
						}
					}
				";
			}
			print"
					if ((bodyload==\"0\")&&(formulario[tabela].value!=\"null\")) {
						formulario[campohidden].value = 0;
						formulario[campo].focus();
					}
					if (bodyload==\"1\") formulario[campo].selectedIndex = formulario[campohidden].value; 
			";
		}
		
		print"
		}
		}
		</script>
		";
	}

	static function JSPreencheCamposNum(){
		print"
		<SCRIPT LANGUAGE=\"JavaScript\">
		function PreencheCamposNum(formulario, tabela, campo, field1, field2, campohidden, bodyload) {
		if ((bodyload==\"0\")|| ((campohidden!=null)&&(formulario[campohidden].value!=\"-1\"))) {
			if (formulario[tabela].value==\"null\") {
				for(i = formulario[campo].length; i>= 0; i--){
					formulario[campo].options[i] = null;
				}
				formulario[campo].selectedIndex = 0;
				formulario[campo].disabled = true;
				if (field1!=null){
					formulario[field1].selectedIndex = 0;
					formulario[field1].disabled = true;
				}
				if (field2!=null){
					formulario[field2].selectedIndex = 0;
					formulario[field2].disabled = true;
				}
				if (campohidden!=null) formulario[campohidden].value = \"-1\";
			} 
		";
		
		$dados = self::PegarTabelasECampos(0);
	
		if (count($dados) > 0)
		{
			foreach ($dados as $nome_tabela => $colunas)
			{
				print "if (formulario[tabela].value==\"$nome_tabela\") {";
				$entra_while = 1;
				if (count($colunas) > 0)
				{
					print "
						for(i = formulario[campo].length; i>= 0; i--){
							formulario[campo].options[i] = null;
						}
						ids = new Array(";
					foreach ($colunas as $coluna)
					{
						$nome_coluna = $coluna["nome"];
						if ($coluna["numerico"])
						{
							if ($entra_while == 1) print "\"$nome_coluna\""; else  print ", \"$nome_coluna\"";
							$entra_while = 0;
						}
					}
					print ");";
				}
				if ($entra_while == 0) {
					print"
						formulario[campo].disabled = false;
						if (field1!=null)	formulario[field1].disabled = false;
						if (field2!=null)	formulario[field2].disabled = false;
						for(i=0; i<ids.length; i++) {
							formulario[campo].options[formulario[campo].length] = new Option(ids[i], ids[i]);
						}
					";
				} else {
					print"
						for(i = formulario[campo].length; i>= 0; i--){
							formulario[campo].options[i] = null;
						}
							formulario[campo].selectedIndex = 0;
							formulario[campo].disabled = true;
							if (field1!=null){
								formulario[field1].selectedIndex = 0;
								formulario[field1].disabled = true;
							}
							if (field2!=null){
								formulario[field2].selectedIndex = 0;
								formulario[field2].disabled = true;
							}
					";
				}
				print "
				}
				";
			}
			print"
					if ((bodyload==\"0\")&&(formulario[tabela].value!=\"null\")) {
						if(campohidden!=null) formulario[campohidden].value = 0;
						formulario[campo].focus();
					}
					if (bodyload==\"1\") formulario[campo].selectedIndex = formulario[campohidden].value; 
			";
		}
		
		print"
		}
		}
		</script>
		";
	}
	

/****************************************************************************
funções genéricas usadas pelos métodos dos passos
****************************************************************************/
	static function PegarCampos1() {
		$dados = self::PegarTabelasECampos(0);
		$coloca_titulo = array();
		foreach ($dados as $nome_tabela => $colunas)
		{
			foreach ($colunas as $coluna)
			{
				$nome_coluna = $coluna["nome"];
				$tab_cam = "$nome_tabela,,,$nome_coluna";
				if ((isset($_POST[$tab_cam]))&&($_POST[$tab_cam] == "true")) $coloca_titulo[] = $tab_cam;
			}
		}
		return $coloca_titulo;
	}

	static function OrdenarCampos2()
	{
		$coloca_titulo = GerarRel::PegarCampos1();
		$tam = count($coloca_titulo);

		$ordena_campos = null;
		for($i=0;$i<$tam;$i++) {
			if (isset($_POST["cam_list".$i])) {
				if (in_array($_POST["cam_list".$i],$coloca_titulo)) {
					$cam_tab = $_POST["cam_list".$i];
					$titulo = $_POST["tit_".$cam_tab];
	
					if ( ((isset($_GET['s']))&&($_GET['s']==$i)) || ((isset($_GET['d']))&&(($_GET['d']+1)==$i)) ){
						$cam_tab = $_POST["cam_list".($i-1)];
						$titulo = $_POST["tit_".$cam_tab];
					}
					if ( ((isset($_GET['s']))&&(($_GET['s']-1)==$i)) || ((isset($_GET['d']))&&($_GET['d']==$i)) ){
						$cam_tab = $_POST["cam_list".($i+1)];
						$titulo = $_POST["tit_".$cam_tab];
					}
					$chave = array_search ($_POST["cam_list".$i],$coloca_titulo);
					array_splice($coloca_titulo,$chave,1);
					$ordena_campos[] = array($cam_tab,$titulo);
				} else $tam++;
			}
		}

		$tam = count($coloca_titulo);
		for($i=0;$i<$tam;$i++) {
			$cam_tab = $coloca_titulo[$i];
			list ($tabela, $campo) = split(",,,",$cam_tab);
			$ordena_campos[] = array($cam_tab,$campo);	
		}
		return $ordena_campos;			
	}

	static function TabelasUsadas(){
		$relacionam_tabelas=null;
		//passo2
		$ordena_campos = GerarRel::OrdenarCampos2();
		$tam = count($ordena_campos);
		for($i=0;$i<$tam;$i++) {
			$cam_tab = $ordena_campos[$i][0];
			list ($tabela, $campo) = split(",,,",$cam_tab);
			if (($relacionam_tabelas==null)||(!in_array($tabela,$relacionam_tabelas))) $relacionam_tabelas[] = $tabela;	
		}
		//passo3
		$qtd_campos = GerarRel::PegaQtdLinhas(3);
		for($i=0;$i<$qtd_campos;$i++) {
			if ((isset($_POST["tab_filt".$i]))&&($_POST["tab_filt".$i]!="null")) {	
				if (!in_array($_POST["tab_filt".$i],$relacionam_tabelas)) $relacionam_tabelas[] = $_POST["tab_filt".$i];	
			}
		}
		//passo5
		$qtd_campos = GerarRel::PegaQtdLinhas(5);
		for($i=0;$i<$qtd_campos;$i++) {
			if ((isset($_POST["tab_agrup".$i]))&&($_POST["tab_agrup".$i]!="null")) {
				if (!in_array($_POST["tab_agrup".$i],$relacionam_tabelas)) $relacionam_tabelas[] = $_POST["tab_agrup".$i];	
			}
		}
		//passo6
		$qtd_campos = GerarRel::PegaQtdLinhas(6);
		for($i=0;$i<$qtd_campos;$i++) {
			if ((isset($_POST["tab_ord".$i]))&&($_POST["tab_ord".$i]!="null")) {
				if (!in_array($_POST["tab_ord".$i],$relacionam_tabelas)) $relacionam_tabelas[] = $_POST["tab_ord".$i];	
			}
		}
		//passo7
		$qtd_campos = GerarRel::PegaQtdLinhas(7);
		for($i=0;$i<$qtd_campos;$i++) {
			if ((isset($_POST["tab_formrel".$i]))&&($_POST["tab_formrel".$i]!="null")) {
				if (!in_array($_POST["tab_formrel".$i],$relacionam_tabelas)) $relacionam_tabelas[] = $_POST["tab_formrel".$i];	
			}
		}			
		//passo8
		if(isset($_POST["tab_graf1"])&&($_POST["tab_graf1"]!="null")){
			if (!in_array($_POST["tab_graf1"],$relacionam_tabelas)) $relacionam_tabelas[] = $_POST["tab_graf1"];
			if (!in_array($_POST["tab_graf2"],$relacionam_tabelas)) $relacionam_tabelas[] = $_POST["tab_graf2"];
		}
		return $relacionam_tabelas;		
	}

	static function ListarCampos($nome_tabela,$colunaSelecionada)
	{
		$dados = self::PegarTabelasECampos(0);
		
		$colunas = $dados[$nome_tabela];
		
		foreach ($colunas as $coluna)
		{
			$nome_coluna = $coluna["nome"];
			print "<option value=\"$nome_coluna\"";
			if($nome_coluna==$colunaSelecionada) print " selected";
			print ">$nome_coluna</option>";
		}
		
	}

	static function ListarTabelas($tabela)
	{
		$dados = self::PegarTabelasECampos(0);
		
		//Mostra só as tabelas que tem campos exibidos no relatorio
		$tabelasEmDestaque = false;
		foreach ($dados as $nome_tabela => $colunas)
		{
			$mostraTabela = false;
			foreach ($colunas as $coluna)
			{
				$nome_coluna = $coluna["nome"];
				$tab_cam = "$nome_tabela,,,$nome_coluna";
				if ((isset($_POST[$tab_cam]))&&($_POST[$tab_cam] == "true")) $mostraTabela = true;
			}
			if ($mostraTabela)
			{
				print "<option value=\"$nome_tabela\"";
				if($nome_tabela==$tabela) print " selected";
				print ">$nome_tabela</option>";
				$tabelasEmDestaque = true;
			}
		}
		
		if ($tabelasEmDestaque)
		{
			print "<option value=\"null\">--------------------------</option>";
		}
		
		//Mostra todas as tabelas
		foreach ($dados as $nome_tabela => $colunas)
		{
			print "<option value=\"$nome_tabela\"";
			if($nome_tabela==$tabela) print " selected";
			print ">$nome_tabela</option>";
		}
	}
	
	static function ListarCores($cor){
				print "<option style=\"color:#FFFFFF; background-color: #8B0000\" value=\"8B0000\"";
				if ($cor=="8B0000") print " selected";
				print ">"._CORVERMESCURO."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #FF0000\" value=\"FF0000\"";
				if ($cor=="FF0000") print " selected";
				print ">"._CORVERM."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #FFA500\" value=\"FFA500\"";
				if ($cor=="FFA500") print " selected";
				print ">"._CORLARANJA."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #A52A2A\" value=\"A52A2A\"";
				if ($cor=="A52A2A") print " selected";
				print ">"._CORCASTANHO."</option>";
				print "<option style=\"color:#000000; background-color: #FFFF00\" value=\"FFFF00\"";
				if ($cor=="FFFF00") print " selected";
				print ">"._CORAMARELHO."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #008000\" value=\"008000\"";
				if ($cor=="008000") print " selected";
				print ">"._CORVERDE."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #808000\" value=\"808000\"";
				if ($cor=="808000") print " selected";
				print ">"._CORVERDOLIVA."</option>";
				print "<option style=\"color:#000000; background-color: #00FFFF\" value=\"00FFFF\"";
				if ($cor=="00FFFF") print " selected";
				print ">"._CORCIANO."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #0000FF\" value=\"0000FF\"";
				if ($cor=="0000FF") print " selected";
				print ">"._CORAZUL."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #00008B\" value=\"00008B\"";
				if ($cor=="00008B") print " selected";
				print ">"._CORAZULESC."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #4B0082\" value=\"4B0082\"";
				if ($cor=="4B0082") print " selected";
				print ">"._CORINDIGO."</option>";
				print "<option style=\"color:#FFFFFF; background-color: #EE82EE\" value=\"EE82EE\"";
				if ($cor=="EE82EE") print " selected";
				print ">"._CORVIOLETA."</option>";
	}
	
	static function ListarTipoOrdem($ord){
				print "<option value=\"ASC\"";
				if ($ord=="ASC") print " selected";
				print ">"._CRESCENTE."</option>";
				print "<option value=\"DESC\"";
				if ($ord=="DESC") print " selected";
				print ">"._DECRESCENTE."</option>";
	}
	
	static function ListarTipoFormula($tipo){
				print "<option value=\"SUM\"";
				if ($tipo=="SUM") print " selected";
				print ">"._SOMA."</option>";
				print "<option value=\"AVG\"";
				if ($tipo=="AVG") print " selected";
				print ">"._MEDIA."</option>";
				print "<option value=\"MAX\"";
				if ($tipo=="MAX") print " selected";
				print ">"._MAXIMO."</option>";
				print "<option value=\"MIN\"";
				if ($tipo=="MIN") print " selected";
				print ">"._MINIMO."</option>";
	}
	
	static function ListarCamposNum($nome_tabela,$colunaSelecionada)
	{
		$dados = self::PegarTabelasECampos(0);
		
		$colunas = $dados[$nome_tabela];
		
		foreach ($colunas as $coluna)
		{
			$nome_coluna = $coluna["nome"];
			if($coluna["numerico"])
			{
				print "<option value=\"$nome_coluna\"";
				if($nome_coluna==$colunaSelecionada) print " selected";
				print ">$nome_coluna</option>";
			 }
		}
	}
	
	static function ListarUtilizacaoGrupos($grupo){
		print "<option value=\"r\"";
		if ($grupo=="r") print " selected";
		print ">"._RELATORIO."</option>";
		$existe_grupo=0;
		for($i=0;$i<$_POST['qtd_campos5'];$i++) {
			if ((isset($_POST["tab_agrup".$i]))&&($_POST["tab_agrup".$i]!="null")) $existe_grupo=1;
		}
		if($existe_grupo==1){
			print "<option value=\"g\"";
			if ($grupo=="g") print " selected";
			print ">"._GRUPO."</option>";
		}	
	}
	
	static function ListarCondicao($cond){
		print "<option value=\">\"";
		if ($cond==">") print " selected";
		print ">&gt;</option>";
		print "<option value=\">=\"";
		if ($cond==">=") print " selected";
		print ">&gt;=</option>";
		print "<option value=\"<\"";
		if ($cond=="<") print " selected";
		print ">&lt;</option>";
		print "<option value=\"<=\"";
		if ($cond=="<=") print " selected";
		print ">&lt;=</option>";
		print "<option value=\"=\"";
		if ($cond=="=") print " selected";
		print ">=</option>";
		print "<option value=\"!=\"";
		if ($cond=="!=") print " selected";
		print ">!=</option>";
		print "<option value=\"LIKE\"";
		if ($cond=="LIKE") print " selected";
		print ">C</option>";
		print "<option value=\"NOT LIKE\"";
		if ($cond=="NOT LIKE") print " selected";
		print ">&cent;</option>";
	}

	static function ListarEou($cond){
				print "<option value=\"AND\"";
				if ($cond=="AND") print " selected";
				print ">"._E."</option>";
				print "<option value=\"OR\"";
				if ($cond=="OR") print " selected";
				print ">"._OU."</option>";
	}

/****************************************************************************
métodos dos passo de geração de relatório
****************************************************************************/
	static function ListarCamposCol1($dados, $inicio, $fim, $dadosSelecionados){
		print"<script>
		var site = {};
		site.doctree = [";
		$cont=-1;
		$dadosSelecionadosPost = array();
		foreach ($dados as $nome_tabela => $colunas)
		{
			$cont++;
			if (($cont < $inicio) || ($cont > $fim))
				continue;
			
			print"[\"<br><div class='maozinha'><img src='imagens/mais_menos.gif' align='absmiddle'> <strong>$nome_tabela</strong></div>\", [";
			foreach ($colunas as $coluna)
			{
				$nome_coluna = $coluna["nome"];
				print"[\"<div><input name='$nome_tabela,,,$nome_coluna' type='checkbox' value='true'";
				if (!is_null($dadosSelecionados)){
					if (in_array($nome_tabela.",,,".$nome_coluna, $dadosSelecionados)) 
						print " checked";
				} else {
					if ((isset($_POST[$nome_tabela.",,,".$nome_coluna]))&&($_POST[$nome_tabela.",,,".$nome_coluna]=="true"))
					{
						$dadosSelecionadosPost[] = $nome_tabela.",,,".$nome_coluna;
						print " checked";
					}
				}
				print">";
				if ($coluna["chave_primaria"]) print"<img src='imagens/chave.gif' width='9' height='13' alt='"._CHAVEPRI."'> ";
				else if ($coluna["chave_estrangeira"]) print"<img src='imagens/chave2.gif' width='9' height='13' alt='"._CHAVEEST."'> ";
				print"$nome_coluna</div>\", []],";
			}
			print"]],";
		}
		
		if (is_null($dadosSelecionados)){
			$dadosSelecionados = $dadosSelecionadosPost;
		}
		
		print"
		];
		site.reference = function(){
			function tree(a){
				dadosSelecionados = new Array(\"".implode('","', $dadosSelecionados)."\");
				var i, temp, s = \"\";
				for (i=0; i<a.length; i++){
					if (!a[i]) {}
					else if (typeof(a[i][1]) == \"object\"){
						temp = \"<a>\" + a[i][0] + \"</a><ul>\" + tree(a[i][1]) + \"</ul>\";
						
						if (a[i][1].expanded) {
							s += \"<li onclick='site.toggleTree(event, this)' class='treeVisible'>\" + temp + \"</li>\";
							a.expanded = true;
						}
						else
						{
							s += \"<li onclick='site.toggleTree(event, this)'>\" + temp + \"</li>\";
";
if (isset($_GET['exp']))
{
	if ($_GET['exp']=="1")
	{
		print "
			a.expanded = true;
		";
	}
}
else if (count($dadosSelecionados) > 0)
{
	print "
							for (j=0; j<dadosSelecionados.length; j++)
							{
								if (temp.indexOf(dadosSelecionados[j]) > -1)
								{
									//alert(dadosSelecionados[j]);
									a.expanded = true;
									break;
								}
							}
	";
}

print"
						}
					}
				}
				return s;
			}

			var s = \"\";
			s += \"<ul class='reference' onclick='site.toggleTree(event)'>\";
			s += tree(site.doctree);
			s += \"</ul>\";
		
			return s;
		}
		
		site.toggleTree = function(event, ref){
			ref.className = ref.className ? \"\" : \"treeVisible\";
			event.cancelBubble = true;
		}
		
		var \$reference = {toString: function(){
			return 	site.reference();
		}
		};

		</script>";
	}

	static function ListarCampos1()
	{
		$dados = self::PegarTabelasECampos(1);
		
		$tam_dados = count($dados);
		
		if ($tam_dados > 0)
		{
			$dadosSelecionados = null;
			if ((isset($_POST['duplicar'])) || (isset($_GET["id"])))
			{
				if (isset($_POST["duplicar"])) 
					$relatorio = $_POST["duplicar"]; 
				else 
					$relatorio = $_GET["id"];
					 
				$conecta = Conexao::Conecta();
				$query = "SELECT CAMTABELA, CAMCAMPO FROM PHPREP_CAMPO WHERE RELCODIGO=".$relatorio;
				$result = $conecta->query($query); 
				if (MDB2::isError($result)) die ($result->getMessage()); 
				$dadosSelecionados = array();
				while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT))
				{
					$nome_tabela = $i->CAMTABELA;
					$nome_coluna = $i->CAMCAMPO;
					$dadosSelecionados[] = $nome_tabela.",,,".$nome_coluna;
				}
				Conexao::Desconecta($conecta);
			}
			
			print "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\"><tr>";
			$tam_col = intval($tam_dados/3);
			$sobra = $tam_dados - ($tam_col*3);
			for($i=0;$i<$tam_dados;$i=$i+$tam_col){
				$ini = $i;
				$fin = ($i+$tam_col)-1;
				if((($i==0)&&($sobra>0)) || (($i==$tam_col+1) && ($sobra==1))){
					$i++;
					$fin++;
					$sobra--;
				}
				if ($fin>$tam_dados) $fin = $tam_dados;
				GerarRel::ListarCamposCol1($dados, $ini, $fin, $dadosSelecionados);
				print"<td width=\"33%\" valign=\"top\"><script>document.write(window.\$reference)</script></td>";
			}
			
			print "</tr></table>";
		}
	}

	static function ColocarTitulos2() {
		print"
		  <table border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
    		<tr>
				<td width=\"25\">&nbsp;</td>
    			<td width=\"300\" bgcolor=\"#F0F0F0\"><strong>"._CAMPO."</strong></td>
    			<td width=\"90\" bgcolor=\"#F0F0F0\"><strong>"._TITULOGERAR."</strong></td>
		  </tr>
		";
		
		$ordena_campos = GerarRel::OrdenarCampos2();
		$tam = count($ordena_campos);
		
		for($i=0;$i<$tam;$i++) {
			print"
				<tr>
					<td align=\"center\">
			";
			if ($i!=0) print "<a href=\"javascript:EnviarForm('FrGerarRel2.php?s=".$i."',document.form1);\"><img src=\"imagens/campo-cima.gif\" border=\"0\"></a>";
			if ($i!=($tam-1)) print "&nbsp;<a href=\"javascript:EnviarForm('FrGerarRel2.php?d=".$i."',document.form1);\"><img src=\"imagens/campo-baixo.gif\" border=\"0\"></a>";
			
			$valor = $ordena_campos[$i][0];
			list ($tabela, $campo) = split(",,,",$valor);
			
			print"
					</td>
					<td><input name=\"cam_list".$i."\" type=\"hidden\" value=\"$valor\">".$tabela." - ".$campo."</td>
					<td><input name=\"tit_".$valor."\" type=\"text\" size=\"20\" maxlength=\"20\" value=\"".$ordena_campos[$i][1]."\">
				    </td>
				</tr>
			";
		}
		print "</table>";
	}

	static function ListarFiltros3($qtd_campos){
		print "<body onLoad=\"";
		for($i=0;$i<$qtd_campos;$i++) { print "PreencheCamposPasso3(document.form1,'".$i."','1'); HabilitaPasso3(document.form1,'eou_filt".$i."', 'cond2_filt".$i."', 'cont2_filt".$i."'); "; }
		print "\">";
		//<body onLoad=\"javascript:PreencheCamposPasso3(document.form1,'".$i."'); HabilitaPasso3(document.form1,'eou_filt".$i."', 'cond2_filt".$i."', 'cont2_filt".$i."');\">
		print"
		  <table border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
    		<tr>
    			<td bgcolor=\"#F0F0F0\"><strong>"._TABELA."</strong></td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._CAMPO."</strong></td>
				<td bgcolor=\"#F0F0F0\"><strong>"._FILTRO."</strong></td>
		  </tr>
		";
		for($i=0;$i<$qtd_campos;$i++) {
			if (isset($_POST["tab_filt".$i])) $tabela = $_POST["tab_filt".$i]; else $tabela = null;
			if (isset($_POST["cam_filt".$i])) $campo = $_POST["cam_filt".$i]; else $campo = null;
			print"
			  <tr>
					<td width=\"90\">
						<select name=\"tab_filt".$i."\" onChange=\"PreencheCamposPasso3(document.form1,'".$i."','0');\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>
			"; 
			
		 	GerarRel::ListarTabelas($tabela);
			print"
					  </select>
				  </td>
					<td width=\"90\"><select name=\"cam_filt".$i."\" class=\"rel\"
			";
			if (is_null($campo)) print " disabled";
			print" onChange=\"PegaSelected(document.form1,'cam_filt".$i."','cam_filt_hidden".$i."');\">";
			if (!is_null($tabela)) {
		 			if ($tabela != "null") {
						GerarRel::ListarCampos($tabela,$campo);
					}
			}
			print"
							</select>
							<input type=\"hidden\" name=\"cam_filt_hidden".$i."\" value=\"-1\">
							</td>
				 
			<td>"; 
			print"
			<table border=\"0\" cellpadding=\"0\" cellspacing=\"5\">
			";
			print"
				<tr>
					<td width=\"10\"><select name=\"cond1_filt".$i."\" id=\"cond1_filt".$i."\"";
					if (is_null($tabela)) print " disabled";
					print">";
			if (isset($_POST["cond1_filt".$i])) $aux = $_POST["cond1_filt".$i]; else $aux = null;
			GerarRel::ListarCondicao($aux);
			print"
					</select></td>
					<td width=\"90\">
						<input name=\"cont1_filt".$i."\" type=\"text\" id=\"cont1_filt".$i."\" size=\"15\" maxlength=\"30\"";
						if (is_null($tabela)) print " disabled"; else print " value=\"".$_POST["cont1_filt".$i]."\"";
						print"></td>
					<td width=\"10\"><select name=\"eou_filt".$i."\" id=\"eou_filt".$i."\" onChange=\"HabilitaPasso3(document.form1,'eou_filt".$i."', 'cond2_filt".$i."', 'cont2_filt".$i."');\" onKeyPress=\"esvaziaCombo(this, event)\"";
					if (is_null($tabela)) print " disabled";
					print">
						<option value=\"null\"></option>";
			if (isset($_POST["eou_filt".$i])) $aux = $_POST["eou_filt".$i]; else $aux = null;
			GerarRel::ListarEou($aux);
			print"
									</select></td>
					<td width=\"10\"><select name=\"cond2_filt".$i."\" id=\"cond2_filt".$i."\"";
					if (!isset($_POST["eou_filt".$i]) || ($_POST["eou_filt".$i])=="null") print " disabled";
					print">";
			if (isset($_POST["cond2_filt".$i])) $aux = $_POST["cond2_filt".$i]; else $aux = null;
			GerarRel::ListarCondicao($aux);
			print"
					</select></td>
					<td width=\"90\">
						<input name=\"cont2_filt".$i."\" type=\"text\" id=\"cont2_filt".$i."\" size=\"15\" maxlength=\"30\"";
						if (!isset($_POST["eou_filt".$i]) || ($_POST["eou_filt".$i])=="null") print " disabled"; else print " value=\"".$_POST["cont2_filt".$i]."\"";
						print"></td>
				</tr>
			</table>
				</td>
					</tr>
			"; 
		}
		print"
			  </tr>
			</table>";
	}

	static function ListarCores4(){ 
		$ordena_campos = GerarRel::OrdenarCampos2();
		$tam = count($ordena_campos);
		
		print "<body onLoad=\"";
		for($i=0;$i<$tam;$i++) {
			for ($j=0;$j<3;$j++){ print "HabilitaPasso3(document.form1,'eou".$j."_cor".$i."', 'cond2".$j."_cor".$i."', 'cont2".$j."_cor".$i."'); "; }
		}
		print "\">";
		
		for($i=0;$i<$tam;$i++) {
		print"
		<tr>
  	<td align=\"center\">&nbsp;</td>
  	<td>
		  <table border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
    		<tr>
				<td bgcolor=\"#F0F0F0\"><strong>"._COLUNA."</strong></td>
				<td><strong>".$ordena_campos[$i][1]."</strong></td>
		    </tr>
		  </table>
				</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
  			<td>"; 
			print"
			<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#000000\">
				<tr>
					<td bgcolor=\"#FFFFFF\">
				<table border=\"0\" cellpadding=\"0\" cellspacing=\"5\">
			";
			for ($j=0;$j<3;$j++){
			print"
				<tr>
					<td width=\"80\" align=\"center\" bgcolor=\"#F0F0F0\"><strong>"._CONDICAO.($j+1)."</strong></td>
					<td width=\"10\"><select name=\"cond1".$j."_cor".$i."\" id=\"cond1".$j."_cor".$i."\">";
			if (isset($_POST["cond1".$j."_cor".$i])) $aux = $_POST["cond1".$j."_cor".$i]; else $aux = null;
			GerarRel::ListarCondicao($aux);
			print"
					</select></td>
					<td width=\"90\">
						<input name=\"cont1".$j."_cor".$i."\" type=\"text\" id=\"cont1".$j."_cor".$i."\" size=\"15\" maxlength=\"30\"";
			if (isset($_POST["cont1".$j."_cor".$i])) print " value=\"".$_POST["cont1".$j."_cor".$i]."\"";
						print">
					</td>
					<td width=\"10\"><select name=\"eou".$j."_cor".$i."\" id=\"eou".$j."_cor".$i."\" onChange=\"HabilitaPasso3(document.form1,'eou".$j."_cor".$i."', 'cond2".$j."_cor".$i."', 'cont2".$j."_cor".$i."');\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>";
			if (isset($_POST["eou".$j."_cor".$i])) $aux = $_POST["eou".$j."_cor".$i]; else $aux = null;
			GerarRel::ListarEou($aux);
			print"
									</select></td>
					<td width=\"10\"><select name=\"cond2".$j."_cor".$i."\" id=\"cond2".$j."_cor".$i."\"";
					if (!isset($_POST["eou".$j."_cor".$i]) || ($_POST["eou".$j."_cor".$i])=="null") print " disabled";
					print">";
			if (isset($_POST["cond2".$j."_cor".$i])) $aux = $_POST["cond2".$j."_cor".$i]; else $aux = null;
			GerarRel::ListarCondicao($aux);
			print"
					</select></td>
					<td width=\"90\">
						<input name=\"cont2".$j."_cor".$i."\" type=\"text\" id=\"cont2".$j."_cor".$i."\" size=\"15\" maxlength=\"30\"";
						if (!isset($_POST["eou".$j."_cor".$i]) || ($_POST["eou".$j."_cor".$i])=="null") print " disabled"; else print " value=\"".$_POST["cont2".$j."_cor".$i]."\"";
						print"></td>
					<td width=\"90\"><select name=\"cor".$j."_cor".$i."\" id=\"cor".$j."_cor".$i."\">
					<option style=\"color:#FFFFFF; background-color: #000000\" value=\"000000\">"._CORPADRAO."</option>";
			if (isset($_POST["cor".$j."_cor".$i])) $aux = $_POST["cor".$j."_cor".$i]; else $aux = null;
			GerarRel::ListarCores($aux);
			print"
					</select></td>
				</tr>
			";
			}
			print"
			</table>
				</td>
					</tr>
			</table>
			";
			print"
			</td></tr>
				<tr><td>&nbsp;</td>
  			<td>&nbsp;</td></tr>"; 
		}
	}

	static function ListarAgrupamento5($qtd_campos){
		/*
		print "<body onLoad=\"";
		for($i=0;$i<$qtd_campos;$i++) { print "PreencheCampos(document.form1,'tab_agrup".$i."', 'cam_agrup".$i."', null, null); "; }
		print "\">";
		*/
		print"
		  <table border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
    		<tr>
				<td>&nbsp;</td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._TABELA."</strong></td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._CAMPO."</strong></td>
		  </tr>
		";

		for($i=0;$i<$qtd_campos;$i++) {
			if (isset($_POST["tab_agrup".$i])) $tabela = $_POST["tab_agrup".$i]; else $tabela = null;
			if (isset($_POST["cam_agrup".$i])) $campo = $_POST["cam_agrup".$i]; else $campo = null;

			if ( ((isset($_GET['s']))&&($_GET['s']==$i)) || ((isset($_GET['d']))&&(($_GET['d']+1)==$i)) ){
				$tabela = $_POST["tab_agrup".($i-1)];
				if (isset($_POST["cam_agrup".($i-1)])) $campo = $_POST["cam_agrup".($i-1)]; else $campo = null;
			}
			if ( ((isset($_GET['s']))&&(($_GET['s']-1)==$i)) || ((isset($_GET['d']))&&($_GET['d']==$i)) ){
				$tabela = $_POST["tab_agrup".($i+1)];
				if (isset($_POST["cam_agrup".($i+1)])) $campo = $_POST["cam_agrup".($i+1)]; else $campo = null;
			}

			print"
			  <tr>
			  		<td width=\"25\" align=\"center\">
			";
			if ($i!=0) print "<a href=\"javascript:EnviarForm('FrGerarRel5.php?s=".$i."',document.form1);\"><img src=\"imagens/campo-cima.gif\" border=\"0\"></a>";
			if ($i!=($qtd_campos-1)) print "&nbsp;<a href=\"javascript:EnviarForm('FrGerarRel5.php?d=".$i."',document.form1);\"><img src=\"imagens/campo-baixo.gif\" border=\"0\"></a>";
			print"
					</td>
					<td width=\"90\">
						<select name=\"tab_agrup".$i."\" onChange=\"PreencheCampos(document.form1,'tab_agrup".$i."', 'cam_agrup".$i."', null, null, null, '0');\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>
			";
		 	GerarRel::ListarTabelas($tabela);
			print"
					  </select>
				  </td>
					<td width=\"90\"><select name=\"cam_agrup".$i."\" class=\"rel\"
			";
			if (is_null($campo)) print " disabled";
			print">";
			if (!is_null($tabela)) {
		 			if ($tabela != "null") {
						GerarRel::ListarCampos($tabela,$campo);
					}
			}
			print"
							</select></td>
				  </tr>"; 
		}
		print "</table>";
	}
	
	static function ListarOrdenacao6($qtd_campos){
		/*
		print "<body onLoad=\"";
		for($i=0;$i<$qtd_campos;$i++) { print "PreencheCampos(document.form1,'tab_ord".$i."', 'cam_ord".$i."', 'tipo_ord".$i."', null); "; }
		print "\">";
		*/
		print"
		  <table border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
    		<tr>
				<td>&nbsp;</td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._TABELA."</strong></td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._CAMPO."</strong></td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._TIPOORDENACAO."</strong></td>
		  </tr>
		";

		for($i=0;$i<$qtd_campos;$i++) {
			if (isset($_POST["tab_ord".$i])) $tabela = $_POST["tab_ord".$i]; else $tabela = null;
			if (isset($_POST["cam_ord".$i])) $campo = $_POST["cam_ord".$i]; else $campo = null;
			if (isset($_POST["tipo_ord".$i])) $ord = $_POST["tipo_ord".$i]; else $ord = null;

			if ( ((isset($_GET['s']))&&($_GET['s']==$i)) || ((isset($_GET['d']))&&(($_GET['d']+1)==$i)) ){
				$tabela = $_POST["tab_ord".($i-1)];
				if (isset($_POST["cam_ord".($i-1)])) $campo = $_POST["cam_ord".($i-1)]; else $campo = null;
				if (isset($_POST["tipo_ord".($i-1)])) $ord = $_POST["tipo_ord".($i-1)]; else $ord = null;
			}
			if ( ((isset($_GET['s']))&&(($_GET['s']-1)==$i)) || ((isset($_GET['d']))&&($_GET['d']==$i)) ){
				$tabela = $_POST["tab_ord".($i+1)];
				if (isset($_POST["cam_ord".($i+1)])) $campo = $_POST["cam_ord".($i+1)]; else $campo = null;
				if (isset($_POST["tipo_ord".($i+1)])) $ord = $_POST["tipo_ord".($i+1)]; else $ord = null;
			}

			print"
			  <tr>
			  		<td width=\"25\" align=\"center\">
			";
			if ($i!=0) print "<a href=\"javascript:EnviarForm('FrGerarRel6.php?s=".$i."',document.form1);\"><img src=\"imagens/campo-cima.gif\" border=\"0\"></a>";
			if ($i!=($qtd_campos-1)) print "&nbsp;<a href=\"javascript:EnviarForm('FrGerarRel6.php?d=".$i."',document.form1);\"><img src=\"imagens/campo-baixo.gif\" border=\"0\"></a>";
			print"
					</td>
					<td width=\"90\">
						<select name=\"tab_ord".$i."\" onChange=\"PreencheCampos(document.form1,'tab_ord".$i."', 'cam_ord".$i."', 'tipo_ord".$i."', null, null, '0');\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>
			";
		 	GerarRel::ListarTabelas($tabela);
			print"
					  </select>
				  </td>
					<td width=\"90\"><select name=\"cam_ord".$i."\" class=\"rel\"
			";
			if (is_null($campo)) print " disabled";
			print">";
			if (!is_null($tabela)) {
		 			if ($tabela != "null") {
						GerarRel::ListarCampos($tabela,$campo);
					}
			}
			print"
							</select></td>
					<td width=\"90\"><select name=\"tipo_ord".$i."\" class=\"rel\"
			";
			if (is_null($ord)) print " disabled";
			print">";
			GerarRel::ListarTipoOrdem($ord);
			print"
					</select></td>
				  </tr>"; 
		}
		print "</table>";
	}

	static function ListarFormulas7($qtd_campos){
	
		print "<body onLoad=\"";
		for($i=0;$i<$qtd_campos;$i++) { print "PreencheCamposNum(document.form1,'tab_formrel".$i."', 'cam_formrel".$i."', 'tip_formrel".$i."', 'uti_formrel".$i."', null, '1'); "; }
		print "\">";
		
		print"
		  <table border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
    		<tr>
				<td>&nbsp;</td>
				<td bgcolor=\"#F0F0F0\"><strong>"._TITULOGERAR."</strong></td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._TABELA."</strong></td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._CAMPO."</strong></td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._FORMULA."</strong></td>
				<td bgcolor=\"#F0F0F0\"><strong>"._APLICACAO."</strong></td>
		  </tr>
		";

		for($i=0;$i<$qtd_campos;$i++) {
			if (isset($_POST["tit_formrel".$i])) $titulo = $_POST["tit_formrel".$i]; else $titulo = null;
			if (isset($_POST["tab_formrel".$i])) $tabela = $_POST["tab_formrel".$i]; else $tabela = null;
			if (isset($_POST["cam_formrel".$i])) $campo = $_POST["cam_formrel".$i]; else $campo = null;
			if (isset($_POST["tip_formrel".$i])) $tipo = $_POST["tip_formrel".$i]; else $tipo = null;
			if (isset($_POST["uti_formrel".$i])) $utilizacao = $_POST["uti_formrel".$i]; else $utilizacao = null;

			if ( ((isset($_GET['s']))&&($_GET['s']==$i)) || ((isset($_GET['d']))&&(($_GET['d']+1)==$i)) ){
				$titulo = $_POST["tit_formrel".($i-1)]; 
				$tabela = $_POST["tab_formrel".($i-1)];
				if (isset($_POST["cam_formrel".($i-1)])) $campo = $_POST["cam_formrel".($i-1)]; else $campo = null;
				if (isset($_POST["tip_formrel".($i-1)])) $tipo = $_POST["tip_formrel".($i-1)]; else $tipo = null;
				if (isset($_POST["uti_formrel".($i-1)])) $utilizacao = $_POST["uti_formrel".($i-1)]; else $utilizacao = null;
			}
			if ( ((isset($_GET['s']))&&(($_GET['s']-1)==$i)) || ((isset($_GET['d']))&&($_GET['d']==$i)) ){
				$titulo = $_POST["tit_formrel".($i+1)]; 
				$tabela = $_POST["tab_formrel".($i+1)];
				if (isset($_POST["cam_formrel".($i+1)])) $campo = $_POST["cam_formrel".($i+1)]; else $campo = null;
				if (isset($_POST["tip_formrel".($i+1)])) $tipo = $_POST["tip_formrel".($i+1)]; else $tipo = null;
				if (isset($_POST["uti_formrel".($i+1)])) $utilizacao = $_POST["uti_formrel".($i+1)]; else $utilizacao = null;
			}

			print"
			  <tr>
			  		<td width=\"25\" align=\"center\">
			";
			if ($i!=0) print "<a href=\"javascript:EnviarForm('FrGerarRel7.php?s=".$i."',document.form1);\"><img src=\"imagens/campo-cima.gif\" border=\"0\"></a>";
			if ($i!=($qtd_campos-1)) print "&nbsp;<a href=\"javascript:EnviarForm('FrGerarRel7.php?d=".$i."',document.form1);\"><img src=\"imagens/campo-baixo.gif\" border=\"0\"></a>";
			print"
					</td>
					<td width=\"90\">
						<input name=\"tit_formrel".$i."\" type=\"text\" size=\"16\" maxlength=\"20\"";
						if (!is_null($titulo)) print " value=\"$titulo\"";
						print">
				  </td>
					<td width=\"90\">
						<select name=\"tab_formrel".$i."\" onChange=\"PreencheCamposNum(document.form1,'tab_formrel".$i."', 'cam_formrel".$i."', 'tip_formrel".$i."', 'uti_formrel".$i."', null, '0');\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>
			";
		 	GerarRel::ListarTabelas($tabela);
			print"
					  </select>
				  </td>
					<td width=\"90\"><select name=\"cam_formrel".$i."\" class=\"rel\"
			";
			if (is_null($campo)) print " disabled";
			print">";
			if (!is_null($tabela)) {
		 			if ($tabela != "null") {
						GerarRel::ListarCamposNum($tabela,$campo);
					}
			}
			print"
							</select></td>
					<td width=\"85\"><select name=\"tip_formrel".$i."\" class=\"rel2\"
			";
			if (is_null($tipo)) print " disabled";
			print">";
			GerarRel::ListarTipoFormula($tipo);
			print"
					</select></td>
					<td width=\"90\"><select name=\"uti_formrel".$i."\" class=\"rel\"
			";
			if (is_null($utilizacao)) print " disabled";
			print">";
				GerarRel::ListarUtilizacaoGrupos($utilizacao);
				
			print"
					</select></td>
				  </tr>"; 
		}
		print "</table>";
	}
		
	static function ListarGrafico8(){
		if (isset($_POST["tip_graf"])) $tipo = $_POST["tip_graf"]; else $tipo = null;
		if (isset($_POST["tit_graf"])) $titulo = $_POST["tit_graf"]; else $titulo = null;
		if (isset($_POST["tab_graf1"])) $tabela1 = $_POST["tab_graf1"]; else $tabela1 = null;
		if (isset($_POST["cam_graf1"])) $campo1 = $_POST["cam_graf1"]; else $campo1 = null;
		if (isset($_POST["tab_graf2"])) $tabela2 = $_POST["tab_graf2"]; else $tabela2 = null;
		if (isset($_POST["cam_graf2"])) $campo2 = $_POST["cam_graf2"]; else $campo2 = null;
		if (isset($_POST["leg_graf1"])) $legenda1 = $_POST["leg_graf1"]; else $legenda1 = null;
		if (isset($_POST["leg_graf2"])) $legenda2 = $_POST["leg_graf2"]; else $legenda2 = null;
		
		print "<body onLoad=\"PreencheCampos(document.form1,'tab_graf1', 'cam_graf1', null, null, 'cam_graf_hidden1', '1'); PreencheCamposNum(document.form1,'tab_graf2', 'cam_graf2', null, null, 'cam_graf_hidden2', '1');\">";
		
		print"
			<table width=\"414\"  border=\"0\" cellspacing=\"8\" cellpadding=\"0\">
				<tr>
					<td><input name=\"tip_graf\" type=\"radio\" value=\"1\" checked> 
					<img src=\"imagens/graf-barras.gif\" width=\"20\" height=\"20\" align=\"absmiddle\"> "._BARRAS."</td>
					<td><input name=\"tip_graf\" type=\"radio\" value=\"2\"
		";
		if((!is_null($tipo))&&($tipo=="2")) print" checked";
		print"> <img src=\"imagens/graf-linhas.gif\" width=\"20\" height=\"20\" align=\"absmiddle\"> "._LINHAS."</td>
					<td><input name=\"tip_graf\" type=\"radio\" value=\"3\"
		";
		if((!is_null($tipo))&&($tipo=="3")) print" checked";
		print"> <img src=\"imagens/graf-pizza.gif\" width=\"20\" height=\"20\" align=\"absmiddle\"> "._PIZZA."</td>
				</tr>
				<tr>
					<td colspan=\"3\">&nbsp;</td>
				  </tr>
			</table>

    	<table border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
    		<tr>
    		  <td>&nbsp;</td>
    		  <td colspan=\"2\" bgcolor=\"#F0F0F0\"><strong>"._TITULOGERAR."</strong></td>
    		  </tr>
    		<tr>
    		  <td>&nbsp;</td>
    		  <td colspan=\"2\"><input name=\"tit_graf\" type=\"text\" size=\"50\" maxlength=\"100\"";
			  if(!is_null($titulo)) print" value=\"$titulo\"";
			  print"></td>
    		  </tr>
    		<tr>
    		  <td colspan=\"3\">&nbsp;</td>
   		  </tr>
    		<tr>
    		  <td>&nbsp;</td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._TABELA."</strong></td>
    			<td bgcolor=\"#F0F0F0\"><strong>"._CAMPO."</strong></td>
				<td bgcolor=\"#F0F0F0\"><strong>"._LEGENDA."</strong></td>
		  </tr>
    		<tr>
    		  <td bgcolor=\"#F0F0F0\"><strong>X</strong></td>
    			<td><select name=\"tab_graf1\" onChange=\"PreencheCampos(document.form1,'tab_graf1', 'cam_graf1', null, null, 'cam_graf_hidden1', '0');\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>
			";
		 	GerarRel::ListarTabelas($tabela1);
			print"
					  </select>
			  </td>
    			<td><select name=\"cam_graf1\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\"
			";
			if (is_null($campo1)) print " disabled";
			print" onChange=\"PegaSelected(document.form1,'cam_graf1','cam_graf_hidden1');\">
					<option value=\"null\"></option>
			";
			if (!is_null($tabela1)) {
		 			if ($tabela1 != "null") {
						GerarRel::ListarCampos($tabela1,$campo1);
					}
			}
			print"
				</select>
				<input type=\"hidden\" name=\"cam_graf_hidden1\" value=\"-1\">
				</td>
				<td width=\"90\">
					<input name=\"leg_graf1\" type=\"text\" size=\"16\" maxlength=\"20\"";
					if (!is_null($tabela1)) print " value=\"$legenda1\"";
					print">
			</td>
		  </tr>
    		<tr>
    		  <td colspan=\"3\">&nbsp;</td>
   		  </tr>
    		<tr>
    		  <td bgcolor=\"#F0F0F0\"><strong>Y</strong></td>
    			<td><select name=\"tab_graf2\" onChange=\"PreencheCamposNum(document.form1,'tab_graf2', 'cam_graf2', null, null, 'cam_graf_hidden2', '0');\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>
			";
		 	GerarRel::ListarTabelas($tabela2);
			print"
					 </select></td>
    			<td>&sum; <select name=\"cam_graf2\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\"
			";
			if (is_null($campo2)) print " disabled";
			print" onChange=\"PegaSelected(document.form1,'cam_graf2','cam_graf_hidden2');\">
					<option value=\"null\"></option>
			";
			if (!is_null($tabela2)) {
		 			if ($tabela2 != "null") {
						GerarRel::ListarCamposNum($tabela2,$campo2);
					}
			}
			print"
					</select>
					<input type=\"hidden\" name=\"cam_graf_hidden2\" value=\"-1\">
					</td>
				<td width=\"90\">
					<input name=\"leg_graf2\" type=\"text\" size=\"16\" maxlength=\"20\"";
					if (!is_null($tabela2)) print " value=\"$legenda2\"";
					print">
			</td>
		  </tr>
   		</table>
		";
	}

	static function CabecalhoRodape9(){
		print"
		<table width=\"700\" border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
    		<tr>
    		  <td bgcolor=\"#F0F0F0\"><strong>"._CABECALHO."</strong></td>
   		  </tr>
    		<tr>
    		  <td><textarea name=\"cabecalho\" style=\"width:100%; height:150\">";
		if (isset($_POST["cabecalho"])) {
			$cabecalho = str_replace("[[aspas]]","\"",$_POST["cabecalho"]);
			print $cabecalho;
		}
			  print"</textarea></td>
   		  </tr>
    		<tr>
    		  <td>&nbsp;</td>
   		  </tr>
    		<tr>
    		  <td bgcolor=\"#F0F0F0\"><strong>"._RODAPE."</strong></td>
		  </tr>
    		<tr>
    		  <td><textarea name=\"rodape\" style=\"width:100%; height:150\">";
		if (isset($_POST["rodape"])) {
			$rodape = str_replace("[[aspas]]","\"",$_POST["rodape"]);
			print $rodape;
		}
			  print"</textarea></td>
   		  </tr>
   		</table>
		";
	}
	
	static function Templates10(){
		print"
	  <tr>
		<td align=\"center\">&nbsp;</td>
		<td> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
						<tr>
							<td width=\"35\">
								<div align=\"center\">
									<input name=\"template\" type=\"radio\" value=\"1\" checked>
									</div></td>
							<td width=\"470\"><img src=\"imagens/template1.jpg\" width=\"520\" height=\"141\"></td>
							</tr>
						<tr>
							<td><div align=\"center\"></div></td>
							<td>&nbsp;</td>
							</tr>
						<tr>
							<td><div align=\"center\">
									<input name=\"template\" type=\"radio\" value=\"2\"";
		if ((isset($_POST["template"]))&&($_POST["template"]=="2")) print" checked";
		print">
									</div></td>
							<td><img src=\"imagens/template2.jpg\" width=\"520\" height=\"141\"></td>
							</tr>
						</table></td>
		</tr>
	  <tr>
		<td align=\"center\">&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
	  <tr>
		<td align=\"center\">&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
	  <tr>
		<td align=\"center\">&nbsp;</td>
		<td><table width=\"358\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				<td colspan=\"5\"><strong>"._FORMAEXIBICAO."</strong></td>
				</tr>
			<tr>
				<td colspan=\"5\">&nbsp;</td>
				</tr>
			<tr>
				<td width=\"84\">&nbsp;</td>
				<td width=\"28\"><div align=\"center\">
						<input name=\"template_tipo\" type=\"radio\" value=\"1\" checked>
						</div></td>
				<td width=\"71\"><div align=\"left\"><img src=\"imagens/barrarolagem.gif\" width=\"15\" height=\"90\"></div></td>
				<td width=\"28\"><div align=\"center\">
					<input name=\"template_tipo\" type=\"radio\" value=\"2\"";
		if ((isset($_POST["template_tipo"]))&&($_POST["template_tipo"]=="2")) print" checked";
		print">
					</div></td>
				<td width=\"147\"><img src=\"imagens/paginacao.gif\" width=\"129\" height=\"29\"></td>
			</tr>
			</table></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
	  <tr>
		<td align=\"center\">&nbsp;</td>
		<td><table width=\"358\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				<td colspan=\"5\"><strong>"._EXIBICAOREGISTRO."</strong></td>
				</tr>
			<tr>
				<td colspan=\"5\">&nbsp;</td>
				</tr>
			<tr>
				<td width=\"84\">&nbsp;</td>
				<td width=\"28\"><div align=\"center\">
						<input name=\"template_nume\" type=\"radio\" value=\"1\" checked>
						</div></td>
				<td width=\"71\">"._SIM."</td>
				<td width=\"28\"><div align=\"center\">
					<input name=\"template_nume\" type=\"radio\" value=\"2\"";
		if ((isset($_POST["template_nume"]))&&($_POST["template_nume"]=="2")) print" checked";
		print">
					</div></td>
				<td width=\"147\">"._NAO."</td>
			</tr>
			</table></td>
		</tr>
		";
	}
	
	static function ListarRelacionamento11($qtd_campos){
		$relacionam_tabelas = GerarRel::TabelasUsadas();
		if (count($relacionam_tabelas)>1){
		
			print "<body onLoad=\"";
			for($j=0;$j<$qtd_campos;$j++) {
				print "PreencheCampos(document.form1,'tab_relac1".$j."', 'cam_relac1".$j."', null, null, 'cam_relac1_hidden".$j."', '1'); PreencheCampos(document.form1,'tab_relac2".$j."', 'cam_relac2".$j."', null, null, 'cam_relac2_hidden".$j."', '1'); ";
			}
			print "\">";
		
			print"
			  <table border=\"0\" cellpadding=\"3\" cellspacing=\"8\">
				<tr>
					<td bgcolor=\"#F0F0F0\"><strong>"._TABELA."</strong></td>
					<td bgcolor=\"#F0F0F0\"><strong>"._CAMPO."</strong></td>
					<td bgcolor=\"#F0F0F0\"><strong>"._TABELA."</strong></td>
					<td bgcolor=\"#F0F0F0\"><strong>"._CAMPO."</strong></td>
			  </tr>
			";

			for($i=0;$i<$qtd_campos;$i++) {

				if (isset($_POST["tab_relac1".$i])) $tabela1 = $_POST["tab_relac1".$i]; else $tabela1 = null;
				if (isset($_POST["cam_relac1".$i])) $campo1 = $_POST["cam_relac1".$i]; else $campo1 = null;
				if (isset($_POST["tab_relac2".$i])) $tabela2 = $_POST["tab_relac2".$i]; else $tabela2 = null;
				if (isset($_POST["cam_relac2".$i])) $campo2 = $_POST["cam_relac2".$i]; else $campo2 = null;

			print"
			  <tr>
					<td width=\"90\">
						<select name=\"tab_relac1".$i."\" onChange=\"PreencheCampos(document.form1,'tab_relac1".$i."', 'cam_relac1".$i."', null, null, 'cam_relac1_hidden".$i."', '0');\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>
			"; 
		 	GerarRel::ListarTabelas($tabela1);
			print"
					  </select>
				  </td>
					<td width=\"90\"><select name=\"cam_relac1".$i."\" class=\"rel\" onChange=\"PegaSelected(document.form1,'cam_relac1".$i."','cam_relac1_hidden".$i."');\"";
					if ($campo1==null) print " disabled";
					print">";
					if ($campo1!=null) GerarRel::ListarCampos($tabela1,$campo1);
					print"
						</select>
					<input type=\"hidden\" name=\"cam_relac1_hidden".$i."\" value=\"-1\">
					</td>
					<td width=\"90\">
						<select name=\"tab_relac2".$i."\" onChange=\"PreencheCampos(document.form1,'tab_relac2".$i."', 'cam_relac2".$i."', null, null, 'cam_relac2_hidden".$i."', '0');\" class=\"rel\" onKeyPress=\"esvaziaCombo(this, event)\">
						<option value=\"null\"></option>
			";
		 	GerarRel::ListarTabelas($tabela2);
			print"
					  </select>
				  </td>
					<td width=\"90\"><select name=\"cam_relac2".$i."\" class=\"rel\" onChange=\"PegaSelected(document.form1,'cam_relac2".$i."','cam_relac2_hidden".$i."');\"";
					if ($campo2==null) print " disabled";
					print">";
					if ($campo2!=null) GerarRel::ListarCampos($tabela2,$campo2);
					print"
							</select>
					<input type=\"hidden\" name=\"cam_relac2_hidden".$i."\" value=\"-1\">
					</td>
				  </tr>"; 
			}
			echo "</table>";
		} else print ""._NAORELACIONAM."";
	}
}
?>