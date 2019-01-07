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
	include("classes/Class_SalvarRel.php");

Layout::Cabecalho("GerarRel");
?>

<table width="600"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-gerar-rel.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_TITULO2;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
  </tr>
</table>
<form name="form1" method="post" action="FrVisualizarRel.php">
<? GerarRel::PegarPassos(0); ?>
  <table width="277"  border="0" cellspacing="2" cellpadding="0">
    <tr>
    	<td align="right"><?=_NOME;?></td>
    	<td width="10">&nbsp;</td>
    	<td><input name="RelNome" type="text" id="RelNome" size="30" maxlength="40"<?
		 if ($_POST["id"]!="null") {
		 	echo " value=\"".SalvarRel::NomeRel($_POST["id"])."\"";
		}
		 ?>></td>
   	</tr>
    <tr>
      <td align="right"><?=_GRUPO;?></td>
      <td>&nbsp;</td>
      <td><select name="GrupoRel" id="GrupoRel">
          <option value="null"><?=_SELECIONE;?></option><? SalvarRel::CaixaGrupos($_POST["id"]); ?></select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>[ <a href="#" onClick="javascript:Lista('ListaGrupo');"><?=_VERDESCRICAO;?></a> ]</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center">
          <input type="button" class="botao_volt" onClick="javascript:EnviarForm('FrGerarRel11.php',document.form1);" value="<?=_VOLTAR;?>">
&nbsp;&nbsp;
      <input name="Salvar" type="submit" class="botao_cad" value="<?=_SALVAR;?>"></td>
    </tr>
  </table>
</form>
<? Layout::Rodape(); ?>