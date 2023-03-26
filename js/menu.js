function CargarOficio(){
	$.get('proyecto/conformidad.php', function(e){
		$('#resultado').html(e);
	})
}