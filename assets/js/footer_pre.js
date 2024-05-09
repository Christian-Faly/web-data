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

function click_h6_a(h6a){
	var $h6=$(h6a).parent();
	$("#id_gand_titre").text($h6.text());
}	

function click_paragraphe(paragraphe){
	$("#id_sous_titre").text($(paragraphe).text());
	var $p_id = $(paragraphe).attr('id');
	$("#td_lst_req option").hide();
	$("#td_lst_req option[alt*='" + $p_id +"']").show(500);			
}	

$(document).ready(function() {
// On ajoute un élément <a> au sein des titres <h3> On lui adjoint un attribut href
	$("#accordeon p").wrapInner("<a></a>");
	$("#accordeon p a").attr("href","#");
	
	$("#td_lst_req option").hide();
	$("#id_ligne_titre").nextAll("tr").hide();

	$("#accordeon h6 a").click(function() {
		click_h6_a(this);
	});	

	$("#accordeon p").click(function() {
		click_paragraphe($(this));
	});

	$("#load_commune").append("<div id='loading'></div>");
	//$("#load_commune").append("blabla");
	$("#loading").css({
		"background":"url(ajax-loading.gif) no-repeat top left",
		"float":"right",
		"height":"30px",
		"width":"30px"
	}).hide();
	
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
		$("#sel_region").val(0); 
		$("#ligne_district").hide();
		$("#sel_district").val(0); 
		$("#ligne_commune").hide();		
		$("#sel_commune").val(0); 
	});
	
	$("#ug_district").click(function() {
		$("#ligne_region").show();
		$("#ligne_district").hide();
		$("#sel_district").val(0); 
		$("#ligne_commune").hide();		
		$("#sel_commune").val(0); 
	});
	$("#ug_commune").click(function() {
		$("#ligne_region").show();
		$("#ligne_district").show();
		$("#ligne_commune").hide();		
		$("#sel_commune").val(0); 
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
