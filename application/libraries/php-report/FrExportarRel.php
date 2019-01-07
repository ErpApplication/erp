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
	Layout::AcessoPagina("ExportarRel");
	include("idiomas/Exportar/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_ExportarRel.php");
	include("classes/Class_VisualizarRel.php");

	if (isset($_POST['Exportar'])) {
		ExportarRel::VerificaCampos();

	}

Layout::Cabecalho(); ?>
<body onLoad="ExpHabilita();">
<table width="50%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-relatorios.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_TITULO;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
</table>
<? $id = $_GET['id']; ?>
<form name="form1" method="post" action="<?=$PHP_SELF?>">
  <table width="50%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div align="right">
              <?=_TIPOARQUIVO;?>
          </div></td>
          <td width="6">&nbsp;</td>
          <td>
            <select name="tipoarquivo" id="tipoarquivo" onChange="ExpHabilita();">
              <option selected value="null">
              <?=_SELECIONE;?>
              </option>
              <option value="CSV">CSV</option>
              <option value="PDF">PDF</option>
              <option value="XML">XML</option>
              <option value="PHP">PHP</option>
            </select>
            <input type="hidden" name="id" value="<? echo"$id"; ?>"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td><div align="right">
              <?=_PAPEL;?>
          </div></td>
          <td align="center">&nbsp;</td>
          <td align="center"><div align="left">
              <select name="folha" id="folha" disabled>
                <option value="null">
                <?=_SELECIONE;?>
                </option>
                <option value="A3">A3</option>
                <option value="A4">A4</option>
                <option value="A5">A5</option>
                <option value="letter">letter</option>
                <option value="legal">legal</option>
              </select>
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>
            <div align="right">
              <?=_ORIENTACAO;?>
          </div></td>
          <td align="center">&nbsp;</td>
          <td align="center"><div align="left">
              <select name="estilo" id="estilo" disabled>
                <option selected value="null">
                <?=_SELECIONE;?>
                </option>
                <option value="P"><?=_RETRATO;?></option>
                <option value="L"><?=_PAISAGEM?></option>
              </select>
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td><div align="right">
              <?=_FONTE;?>
          </div></td>
          <td align="center">&nbsp;</td>
          <td align="center"><div align="left">
              <select name="fonte" id="fonte" disabled>
                <option selected value="null">
                <?=_SELECIONE;?>
                </option>
                <option value="arial">Arial</option>
                <option value="Courier">Courier</option>
                <option value="Helvetica">Helvetica</option>
                <option value="times">Times</option>
              </select>
&nbsp;
        <?=_TAMANHO;?>
&nbsp;
        <input name="tam" type="text" id="tam" size="3" maxlength="2" onKeyPress="return sonumero(event);" disabled>
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td><div align="right">
              <?=_MARGENS;?>
          </div></td>
          <td align="center">&nbsp;</td>
          <td align="center"><div align="left">&nbsp;
                  <?=_TOP;?>
                  <input name="top" type="text" id="top" size="2" maxlength="2" value="25" onKeyPress="return sonumero(event);" disabled>
&nbsp;&nbsp;
        <?=_DIR;?>
        <input name="dir" type="text" id="dir" size="2" maxlength="2" value="25" onKeyPress="return sonumero(event);" disabled>
&nbsp;
        <?=_ESQ;?>
        <input name="esq" type="text" id="esq" size="2" maxlength="2" value="25" onKeyPress="return sonumero(event);" disabled>
          </div></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="center"><input name="Exportar" type="Submit" class="botao_cad" id="Exportar" value="<?=_EXPORTAR;?>">
&nbsp;&nbsp;
      <input name="Cancelar" type="button" class="botao_cancel" id="Cancelar" onClick="javascript:EnviarForm('javascript:history.back()',document.form1);" value="<?=_CANCELAR;?>"></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
<p><br>
<? Layout::Rodape(); ?>
</p>
<p>&nbsp;</p>