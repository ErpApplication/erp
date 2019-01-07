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

GerarRel::GuiaPasso(4);
?>
<table width="600"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-gerar-rel.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_PASSO4;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2"><strong><?=_DESCRICAO4;?></strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<form name="form1" method="post" action="">
<?
GerarRel::PegarPassos(4);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<? GerarRel::ListarCores4(); ?>
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
  	<td>&nbsp;</td>
	</tr>
  <tr>
  	<td width="60" align="center">&nbsp;</td>
    <td>
 	  <input type="button" onClick="javascript:EnviarForm('FrGerarRel3.php',document.form1);" value="<?=_VOLTAR;?>" class="botao_volt">&nbsp;&nbsp;&nbsp;
	  <input type="button" onClick="javascript:EnviarForm('FrGerarRel11.php',document.form1);" value="<?=_FINALIZAR;?>" class="botao_conf">&nbsp;&nbsp;&nbsp;
      <input type="button" onClick="javascript:EnviarForm('FrGerarRel5.php',document.form1);" value="<?=_AVANCAR;?>" class="botao_avanc"> </td>
  </tr>
</table>
</form>
<? Layout::Rodape(); ?>