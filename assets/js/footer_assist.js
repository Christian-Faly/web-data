function click_paragraphe(paragraphe){
	$("#tr1 td").text(paragraphe.attr('alt'));
	$("#assist_req_corps  tr").hide();
	$("#assist_req_corps  #tr1").show();
	$("#assist_req_corps  .headingTr").show();
	$("#assist_req_corps tr[alt='"+paragraphe.attr('alt')+"']").show();
	$("#assist_req_corps tr[alt='tout']").show();
	$("#sel_req  option").hide();
	$('#sel_req option[alt="'+paragraphe.attr('id')+'"]').show();
	console.log(paragraphe.attr('id'));
	$('#code_r').val('"'+paragraphe.attr('id')+'"');
	console.log(paragraphe.attr('alt'));
	$('#nom_table').val(paragraphe.attr('alt'));
}	
	
$(document).ready(function() {
	console.log('Footers assist');
		
// On affiche le grand titre
	$("#id_gand_titre").text($("#accordeon > h4:first").text());
	// On masque les paragraphes dans les div et affiche le premier div
	$("#accordeon div").hide();
	$("#accordeon > h4:first ~ div:first").show();
	
	// On ajoute un �l�ment <a> au sein des titres <h4> et lui adjoint un attribut href
	$("#accordeon h4").wrapInner("<a></a>");
	//$("#accordeon h4 a").attr("href","#");
	$("#accordeon p").wrapInner("<a></a>");
	$("#accordeon p a").attr("href","#");
	
	
	// Gestion de l'�v�nement clic sur chacun des liens de l'accord�on
	$("#accordeon h4 a").click(function() {
		// On retrouve le paragraphe suivant le titre cliqu� dans le DOM
		var $h4=$(this).parent();
		$("#id_gand_titre").text($h4.text());
		var $div = $(this).parent().next("div");
		if(!$div.is(":visible")) {
			$("#accordeon div").slideUp(500);
			$div.slideDown(500);
		}
	});

	$("#assist_req_corps  tr").hide();
	$("#assist_req_corps  #tr1").show();
	$("#assist_req_corps  .headingTr").show();
	
	click_paragraphe($("#accordeon p:first"));
	
	$("#accordeon p").click(function() {
		click_paragraphe($(this));
	});	
	
	$("#sel_region option").click(function() {
		var id_region = $(this).attr('id');
		$("#sel_district option").hide();
		$("#sel_district > option[alt*='" + id_region +"']").show();			
	});
	$("#sel_district option").click(function() {
		var id_district = $(this).attr('id');
		$("#sel_commune option").hide();
		$("#sel_commune > option[alt*='" + id_district +"']").show();			
	});
});
