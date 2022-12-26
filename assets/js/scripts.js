function calcularDiferencaKm() {
	const kmAtual = document.getElementById("km").value
	const kmAnterior = document.getElementById("ultimokm").value

	const diferencaKm = kmAtual - kmAnterior
	
	document.getElementById("diferencakm").value = diferencaKm 
	
}
function calcularDiferencaHr() {
	const hrAtual = document.getElementById("hr").value
	const hrAnterior = document.getElementById("ultimohr").value

	const diferencaHr = hrAtual - hrAnterior
		
    document.getElementById("diferencahr").value = diferencaHr 
}
		
function calcularLitrosOd() {
	const odometroInicial = document.getElementById("odometroinicial").value
	const odometroFinal = document.getElementById("odometrofinal").value

	const litrosOdometro = odometroFinal - odometroInicial

		document.getElementById("litros_od").value = litrosOdometro.toFixed(2)
}
function calcularMedia(){

	const kmRodado = document.getElementById("diferencakm").value
	const litros = document.getElementById("litros").value

		const media = kmRodado / litros
		document.getElementById("media").value = media.toFixed(2) 
		
}
function somenteNumeros(num) {
    var er = /[^0-9,\.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
      campo.value = "";
    }
}

function PopupCenter(url, title, w, h) {  
    // Fixes dual-screen position                         Most browsers      Firefox  
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;  
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;  
              
    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;  
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;  
              
    var left = ((width / 2) - (w / 2)) + dualScreenLeft;  
    var top = ((height / 2) - (h / 2)) + dualScreenTop;  
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);  
  
    // Puts focus on the newWindow  
    if (window.focus) {  
        newWindow.focus();  
    }  
}  
function table2excel(id) {
    $("#" + id).table2excel({
        exclude: ".excludeThisClass",
        name: "export",
        filename: "export.xls", // do include extension, usar xls pra nÃ£o dar pau com o chrome
        preserveColors: true // set to true if you want background colors and font colors preserved
        
    });
}
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
async function alterarStatusErro(idErro, id_abastecimento){
    const acao = 'alterar-status-erro'
	const data = new FormData()
	data.append('idErro', idErro)
    data.append('id_abastecimento', id_abastecimento)
    data.append('acao', acao)

	const req = await fetch('diesel-control-1.1/assets/controllers/abastecimentoDataBaseAcess.php', {
		method: 'POST',
		body: data
	})

	const json = await req.json()

	const idRow =`td${id_abastecimento}`

	novoStatus = json.erro_status

	if(novoStatus == 1){
		document.getElementById(idRow).innerHTML='NÃO'
		document.getElementById(idRow).className='w3-red'
	}else{
		document.getElementById(idRow).innerHTML='SIM'
		document.getElementById(idRow).className='w3-green'
	}
}
async function buscarInfoVeiculo(id){

	const dados = await fetch(`diesel-control-1.1/assets/controllers/abastecimentoDataBaseAcess.php?&acao=ultimoKm&id=${id}`)
    const response = await dados.json()
    console.log(response)
	document.getElementById("setor").value = response['dados'].setor
	document.getElementById("ultimokm").value = response['dados'].ultimoKm
	document.getElementById("ultimohr").value = response['dados'].ultimoHr


}