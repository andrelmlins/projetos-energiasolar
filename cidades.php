<?php

header('Content-Type: application/json', true);
require_once('../../../wp-config.php');
global $wpdb;

if(isset($_POST['estado'])){
	$estado = $_POST['estado'];
	$cidades = $wpdb->get_results("SELECT cidade FROM ".$wpdb->prefix."projetos_energiasolar where estado = '".$estado."'");
	echo json_encode($cidades);
}

