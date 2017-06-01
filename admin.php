<?php
	if(isset($_POST['cliente']) && isset($_POST['potencia']) && isset($_POST['cidade']) && isset($_POST['estado']) && isset($_POST['responsavel']) && isset($_POST['mes']) && isset($_POST['ano']) && isset($_POST['imagem1']) && isset($_POST['imagem2']) && isset($_POST['imagem3']) && isset($_POST['url'])){
		$data_atual = date("Y-m-d"); 
		$wpdb->insert(
			$wpdb->prefix."projetos_energiasolar",
			array(
				'cliente'=>$_POST['cliente'],
				'potencia'=>$_POST['potencia'],
				'cidade'=>$_POST['cidade'],
				'estado'=>$_POST['estado'],
				'responsavel'=>$_POST['responsavel'],
				'mes'=>$_POST['mes'],
				'ano'=>$_POST['ano'],
				'imagem1'=>$_POST['imagem1'],
				'imagem2'=>$_POST['imagem2'],
				'imagem3'=>$_POST['imagem3'],
				'url'=>$_POST['url'],
				'data_cadastro'=>$data_atual
			)
		);
	} else if(isset($_POST['id'])) {
		$wpdb->delete($wpdb->prefix."projetos_energiasolar", array('id'=>$_POST['id']));
	} else {
		if($_POST){
			$error = true;
		}
	}
	$estados = json_decode(file_get_contents(dirname(__FILE__)."/estados-cidades.json"))->estados;
	$projetos = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."projetos_energiasolar");
?>
<link type="text/css" rel="stylesheet" href="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/css/jquery.dataTables.css" />
<script type="text/javascript" src="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/js/jquery.dataTables.js" ></script>
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

	    $("select[name='estado'").change(function(){
	    	var cidades = JSON.parse($("option[value='"+$(this).val()+"']").attr('cidades'));
	    	$("select[name='cidade'] option").each(function(){
	    		if($(this).attr('value')!="")$(this).remove();
	    	});
	    	for(var i=0; i<cidades.length; i++){
	    		var option = $("<option/>");
	    		option.text(cidades[i]);
	    		option.attr('value',cidades[i]);
	    		$("select[name='cidade']").append(option);
	    	}
	    });
	});
</script>
<div class="wrap"> 
	<div id="icon-edit-pages" class="icon32"><br /></div> 
<h2><strong>Projetos de Energia Solar</strong></h2><br>
<div class="clear"></div>

<div class="adicionar-projeto">
    <h2 >Adicione um novo projeto:</h2>
    <?php if($error){ ?>
    	<div class="alerta">
    		Todos os campos são obrigatórios.
    	</div>
    <?php } ?>
    <form method="post">
    	<div class="row">
    		<div class="column column-8">
    			<input type="text" name="cliente" placeholder="Cliente">
    		</div>
    		<div class="column column-4">
    			<input type="text" name="potencia" placeholder="Potência">
    		</div>
    	</div>
    	<div class="row">
    		<div class="column column-3">
			    <select name="estado">
			    	<option value="" disabled selected>Estado</option>
			    	<?php foreach($estados as $estado){ ?>
			    		<option value="<?php echo $estado->sigla ?>" cidades='<?php echo json_encode($estado->cidades); ?>'><?php echo $estado->nome ?></option>
			    	<?php } ?>
		   		</select>
		    </div>
		    <div class="column column-3">
			    <select name="cidade">
			    	<option value="" disabled selected>Cidade</option>
			    </select>
		    </div>
		    <div class="column column-3">
    			<select name="mes">
			    	<option value="" disabled selected>Mês</option>
			    	<option value="Janeiro">Janeiro</option>
			    	<option value="Feveiro">Fevereiro</option>
			    	<option value="Março">Março</option>
			    	<option value="Abril">Abril</option>
			    	<option value="Maio">Maio</option>
			    	<option value="Junho">Junho</option>
			    	<option value="Julho">Julho</option>
			    	<option value="Agosto">Agosto</option>
			    	<option value="Setembro">Setembro</option>
			    	<option value="Outubro">Outubro</option>
			    	<option value="Novembro">Novembro</option>
			    	<option value="Dezembro">Dezembro</option>
			    </select>
		    </div>
		    <div class="column column-3">
    			<input type="text" name="ano" placeholder="Ano">
		    </div>
	    </div>
	    <div class="row">
		    <div class="column column-6">
    			<input type="text" name="responsavel" placeholder="Responsável">
		    </div>
		    <div class="column column-6">
    			<input type="text" name="url" placeholder="Url">
		    </div>
	    </div>
	    <div class="row">
	    	<div class="column column-4">
    			<input type="text" name="imagem1" placeholder="Url da Imagem Principal">
		    </div>
		    <div class="column column-4">
    			<input type="text" name="imagem2" placeholder="Url da Imagem Lateral">
		    </div>
		    <div class="column column-4">
    			<input type="text" name="imagem3" placeholder="Url da Imagem Lateral">
		    </div>
	    </div>
    	<div class="row">
		    <div class="column column-12">
			    <button type="submit">Adicionar</button>
		    </div>
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
		    <th>Cliente</th>
		    <th>Potência</th>
		    <th>Cidade/Estado</th>
			<th>Mes/Ano</th> 
			<th>Responsável</th> 
			<th>URL</th> 
			<th> </th> 
	  	</tr> 
  	</thead> 
  
  	<tbody> 
<?php

	foreach($projetos as $projeto) {
	?>
	  	<tr style="text-align: center"> 
		    <td><?php echo $projeto->id ?></td>
			<td><?php echo $projeto->cliente ?></td>
			<td><?php echo $projeto->potencia ?></td>
			<td><?php echo $projeto->mes." / ".$projeto->ano ?></td>
			<td><?php echo $projeto->cidade." / ".$projeto->estado ?></td>
			<td><?php echo $projeto->responsavel ?></td>
			<td><a href="<?php echo $projeto->url ?>"><?php echo $projeto->url ?></a></td>
			<td>
			<form method="post"><input type="hidden" name="id" value="<?php echo $projeto->id ?>"><button type="submit">Excluir</button></form>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
