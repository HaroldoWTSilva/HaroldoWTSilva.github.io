function nova_linha(){
	var col_index = $("<td>") ;
	$(col_index).text(current_col_index);
	var col_etapa = $("<td>").html(`
    <select>
        <option value="ida">Ida</option>
        <option value="volta">Volta</option>
        <option value="embarque">Embarque</option>
    </select>`);

	var col_milhas = $("<td>").html('<input class="milhas" type="number">');
	var col_dinheiro = $("<td>").html('<input class="dinheiro" type="number">') ;
	var tr = $("<tr>").append(col_index, col_etapa, col_milhas, col_dinheiro);
	$("table#etapas").append(tr);
	current_col_index += 1;

}

function page_main(){
	$("button#adicionar_etapa").click(nova_linha);
	current_col_index = 1;
}
