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
function calcularDiferencaKm() {
	const kmAtual = document.getElementById("km").value
	const kmAnterior = document.getElementById("ultimoKmCad").value
	
	document.getElementById("diferencaKmCad").value = subtrairConvertendo(kmAnterior, kmAtual) 
	
}
function calcularDiferencaKmAlt() {
	const kmAtual = document.getElementById("kmAlt").value
	const kmAnterior = document.getElementById("ultimoKmAlt").value
	
	document.getElementById("diferencaKmAlt").value = subtrairConvertendo(kmAnterior, kmAtual) 
	
}
function calcularDiferencaHr() {
	const hrAtual = document.getElementById("hr").value
	const hrAnterior = document.getElementById("ultimoHrCad").value

    document.getElementById("diferencaHrCad").value = subtrairConvertendo(hrAnterior, hrAtual) 
}
function calcularDiferencaHrAlt() {
	const hrAtual = document.getElementById("hrAlt").value
	const hrAnterior = document.getElementById("ultimoHrAlt").value

    document.getElementById("diferencaHrAlt").value = subtrairConvertendo(hrAnterior, hrAtual) 
}		
function calcularLitrosOd() {

	const odometroInicial = document.getElementById("odometroinicial").value
	const odometroFinal = document.getElementById("odometrofinal").value
	document.getElementById("litros_od").value = subtrairConvertendo(odometroInicial, odometroFinal)
	
}
function calcularLitrosAlt() {

	const odometroInicial = document.getElementById("odometroInicialAlt").value
	const odometroFinal = document.getElementById("odometrofinalAlt").value
	document.getElementById("litrosOdAlt").value = subtrairConvertendo(odometroInicial, odometroFinal)
	
}
function calcularMedia(){

	const kmRodado = document.getElementById("diferencaKmCad").value
	const litros = document.getElementById("litros").value
	document.getElementById("media").value = dividirConvertendo(kmRodado, litros)
		
}
function calcularMediaAlt(){

	const kmRodado = document.getElementById("diferencaKmAlt").value
	const litros = document.getElementById("litrosAlt").value
	document.getElementById("mediaAlt").value = dividirConvertendo(kmRodado, litros)
		
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