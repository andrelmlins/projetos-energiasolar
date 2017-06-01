<?php
	if(isset($_POST['pais']) && isset($_POST['cidade'])){
		$data_atual = date("Y-m-d"); 
		$wpdb->insert($wpdb->prefix."select_pais_cidade", array('pais'=>$_POST['pais'], 'cidade'=>$_POST['cidade'], 'data_cadastro'=>$data_atual));
	} else if(isset($_POST['id'])) {
		$wpdb->delete($wpdb->prefix."select_pais_cidade", array('id'=>$_POST['id']));
	}
	$estados = json_decode(file_get_contents(dirname(__FILE__)."/estados-cidades.json"))->estados;
	$projetos = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."projetos-energiasolar");
?>
<link type="text/css" rel="stylesheet" href="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/select-pais-cidade/css/jquery.dataTables.css" />
<script type="text/javascript" src="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/select-pais-cidade/js/jquery.dataTables.js" ></script>
<link type="text/css" rel="stylesheet" href="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/css/style.css" />
<script>
	jQuery(document).ready(function( $ ){

	     var config_datatable = {
	        "iDisplayLength": 20,
	        "aLengthMenu": [[10, 20, 40, 60, -1], [10, 20, 40, 60, "Todos"]],
	        "language": {
	            "sEmptyTable": "Nenhum registro encontrado",
	            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
	            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
	            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
	            "sInfoPostFix": "",
	            "sInfoThousands": ".",
	            "sLengthMenu": "_MENU_ resultados por página",
	            "sLoadingRecords": "Carregando...",
	            "sProcessing": "Processando...",
	            "sZeroRecords": "Nenhum registro encontrado",
	            "sSearch": "Pesquisar em qualquer coluna",
	            "oPaginate": {
	                "sNext": "Próximo",
	                "sPrevious": "Anterior",
	                "sFirst": "Primeiro",
	                "sLast": "Último"
	            },
	            "oAria": {
	                "sSortAscending": ": Ordenar colunas de forma ascendente",
	                "sSortDescending": ": Ordenar colunas de forma descendente"
	            }
	        }
	    }
	    $('table').DataTable(config_datatable);

	    $("estado").change(function(){

	    });
	});
</script>
<div class="wrap"> 
	<div id="icon-edit-pages" class="icon32"><br /></div> 
<h2><strong>Projetos de Energia Solar</strong></h2><br>
<div class="clear"></div>

<div class="adicionar-projeto">
    <h2 id='title' style="display:inline-table;">Adicione um novo projeto:</h2>
    <form method="post">
    	<div class="row">
    		<div class="column column-3">
			    <select name="estado">
			    	<option value="" selected>Estado</option>
			    	<?php foreach($estados as $estado){ ?>
			    		<option value="<?php echo $estado->sigla ?>" cidades="<?php echo $estado->cidades?>"><?php echo $estado->nome ?></option>
			    	<?php } ?>
		   		</select>
		    </div>
		    <div class="column column-3">
			    <select name="cidade">
			    	<option value="" selected>Cidade</option>
			    </select>
		    </div>
		    <input type="text" style="width: 300px" name="cidade" placeholder="Cidade">
		    <button type="submit">Adicionar</button>
	    </div>
    </form>
</div>

<br>
<style>

</style>
<table style="width: 100%;" cellspacing="0"> 
  	<thead> 
	  	<tr> 
		    <th>ID</th>
		    <th>País</th>
			<th>Cidade</th> 
			<th>Data</th> 
			<th> </th> 
	  	</tr> 
  	</thead> 
  
  	<tbody> 
<?php

	foreach($paisesadicionados as $paises) {
	?>
	  	<tr style="text-align: center"> 
		    <td style="width: 10%;"><?php echo $paises->id ?></td>
			<td style="width: 25%;"><?php echo $paises->pais ?></td>
			<td style="width: 25%;"><?php echo $paises->cidade ?></td>
			<td style="width: 25%;"><?php echo date('d/m/Y',strtotime($paises->data_cadastro)); ?></td>
			<td style="width: 15%;">
			<form method="post"><input type="hidden" name="id" value="<?php echo $paises->id ?>"><button type="submit">Excluir</button></form>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
