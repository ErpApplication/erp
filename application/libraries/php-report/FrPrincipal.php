<? 
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

	session_start();
	include("classes/Class_Config.php");
	include("classes/Class_Layout.php");
	Layout::AcessoPagina("Principal");
	include("idiomas/Principal/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_Autenticacao.php");
	

Layout::Cabecalho();
?>

<table width="600"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5">&nbsp;</td>
    <td width="55"><img src="imagens/titulo-relatorios.gif" width="55" height="55"></td>
    <td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;
        <?=_TITULO;?></td>
    <td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><?=_MSG;?></td>
  </tr>
</table>
<br>
<br>
<br>
<? Layout::Rodape(); ?>
