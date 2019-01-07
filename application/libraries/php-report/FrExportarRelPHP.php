<?
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

	header('Content-type: text/plain');
	header('Expires: 0');
	header('Content-Disposition: inline; filename=Arquivo.txt');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	
	session_start();
	include("classes/Class_Config.php");
	include("classes/Class_Layout.php");
	Layout::AcessoPagina("Visualizar");
	include("idiomas/Visualizar/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_VisualizarRel.php");
	include("classes/Class_PHP.php");
	
	ExportarRelPHP::VisualizarSalvo($_GET['id']);
?>