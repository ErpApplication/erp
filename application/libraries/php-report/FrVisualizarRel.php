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
	Layout::AcessoPagina("Visualizar");
	include("idiomas/Visualizar/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_Query.php");
	include("classes/Class_GerarRel.php");
	include("classes/Class_SalvarRel.php");
	include("classes/Class_Relatorio.php");
	include("classes/Class_VisualizarRel.php");

	if (isset($_POST['Salvar'])) {
		SalvarRel::Salvar();
	} else {
		if(!isset($_GET['ver']) && !isset($_GET['id'])) header("Location: FrRelatorio.php");
	}

Layout::Cabecalho();
?>
<table width="50%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="5">&nbsp;</td>
		<td width="55"><img src="imagens/titulo-relatorios.gif" width="55" height="55"></td>
		<td background="imagens/titulo-meio.gif" class="titulo">&nbsp;&nbsp;<?=_TITULO;?></td>
		<td width="5"><img src="imagens/titulo-dir.gif" width="5" height="55"></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2"><strong><? if(isset($_GET['ver'])) echo _MSGPREVISUALIZAR ; ?>&nbsp;</strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
			<table width="50%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<? if(isset($_GET['ver'])) {?>
					<form name="form1" method="post" action="">
					<input name="Salvar" type="hidden" value="">
					<input name="ColunasLargura" type="hidden" value="">
					<input name="ColunasLarguraTotal" type="hidden" value="">
					<? GerarRel::PegarPassos(0); ?>
					<td align="center"><a href="#" onClick="javascript:EnviarFormVisualiza(0);"><img src="imagens/editar.jpg" width="50" height="50" border="0" align="absmiddle"><br><?=_MODOEDICAO;?></a></td>
					<td align="center"><a href="#" onClick="javascript:EnviarFormVisualiza(1);"><img src="imagens/salvar.jpg" width="50" height="50" border="0" align="absmiddle"><br><?=_SALVAR;?></a></td>
					</form>
				<? } else { ?>
					<td align="center"><a href="#" onclick="Relatorio(<?=$_GET['id'];?>);"><img src="imagens/visualizar.jpg" width="50" height="50" border="0" align="absmiddle"><br><?=_VISUALIZAR;?></a></td>
					<?
					$edita = 0; 
					if($_SESSION["TipoUsu"]==2){
						$conecta = Conexao::Conecta();
						$query = "SELECT a.BASNOME FROM PHPREP_DBACESSO a INNER JOIN PHPREP_RELATORIO r ON (r.RELBASE=a.BASNOME) WHERE a.USUCODIGO=".$_SESSION["CodUsu"]." AND r.RELCODIGO=".$_GET['id'];
						$result = $conecta->query($query); 
						if (MDB2::isError($result)) die ($result->getMessage()); 
						$rows = $result->numRows(); 
						if ($rows>0) $edita = 1; 
					} else if ($_SESSION["TipoUsu"]==1) $edita = 1; 
					
					if ($edita == 1){
					?>
					<td align="center"><a href="FrGerarRel1.php?id=<?=$_GET['id'];?>"><img src="imagens/editar.jpg" width="50" height="50" border="0" align="absmiddle"><br><?=_EDITAR;?></a></td>
					<td align="center"><a href="#" onclick="javascript:EnviarConf('FrRelatorio.php?del=<?=$_GET['id'];?>','<?=_EXCLUIRCONF?>');"><img src="imagens/deletar.jpg" width="50" height="50" border="0" align="absmiddle"><br><?=_EXCLUIR;?></a></td>
					<? } ?>
					<td align="center"><a href="FrExportarRel.php?id=<?=$_GET['id'];?>"><img src="imagens/exportar.jpg" width="50" height="50" border="0" align="absmiddle"><br><?=_EXPORTAR;?></a></td>
				<? } ?>
				</tr>
</table><br>
<br>
<?
if(isset($_GET['ver'])){ 
	VisualizarRel::Visualizar($_GET['id']);
} else {
	VisualizarRel::DadosRel($_GET['id']);
	echo "<script>Relatorio(".$_GET['id'].");</script>";
}
Layout::Rodape();
if(isset($_GET['ver']) && !isset($_GET['pagina'])) print"<script>alert('"._AVISO."');</script>";
?>