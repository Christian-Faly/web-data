
$(document).ready(function(){
	console.log("Mandalo");
	$("<div id=\"loading\"></div>").insertAfter("h1");
	$("#loading").css({
		"background":"url(../../assets/img/ajax-loading.gif) no-repeat top left",
		"float":"right",
		"height":"60px",
		"width":"60px"
	}).hide();

	chercher_url($("#page_tb").val());
	var ladate=new Date();
	var y=ladate.getFullYear();	
	$("#sel_type_tb option").click(function() {
		if ($(this).text()=='Annuel'){
			$('#sel_annee_tb option:last-child').prop('selected', true);
			$("#sel_region_tb option[value='0']").prop('selected', true);
			$("#sel_annee_tb" ).prop( "disabled", true);
			
		}else{
			$("#sel_annee_tb" ).prop( "disabled", false);
		}
		
		if ($(this).text()=='Par région'){
			$('#sel_annee_tb option[value="'+y+'"]').prop('selected', true);
			$("#sel_region_tb" ).prop( "disabled", true);
		}else{
			$("#sel_region_tb" ).prop( "disabled", false);
		}
		
		if ($(this).text()=='Trimestriel'){
			$('#sel_annee_tb option[value="'+y+'"]').prop('selected', true);
			$("#sel_region_tb option[value='0']").prop('selected', true);
			$("#sel_annee_tb" ).prop( "disabled", false);
			$("#sel_region_tb" ).prop( "disabled", false);
		}
		chercher_url($("#page_tb").val());
	});
	
	
	$("#sel_annee_tb option").click(function() {
		chercher_url($("#page_tb").val());
	});
	
	$("#sel_region_tb option").click(function() {
		chercher_url($("#page_tb").val());
	});
	
	$(document).on("click", "#pagination a", function() {
		console.log($(this).text());
		chercher_url($(this).text());
	});

	$(document).on("click", "#visu_tb_annuel a", function() {
		console.log($(this));
		var date_debut = "'01/01/"+ $(this).parent().attr("alt")+"'";
		var date_fin = "'31/12/"+ $(this).parent().attr("alt")+"'";
		var sql = $(this).parent().parent().children(":hidden").text();
		var url = $("#echo_base_url").text()+'index.php/assist_requete/visualisation';
		sql=sql.replace(":a",date_debut);
		sql=sql.replace(":b",date_fin);
		console.log(url);
		console.log(sql);
		$.post(
			url,
  			{
    			code_r : "02010101",
				source : "sqlliste",
				array_para : "",
				textSQL : sql,
				action : "sql_liste"
  			},
  			function(data, status){
    			alert("Data: " + data + "\nStatus: " + status);
  			});
	});
});

function chercher_url(page){
	var url=$("#url_base").val()+'tb='+$("#nom_tb").val();
	url=url+'&classe='+$("#sel_type_tb option:selected").val();
	url=url+'&val_Annee='+$("#sel_annee_tb option:selected").val();
	url=url+'&val_Region='+$("#sel_region_tb option:selected").val();
	url=url+'&page='+page;
	url=url+'&nbparpage='+$("#nbparpage").val();
		
	$("#loading").show();
	$("#debug").text("Requête en cours ...!");
	
	console.log(url);
	$.ajax({
		url: url,
		type:'GET',
		dataType:'html',
		complete: function(resultat, status) {
			//console.log(resultat);
			
		},
		success: function(codehtml, status) {
			console.log(codehtml);
			$("#div_tb").load(url+"  #div_tb_ainserer");
			//$("#sel_liste_fkt").load(url_tot+"  #sel_lst_fokontany");
			$("#loading").hide();
			$("#debug").text("");
			
		},
		error: function(resultat, status, err) {
			$("#statut").text("Erreur");
		}
	});
}
