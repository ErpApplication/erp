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
	Layout::AcessoPagina("GrupoRel");
	include("idiomas/GrupoRel/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_GrupoRelatorio.php");
	
	
	if (isset($_POST['Cadastrar'])) {
		GrupoRel::CadGrupoRel();
	} 
	
	if (isset($_POST['Listar'])) {
		$vetor = GrupoRel::ListGrupoRel();
	} 	
	
	if (isset($_POST['Editar'])) {
		GrupoRel::EditGrupoRel();
	} 	

	if (isset($_GET['excl'])) {
		GrupoRel::VerifRel();
	} 

Layout::Cabecalho(); ?>
<table width="50%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-grupos.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_TITULO;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td class="mensagem">&nbsp;&nbsp;&nbsp;&nbsp;<strong><? if (isset($_GET['msg'])) print $_GET['msg'];?></strong> </td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="50%">
<form name="form1" method="post" action="FrGrupoRel.php">
  <p>
    <input name="cod" type="hidden" value="<?=$_POST['cod'];?>">
    <input name="nivel" type="hidden" value="<?=$vetor[2];?>">
  </p>
  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="right"><?=_NOME;?></div></td>
      <td width="10">&nbsp;</td>
      <td><input name="GruRelNome" type="text" id="GruRelNome" value="<? if (isset($_POST['Listar'])) print $vetor[0];?>" size="20" maxlength="20"></td>
    </tr>
    <tr>
      <td><div align="right"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right"><?=_DESCRICAO;?></div></td>
      <td>&nbsp;</td>
      <td>        <textarea name="GruRelDescricao" cols="50" rows="6" id="GruRelDescricao"><? if (isset($_POST['Listar']))print $vetor[1];?></textarea></td>
    </tr>
<? if (!isset($_POST['Listar'])) {?>
    <tr>
      <td><div align="right"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right"><?=_NIVEL;?></div></td>
      <td>&nbsp;</td>
      <td><select name="GruRelNivel" id="GruRelNivel" class="combo">
	  <option value="0" selected>/</option>
<?	print GrupoRel::CaixaGrupos(null); ?>
	  	      </select></td>
    </tr>
<? } ?>
    <tr>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	</tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center">
<? if(isset($_POST['Listar'])) {?> 
    <input name="Editar" type="submit" id="Editar" value="<?=_CONFIRMAR;?>" class="botao_conf">
&nbsp;&nbsp;&nbsp;
  <input name="Excluir" type="button" id="Excluir" value="<?=_EXCLUIR;?>" class="botao_excl" onClick="javascript:EnviarFormConf('FrGrupoRel.php?excl=1',document.form1,'<?=_CONFIRMAEXCL?>');">
&nbsp;&nbsp;&nbsp;
  <input name="Cancelar" type="button" id="Cancelar" value="<?=_CANCELAR;?>" class="botao_cancel" onClick="window.open('FrGrupoRel.php','_self')">
    <? } else { ?>
    <input name="Cadastrar" type="submit" id="Cadastrar" value="<?=_CADASTRAR;?>" class="botao_cad">
    <? } ?>
      </td>
    </tr>
  </table>
</form>		</td>
		<td valign="top" align="center" width="50%">
 <form name="form2" method="post" action="FrGrupoRel.php">
<table width="255"  border="0" cellspacing="1" cellpadding="0" bgcolor="#999999">
    <tr>
      <td height="24" background="imagens/subtitulo.gif" bgcolor="#F2F2F2" class="subtitulo">&nbsp;&nbsp;<?=_GRUCADASTRADOS;?></td>
    </tr> 
	<tr>
		<td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td>
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td>&nbsp;</td>
    	</tr>
    <tr>
      <td><select name="cod" id="cod">
        <option value="null" selected>
        <?=_SELECIONE;?>
        </option>
        <?	print GrupoRel::CaixaGrupos(null); ?>
                  </select></td>
      </tr>
    <tr>
    	<td>&nbsp;</td>
    	</tr>
    <tr>
    	<td align="center"><input name="Listar" type="submit" id="Listar" value="<?=_EDITAR;?>" class="botao_edi"> 
&nbsp;&nbsp;
<input name="Excluir" type="button" id="Excluir" onClick="javascript:EnviarFormConf('FrGrupoRel.php?excl=1',document.form2,'<?=_CONFIRMAEXCL?>');" value="<?=_EXCLUIR;?>" class="botao_excl"></td>
    	</tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input name="Ver" type="button" id="Ver" value="<?=_VER;?>" class="botao_pesq" onClick="javascript:Lista('ListaGrupo');"></td>
    </tr>
  </table>
</td>
  </tr>
</table>
		</td>
	</tr>
</table>
</form>
		</td>
	</tr>
</table>
<? Layout::Rodape(); ?>
