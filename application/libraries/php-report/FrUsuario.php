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
	Layout::AcessoPagina("Usuario");
	include("idiomas/Usuario/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_Query.php");
	include("classes/Class_Usuario.php");
	
	if (isset($_POST['Cadastrar'])) {
		Usuario::CadUsuario();
	} 
	
	if (isset($_POST['Listar'])) {
		$vetor = Usuario::ListaUsuarios();
	} 	
	
	if (isset($_POST['Editar'])) {
		Usuario::EditUsuario();
	} 	

	if (isset($_GET['excl'])) {
		Usuario::ExcUsuario();
	} 

Layout::Cabecalho(); 
?>
<body onLoad="javascript:VerificaUsuario();">
<table width="50%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-usuarios.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_TITULO;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td class="mensagem">&nbsp;&nbsp;&nbsp;&nbsp; <? if (isset($_GET['msg'])) print $_GET['msg'];?>
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
<form name="form1" method="post" action="FrUsuario.php">
<input name="cod" type="hidden" value="<?=$_POST['cod'];?>">
<table border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td align="right"><?=_NOME;?>
     </td>
    <td width="6">&nbsp;</td>
    <td><input name="UsuNome" type="text" id="UsuNome" value="<? if (isset($_POST['Listar'])) print $vetor[0];?>" size="30" maxlength="40">   </td>
  </tr>
  <tr>
    <td align="right"><?=_EMAIL;?>
      </td>
    <td>&nbsp;</td>
    <td><input name="UsuEmail" type="text" id="UsuEmail" value="<? if (isset($_POST['Listar'])) print $vetor[1];?>" size="30" maxlength="50"></td>
  </tr>
  <tr>
    <td align="right"><?=_USUARIO;?> </td>
    <td>&nbsp;</td>
    <td><input name="UsuUsuario" type="text" id="UsuUsuario" value="<? if (isset($_POST['Listar'])) print $vetor[2];?>" size="15" maxlength="15"></td>
  </tr>
  <tr>
    <td align="right"><? if(isset($_POST['Listar'])) print ""._TROCARSENHA; else print ""._SENHA;?>
	 </td>
    <td>&nbsp;</td>
    <td><input name="UsuSenha" type="password" id="UsuSenha" size="15" maxlength="8"> 
     <?=_DE6A8CARACTERES;?></td>
  </tr>
  <tr>
    <td align="right"><?=_REPSENHA;?>
      </td>
    <td>&nbsp;</td>
    <td><input name="UsuRepSenha" type="password" id="UsuRepSenha" size="15" maxlength="8"></td>
  </tr>
  <tr>
    <td align="right"><?=_TIPO;?>
     </td>
    <td>&nbsp;</td>
    <td><select name="UsuTipo" id="UsuTipo" onChange="VerificaUsuario();">
      <option value="null">
      <?=_SELECIONE;?>
      </option>
      <option value="1"<? if ((isset($_POST['Listar']))&&($vetor[3]==1)) print " selected";?>><?=_ADMINISTRADOR;?></option>
      <option value="2"<? if ((isset($_POST['Listar']))&&($vetor[3]==2)) print " selected";?>><?=_ELABORADOR;?></option>
      <option value="3"<? if ((isset($_POST['Listar']))&&($vetor[3]==3)) print " selected";?>><?=_VISUALIZADOR;?></option>
    </select></td>
  </tr>
  <tr>
    <td align="right"> <?=_BASEDADOS;?>
      </td>
    <td>&nbsp;</td>
    <td><select name="UsuBaseDados[]" size="4" multiple
	 <? if(isset($_POST['Listar'])){
			if ($vetor[3] != 2) print " disabled";
			} else print " disabled";
	 ?> class="usu">
      <?
		$txt = new Usuario;
		print $txt->ListarDb($_POST['cod']);
		?>
    </select>
    	*</td>
  </tr>
  <tr>
    <td align="right"><?=_GRUPORELATORIO;?>
      </td>
    <td>&nbsp;</td>
    <td><select name="UsuGrupoRel[]" size="4" multiple
	<? if(isset($_POST['Listar'])){
			if ($vetor[3] != 3) print " disabled";
			} else print " disabled";
	 ?> class="usu">
      <?
	$txt = new Usuario;
	print $txt->CaixaGrupos($_POST['cod']);
?>
    </select>
    	*</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>[ <a href="#" onClick="javascript:Lista('ListaGrupo');"><?=_VERDESCRICAO;?></a> ]</td>
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
<input name="Excluir" type="button" id="Excluir"  value="<?=_EXCLUIR;?>" class="botao_excl" onClick="javascript:EnviarFormConf('FrUsuario.php?excl=1',document.form1,'<?=_CONFIRMAEXCL;?>');">
&nbsp;&nbsp;&nbsp;
<input name="Cancelar" type="button" id="Cancelar" value="<?=_CANCELAR;?>" class="botao_cancel" onClick="window.open('FrUsuario.php','_self')">
<? } else { ?>
<input name="Cadastrar" type="submit" id="Cadastrar" value="<?=_CADASTRAR;?>" class="botao_cad">
<? } ?>
</td>
  </tr>
  <tr>
  	<td colspan="3">&nbsp;</td>
  	</tr>
  <tr>
  	<td colspan="3">* <?=_CTRL;?></td>
  	</tr>
</table>
</form>
		</td>
		<td valign="top" align="center" width="50%">
 <form name="form2" method="post" action="FrUsuario.php">
<table width="255"  border="0" cellspacing="1" cellpadding="0" bgcolor="#999999">
    <tr>
      <td height="24" background="imagens/subtitulo.gif" bgcolor="#F2F2F2" class="subtitulo">
       &nbsp;&nbsp; <?=_TITULO2;?>
     </td>
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
      <td>
         <select name="cod" id="cod">
		 <option value="null"><?=_SELECIONE;?></option>
          <? print Usuario::CaixaUsuarios(); ?>
      </select></td>
      </tr>
    <tr>
    	<td>&nbsp;</td>
    	</tr>
    <tr>
    	<td align="center"><input name="Listar" type="submit" id="Listar" value="<?=_EDITAR;?>" class="botao_edi"> 
&nbsp;&nbsp;
<input name="Excluir" type="button" id="Excluir" value="<?=_EXCLUIR;?>" class="botao_excl" onClick="javascript:EnviarFormConf('FrUsuario.php?excl=1',document.form2,'<?=_CONFIRMAEXCL;?>');"></td>
    	</tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
		  <td align="center"><input name="Ver" type="button" id="Ver" value="<?=_VER;?>" class="botao_pesq" onClick="javascript:Lista('ListaUsuario');"></td>
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