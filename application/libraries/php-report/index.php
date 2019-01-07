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
	if(isset($_SESSION["login"])) header("Location: FrPrincipal.php");
	include("classes/Class_Layout.php");
	$idioma = Layout::PegarIdioma();
	include("idiomas/Autenticacao/".$idioma.".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_Autenticacao.php");
	
	// Logout
	if (isset($_GET["op"]))
	{
		Autenticacao::logout($_GET["op"]);
	}
	
	//Login
	if (isset($_POST['Entrar']))
	{ 
		Autenticacao::VerificaUsu();
	}
	
	Layout::Cabecalho();
?>

<table width="50%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5">&nbsp;</td>
    <td width="55"><img src="imagens/titulo-usuarios.gif" width="55" height="55"></td>
    <td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_TITULO;?></td>
    <td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<table width="50%" border="0">
		  <tr>
			<td width="50%">
			  <form name="form1" method="post" action="index.php">
			  <table border="0" align="center" cellpadding="0" cellspacing="5">
				<tr>
				  <td align="right"><?=_USUARIO;?></td>
				  <td width="6">&nbsp;</td>
				  <td><input name="UsuUsuario" type="text" id="UsuUsuario" size="20" maxlength="15"></td>
				</tr>
				<tr>
				  <td align="right"><?=_SENHA;?></td>
				  <td>&nbsp;</td>
				  <td><input name="UsuSenha" type="password" id="UsuSenha" size="20" maxlength="15"></td>
				</tr>
				<tr>
				  <td colspan="3">&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="3" align="center"><input name="Entrar" type="submit" id="Entrar" value="<?=_ENTRAR;?>" class="botao_avanc"></td>
				</tr>
			  </table>
			  </form>
			</td>
		  </tr>
		</table>
<br>
<? Layout::Rodape(); ?>