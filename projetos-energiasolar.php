<?php
/*
Plugin Name: Projetos de Energia Solar
Description: Plugin responsável por listar projetos de energia solar com seus detalhamentos
Version: 1.0
Author: LamaTech
*/

// Admin Panel
global $wpdb;

add_action('admin_menu', 'add_page_projetos_energiasolar');
register_activation_hook(__FILE__,'select_install_projetos_energiasolar');
add_filter('the_content', 'select_page_projetos_energiasolar');


function add_page_projetos_energiasolar() {
    add_menu_page('Projetos de Energia Solar', 'Projetos de Energia Solar', 8, __FILE__, 'add_page_admin_projetos_energiasolar');
}

function add_page_admin_projetos_energiasolar() {
	global $wpdb;
    include('admin.php');
}

function select_page_projetos_energiasolar($content) {
	global $wpdb;
	ob_start();
    include('select-page.php');
	$html = ob_get_clean();
	$tags = '[projetos-energiasolar]';
	$subst = $html;
	
	
	return str_replace($tags,$subst,$content);
}


function select_install_projetos_energiasolar() {
   global $wpdb;
   require_once(ABSPATH.'wp-admin/includes/upgrade.php');      

   $table_name = $wpdb->prefix."projetos_energiasolar";
   
  	$sql = "CREATE TABLE ".$table_name." (
	  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	  cliente varchar(255),
	  cidade varchar(255),
	  estado varchar(2),
	  responsavel varchar(255),
	  potencia varchar(15),
	  mes varchar(20),
	  ano varchar(5),
	  imagem1 varchar(255),
	  imagem2 varchar(255),
	  imagem3 varchar(255),
	  url varchar(255),
	  data_cadastro date,
	  PRIMARY KEY  (id)
 	);";

    dbDelta($sql);
	
}
