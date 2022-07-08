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

	novoStatus = json.status_erro

    alert(novoStatus)

	if(novoStatus == 1){
		document.getElementById(id_abastecimento).innerHTML='NÃO'
		document.getElementById(id_abastecimento).className='w3-red'
	}else if(novoStatus== 0){
		document.getElementById(id_abastecimento).innerHTML='SIM'
		document.getElementById(id_abastecimento).className='w3-green'
	}
}