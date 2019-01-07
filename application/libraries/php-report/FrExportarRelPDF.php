<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

	define('FPDF_FONTPATH','scripts/font/');
	require('scripts/fpdf.php');

	session_start();
	include("classes/Class_Config.php");
	include("classes/Class_Layout.php");
	Layout::AcessoPagina("Visualizar");
	include("idiomas/Exportar/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_ExportarRel.php");
	include("classes/Class_VisualizarRel.php");
	
	$tipoarquivo = $_GET['tipoarquivo'];
	$estilo = $_GET['estilo'];
	$fonte = $_GET['fonte'];
	$folha = $_GET['folha'];
	$tam = $_GET['tam'];
	$top = $_GET['top'];
	$dir = $_GET['dir'];
	$esq = $_GET['esq'];
	
	class MeuPDF extends FPDF
	{
		var $dados;
		var $id;
		var $conecta;
		
		function MeuPDF($orientation='P',$unit='mm',$format='A4',$id)
		{
			parent::FPDF($orientation,$unit,$format);
			
			$this->conecta = Conexao::Conecta();
			
			$this->id = $id;
			
			$this->dados = VisualizarRel::GetDadosPrincipaisRelatorio($this->id, $this->conecta);
		}
		
		function Header()
		{
			$tam = $_GET['tam'];
			$fonte = $_GET['fonte'];
			$cabecalho = $this->dados["cabecalho"];
			$cabecalho = str_replace("[[aspas]]","\"",$cabecalho);
			$cabecalho = str_replace("<STRONG>","",$cabecalho);
			$cabecalho = str_replace("</STRONG>","",$cabecalho);
			$cabecalho = str_replace("<EM>","",$cabecalho);
			$cabecalho = str_replace("</EM>","",$cabecalho);
			$cabecalho = str_replace("<BR>","     ",$cabecalho);
			$cabecalho = str_replace("<P>","          ",$cabecalho);
			$cabecalho = str_replace("<P align=center>","          ",$cabecalho);
			$cabecalho = str_replace("<P align=right>","          ",$cabecalho);
			$cabecalho = str_replace("<P align=left>","          ",$cabecalho);
			$cabecalho = str_replace("</P>","",$cabecalho);
			$cabecalho = strip_tags($cabecalho,$cabecalho);
			$this->SetFont($fonte,'',$tam+2);
			//$this->Image($imagem, 1200, 2, 50); //insere uma imagem 
			$this->Cell(0, 10,$cabecalho,0,1,'C');
			$this->ln();
		}
		
		function Footer()
		{
			$top = $_GET['top'];
			$tam = $_GET['tam'];
			$fonte = $_GET['fonte'];
			$i = $result->fetchRow(MDB2_FETCHMODE_OBJECT);
			$rodape = $this->dados["rodape"];;
			$rodape = str_replace("[[aspas]]","\"",$rodape);
			$rodape = str_replace("<BR>","",$rodape);
			$rodape = str_replace("<STRONG>","",$rodape);
			$rodape = str_replace("</STRONG>","",$rodape);
			$rodape = str_replace("<BR>","     ",$rodape);
			$rodape = str_replace("<P>","          ",$rodape);
			$rodape = str_replace("<P align=center>","          ",$rodape);
			$rodape = str_replace("<P align=right>","          ",$rodape);
			$rodape = str_replace("<P align=left>","          ",$rodape);
			$rodape = str_replace("</P>","",$rodape);
			$rodape = strip_tags ($rodape,$rodape);
			
			$this->SetY(-($top));
			$this->SetFont($fonte,'',$tam+2);
			//$this->Cell(0,10,'Pï¿½gina '.$this->PageNo().'/{nb}',0,0,'C');
			$this->Cell(0, 10,$rodape,0,1,'C');
			/*$this->SetFont($fonte,'',$tam+2);
			$this->Cell(0, 5,$rodape,0,1,'C');
			$this->Cell(0,5,$this->PageNo(),0,0,'R');*/
		}
	
		function RelatorioPrinc($id,$pdf,$largura,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conectaRel)
		{
		$query = "SELECT CAMTITULO FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." ORDER BY CAMORDEM";
		$result = $this->conecta->query($query); 
		if (MDB2::isError($result)) die ($result->getDebugInfo()); 
		$colunas = $result->numRows(); 
		$larg = $largura / $colunas;
		//$pdf->ln();
		if ($colunas > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$titulo = $i->CAMTITULO;
				$pdf->SetFont($_GET["fonte"],'',$_GET["tam"]);
				$pdf->Cell($larg,5,$titulo,1);
			}
			$pdf->ln();
		}

		if (($sqlwhere==null)&&($addwhere==null)) $where = null;
		else if (($sqlwhere!=null)&&($addwhere!=null)) $where = " ".$sqlwhere." AND ".$addwhere;
		else if (($sqlwhere==null)&&($addwhere!=null)) $where = " WHERE ".$addwhere; 
		else $where = " ".$sqlwhere;
		$stringsql = $sqlselect." ".$from_rel.$where." ".$sqlorder;
		
		$result = $conectaRel->query($stringsql);
				if (MDB2::isError($result)) die ($result->getDebugInfo());
				$linhas = $result->numRows();
				if ($linhas > 0) {
					while($j = $result->fetchRow(MDB2_FETCHMODE_OBJECT)) {		
						for($id_coluna=0;$id_coluna<$colunas;$id_coluna++){
							
							$pegacoluna = "COLUNA".$id_coluna;
							$dado = $j->$pegacoluna;
							$query = "SELECT CAMCAMPO FROM PHPREP_CAMPO WHERE RELCODIGO=".$id." AND CAMORDEM=".$id_coluna;
							$result1 = $this->conecta->query($query); 
							if (MDB2::isError($result1)) die ($result1->getDebugInfo()); 
							$i = $result1->fetchRow(MDB2_FETCHMODE_OBJECT);
							$titulo = $i->CAMCAMPO;
							//$dado = wordwrap($dado, 10);
							$pdf->SetFont($_GET["fonte"],'',$_GET["tam"]);
							if ($dado!=null) $pdf->Cell($larg,5,$dado,1); 
						}
						$pdf->ln();
					}
				}
		
		//imprime formulas do grupo
		$query = "SELECT FORCAMPO,FORTITULO FROM PHPREP_FORMULA WHERE RELCODIGO=".$id." AND FORAPLICACAO='g' ORDER BY FORORDEM";
		$result = $this->conecta->query($query);
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
					$pdf->SetFont($_GET["fonte"],'',$_GET["tam"]);
					$pdf->Cell(0,10,$titulo.": ".$formula,0,1,'R');
					//$pdf->ln();
					//$pdf->ln();
				}
			}
		} 
	}

	function RelatorioGrupo($id,$pdf,$grupo,$largura,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conectaRel){
		
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
		
		$stringsql = "SELECT ".$select." AS GRUPO".$grupo.$from_rel.$imp_where." GROUP BY ".$agrupar;
		$result = $conectaRel->query($stringsql);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$rows = $result->numRows();
		if ($rows > 0){
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$pegagrupo = "GRUPO".$grupo;
				$dado = $i->$pegagrupo;
				for ($k=0;$k<$grupo;$k++) $espaco.="     ";
				if ($grupo==0) {
					$tam_font = $_GET["tam"]+2;
					$pdf->SetFont($_GET["fonte"],'',$tam_font); 
				} else {
					$tam_font = $_GET["tam"]+1;
					$pdf->SetFont($_GET["fonte"],'',$tam_font); 
				}
				//$pdf->Cell($larg,5,$dado,1);
				$pdf->Cell(0,10,$espaco.$dado,0,1,'L');
				//$pdf->ln();
				
				$where[$grupo] = $select."='".$dado."'";
				if($grupo==$tam-1) {
					$addwhere=null;
					for($j=0;$j<=$grupo;$j++){
						if ($j!=0) $addwhere.=" AND ";
						$addwhere.=$where[$j];
					}
					$this->RelatorioPrinc($id,$pdf,$largura,$addwhere,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conectaRel);
				} else if ($grupo<$tam) {
					$this->RelatorioGrupo($id,$pdf,$grupo+1,$largura,$agrupar_por,$tam,$where,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conectaRel);
				}
				//$pdf->ln();
			}
		}
	}
	function VisualizarSalvo($pdf,$largura)
	{
		$base = $this->dados["base"];
		$template = $this->dados["template"];
		$template_tipo = $this->dados["template_tipo"];
		$template_nume = $this->dados["template_nume"];
		$sqlselect = $this->dados["sqlselect"];
		$sqlfrom = $this->dados["sqlfrom"];
		$sqlwhere = $this->dados["sqlwhere"];
		$sqlorder = $this->dados["sqlorder"];
		$sqlgroup = $this->dados["sqlgroup"];
		$sqlformgrup = $this->dados["sqlformgrup"];
		$sqlformrel = $this->dados["sqlformrel"];
		
		$conectaRel = Conexao::ConectaRel($base);
		
		//Adiciona caracter "`" nos inserts se mysql
		$char_mysql = "";
		$partes = split("¶", $base);
		$key_block = $partes[0];
		if (Config::$Servers[$key_block]["DBType"] == "mysql")
			$char_mysql = "`";
		
		$from_rel = VisualizarRel::From($this->id,"rel",$char_mysql,$this->conecta);
		$from_form = VisualizarRel::From($this->id,"form",$char_mysql,$this->conecta);
		
		$query = "SELECT AGRTABELA,AGRCAMPO FROM PHPREP_AGRUPAMENTO WHERE RELCODIGO=".$this->id." ORDER BY AGRNIVEL";
		$result = $this->conecta->query($query);
		if (MDB2::isError($result)) die ($result->getDebugInfo());
		$grupos = $result->numRows();
		if ($grupos > 0){
			$agrupar_por=null;
			while($i = $result->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$grup_tab = $i->AGRTABELA;
				$grup_cam = $i->AGRCAMPO;
				$agrupar_por[]="$char_mysql".$grup_tab."$char_mysql.$char_mysql".$grup_cam."$char_mysql";
			}
			$this->RelatorioGrupo($this->id,$pdf,0,$largura,$agrupar_por,count($agrupar_por),null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conectaRel);
		} else $this->RelatorioPrinc($this->id,$pdf,$largura,null,$from_rel,$from_form,$base,$template,$template_tipo,$template_nume,$sqlselect,$sqlfrom,$sqlwhere,$sqlorder,$sqlgroup,$sqlformgrup,$conectaRel);
		
		//Imprime formulas do relatorio geral
		$query = "SELECT FORCAMPO,FORTITULO FROM PHPREP_FORMULA WHERE RELCODIGO=".$this->id." AND FORAPLICACAO='r' ORDER BY FORORDEM";
		$result = $this->conecta->query($query);
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
					//$pdf->Cell($larg,5,$titulo.": ".$formula,1);
					$pdf->SetFont($_GET["fonte"],'',$_GET["tam"]);
					$pdf->Cell(0,10,$titulo.": ".$formula,0,1,'R');
				}
			}
		}
		
		
		Conexao::Desconecta($this->conecta);
		Conexao::Desconecta($conectaRel);
	}
}

	$pdf = new MeuPDF($estilo,'mm',$folha,$_GET['id']);
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetFont($fonte, '', $tam);
	$pdf->SetAuthor('PHP Report');
	$pdf->SetLeftMargin($esq);
	$pdf->SetRightMargin($dir);
	$pdf->SetTopMargin($top);
	$pdf->SetAutoPageBreak(true,$top);
	if ($folha == "A4"){
		if ($estilo == "P")$largura = 210; else $largura = 297;
	}
	if ($folha == "A3"){
		if ($estilo == "P")$largura = 297;else $largura = 420;
	}
	if ($folha == "A5"){
		if ($estilo == "P")$largura = 148; else $largura = 210;
	}
	if (($folha == "legal") || ($folha == "letter")){
		if ($estilo == "P") $largura = 216; else $largura = 280;
	}
	$largura = $largura - ($dir + $esq);
	
	$pdf->VisualizarSalvo($pdf,$largura);

	$pdf->Output("Relatorio.pdf","F");
?>