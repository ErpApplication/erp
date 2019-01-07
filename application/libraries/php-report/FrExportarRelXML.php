<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

	header('Content-type: applicattion/xml');
	header('Expires: 0');
	header('Content-Disposition: inline; filename=Arquivo.xml');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	
	session_start();
	include("classes/Class_Config.php");
	include("classes/Class_Layout.php");
	Layout::AcessoPagina("Visualizar");
	include("idiomas/Exportar/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_XML.php");
	include("classes/Class_VisualizarRel.php");

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>";
	print"<RELATORIO>";
	ExportarRelXML::VisualizarSalvo($_GET["id"]);
	print"</RELATORIO>";
?>