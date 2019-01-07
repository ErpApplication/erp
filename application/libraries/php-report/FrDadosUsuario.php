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
	include("idiomas/DadosUsuario/".$_SESSION["Idioma"].".php");
	include("classes/Class_Layout.php");
	Layout::AcessoPagina("DadosUsuario");
	include("classes/Class_Conexao.php");
	include("classes/Class_DadosUsuario.php");
	
	if (isset($_POST["Cadastrar"])) DadosUsuario::EditDadosUsuario();
	$vetor = DadosUsuario::ExibeDados();
	
Layout::Cabecalho(); ?>
<table width="50%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-preferencias.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_TITULO;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td  class="mensagem"> &nbsp;&nbsp;&nbsp;&nbsp; <? if (isset($_GET['msg'])) print $_GET['msg'];?>
	  	</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="50%">
<form name="form1" method="post" action="<?=$PHP_SELF;?>">
<input name="cod" type="hidden" value="<?=$cod;?>">
<? if ($vetor[0]=="GOD") print "<input name=\"UsuNome\" type=\"hidden\" value=\"GOD\">"; ?>
<table border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td align="right"><?=_NOME;?></td>
    <td width="6">&nbsp;</td>
    <td><input name="UsuNome" type="text" id="UsuNome" value="<? print $vetor[0]; ?>" <? if ($vetor[0]=="GOD") print " disabled"; ?>></td>
  </tr>
  <tr>
    <td align="right"><?=_EMAIL;?></td>
    <td>&nbsp;</td>
    <td><input name="UsuEmail" type="text" id="UsuEmail" value="<? print $vetor[1]; ?>" size="30"></td>
  </tr>
  <tr>
    <td align="right"><?=_USUARIO;?></td>
    <td>&nbsp;</td>
    <td><input name="UsuUsuario" type="text" id="UsuUsuario" value="<? print $vetor[2]; ?>"></td>
  </tr>
  <tr>
    <td align="right"><?=_SENHA;?></td>
    <td>&nbsp;</td>
    <td><input name="UsuSenha" type="password" id="UsuSenha" size="15" maxlength="8">  
    <?=_DE6A8CARACTERES;?> </td>
  </tr>
  <tr>
    <td align="right"><?=_REPSENHA;?></td>
    <td>&nbsp;</td>
    <td><input name="UsuRepSenha" type="password" id="UsuRepSenha" size="15" maxlength="8"></td>
  </tr>
  <tr>
    <td align="right"><?=_IDIOMA;?></td>
    <td>&nbsp;</td>
    <td><select name="UsuIdioma" id="UsuIdioma">
      <option value=""><?=_PADRAO;?></option>
<? DadosUsuario::ListaIdiomas($vetor[3]); ?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center">
    <input name="Cadastrar" type="submit" id="Cadastrar" value="<?=_CONFIRMAR;?>" class="botao_conf">
    </td>
  </tr>
</table>
</form>
		</td>
		<td valign="top" align="center" width="50%">&nbsp; </td>
	</tr>
</table>
<? Layout::Rodape(); ?>