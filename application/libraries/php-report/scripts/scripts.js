function EnviarForm(pag,form){
	form.action = pag;
	form.submit();
}

function EnviarFormConf(pag,form,msg){
	var name = confirm(msg);
	if (name != false) {
		form.action = pag;
		form.submit();
	}
}

function EnviarConf(pag,msg){
	var name = confirm(msg);
	if (name != false) {
		window.open(pag,'_self');
	}
}

function Relatorio(id){
	var horizontal = window.screen.availWidth-10;
	var vertical = window.screen.availHeight-35;
	var janela = 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,copyhistory=no,width=' + horizontal + ',height=' + vertical;
	OpenWindow = window.document.open('FrVisualizarRel1.php?id='+id,'relatorio'+id,janela);
	OpenWindow.moveTo(0,0);
}

function help(){
	var horizontal = window.screen.availWidth-10;
	var vertical = window.screen.availHeight-35;
	var janela = 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,copyhistory=no,width=' + horizontal + ',height=' + vertical;
	OpenWindow = window.document.open('help','help',janela);
	OpenWindow.moveTo(0,0);
}

function sonumero(caracter) {
 if(document.all) { // Internet Explorer
  var tecla = caracter.keyCode;
 }
 else {
   var tecla = caracter.which;
 }
 if(tecla > 47 && tecla < 58) { // numeros de 0 a 9
  return true;
 }
 else {
  if ((tecla != 8) && (tecla != 0)) { // backspace e delete
   return false;
  }
  else {
   return true;
  }
 }

}

function esvaziaCombo(combo, caracter) {
	
	 if(document.all) { // Internet Explorer
	  var tecla = caracter.keyCode;
	 }
	 else {
	   var tecla = caracter.which;
	 }

	 if ((tecla == 32) || (tecla == 0)) { // space e delete
	   combo.selectedIndex = 0;
	 }
}

function VerificaUsuario() {
	formulario = document.form1;
	nomeBase = 'UsuBaseDados[]';
	nomeGrupo = 'UsuGrupoRel[]';
	if (form1.UsuTipo.value=="2") {
		formulario[nomeBase].disabled = false;
		formulario[nomeGrupo].selectedIndex = -1;
		formulario[nomeGrupo].disabled = true;
	} else 	if (form1.UsuTipo.value=="3") {
		formulario[nomeBase].selectedIndex = -1;
		formulario[nomeBase].disabled = true;
		formulario[nomeGrupo].disabled = false;
	} else {
		formulario[nomeBase].selectedIndex = -1;
		formulario[nomeBase].disabled = true;
		formulario[nomeGrupo].selectedIndex = -1;
		formulario[nomeGrupo].disabled = true;
	}
}

function CriarRel(onde) {
	if (onde=="novo") {
		form1.db.disabled = false;
		form1.duplicar.disabled = true;
	} else {
		form1.db.disabled = true;
		form1.duplicar.disabled = false;
	}
}

function PegaSelected(formulario, campo, campohidden) {
	selecao = formulario[campo].selectedIndex;
	formulario[campohidden].value = selecao;
}

function HabilitaPasso3(formulario, adiciona, cond, cont) {
	if (formulario[adiciona].value=="null") {
		formulario[cond].selectedIndex = 0;
		formulario[cond].disabled = true;
		formulario[cont].value = "";
		formulario[cont].disabled = true;
	} else {
		formulario[cond].disabled = false;
		formulario[cont].disabled = false;
	}
}

function Lista(pagina) {
	var w = 600;
	var h = 350;
	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 2;
	window.open(pagina+".php",pagina,"toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width="+w+", height="+h+", top="+wint+",left="+winl)
} 

function ExpHabilita() {
	if (form1.tipoarquivo.value=="PDF") {
		form1.folha.disabled = false;
		form1.estilo.disabled = false;
		form1.fonte.disabled = false;
		form1.tam.disabled = false;
		form1.top.disabled = false;
		form1.dir.disabled = false;
		form1.esq.disabled = false;
	} else {
		form1.folha.selectedIndex = 0;
		form1.folha.disabled = true;
		form1.estilo.selectedIndex = 0;
		form1.estilo.disabled = true;
		form1.fonte.selectedIndex = 0;
		form1.fonte.disabled = true;
		form1.tam.value = "";
		form1.tam.disabled = true;
		form1.top.value = "25";
		form1.top.disabled = true;
		form1.dir.value = "25";
		form1.dir.disabled = true;
		form1.esq.value = "25";
		form1.esq.disabled = true;
	}
}