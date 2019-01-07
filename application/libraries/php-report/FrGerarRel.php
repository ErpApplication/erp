<? 
/***********************************************************************************/
/*                                 PHP Report                                      */
/*                                                                                 */
/* Copyright (c) 2005 by Daniela Toniolo, Leonardo Galvão and Marli Carneiro       */
/*                                                                                 */
/* This is a free software. You can redistribute it and/or modify it under the     */
/* terms of the GNU General Public License.                                        */
/***********************************************************************************/

	session_cache_limiter('public');
	
	session_start();
	include("classes/Class_Config.php");
	include("classes/Class_Layout.php");
	Layout::AcessoPagina("GerarRel");
	include("idiomas/GerarRel/".$_SESSION["Idioma"].".php");	
	include("classes/Class_Conexao.php");
	include("classes/Class_Query.php");
	include("classes/Class_Usuario.php");
	include("classes/Class_GerarRel.php");

Layout::Cabecalho();
?>
<table width="600"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-gerar-rel.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_PASSO0;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<form name="form1" method="post" action="">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td>&nbsp;</td>
  	<td><input name="relatorio" type="radio" value="novo" checked onFocus="CriarRel('novo')">
  		<?=_EMBRANCO;?></td>
  	</tr>
  <tr>
  	<td>&nbsp;</td>
  	<td><?=_BASEDADOS;?> :
  	  <select name="db" id="db">
<? GerarRel::ListarDb(); ?>
      </select></td>
  	</tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  	<td width="60">&nbsp;</td>
  	<td><input name="relatorio" type="radio" value="duplicar" onFocus="CriarRel('duplicar')"> 
  		<?=_DUPLICAR;?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?=_RELATORIO;?> : 
      <select name="duplicar" id="duplicar" disabled>
	  <? GerarRel::ListarRelatorios(); ?>
      </select></td>
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
    <td>&nbsp;</td>
    <td><input type="button" onClick="javascript:EnviarForm('FrGerarRel1.php',document.form1);" value="<?=_AVANCAR;?>" class="botao_avanc"> </td>
  </tr>
</table>
</form>
<? Layout::Rodape(); ?>