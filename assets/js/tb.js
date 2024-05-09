$(document).ready(function(){
	console.log("Mandalo");
	$("<div id=\"loading\"></div>").insertAfter("h1");
	$("#loading").css({
		"background":"url(../../assets/img/ajax-loading.gif) no-repeat top left",
		"float":"right",
		"height":"60px",
		"width":"60px"
	}).hide();
	$('#sel_annee_tb option:last-child').prop('selected', true);
	chercher_url($("#page_tb").val());
	var ladate=new Date();
	var y=ladate.getFullYear();

	$("#sel_type_tb").change(function() {
		if ($(this).val()=='annuel'){

			$('#sel_annee_tb option:last-child').prop('selected', true);
			$("#sel_region_tb option[value='0']").prop('selected', true);
			$("#sel_annee_tb" ).prop( "disabled", true);

		}else{
			$("#sel_annee_tb" ).prop( "disabled", false);
		}

		if ($(this).val()=='par région'){
			$('#sel_annee_tb option:first-child').prop('selected', true);
			$("#sel_region_tb option[value='0']").prop('selected', true);
			$("#sel_region_tb" ).prop( "disabled", true);
		}else{
			$("#sel_region_tb" ).prop( "disabled", false);
		}

		if ($(this).val()=='trimestriel'){
			$('#sel_annee_tb option:first-child').prop('selected', true);
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

	$(document).on("click", "#export_tb", function() {
		$("#visu_tb_annuel").DataTable({ dom: 'Bfrtip', buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ], "scrollX": true});
   	});
 
	$(document).on("click", "#visu_tb_par_region a", function() {
		console.log("mandalo eto");
                var x=$(this).parent().attr("alt");
                var date_debut="'2000/01/01'" ;
                var date_fin="'2040/12/31'";
		if($("#sel_annee_tb").val()!="Toutes"){
			date_debut="'"+$("#sel_annee_tb").val()+"/01/01'";
			date_fin="'"+$("#sel_annee_tb").val()+ "/12/31'";
		}

                var sql = $(this).parent().parent().children(":hidden").text();
                var url1 = $("#echo_base_url").text()+'index.php/assist_requete/tableau_sql_ajax';
		sql=sql.replace(":a",date_debut);
		sql=sql.replace(":b",date_fin);
		sql=sql+" AND (nregion="+x+")";
                var data1='code_r = 02010101 & source = sqlliste & array_para = & textSQL=' + sql +'&action=sql_liste';
                console.log(url1);
                console.log(sql);
                console.log(data1);
                $.ajax({
                        url : url1,
                        type : 'POST', // Le type de la requête HTTP, ici devenu POST
                        data : data1,
                        dataType : 'html',
                        success : function(code_html, statut){
                                //$('html').html(code_html);
                                $("#visu_tb_par_region").hide();
                                $("#tableau_bord").html(code_html);
                                //console.log(code_html);
                                //$(code_html).find('#liste').appendTo('#tableau_bord');
                        },

                        error : function(resultat, statut, erreur){
                                console.log(erreur);
                        },

                        complete : function(resultat, statut){

                        }

                 });
        });

	$(document).on("click", "#visu_tb_trimestriel a", function() {
		var x=$(this).parent().attr("alt");
		var y=$("#sel_annee_tb").val();
		var date_debut="'"+y+"/"+x+"/01'" ;
		var date_fin="'"+y+"/"+x+"/"+(32-(new Date(Number(y),Number(x)-1,32)).getDate())+"'";
		console.log(date_debut);
		console.log(date_fin);
		var sql = $(this).parent().parent().children(":hidden").text();
		var url1 = $("#echo_base_url").text()+'index.php/assist_requete/tableau_sql_ajax';
		sql=sql.replace(":a",date_debut);
		sql=sql.replace(":b",date_fin);
		var data1='code_r = 02010101 & source = sqlliste & array_para = & textSQL=' + sql +'&action=sql_liste';
		console.log(url1);
		console.log(sql);
		console.log(data1);
		$.ajax({
			url : url1,
       			type : 'POST', // Le type de la requête HTTP, ici devenu POST
       			data : data1,
       			dataType : 'html',
    			success : function(code_html, statut){
    				//$('html').html(code_html);
    				$("#visu_tb_trimestriel").hide();
				$("#tableau_bord").html(code_html);
				//console.log(code_html);
    				//$(code_html).find('#liste').appendTo('#tableau_bord');
			},

       			error : function(resultat, statut, erreur){
       				console.log(erreur);
       			},

       			complete : function(resultat, statut){

       			}

		 });
   	});


	$(document).on("click", "#visu_tb_annuel a", function() {
		console.log($(this));
		var date_debut = "'"+ $(this).parent().attr("alt")+"/01/01'";
		var date_fin = "'"+$(this).parent().attr("alt")+"/12/01'";
		var sql = $(this).parent().parent().children(":hidden").text();
		var url1 = $("#echo_base_url").text()+'index.php/assist_requete/tableau_sql_ajax';
		sql=sql.replace(":a",date_debut);
		sql=sql.replace(":b",date_fin);
		var data1='code_r = 02010101 & source = sqlliste & array_para = & textSQL=' + sql +'&action=sql_liste';
		console.log(url1);
		console.log(sql);
		console.log(data1);
		$.ajax({
			url : url1,
       			type : 'POST', // Le type de la requête HTTP, ici devenu POST
       			data : data1,
       			dataType : 'html',
    			success : function(code_html, statut){
    				//$('html').html(code_html);
    				$("#visu_tb_annuel").hide();
				$("#tableau_bord").html(code_html);
				//console.log(code_html); $("#visu_tb_annuel").hide()
    				//$(code_html).find('#liste').appendTo('#tableau_bord');
			},

       			error : function(resultat, statut, erreur){
       				console.log(erreur);
       			},

       			complete : function(resultat, statut){

       			}

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
	$("statut").text("");
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
