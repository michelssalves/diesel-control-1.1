function soNumeros(evento) {
	var theEvent = evento || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode( key );
	//var regex = /^[0-9.,]+$/;
	var regex = /^[0-9,]+$/;
	if( !regex.test(key) ) {
	   theEvent.returnValue = false;
	   if(theEvent.preventDefault) theEvent.preventDefault();
	}
 }
function calcularDiferencaKmCad() {

	const kmAtualCad = document.getElementById("kmCad").value
	const kmAnteriorCad = document.getElementById("ultimoKmCad").value
	
	document.getElementById("diferencaKmCad").value = subtrairConvertendo(kmAnteriorCad, kmAtualCad) 
	
}
function calcularDiferencaHrCad() {
	const hrAtualCad = document.getElementById("hrCad").value
	const hrAnteriorCad = document.getElementById("ultimoHrCad").value

    document.getElementById("diferencaHrCad").value = subtrairConvertendo(hrAnteriorCad, hrAtualCad) 
}	
function calcularLitrosOdCad() {

	const odometroInicialCad = document.getElementById("odometroInicialCad").value
	const odometroFinalCad = document.getElementById("odometroFinalCad").value
	document.getElementById("litrosOdCad").value = subtrairConvertendo(odometroInicialCad, odometroFinalCad)
	
}
function calcularMediaCad(){

	const kmRodadoCad = document.getElementById("diferencaKmCad").value
	const litrosCad = document.getElementById("litrosCad").value
	document.getElementById("mediaCad").value = dividirConvertendo(kmRodadoCad, litrosCad)
		
}
function subtrairConvertendo(v1, v2){

	const n1 = parseFloat(v1.replace(',', '.'));
	const n2 = parseFloat(v2.replace(',', '.'));
	const n3 = n2 - n1
	return n4 = n3.toFixed(2).toString().replace('.', ',')

}
function dividirConvertendo(v1, v2){

	const kmRodado = parseFloat(v1.replace(',', '.'))
	const litros = parseFloat(v2.replace(',', '.'))
	const media = kmRodado / litros
	return mediaFinal = media.toFixed(2).toString().replace('.', ',')

}
async function buscarInfoVeiculo(id){

	const dados = await fetch(`diesel-control-1.1/assets/controllers/abastecimentoDataBaseAcess.php?&acao=ultimoKm&id=${id}`)
    const response = await dados.json()
	document.getElementById("setor").value = response['dados'].setor
	document.getElementById("ultimoKmCad").value = response['dados'].ultimoKm
	document.getElementById("ultimoHrCad").value = response['dados'].ultimoHr

}
function table2excel(id) {

    $("#" + id).table2excel({

        exclude: ".excludeThisClass",
        name: "export",
        filename: "export.xls", // do include extension, usar xls pra nÃ£o dar pau com o chrome
        preserveColors: true // set to true if you want background colors and font colors preserved
        
    });
}
function impedirClicks(){

	document.getElementById("conteudo").style.display = "none";
	document.getElementById("loading").style.display = "block";
	
}