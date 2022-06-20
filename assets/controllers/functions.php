<?php
function anexarImagem($imagem, $caminho, $id_noticia){
    
    $imagem = $_FILES["imagem"]["tmp_name"];
    $ext = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
    $nome_arquivo = $id_noticia.".".$ext;
    move_uploaded_file($imagem, "$caminho$nome_arquivo");
	
    return $nome_arquivo;
}   
function anexarMiniatura($imagem, $caminho, $id_noticia){

	$altura = "190";
	$largura = "275";
    
    $ext = pathinfo($_FILES["miniatura"]["name"], PATHINFO_EXTENSION);
    $nome_arquivo = $id_noticia.".".$ext;
	 
	switch($_FILES['miniatura']['type']):

		case 'image/jpeg';
		case 'image/pjpeg';

			$imagem_temporaria = imagecreatefromjpeg($_FILES['arquivo']['tmp_name']);
			
			$largura_original = imagesx($imagem_temporaria);
			
			$altura_original = imagesy($imagem_temporaria);
			
			$nova_largura = $largura ? $largura : floor (($largura_original / $altura_original) * $altura);
			
			$nova_altura = $altura ? $altura : floor (($altura_original / $largura_original) * $largura);
			
			$imagem = imagecreatetruecolor($nova_largura, $nova_altura);

			imagecopyresampled($imagem, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			
			imagejpeg($imagem, 'arquivo/' . $_FILES['arquivo']['name']);
						
		break;

		case 'image/png':
		case 'image/x-png';

			$imagem_temporaria = imagecreatefrompng($_FILES['miniatura']['tmp_name']);
			$largura_original = imagesx($imagem_temporaria);
			$altura_original = imagesy($imagem_temporaria);
			
			$nova_largura = $largura ? $largura : floor(( $largura_original / $altura_original ) * $altura);
	
			$nova_altura = $altura ? $altura : floor(( $altura_original / $largura_original ) * $largura);
			
			$imagem = imagecreatetruecolor($nova_largura, $nova_altura);
			
			imagecopyresampled($imagem, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			
			imagepng($imagem, "$caminho$nome_arquivo");
			
		break;

	endswitch;

    return $nome_arquivo;
}  
function filtrar($texto)
{
$texto = str_replace('<infCpl>', " ", $texto);
$texto = str_replace('</infCpl>', " ", $texto);
$texto = str_replace("'", " ", $texto);	
$texto = str_replace('"', " ", $texto);
$texto = str_replace('>', " ", $texto);
$texto = str_replace('<', " ", $texto);

$texto = strtoupper($texto);
return  nl2br($texto);
}
//funçoes para fomrmatar valores
function vN($v) { return number_format($v,'0','',''); }
function v0($v) { return number_format($v,'0',',','.'); }
function v1($v) { return number_format($v,'1',',','.'); }
function v2($v) { return number_format($v,'2',',','.'); }
function v3($v) { return number_format($v,'3',',','.'); }
function v4($v) { return number_format($v,'4',',','.'); }
function v5($v) { return number_format($v,'5',',','.'); }
function v0USA($v){ return number_format($v,'0','.',''); }
function v2USA($v){ return number_format($v,'2','.',''); }
function v4USA($v){ return number_format($v,'4','.',''); }
function v0Graf($v){ return number_format($v,'0','',''); }
function l10($v){ return substr($v, 0, 10); }
function l12($v){ return substr($v, 0, 12); }
function l20($v){ return substr($v, 0, 20); }
function l25($v){ return substr($v, 0, 25); }
function l15($v){ return substr($v, 0, 15); }
function l30($v){ return substr($v, 0, 30); }
function l100($v){ return substr($v, 0, 100); }
function l4($v){ return substr($v, 0, 4); }

//funções para data
function hi($m)   { if ($m) { $data = date('Hi',strtotime($m)); 	return $data;}}  //converte yyyy-mm-aa para dd-mm-aaaa
function H_i($m)  { if ($m) { $data = date('H:i',strtotime($m)); 	return $data;}}  //converte yyyy-mm-aa para dd-mm-aaaa
function dma($m)  { if ($m) { $data = date('d-m-Y',strtotime($m)); 	return $data; }}  //converte yyyy-mm-aa para dd-mm-aaaa
function Ymd($m)  { if ($m) { $data = date('Y-m-d',strtotime($m)); 	return $data;}}  //converte yyyy-mm-aa para dd-mm-aaaa
function dmaH($m) { if ($m) { $data = date('d-m-Y H:i',strtotime($m)); return $data; }} //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii
function dmaHis($m) { if ($m) { $data = date('d-m-Y H:i:s',strtotime($m)); return $data; }} //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii

function dmaHLocal($m) { if ($m) { 
	$data1 = date('Y-m-d',strtotime($m)); 
	$data2 = 'T'; 
	$data3 = date('H:i',strtotime($m));
	$data =  $data1.$data2.$data3;
	return $data; 
}} //usado para html datetime-local
function diaSemana($m) { $data = date('w',strtotime($m)); return $data; } //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii
function w($m) { $data = date('w',strtotime($m)); return $data; } //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii
function diaTexto($m) { $data = date('D',strtotime($m)); return $data; } //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii


function upload($arq, $nome, $local)
{
	if (move_uploaded_file($_FILES[$arq]['tmp_name'], $local . '/' .  $nome . '.pdf')) 
	{ return 1 ;}
	else
	{ return 0; }

}

//acha mes pelo nome
function achaMes($m) 
{
	$mmm = array('MES','JAN','FEV','MAR','ABR','MAI','JUN','JUL','AGO','SET','OUT','NOV','DEZ');
	for ($a=1;$a<=12;$a++) 	{ if ($m == $mmm[$a]) { $r = $a; } }
	return $r;
}

function diaSem($d)
{

	$dia[0] = 'DOM';
	$dia[1] = 'SEG';
	$dia[2] = 'TER';
	$dia[3] = 'QUA';
	$dia[4] = 'QUI';
	$dia[5] = 'SEX';
	$dia[6] = 'SAB';
	return $dia[$d];
}
function achaUltimoId($tabela, $campo)
{
	$connP = odbc_connect( 'sb-pedidos','dba','rdp' );  //sb-pedidos
	$sqlUI = "select top 1 $campo as id from $tabela order by id desc";
	$qryUI = odbc_exec($connP,$sqlUI);
	$rowUI = odbc_fetch_array($qryUI);	
	return $rowUI['id'];
}

//especificos para frota

$tipoF['C'] = 'CAVALO';
$tipoF['T'] = 'TOCO';
$tipoF['A'] = 'CARRETA';
$tipoF['R'] = 'TRUCK';
$tipoF['E'] = 'TREMINHAO';

$style['NOVO'] = 'w3-red';
$style['XML'] = 'w3-yellow';
$style['RECEBIDO'] = 'w3-orange';
$style['TRANSFERIDO'] = 'w3-blue';
$style['DESCARREGADO'] = 'w3-indigo';
$style['FINALIZADO'] = 'w3-green';
$style['CANCELADO'] = 'w3-purple';

//	array para armazenar os meses 
$mmm = array('MES','JAN','FEV','MAR','ABR','MAI','JUN','JUL','AGO','SET','OUT','NOV','DEZ');
//	array para armazenar os meses 
$mmmE = array('MES','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');	  
	  
$codentSispetro[2] = 499;
$codentSispetro[3] = 100;
$codentSispetro[4] = 80;
$codentSispetro[5] = 2140;
$codentSispetro[6] = 2101;
$codentSispetro[7] = 2164;
$codentSispetro[12] = 2872;
$codentSispetro[14] = 3210;
$codentSispetro[15] = 3286;
$codentSispetro[18] = 3845;
$codentSispetro[19] = 3857;


function filtraCNPJ($texto){
	$texto = str_replace(".", "", $texto);	
	$texto = str_replace('-', "", $texto);$texto = str_replace('/', "", $texto);return $texto;}
function cpf($texto){$texto = filtraCNPJ($texto);	$texto = substr($texto,0,3).'.'.substr($texto,3,3).'.'.substr($texto,6,3).'-'.substr($texto,9,2);return $texto;}
function rg($texto) {$texto = filtraCNPJ($texto);	$texto = substr($texto,0,1).'.'.substr($texto,1,3).'.'.substr($texto,4,3).'-'.substr($texto,7,1);return $texto;}
function filtraSQL($texto) {
	$texto = str_replace("'", "´", $texto); return $texto; }

function filtraRegiao($texto) 
{ 
	$texto = str_replace(" ", "", $texto); 
	$texto = str_replace("/", "", $texto); 
	return $texto; 
}

$ddd[0] = 'Domingo';
$ddd[1] = 'Segunda-Feira';
$ddd[2] = 'Terca-Feira';
$ddd[3] = 'Quarta-Feira';
$ddd[4] = 'Quinta-Feira';
$ddd[5] = 'Sexta-Feira';
$ddd[6] = 'Sabado';
$ddd[7] = 'Domingo';
$ddd[8] = 'Segunda-Feira';
$ddd[9] = 'Terca-Feira';
$ddd[10] = 'Quarta-Feira';
$ddd[11] = 'Quinta-Feira';
$ddd[12] = 'Sexta-Feira';
$ddd[13] = 'Sabado';
$ddd[14] = 'Domingo';
$ddd[15] = 'Segunda-Feira';
$ddd[16] = 'Terca-Feira';
$ddd[17] = 'Quarta-Feira';
$ddd[18] = 'Quinta-Feira';
$ddd[19] = 'Sexta-Feira';
$ddd[20] = 'Sabado';
$ddd[21] = 'Domingo';
$ddd[22] = 'Segunda-Feira';
$ddd[23] = 'Terca-Feira';
$ddd[24] = 'Quarta-Feira';
$ddd[25] = 'Quinta-Feira';
$ddd[26] = 'Sexta-Feira';
$ddd[27] = 'Sabado';
?>

