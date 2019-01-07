<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

include("classes/Class_Config.php");
include("classes/Class_Conexao.php");
function Grafico(){
	$id = $_GET['id'];
	$base = $_GET['base'];
	$sqlselect = $_GET['sqlselect'];
	$from_gra = $_GET['from_gra'];
	$sqlwhere = $_GET['sqlwhere'];

	$sqlwhere = stripslashes($sqlwhere);
	$from_gra = stripslashes($from_gra);
	$sqlselect = stripslashes($sqlselect);
	$sqlwhere = str_replace("[[aspas]]","'",$sqlwhere);

	$conecta = Conexao::Conecta();
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
		$array_x = array();
		$array_y = array();
		
		Conexao::Desconecta($conecta);
		
		$conecta = Conexao::ConectaRel($base);
		
		//Adiciona caracter "´" se mysql
		$char_mysql = "";
		$partes = split("¶", $base);
		$key_block = $partes[0];
		if (Config::$Servers[$key_block]["DBType"] == "mysql")
			$char_mysql = "`";
		
		$stringsql_x = "SELECT $char_mysql".$tabelax."$char_mysql.$char_mysql".$campox."$char_mysql AS EIXOX".$from_gra.$sqlwhere." GROUP BY $char_mysql".$tabelax."$char_mysql.$char_mysql".$campox."$char_mysql";
		$result_x = $conecta->query($stringsql_x);
		if (MDB2::isError($result_x)) die ($result_x->getDebugInfo());
		$rows_x = $result_x->numRows();
		if ($rows_x > 0){
			while($i = $result_x->fetchRow(MDB2_FETCHMODE_OBJECT)){
				$valor_x = $i->EIXOX;
				$valor_x = addslashes($valor_x);
				if($tipo == 3){
					if (strlen($valor_x) <= 17)$array_x[] = " ".$valor_x; else  $array_x[] = " ".(substr($valor_x, 0, 17));
				} else {
					if (strlen($valor_x) <= 13)$array_x[] = " ".$valor_x; else  $array_x[] = " ".(substr($valor_x, 0, 13));
				}
				if ($sqlwhere==null) $where = " WHERE $char_mysql".$tabelax."$char_mysql.$char_mysql".$campox."$char_mysql='".$valor_x."'";
				else $where = $sqlwhere." AND $char_mysql".$tabelax."$char_mysql.$char_mysql".$campox."$char_mysql='".$valor_x."'";
				$stringsql_y = "SELECT SUM($char_mysql".$tabelay."$char_mysql.$char_mysql".$campoy."$char_mysql) AS EIXOY".$from_gra.$where;
				$result_y = $conecta->query($stringsql_y);
				if (MDB2::isError($result_y)) die ($result_y->getDebugInfo());
				$rows_y = $result_y->numRows();
				if ($rows_y > 0){
					while($j = $result_y->fetchRow(MDB2_FETCHMODE_OBJECT)){
						$valor_y = $j->EIXOY;
						$array_y[] = $valor_y;
					}
				}				
			}
		}
		include ("scripts/jpgraph/jpgraph.php");
		include ("scripts/jpgraph/jpgraph_line.php");
		include ("scripts/jpgraph/jpgraph_bar.php");
		include ("scripts/jpgraph/jpgraph_pie.php");
		include ("scripts/jpgraph/jpgraph_pie3d.php");

		if($tipo == 3) $gJpgBrandTiming=true;
		
		if($tipo == 3) $graph = new PieGraph(550,300,'auto'); else $graph = new Graph(550,300,'auto');
		
		$graph->SetShadow();
		$graph->SetScale("textlin");
		
		$graph->img->SetMargin(45,30,40,90);
		
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->SetLabelAngle(90);
		if($tipo == 2){
			$lineplot = new LinePlot($array_y);
			$lineplot->SetColor("blue");
			$graph->title->Set($titulo);
			$graph->xaxis->SetTickLabels($array_x);
			$graph->xaxis->title->Set($legendax);
			$graph->yaxis->title->Set($legenday);
			$graph->Add($lineplot);
			$graph->Stroke();
		}
		if($tipo == 1){
			$BarPlot=new BarPlot($array_y);
			$BarPlot->SetColor("blue");
			$graph->title->Set($titulo);
			$graph->xaxis->SetTickLabels($array_x);
			$graph->xaxis->title->Set($legendax);
			$graph->yaxis->title->Set($legenday);
			$graph->legend->Pos(0.03,0.5,"right","center");
			$graph->Add($BarPlot);
			$graph->Stroke();
		}
		if($tipo == 3){
			$array_x2 = array_reverse($array_x);
			$p1 = new PiePlot3D($array_y);
			$graph->title->Set($titulo); 
			$p1->SetLegends($array_x2);
			$graph->legend->Pos(0.02,0.02);
			$p1->SetCenter(0.35,0.5);
			$p1->SetLabelType(0);
			$graph->Add($p1);
			$graph->StrokeCSIM('GraficoRel.php');
		}
		
		Conexao::Desconecta($conecta);
	}
}
Grafico();
?>