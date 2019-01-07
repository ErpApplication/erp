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

GerarRel::GuiaPasso(10);
?>
<table width="600"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-gerar-rel.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_PASSO10;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2"><strong><?=_DESCRICAO10;?></strong></td>
  </tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<form name="form1" method="post" action="">
<?
GerarRel::PegarPassos(10);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td align="center">&nbsp;</td>
  	<td>
<? GerarRel::Templates10(); ?>
	</td>
 	</tr>
  <tr>
  	<td align="center">&nbsp;</td>
  	<td>&nbsp;</td>
  	</tr>
  <tr>
  	<td align="center">&nbsp;</td>
  	<td>&nbsp;</td>
 	</tr>
  <tr>
  	<td width="60" align="center">&nbsp;</td>
    <td>
      <input name="button" type="button" class="botao_volt" onClick="javascript:EnviarForm('FrGerarRel9.php',document.form1);" value="<?=_VOLTAR;?>">
      &nbsp;&nbsp;&nbsp;
      <input name="button" type="button" class="botao_conf" onClick="javascript:EnviarForm('FrGerarRel11.php',document.form1);" value="<?=_FINALIZAR;?>">
</td>
  </tr>
</table>
</form>
<? Layout::Rodape(); ?>