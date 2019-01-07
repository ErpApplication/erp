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

GerarRel::JSPreencheCampos();

GerarRel::GuiaPasso(11);
?>
<table width="600"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-gerar-rel.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_PASSO11;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2"><strong><?=_DESCRICAO11;?></strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<form name="form1" method="post" action="">
<?
$qtd_campos = GerarRel::QtdLinhas(11);
GerarRel::PegarPassos(11);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td align="center">&nbsp;</td>
  	<td>
<?
GerarRel::ListarRelacionamento11($qtd_campos);
?>
	</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  	<td>&nbsp;</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  	<td>&nbsp;</td>
  </tr>
<?
$relacionam_tabelas = GerarRel::TabelasUsadas();
if (($qtd_campos < 30)&&(count($relacionam_tabelas)>1)) {?>
  <tr>
  	<td align="center">&nbsp;</td>
  	<td><table width="268" border="0" cellpadding="0" cellspacing="0">
    	<tr>
    		<td><div align="center"><?=_ADICIONAR;?></div></td>
    		<td><div align="center">
    			<input name="adi_campos11" type="text" class="texto" onKeyPress="return sonumero(event);" size="2" maxlength="1">
    			</div></td>
    		<td><div align="center"><?=_RELACIONAMTOS;?></div></td>
    		<td><div align="center">
    			<input type="submit" name="envia_campos11" value="<?=_OK;?>" class="botao_ok">
    			</div></td>
    		</tr>
    	</table></td>
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
  	<td align="center">&nbsp;</td>
  	<td>&nbsp;</td>
 	</tr>
<? } ?>
  <tr>
  	<td>&nbsp;</td>
  	<td>&nbsp;</td>
  </tr>
  <tr>
  	<td width="60" align="center">&nbsp;</td>
    <td>
 	  <input type="button" onClick="javascript:EnviarForm('FrGerarRel10.php?volta=1',document.form1);" value="<?=_VOLTAR;?>" class="botao_volt">&nbsp;&nbsp;&nbsp;
	  <input type="button" onClick="javascript:EnviarForm('FrVisualizarRel.php?ver=1',document.form1);" value="<?=_VISUALIZAR;?>" class="botao_pesq">&nbsp;&nbsp;&nbsp;
      <input type="button" onClick="javascript:EnviarForm('FrGerarRelSalvar.php',document.form1);" value="<?=_CONCLUIR;?>" class="botao_cad"> </td>
  </tr>
</table>
</form>
<? Layout::Rodape(); ?>