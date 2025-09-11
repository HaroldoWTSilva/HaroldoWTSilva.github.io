function tapronto(){
    $.getJSON('/js/frases.json', function(data) {
	if (data.length > 0) {
	    var randomIndex = Math.floor(Math.random() * data.length);
	    var fraseAleatoria = data[randomIndex];
	    $('blockquote.citacoes').text(fraseAleatoria);
	    console.log("citacao: "+fraseAleatoria);
	} else {
	    console.log("citacao: nenhuma frase!")
	}
    }).fail(function() {
	console.log('citacao: erro!')
    });
    if (typeof(page_main) === 'function' )
	page_main();
}

$(document).ready(tapronto);
