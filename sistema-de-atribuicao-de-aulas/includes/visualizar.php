<?php
session_start();

wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery', 'popper'), '4.1.3', true );

include( plugin_dir_path( __FILE__ ) . 'includes/functions.php'); //funções PHP

$variavel = $_GET['minha_variavel'];
//echo 'Valor da variável: ' . $variavel;
if(1==1){
	global $wpdb;
	
	$resultado = '';
	
	//$query_user = "SELECT * FROM wp_smerc_classes WHERE ID = '" . $_POST["user_id"] . "' LIMIT 1";
	$query_user = "SELECT * FROM wp_smerc_classes WHERE ID = '$variavel' LIMIT 1";
	$resultado_user = $wpdb->get_results($query_user);
	$row_user = $resultado_user[0];
	

	$resultado .= '<table class="table table-sm table-striped table-bordered table-hover">';
	
	$resultado .= '<tr class="table-'.cor($row_user->status).'"><td>Status</td>';
	$resultado .= '<td>'.strtoupper($row_user->status).'</td></tr>';
	
	$resultado .= '<tr><td>Classe</td>';
	$resultado .= '<td>'.$row_user->classe.' '.$row_user->turma.' - '.$row_user->etapa.'</td></tr>';
	
	$resultado .= '<tr><td>Quantidade de aulas</td>';
	$resultado .= '<td>'.$row_user->quantidade_aulas.' aulas</td></tr>';

	$resultado .= '<tr><td>Horário e Período</td>';
	$resultado .= '<td>'.$row_user->horario.' - '.$row_user->periodo.'</td></tr>';
	
	$resultado .= '<tr><td>Professor(a)</td>';
	$resultado .= '<td>'.$row_user->nome_professor_01.'</td></tr>';

	$resultado .= '<tr><td>Motivo do afastamento</td>';
	$resultado .= '<td>'.$row_user->motivo_01." ".$row_user->detalhe_motivo_01.'</td></tr>';

	$resultado .= '<tr><td>HTPC</td>';
	$resultado .= '<td>'.$row_user->dia_htpc.' das '.$row_user->hora01.' até '.$row_user->hora02.'</td></tr>';
	if ($row_user->dia_htpc2 != "") {
		$resultado .= '<td>'.$row_user->dia_htpc2.' das '.$row_user->hora03.' até '.$row_user->hora04.'</td></tr>';
	}
	if ($row_user->dia_htpc3 != "") {
		$resultado .= '<td>'.$row_user->dia_htpc3.' das '.$row_user->hora05.' até '.$row_user->hora06.'</td></tr>';
	}

	$resultado .= '<tr><td>Observações da escola</td>';
	$resultado .= '<td>'.$row_user->observacao_esc.'</td></tr>';

	$resultado .= '<tr><td>Observações da SMERC</td>';
	$resultado .= '<td>'.$row_user->observacao_sec.'</td></tr>';

	$resultado .= '</table>';
	
	$resultado .= '<button type="button" class="btn btn-primary" id="voltar" onclick="history.back();">voltar</button>';



	echo $resultado;
}
?>
