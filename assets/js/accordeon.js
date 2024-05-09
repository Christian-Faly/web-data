$(document).ready(function() {
// On affiche le grand titre
	$("#id_gand_titre").text($("#accordeon > h6:first").text());
	// On masque les paragraphes dans les div et affiche le premier div
	$("#accordeon div").hide();
	$("#accordeon > h6:first ~ div:first").show();
	
	$("#accordeon p").wrapInner("<a></a>");
	$("#accordeon p a").attr("href","#");
	
	// On ajoute un élément <a> au sein des titres <h6> et lui adjoint un attribut href
	$("#accordeon h6").wrapInner("<a></a>");
	$("#accordeon h6 a").attr("href","#"+$("#accordeon h6").next('h6').attr('id'));
	
	// Gestion de l'événement clic sur chacun des liens de l'accordéon
	$("#accordeon h6 a").click(function() {
		// On retrouve le paragraphe suivant le titre cliqué dans le DOM
		var $div = $(this).parent().next("div");
		if(!$div.is(":visible")) {
			$("#accordeon div").slideUp(500);
			$div.slideDown(500);
		}
	});	
});
