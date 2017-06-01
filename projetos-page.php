<?php 

require_once(ABSPATH.'wp-config.php');      
global $wpdb;

$estados =  $wpdb->get_results("SELECT estado FROM ".$wpdb->prefix."projetos_energiasolar group by estado");

if($_POST['cidade'] != '' && $_POST['estado'] != ''){
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$projetos = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."projetos_energiasolar where estado='".$estado."' AND cidade ='".$cidade."'");
} else if($_POST['estado'] != ''){
	$estado = $_POST['estado'];
	$projetos = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."projetos_energiasolar where estado='".$estado."'");
} else { 
	$projetos = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."projetos_energiasolar");
}


?>

<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/css/style.css" />
<link type="text/css" rel="stylesheet" href="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/css/styles-pagination.css" />

</head>

<div>

		<div class="filtros">
			<div class="row" style="margin-left: 20px; margin-right: 20px">
				
				<form method="post">
					<div class="col-md-2"><span>Filtrar por: </span></div>
					<div class="form-group">
					    <label class="col-xs-12 col-md-1">Estado</label>
					    <div class="col-xs-12 col-md-3">
					     	<select class="form-control" name="estado" id="estado">
								<option value="">Todos</option>
								<?php 
									foreach ($estados as $estado){
										echo '<option value="'.$estado->estado.'">' . $estado->estado. '</option>';
									}
								?>
							</select>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-xs-12 col-md-1">Cidade</label>
					    <div class="col-xs-12 col-md-3">
					     	<select class="form-control" name="cidade" id="cidade">
								<option disabled value="">Cidade</option>
								
							</select>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-md-2">
							<button type="submit" id="filtro" class="btn btn-default">Filtrar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="info-legenda">
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-12">
					<div class="col-xs-12 col-md-2 color-projeto">
						<p style="margin-left: 20px;"> Legenda:  </p>
					</div>
					<div class="col-xs-12 col-md-2 color-grey">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
						<span> Localização</span> 
					</div>
					<div class="col-xs-12 col-md-2 color-grey">
						<i class="fa fa-user" aria-hidden="true"></i>
						<span> Responsável</span>  
					</div>
					<div class="col-xs-12 col-md-2 color-grey">
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<span> Data do Projeto</span> 
					</div>
					<div class="col-xs-12 col-md-2 color-grey">
						<i class="fa fa-bolt" aria-hidden="true"></i>
						<span> Potência</span>
					</div>
				</div>
			</div>
		</div>
		<div class="projetos-energiasolar">
			<ul class="projetos-energiasolar">	
				<?php foreach($projetos as $projeto){ ?>
				<li style="margin-top: 25px;">
					<div class="row">
						<a href="<?php echo $projeto->url;?>">
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<div class="col-md-12">	
									<div class="legenda-cliente">
										<i class="fa fa-home" aria-hidden="true"></i>&nbsp;
										<?php echo $projeto->cliente;?>
									</div>				
									<img class="img-responsive img-principal-projeto" src="<?php echo $projeto->imagem1 ?>">			
									<img class="img-responsive img-secundaria" src="<?php echo $projeto->imagem2 ?>">
									<img class="img-responsive img-secundaria" src="<?php echo $projeto->imagem3 ?>" style="margin-top: 5px;">
								</div>
								<div class="col-xs-12 col-md-12">
									<div class="legenda-box"> 
										<div class="col-xs-12 col-md-2">
											<p class="legenda"> 
												<img class="img-estado" src="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/img/<?php echo strtolower($projeto->estado) ?>.svg"/> 
												<span style="font-size:12px;">

												</span>
											</p>
										</div>
										<div class="col-xs-12 col-md-3">
											<p class="legenda"> <i class="fa fa-map-marker" aria-hidden="true"></i> 
												<span style="font-size:12px;">
													<?php echo $projeto->cidade . ', ' . $projeto->estado; ?> 
												</span>
											</p>
										</div>
										<div class="col-xs-12 col-md-3">
											<p class="legenda">
												<i class="fa fa-user" aria-hidden="true"></i> 
												<span style="font-size:12px;">
													<?php echo $projeto->responsavel; ?> 
												</span>
											</p>
										</div>
										<div class="col-xs-12 col-md-2">
											<p class="legenda">
												<i class="fa fa-calendar" aria-hidden="true"></i>
												<span style="font-size:12px;">
													<?php echo $projeto->mes . '/' . $projeto->ano; ?> 
												</span>
											</p>
										</div>
										
										<div class="col-xs-12 col-md-2">
											<p class="legenda">
												<i class="fa fa-bolt" aria-hidden="true"></i>
												<span style="font-size:12px;">
													<?php echo $projeto->potencia . 'W'; ?> 
												</span>
											</p>
										</div>
										
									</div>
								</div>
							</div>
							<div class="col-md-1"></div>
						</a>
					</div>
				</li>
			<?php } ?>
			</ul>	
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/js/jquery.quick.pagination.min.js"></script>
<script>
(function($) {
	
	$("#estado").change(function() {
		var estado = $("select[name='estado']").val();
		$.ajax({
	        type: 'POST',
	        url: "<?php echo get_bloginfo('wpurl') ?>/wp-content/plugins/projetos-energiasolar/cidades.php",
	        data: {estado},
	         success: function(data) {
	         	console.log(data);
              	$("select[name='cidade']").prop("disabled", false);
              	$('select[name="cidade"] option').remove();
              	$('select[name="cidade"]').append("<option value=''>Escolha a cidade</option>")
              	$.each(data, function(i,  value ) {
				  $('select[name="cidade"]').append("<option value='" + value.cidade + "'>"+ value.cidade + "</option>");
				});    
            }        
       	});
	});

	$("ul.projetos-energiasolar").quickPagination({pagerLocation:"bottom",pageSize:"3"});

})(jQuery);
</script> 
