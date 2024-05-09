var idEdit = null ;
var idEditGenerique = null ;
var listeIndice ;
var listeIndiceaAffiche ;
var listeNameInput ;
var modalName ;
var table ;
var listeEntete ;
var listeData ;
var listeAct		= new Array() ;
var listeCaptage = new Array() ;
var listeBf = new Array() ;
function visibleTabByTypeInfrastructure()
{
	var zTypeInfra = document.getElementById('type_infrastructure').value ;
	if(zTypeInfra == 2 || zTypeInfra == 1)
	{
		document.getElementById('add_captages').style.display 			 = "block" ;
		document.getElementById('add_bf').style.display 				 = "block" ;
		document.getElementById('mode_gestion').style.visibility		 = "hidden" ;
		document.getElementById('moyen_inf_eau').style.visibility		 = "hidden" ;
		document.getElementById('add_couche_lithologique').style.display ="none" ;
	}
	if(zTypeInfra == 3 || zTypeInfra == 4)
	{
		document.getElementById('mode_gestion').style.visibility		 = "visible" ;
		document.getElementById('moyen_inf_eau').style.visibility		 = "visible" ;
		document.getElementById('add_couche_lithologique').style.display = "block" ;
		document.getElementById('add_captages').style.display 			 = "none" ;
		document.getElementById('add_bf').style.display					 = "none" ;
	}
}
/*begin tableau*/
function createSelect(tzData, iId)
{
	var select			= document.createElement('select') ;
	select.id			= iId ;
	select.className	= "form-control" ;
	for(var iKey = 0; iKey < tzData.length ; iKey++)
	{
		var option = document.createElement("option");
		option.value = tzData[iKey];
		option.text = tzData[iKey];
		select.appendChild(option); 
	}
	return select ;
}

function createInputTab(zIdtab, iNbcel)
{
	var table	= document.getElementById(zIdtab) ;
	var row		= table.insertRow(-1) ;
	var district = ["District 1","District 2", "District 2"] ;
	var commune = ["commune 1","commune 2", "commune 2"] ;
	var fokotany = ["fokotany 1","fokotany 2", "fokotany 2"] ;
	var localit = ["localit 1","localit 2", "localit 2"] ;
	var input	= document.createElement('input');
	input.type  = 'text' ;
	/* for(var iKey = 0; iKey < iNbcel; iKey++){
		row.insertCell(iKey).innerHTML += '<input id="'+iKey+'" type="text" class="form-control input-sm"></input>' ;
	} */
	row.insertCell(0).appendChild(createSelect(district , 0)) ;
	row.insertCell(1).appendChild(createSelect(commune , 1)) ;
	row.insertCell(2).appendChild(createSelect(fokotany , 2)) ;
	row.insertCell(3).appendChild(createSelect(localit , 3)) ;
	row.insertCell(3).appendChild(createSelect(localit , 4)) ;
	row.insertCell(3).appendChild(createSelect(localit , 5)) ;
	row.insertCell(3).appendChild(createSelect(localit , 6)) ;
	row.insertCell(3).appendChild(createSelect(localit , 7)) ;
	row.insertCell(iNbcel).innerHTML += '<button onClick="addToTab('+zIdtab+','+iNbcel+', '+row.rowIndex+')" type="button" class="btn btn-info btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>' ;
	// row.insertCell(iNbcel+1).innerHTML += input;
	
}
function ajouterDonneToTable(table, tzTable)
{
	var row			= table.insertRow(-1) ;
	var iLength 	= tzTable.length ;
	for(var iKey = 0; iKey < iLength; iKey++){
		row.insertCell(iKey).value = 1; 
		row.insertCell(iKey).text = "tantano"; 
	} 
	row.insertCell(iLength).innerHTML += '<button onClick="addToTab('+zIdtab+','+iNbcel+', '+row.rowIndex+')" type="button" class="btn btn-info btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' ;
	row.insertCell(iLength+1).innerHTML += '<button onClick="deleterow('+zIdtab+','+row.rowIndex+')" type="button" class="btn btn-danger btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>' ;
} 
/*ending tableau*/
function addToTab(zIdtab, iNbcel, iRowIndex)
{
	var tzDataTab = new Array() ;
	for(var iKey = 0; iKey < iNbcel; iKey++)
	{
		tzDataTab[iKey] = document.getElementById(iKey).value ;
	}
	alert(tzDataTab) ;
	var table	= document.getElementById(zIdtab) ;
	table.deleteRow(iRowIndex) ;
	var row		= table.insertRow(-1) ;
	for(var iKey = 0; iKey < iNbcel; iKey++){
		row.insertCell(iKey).innerHTML += tzDataTab[iKey] ;
	}
	row.insertCell(iNbcel).innerHTML += '<button onClick="addToTab('+zIdtab+','+iNbcel+', '+row.rowIndex+')" type="button" class="btn btn-info btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' ;
	row.insertCell(iNbcel+1).innerHTML += '<button onClick="deleterow('+zIdtab+','+row.rowIndex+')" type="button" class="btn btn-danger btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>' ;
}
function deleterow(zIdtab, iRowIndex)
{
	alert(zIdtab) ;
	var table	= document.getElementById(zIdtab) ;
	table.deleteRow(iRowIndex) ;
}
function deleteOptionSelect(select){
	var option	= select.getElementsByTagName("option") ;
	var i		= 0 ;
	while(i < option.length){
		select.removeChild(option[i]) ;
		i++;
	}
}
function getRegion(zIdSelect)
{
	$.ajax({
		type	: 'POST',
		url		: '<?php echo site_url()."/region/getRegion/"; ?>',
		cache : false,
		async	: false ,
		dataType:'json',
		success: function(data){
			var select = document.getElementById("zIdSelect") ;
			var donne = data;
			if(donne != null){
				deleteOptionSelect(listeDistrict);
				for(var i=0; i<donne['districts'].length; i++){
					var option = document.createElement("option");
					option.value = districts['districts'][i]['iddis'] ;
					option.text = districts['districts'][i]['designationdis'] ;
					listeDistrict.appendChild(option); 
				}
			}
			else{
				var option = document.createElement("option");
				option.text = "vide";
				listeDistrict.appendChild(option);
			}	
		} 
	});
}

/* verifier si un input est numeric */
function isNumeric(idConteneur, data){
	var bRep = $.isNumeric(data) ;
	if(bRep == false){
		$( idConteneur).append('<div class="alert alert-danger divErreurStyle" id="erreurLocalite"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Erreur!</strong> entrant un valeur numeric</div>' );
	}
}
/*verifier si un input est vide si non verifier si numeric*/
function verifiedInputNumeric(idConteneur, data){
	if(data == ""){
		$(idConteneur).append('<div class="alert alert-danger divErreurStyle" id="erreurLocalite"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Erreur!</strong> ce champ ne peut pas &ecirc;tre vide</div>' );
	}
	else{
		isNumeric(idConteneur, data) ;
	}
}
/*validation des tableau d'input type numeric*/
function validationInputNumeric(tzConteneur, tzData){
	for(var iKey=0 ; iKey < tzData.length ;iKey++){
		verifiedInputNumeric(tzConteneur[iKey] , tzData[iKey]) ;
	}
}
/*verifier si les div conteneur de la div erreur n'est pas vide*/
function isErrorExist(tzAllConteneur){
	for(var iKey=0 ; iKey < tzAllConteneur.length ;iKey++){
		if(!$(tzAllConteneur[iKey]).is(":empty")){
			return 1 ;
		}
	}
	return 0 ;
}
/* verifier si l'input est vide */
function isInputEmpty(idConteneur, data){
	if(data == ""){
		$(idConteneur).append('<div class="alert alert-danger divErreurStyle" id="erreurLocalite"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Erreur!</strong> ce champ ne peut pas être vide</div>' );
	}
}
/*verifier si l'un ou plusieur input sont vide*/
function isManyInputEmpty(tzConteneur , tzData){
	for(var iKey=0 ; iKey < tzAllConteneur.length ;iKey++){
		isInputEmpty(tzConteneur[iKey], tzData[iKey]) ;
	}
}
/*vider tous les contenue des div*/
function cleanDiv(tzAllConteneur){
	for(var iKey=0 ; iKey < tzAllConteneur.length ;iKey++){
		if(!$(tzAllConteneur[iKey]).is("empty")){
			$(tzAllConteneur[iKey]).empty() ;
		}
	}
	return 0 ;
}

function viderInput(tzIdInput){
	for(var i = 0 ; i < tzIdInput.length; i++){
		$(tzIdInput[i]).val("") ;
	}
}
function viderListeInput(tzIdInput){
	for(var i = 0 ; i < tzIdInput.length; i++){
		if($("#"+tzIdInput[i]).get(0).nodeName != "SELECT"){
			$("#"+tzIdInput[i]).val("") ;
		}
	}
}
/*fonction pour scroller vers un block*/
 function goToByScroll(id){
	  // Reove "link" from the ID
	id = id.replace("link", "");
	  // Scroll
	$('html,body').animate({
		scrollTop: $("#"+id).offset().top},
		'slow');
}
function cleanInput(tzListeInput){
	for(var i=0; i < tzListeInput.length ; i++){
		if(!$(tzListeInput[i]).is("empty")){
			$(tzListeInput[i]).val("") ;
		}
	}
}

/*debut edit delete table captage*/
function editTable(index){
	//listeCaptage;
	for(var itt = 0; itt < listeCaptage.length ; itt++){
		if(listeCaptage[itt][16] == index){
			$("#nomCaptage").val(listeCaptage[itt][0]) ;
			$('#communeCaptage').val(listeCaptage[itt][1]) ;
			$('#fokotanyCaptage').val(listeCaptage[itt][2]) ;
			$('#localiteCaptage').val(listeCaptage[itt][3]) ;
			$('#longCaptage').val(listeCaptage[itt][4]) ;
			$('#latCaptage').val(listeCaptage[itt][5]) ;
			$('#altCaptage').val(listeCaptage[itt][6]) ;
			$('#typeCapptage').val(listeCaptage[itt][7]) ;
			$("#modalCaptage").modal('show'); 
			idEdit = itt ;
			return ;
		}
	}
}
function deleteRowTCaptage(index){
	for(var itt = 0; itt < listeCaptage.length ; itt++){
		if(listeCaptage[itt][16] == index){
			listeCaptage.splice(itt, 1) ;
		}
	}
	var table = document.getElementById("tableCaptage") ;
	$("#tableCaptage").empty() ;
	jQuery("<thead><tr><th>District</th><th>Commune</th><th>Fokotany</th><th>Localité</th></tr></thead>").appendTo(table) ;
	for(var i = 0; i <  listeCaptage.length; i++){
		var row			= table.insertRow(-1) ;
		var indexRow	= row.rowIndex ;
		row.insertCell(0).innerHTML += listeCaptage[i][8] ;
		row.insertCell(1).innerHTML += listeCaptage[i][9] ;
		row.insertCell(2).innerHTML += listeCaptage[i][10] ;
		row.insertCell(3).innerHTML += listeCaptage[i][11] ;
		listeCaptage[i][16] = indexRow ;
		row.insertCell(4).innerHTML += '<button onClick="editTable('+indexRow+')" type="button" class="btn btn-info btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' ;
		row.insertCell(5).innerHTML += '<button onClick="deleteRowTCaptage('+indexRow+')" type="button" class="btn btn-danger btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>' ;
	}
}
/*fin delete edit captage*/
/*debut edit delete generique*/
function editTableGenerique(index,listeData, listeIndice, listeNameInput, modalName){
	
	for(var itt = 0; itt < listeData.length ; itt++){
		if(listeData[itt][listeData[itt].length-1] == index){
			for(var ii = 0; ii < listeNameInput.length ; ii++){
				$("#"+listeNameInput[ii]).val(listeData[itt][listeIndice[ii]]) ;
			}
			
			$("#"+modalName).modal('show'); 
			idEdit = itt ;
			return ;
		}
	}
}
function deleteRowTGenerique(index, listeData, table, listeEntete, listeIndiceaAffiche, listeNameInput, modalName){
	alert("listeData"+listeData.length) ;
	for(var itt = 0; itt < listeData.length ; itt++){
		if(listeData[itt][16] == index){
			listeData.splice(itt, 1) ;
		}
	}
	$(table).empty() ;
	var entete = "<thead><tr>"
	for(var iLe = 0; iLe < listeEntete.length ; iLe++){
		entete = entete+"<th>"+listeEntete[iLe]+"</th>" ;
	}
	entete = entete+"</tr></thead>" ;
	jQuery(entete).appendTo(table) ;
	for(var i = 0; i <  listeData.length; i++){
		var row			= table.insertRow(-1) ;
		var indexRow	= row.rowIndex ;
		var iR = 0 ;
		for(var iLi=0; iLi < listeIndiceaAffiche.length ; iLi++){
			row.insertCell(iR).innerHTML += listeData[i][listeIndiceaAffiche[iLi]] ;
			iR++ ;
		}
		listeData[i][listeIndiceaAffiche.length-1] = indexRow ;
		// row.insertCell(iR).innerHTML += '<button onClick="editTableGenerique('+indexRow+','+listeData+','+listeIndice+','+listeNameInput+','+modalName+')" type="button" class="btn btn-info btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' ;
		// row.insertCell(iR+1).innerHTML += '<button onClick="deleteRowTGenerique('+indexRow+','+listeData+','+table+','+ listeEntete+','+listeIndice+','+listeNameInput+','+modalName+')" type="button" class="btn btn-danger btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>' ;
		row.insertCell(iR).innerHTML += '<button onClick="editTableGenerique('+indexRow+','+"listeData"+','+"listeIndice"+','+"listeNameInput"+','+"modalName"+')" type="button" class="btn btn-info btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' ;
		row.insertCell(iR+1).innerHTML += '<button onClick="deleteRowTGenerique('+indexRow+','+"listeData"+','+"table"+','+"listeEntete"+','+"listeIndiceaAffiche"+','+"listeNameInput"+','+"modalName"+')" type="button" class="btn btn-danger btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
	}
}
function editListeGenerique(idEdit, tabTemp, table, listeEntete, listeData, listeIndiceaAffiche, listeIndice, listeNameInput,modalName){
	listeData.splice(idEdit, 1) ;
	listeData.push(tabTemp) ;
	$(table).empty() ;
	var entete = "<thead><tr>"
	for(var iLe = 0; iLe < listeEntete.length ; iLe++){
		entete = entete+"<th>"+listeEntete[iLe]+"</th>" ;
	}
	entete = entete+"</tr></thead>" ;
	jQuery(entete).appendTo(table) ;
	for(var i = 0; i <  listeData.length; i++){
		var row			= table.insertRow(-1) ;
		var indexRow	= row.rowIndex ;
		var iR = 0;
		for(var iLiaa=0; iLiaa < listeIndiceaAffiche.length ; iLiaa++){
			row.insertCell(iR).innerHTML += listeData[i][listeIndiceaAffiche[iLiaa]] ;
			iR++ ;
		}
		listeData[i][listeIndiceaAffiche.length-1] = indexRow ;
		row.insertCell(iR).innerHTML += '<button onClick="editTableGenerique('+indexRow+','+listeData+','+listeIndice+','+listeNameInput+','+modalName+')" type="button" class="btn btn-info btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>' ;
		row.insertCell(iR+1).innerHTML += '<button onClick="deleteBf('+indexRow+','+listeData+','+table+','+ listeEntete+','+listeIndice+','+listeNameInput+','+modalName+')" type="button" class="btn btn-danger btn-circle displayInlineBlock btnCircle" data-placement="bottom" data-toggle="modal" title="Nouveau!"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>' ;
	}
	idEdit = null ;
	$(modalName).modal('hide')
	return ;
}
/*fin edit delete generique*/
function annulerEdit(){
	if(idEdit != null){
		viderListeInput(listeNameInput) ;
		idEdit = null ;
	}
}
function deleteBf(index, listeBf, table, listeEntete, listeIndiceaAffiche, listeNameInput, modalName){
	deleteRowTGenerique(index, listeBf, table, listeEntete, listeIndiceaAffiche, listeNameInput, modalName) ;
}
function addValueCheckBox(checkBox){
	if($("#"+checkBox).is(':checked')== true){
			return 1 ;
	}
	if($("#"+checkBox).is(':checked')== false){
			return 0 ;
	}
}
function addTotableFromModif(listeData){
	
}
