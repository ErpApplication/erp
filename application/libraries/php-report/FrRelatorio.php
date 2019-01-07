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
	Layout::AcessoPagina("Relatorio");
	if(isset($_GET["del"])) Layout::AcessoPagina("GerarRel");
	include("idiomas/Relatorio/".$_SESSION["Idioma"].".php");
	include("classes/Class_Conexao.php");
	include("classes/Class_Query.php");
	include("classes/Class_Relatorio.php");
	include("classes/Class_GrupoRelatorio.php");
	include("classes/Class_Usuario.php");
	
	if(isset($_GET["del"])){
		include("classes/Class_SalvarRel.php");
		SalvarRel::DeletarRel($_GET["del"]);
	}

Layout::Cabecalho(); ?>
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
	  <td class="mensagem">&nbsp;&nbsp;&nbsp;&nbsp;<strong><? if (isset($_GET['msg'])) print $_GET['msg'];?></strong></td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="50%">
<? Relatorio::ListRelatorio(); ?>
	</td>
		<td valign="top" align="center" width="50%">
 <form name="form2" method="post" action="FrRelatorio.php">
<table width="255"  border="0" cellspacing="1" cellpadding="0" bgcolor="#999999">
    <tr>
      <td height="24" background="imagens/subtitulo.gif" bgcolor="#F2F2F2" class="subtitulo">&nbsp;&nbsp;<?=_BUSCARREL;?></td>
    </tr> 
	<tr>
		<td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td>
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="2">&nbsp;</td>
    	</tr>
    <tr>
      <td colspan="2"><?=_GRUPO;?></td>
    </tr>
    <tr>
      <td colspan="2">
        <select name="RelGrupo" id="RelGrupo">
		 <option value="null">::<?=_TODOS;?>::</option>
          <?
	if (isset($_POST["RelGrupo"])) $grupo=$_POST["RelGrupo"]; else $grupo=null;
	GrupoRel::CaixaGrupos($grupo);
?>
      </select></td>
      </tr>
	      <tr>
	        <td colspan="2">[ <a href="#" onClick="javascript:Lista('ListaGrupo');"><?=_VERDESCRICAO;?></a> ]</td>
	        </tr>
	      <tr>
	      	<td colspan="2">&nbsp;</td>
      	</tr>
	      <tr>
      <td colspan="2"><?=_USUMODIFICACAO;?></td>
    </tr>
    <tr>
      <td colspan="2">
        <select name="RelUsuario" id="RelUsuario">
		 <option value="null">::<?=_TODOS;?>::</option>
          <?
	if (isset($_POST["RelUsuario"])) $usuario=$_POST["RelUsuario"]; else $usuario=null;
	Relatorio::CaixaUsuarios($usuario);
?>
      </select></td>
      </tr>
	  	      <tr>
	  	      	<td colspan="2">&nbsp;</td>
  	      	</tr>
	  	      <tr>
      <td colspan="2"><?=_DATAMODIFICACAO;?></td>
    </tr>
<?
if (isset($_POST["dia1"])) $dia1=$_POST["dia1"]; else $dia1="null";
if (isset($_POST["mes1"])) $mes1=$_POST["mes1"]; else $mes1="null";
if (isset($_POST["ano1"])) $ano1=$_POST["ano1"]; else $ano1=strftime("%Y");
if (isset($_POST["dia2"])) $dia2=$_POST["dia2"]; else $dia2="null";
if (isset($_POST["mes2"])) $mes2=$_POST["mes2"]; else $mes2="null";
if (isset($_POST["ano2"])) $ano2=$_POST["ano2"]; else $ano2=strftime("%Y");
?>
    <tr>
      <td width="19%">
        <div align="right"><?=_DE;?>:&nbsp;</div></td>
      <td width="81%"><select name="dia1" class="texto" id="select3">
      	<option value="null">--</option>
      	<option value="01"<? if($dia1=="01") echo " selected";?>>01</option>
      	<option value="02"<? if($dia1=="02") echo " selected";?>>02</option>
      	<option value="03"<? if($dia1=="03") echo " selected";?>>03</option>
      	<option value="04"<? if($dia1=="04") echo " selected";?>>04</option>
      	<option value="05"<? if($dia1=="05") echo " selected";?>>05</option>
      	<option value="06"<? if($dia1=="06") echo " selected";?>>06</option>
      	<option value="07"<? if($dia1=="07") echo " selected";?>>07</option>
      	<option value="08"<? if($dia1=="08") echo " selected";?>>08</option>
      	<option value="09"<? if($dia1=="09") echo " selected";?>>09</option>
      	<option value="10"<? if($dia1=="10") echo " selected";?>>10</option>
      	<option value="11"<? if($dia1=="11") echo " selected";?>>11</option>
      	<option value="12"<? if($dia1=="12") echo " selected";?>>12</option>
      	<option value="13"<? if($dia1=="13") echo " selected";?>>13</option>
      	<option value="14"<? if($dia1=="14") echo " selected";?>>14</option>
      	<option value="15"<? if($dia1=="15") echo " selected";?>>15</option>
      	<option value="16"<? if($dia1=="16") echo " selected";?>>16</option>
      	<option value="17"<? if($dia1=="17") echo " selected";?>>17</option>
      	<option value="18"<? if($dia1=="18") echo " selected";?>>18</option>
      	<option value="19"<? if($dia1=="19") echo " selected";?>>19</option>
      	<option value="20"<? if($dia1=="20") echo " selected";?>>20</option>
      	<option value="21"<? if($dia1=="21") echo " selected";?>>21</option>
      	<option value="22"<? if($dia1=="22") echo " selected";?>>22</option>
      	<option value="23"<? if($dia1=="23") echo " selected";?>>23</option>
      	<option value="24"<? if($dia1=="24") echo " selected";?>>24</option>
      	<option value="25"<? if($dia1=="25") echo " selected";?>>25</option>
      	<option value="26"<? if($dia1=="26") echo " selected";?>>26</option>
      	<option value="27"<? if($dia1=="27") echo " selected";?>>27</option>
      	<option value="28"<? if($dia1=="28") echo " selected";?>>28</option>
      	<option value="29"<? if($dia1=="29") echo " selected";?>>29</option>
      	<option value="30"<? if($dia1=="30") echo " selected";?>>30</option>
      	<option value="31"<? if($dia1=="31") echo " selected";?>>31</option>
      	</select>
/
<select name="mes1" class="texto" id="select4">
	<option value="null">--</option>
	<option value="01"<? if($mes1=="01") echo " selected";?>>01</option>
	<option value="02"<? if($mes1=="02") echo " selected";?>>02</option>
	<option value="03"<? if($mes1=="03") echo " selected";?>>03</option>
	<option value="04"<? if($mes1=="04") echo " selected";?>>04</option>
	<option value="05"<? if($mes1=="05") echo " selected";?>>05</option>
	<option value="06"<? if($mes1=="06") echo " selected";?>>06</option>
	<option value="07"<? if($mes1=="07") echo " selected";?>>07</option>
	<option value="08"<? if($mes1=="08") echo " selected";?>>08</option>
	<option value="09"<? if($mes1=="09") echo " selected";?>>09</option>
	<option value="10"<? if($mes1=="10") echo " selected";?>>10</option>
	<option value="11"<? if($mes1=="11") echo " selected";?>>11</option>
	<option value="12"<? if($mes1=="12") echo " selected";?>>12</option>
</select>
/
<input name="ano1" type="text" class="texto" id="ano1" value="<?=$ano1;?>" size="4" maxlength="4"></td>
    </tr>
    <tr>
    	<td>
    		<div align="right"><?=_ATE;?>:&nbsp;</div></td>
    	<td><select name="dia2" class="texto" id="select5">
      	<option value="null">--</option>
      	<option value="01"<? if($dia2=="01") echo " selected";?>>01</option>
      	<option value="02"<? if($dia2=="02") echo " selected";?>>02</option>
      	<option value="03"<? if($dia2=="03") echo " selected";?>>03</option>
      	<option value="04"<? if($dia2=="04") echo " selected";?>>04</option>
      	<option value="05"<? if($dia2=="05") echo " selected";?>>05</option>
      	<option value="06"<? if($dia2=="06") echo " selected";?>>06</option>
      	<option value="07"<? if($dia2=="07") echo " selected";?>>07</option>
      	<option value="08"<? if($dia2=="08") echo " selected";?>>08</option>
      	<option value="09"<? if($dia2=="09") echo " selected";?>>09</option>
      	<option value="10"<? if($dia2=="10") echo " selected";?>>10</option>
      	<option value="11"<? if($dia2=="11") echo " selected";?>>11</option>
      	<option value="12"<? if($dia2=="12") echo " selected";?>>12</option>
      	<option value="13"<? if($dia2=="13") echo " selected";?>>13</option>
      	<option value="14"<? if($dia2=="14") echo " selected";?>>14</option>
      	<option value="15"<? if($dia2=="15") echo " selected";?>>15</option>
      	<option value="16"<? if($dia2=="16") echo " selected";?>>16</option>
      	<option value="17"<? if($dia2=="17") echo " selected";?>>17</option>
      	<option value="18"<? if($dia2=="18") echo " selected";?>>18</option>
      	<option value="19"<? if($dia2=="19") echo " selected";?>>19</option>
      	<option value="20"<? if($dia2=="20") echo " selected";?>>20</option>
      	<option value="21"<? if($dia2=="21") echo " selected";?>>21</option>
      	<option value="22"<? if($dia2=="22") echo " selected";?>>22</option>
      	<option value="23"<? if($dia2=="23") echo " selected";?>>23</option>
      	<option value="24"<? if($dia2=="24") echo " selected";?>>24</option>
      	<option value="25"<? if($dia2=="25") echo " selected";?>>25</option>
      	<option value="26"<? if($dia2=="26") echo " selected";?>>26</option>
      	<option value="27"<? if($dia2=="27") echo " selected";?>>27</option>
      	<option value="28"<? if($dia2=="28") echo " selected";?>>28</option>
      	<option value="29"<? if($dia2=="29") echo " selected";?>>29</option>
      	<option value="30"<? if($dia2=="30") echo " selected";?>>30</option>
      	<option value="31"<? if($dia2=="31") echo " selected";?>>31</option>
      	</select>
/
<select name="mes2" class="texto" id="select6">
	<option value="null">--</option>
	<option value="01"<? if($mes2=="01") echo " selected";?>>01</option>
	<option value="02"<? if($mes2=="02") echo " selected";?>>02</option>
	<option value="03"<? if($mes2=="03") echo " selected";?>>03</option>
	<option value="04"<? if($mes2=="04") echo " selected";?>>04</option>
	<option value="05"<? if($mes2=="05") echo " selected";?>>05</option>
	<option value="06"<? if($mes2=="06") echo " selected";?>>06</option>
	<option value="07"<? if($mes2=="07") echo " selected";?>>07</option>
	<option value="08"<? if($mes2=="08") echo " selected";?>>08</option>
	<option value="09"<? if($mes2=="09") echo " selected";?>>09</option>
	<option value="10"<? if($mes2=="10") echo " selected";?>>10</option>
	<option value="11"<? if($mes2=="11") echo " selected";?>>11</option>
	<option value="12"<? if($mes2=="12") echo " selected";?>>12</option>
</select>
/
<input name="ano2" type="text" class="texto" id="ano22" value="<?=$ano2;?>" size="4" maxlength="4"></td>
    </tr>
    <tr>
    	<td colspan="2">&nbsp;</td>
    	</tr>
    <tr>
    	<td colspan="2" align="center"><input name="Buscar" type="submit" id="Buscar" value="<?=_BUSCAR;?>" class="botao_pesq"></td>
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