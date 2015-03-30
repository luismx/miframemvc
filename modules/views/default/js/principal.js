function cambiarFecha(fecha, lang){
	//por ahora solo fecha en formato DB
	var miFecha = fecha.split('-');
	var fecha = "";
	switch(lang){
		case 'es':
			return fecha = miFecha[2]+'/'+miFecha[1]+'/'+miFecha[0];
		break;
		case 'en':
			return fecha = miFecha[1]+'/'+miFecha[2]+'/'+miFecha[0];
		break;
	}
}

$(document).ready(function() {
	
});