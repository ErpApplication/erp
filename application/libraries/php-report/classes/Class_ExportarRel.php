<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

class ExportarRel {

	//Verificação dos campos de parametros
	static function VerificaCampos()
	{
		$tipoarquivo = $_POST['tipoarquivo'];
		$estilo = $_POST['estilo'];
		$fonte = $_POST['fonte'];
		$folha = $_POST['folha'];
		$tam = $_POST['tam'];
		$top = $_POST['top'];
		$dir = $_POST['dir'];
		$esq = $_POST['esq'];
		
		if ($tipoarquivo == "null" )die ("<script>alert('"._ESCOLHAARQ."'); history.go(-1);</script>");
		if ($tipoarquivo == "PDF" )
		{
			if (($folha == "null") || ($estilo == "null") || ($fonte == "null") || ($tam == null) || ($top == null) || ($dir == null) || ($esq == null))
			{
				die ("<script>alert('"._PREENCHAPARAM."'); history.go(-1);</script>");
			} 	
		}
		if ($tipoarquivo == "CSV")header("location: FrExportarRelCSV.php?id=".$_POST['id']."");
		if ($tipoarquivo == "XML")header("location: FrExportarRelXML.php?id=".$_POST['id']."");
		if ($tipoarquivo == "PDF")header("location: FrExportarRelPDF.php?id=".$_POST['id']."&tipoarquivo=$tipoarquivo&estilo=$estilo&fonte=$fonte&folha=$folha&tam=$tam&top=$top&dir=$dir&esq=$esq");
		if ($tipoarquivo == "PHP")header("location: FrExportarRelPHP.php?id=".$_POST['id']."");
		
	}
}
?>