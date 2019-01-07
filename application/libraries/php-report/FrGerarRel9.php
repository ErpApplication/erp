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

GerarRel::GuiaPasso(9);
?><head>
<script language="Javascript1.2"><!-- // load htmlarea
_editor_url = "estilo/editor/";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// --></script>
</head>

<table width="600"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-gerar-rel.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_PASSO9;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2"><strong><?=_DESCRICAO9;?></strong></td>
  </tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<form name="form1" method="post" action="">
<?
GerarRel::PegarPassos(9);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td align="center">&nbsp;</td>
  	<td>
<? GerarRel::CabecalhoRodape9(); ?>
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
 	  <input type="button" onClick="javascript:EnviarForm('FrGerarRel8.php',document.form1);" value="<?=_VOLTAR;?>" class="botao_volt">&nbsp;&nbsp;&nbsp;
	  <input type="button" onClick="javascript:EnviarForm('FrGerarRel11.php',document.form1);" value="<?=_FINALIZAR;?>" class="botao_conf">&nbsp;&nbsp;&nbsp;
      <input type="button" onClick="javascript:EnviarForm('FrGerarRel10.php',document.form1);" value="<?=_AVANCAR;?>" class="botao_avanc"> </td>
  </tr>
</table>
</form>
<script language="javascript1.2">
editor_generate("cabecalho");
editor_generate("rodape");
</script>
<? Layout::Rodape(); ?>