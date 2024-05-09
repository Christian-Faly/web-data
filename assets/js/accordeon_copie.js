function myFunction(e) {
	$("#earth").show();
  //var x = e.clientX;
  //var y = e.clientY;
  //var coor = "Coordinates: (" + x + "," + y + ")";
  //document.getElementById("demo").innerHTML = coor;
}

function clearCoor() {
  $("#earth").hide();
  //document.getElementById("demo").innerHTML = "";
}


$(document).ready(function() {
	$("#load_commune").append("<div id='loading'></div>");
	//$("#load_commune").append("blabla");
	$("#loading").css({
		"background":"url(ajax-loading.gif) no-repeat top left",
		"float":"right",
		"height":"30px",
		"width":"30px"
	}).hide();
	
	// On affiche le grand titre
	$("#id_gand_titre").text($("#accordeon > h3:first").text());
	// On masque les paragraphes dans les div et affiche le premier div
	$("#accordeon div").hide();
	$("#accordeon > h3:first ~ div:first").show();
	
	// On ajoute un élément <a> au sein des titres <h3> et lui adjoint un attribut href
	$("#accordeon h3").wrapInner("<a></a>");
	$("#accordeon h3 a").attr("href","#");
	
	// Gestion de l'événement clic sur chacun des liens de l'accordéon
	$("#accordeon h3 a").click(function() {
		// On retrouve le paragraphe suivant le titre cliqué dans le DOM
		var $h3=$(this).parent();
		$("#id_gand_titre").text($h3.text());
		var $div = $(this).parent().next("div");
		if(!$div.is(":visible")) {
			$("#accordeon div").slideUp(1000);
			$div.slideDown(1000);
		}
	});
	
	// On ajoute un élément <a> au sein des titres <h3> On lui adjoint un attribut href
	$("#accordeon p").wrapInner("<a></a>");
	$("#accordeon p a").attr("href","#");
	
	$("#td_lst_req option").hide();
	$("#id_ligne_titre").nextAll("tr").hide();

	$("#accordeon p").click(function() {
		$("#id_sous_titre").text($(this).text());
		var $p_id = $(this).attr('id');
		$("#td_lst_req option").hide();
		$("#td_lst_req option[alt*='" + $p_id +"']").show(500);			
	});
	
	$("#td_lst_req").click(function() {
		$("#id_ligne_titre").nextAll("tr").show();
		$("#ligne_region").hide();	
		$("#ligne_district").hide();
		$("#ligne_commune").hide();
	});
	
	$('#ch_req option').click(function(){
		console.log("click");
		var id_req = $(this).attr('id');
		console.log(id_req);
		$('#ID_REQ').attr('value', id_req);
	});

	$("#ug_region").click(function() {
		$("#ligne_region").hide();
		$("#ligne_district").hide();
		$("#ligne_commune").hide();		
	});
	
	$("#ug_district").click(function() {
		$("#ligne_region").show();
		$("#ligne_district").hide();
		$("#ligne_commune").hide();		
	});
	$("#ug_commune").click(function() {
		$("#ligne_region").show();
		$("#ligne_district").show();
		$("#ligne_commune").hide();		
	});
	
	$("#ug_point").click(function() {
		$("#ligne_region").show();
		$("#ligne_district").show();
		$("#ligne_commune").show();		
	});

	$("#district option").hide();
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
	$("#sel_commune").click(function() {
		$("#loading").show();
	});
	
});
