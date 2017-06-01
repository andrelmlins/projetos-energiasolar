

<script>
(function($) {
	
	$(".page_break").append('<form method="post"><div class="col-md-3">'+
		'<label class="arf_main_label"> Selecione o País</label>'+
		   '<select id="pais">'+
		   		'<option disabled="" value="" >Selecione um país</option>'+
		   		'<option> Pais 1</option>'+
		   		'<option> Pais 2</option>'+
		   		'<option> Pais 3</option>'+
		   	'</select>'+
		   	'</div><br>'+
		   	'<div class="col-md-3">'+
		   		'<label class="arf_main_label"> Selecione a Cidade</label>'+
		   		'<select id="cidade">'+	
		   			'<option disabled="" value="" >Selecione uma cidade</option>'+
		   			'<option>cidade 2</option>'+
		   			'<option>cidade 3</option>'+
		   			'<option>cidade 4</option>'+
		   		'</select></div></form>');
	 
	$("#pais").change(function() {
	  $("input[placeholder='pais']").val($("#pais").val());
	});

	$("#cidade").change(function() {
		$("input[placeholder='cidade']").val($("#cidade").val());
	});


})(jQuery);


</script> 
