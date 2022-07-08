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
	alert(novoStatus)
	if(novoStatus == 1){
		document.getElementById(idRow).innerHTML='N�O'
		document.getElementById(idRow).className='w3-red'
	}else{
		document.getElementById(idRow).innerHTML='SIM'
		document.getElementById(idRow).className='w3-green'
	}
}