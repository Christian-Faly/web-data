var pdfList = [];

jQuery(document).ready(function($) {
    var Body = $('body');
    Body.addClass('preloader-site');
});
$(window).load(function(){
  $('.preloader-wrapper').fadeOut();
	$('body').removeClass('preloader-site');
	$("#wrapper").removeClass('hidden')
});


jQuery(document).ready(function(){
	var accordionsMenu = $('.cd-accordion-menu');
	
	  // Preloader
	 

	if( accordionsMenu.length > 0 ) {
		
		accordionsMenu.each(function(){
			var accordion = $(this);
			//detect change in the input[type="checkbox"] value
			accordion.on('change', 'input[type="checkbox"]', function(){
				var checkbox = $(this);
				console.log(checkbox.prop('checked'));
				( checkbox.prop('checked') ) ? checkbox.siblings('ul').attr('style', 'display:none;').slideDown(300) : checkbox.siblings('ul').attr('style', 'display:block;').slideUp(300);
			});
		});
	}

	$(".login-form").hide();
	var hidden=true;
	$(".btn-login-form").click(function(){
	  if (hidden){
			$(".login-form").show("slow");
			hidden=false;
			console.log("showed")
	  } 
	  else {
			$(".login-form").hide("slow");
			hidden=true;
	  }
	});
 
	$(".accor_parent").click(function(event){
		var element = event.currentTarget,
		icon = element.firstChild;
	
		if(!document.getElementById('child-' + element.id)) {
		   return;
		} else {
		  if($('#child-' + element.id).css('display') === 'none') {
			$('#child-' + element.id).show(300);
			$(icon).removeClass("icon-angle-right");
			$(icon).addClass("icon-angle-down");
		  } else {
			$('#child-' + element.id).hide(300);
			$(icon).removeClass("icon-angle-down");
			$(icon).addClass("icon-angle-right");
		  }
		}
	
	});


	var img_loading= '<img src="'+ site_url +'assets/img/spin-1s-200px.gif" alt="">'
	var pdfjsLib = window['pdfjs-dist/build/pdf'];
	// The workerSrc property shall be specified.
	pdfjsLib.GlobalWorkerOptions.workerSrc = site_url +'assets/js/pdf/pdf.worker.js';
	var text_preview="";

	function intializExport(currentImgData_,currentMapID_){
		var printbtn="<div class='export-options center'>";
		printbtn += 	"<button class='print-button btn'>";
		printbtn += 		"<i class='icon-print icon-bglight active'><span> Imprimer</span></i>"
		printbtn += 	"</button>";
		printbtn += 	"<button class='img-button btn'>";
		printbtn += 		"<a href='"+currentImgData_+"' download='"+currentMapID_+".jpg'>"
		printbtn += 			"<i class='icon-picture icon-bglight active'><span> Export image </span></i>"
		printbtn += 		"</a>"
		printbtn += 	"</button>";
		printbtn += "</div>"
		return printbtn;
	}

	function loading_map(url,id_content){

		fetch(url).then(function(response) {
			if(response.ok) {
				response.blob().then(function(myBlob) {
					if(myBlob.type == "application/pdf"){
	
						var fileReader = new FileReader();  
		
						fileReader.onload = function() {
		
							var pdfData = new Uint8Array(this.result);
							// Using DocumentInitParameters object to load binary data.
							var loadingTask = pdfjsLib.getDocument({data: pdfData});
							loadingTask.promise.then(function(pdf) {
								console.log('PDF loaded');
								
								// Fetch the first page
								var pageNumber = 1;
								pdf.getPage(pageNumber).then(function(page) {
								console.log('Page loaded');
								
								var scale = 1;
								var viewport = page.getViewport({scale: scale});
		
								// Prepare canvas using PDF page dimensions
								var canvas = $("#"+id_content+"> canvas")[0];
								var context = canvas.getContext('2d');
								canvas.height = viewport.height;
								canvas.width = viewport.width;
		
								// Render PDF page into canvas context
								var renderContext = {
									canvasContext: context,
									viewport: viewport
								};
								var renderTask = page.render(renderContext);
								renderTask.promise.then(function () {
									console.log('Page rendered');
									$('#'+id_content+' > data').attr("src",url);
									$('#'+id_content+' > img').css('display', 'none');
									$('#'+id_content+' > strong').remove();
									$('#'+id_content+' > br').remove();
									currentMapID=id_content;
									$('#'+id_content+' > canvas').attr("id",id_content+'_canvas');
									currentImgData = document.getElementById(id_content+'_canvas').toDataURL(); 
									$('#'+id_content).append(intializExport(currentImgData,id_content));
								});
								});
							}, function (reason) {
								// PDF loading error
								
								console.error(reason);
								text_preview="<strong>Erreur de chargement de la carte!!!</strong>"
								$('#'+id_content+' > img').prepend(text_preview);
							});
						};
		
						fileReader.readAsArrayBuffer(myBlob);
					}
				});
			} else {
				text_preview="<strong>Peut-être qu'il y a une mauvaise réponse de QGIS serveur ou erreur du lien vers la carte concernée!</strong><br/>"
				$('#'+id_content+'').prepend(text_preview);
				$('#'+id_content+' > img').css('display', 'none');  
				console.log('Mauvaise réponse du lien');
				
			}
		})
		.catch(function(error) {
			text_preview="<strong>Erreur de réseau ou de connexion: "+ error.message+"</strong><br/>"
			$('#'+id_content+'').prepend(text_preview);
			$('#'+id_content+' > img').css('display', 'none');
			console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
		});
	}




	//loading first map
	var url='http://localhost/uploads/CDDT.pdf'
	var url_=domain_url+'/cgi-bin/qgis_mapserv.fcgi?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_2Server_.qgs&SERVICE=WMS&VERSION=1.3&REQUEST=GetPrint&FORMAT=pdf&EXCEPTIONS=application/vnd.ogc.se_inimage&TRANSPARENT=true&SRS=EPSG:3857&DPI=300&TEMPLATE=PROSPERER&map0:extent=4380027.1,-2695090.3,6225071.5,-1547562.7&map0:rotation=0&map0:scale=7500000&map0:grid_interval_x=250000&map0:grid_interval_y=250000&LAYERS=nb%20MER%20benecifiaire%20(sans%20r%C3%A9dondance)%2Ccoordination%20v7v%2Ccoordination%20sofia%2Ccoordination%20itasy%2Ccoordination%20haute%20matsiatra%2Ccoordination%20bongolava%2Ccoordination%20boeny%2Ccoordination%20atsinanana%2Ccoordination%20analanjirofo%2Ccoordination%20analamanga&OPACITIES=255%2C255%2C255%2C255%2C255%2C255%2C255%2C255%2C255%2C255';
	//url_=url;
	$('#topsix').prepend(img_loading);
	if (action_img=='carte') loading_map(url_,"topsix");



	//loading over map of tabs


	$(".tabs > .nav-tabs > li").click(function(event){
		console.log("link to content: "+event.currentTarget.firstChild.href);
		var id_tab_content_=event.currentTarget.firstChild.href.substring(site_url.length+16);
		var id_tab_content_map= $("#"+ id_tab_content_ +" > .tabs-left > .nav-tabs > li[class='active'] > a").attr("href").substring(1);
		console.log(id_tab_content_map);
		src=$('#'+id_tab_content_map+' > data').attr('link');
		console.log("link:"+src);
		var i=$('#'+id_tab_content_map+' > data').attr("src");
		console.log("src_initial: "+i);
		var default_loading=$('#'+id_tab_content_map +' > img').attr("src");
		var text_preview="";
		if (src==="" || src===undefined || src===null){
			text_preview="<strong>Carte en cours de mise en ligne!!!</strong><br/>"
			$('#'+id_tab_content_map).prepend(text_preview);
		}
		else{
			if (i=="" || i===undefined || i===null){
				if (default_loading=="" || default_loading===undefined || default_loading===null) $('#'+id_tab_content_map).prepend(img_loading);
				else $('#'+id_tab_content_map+' > img').css('display', 'block');
				loading_map(src,id_tab_content_map);
			}
		}
	});



	$(".tabs-left > .nav-tabs > li").click(function(event){

		var element = event.currentTarget
		tab_content_=element.firstChild.href;
		console.log("link to content: "+tab_content_);

		id_tab_content_=tab_content_.substring(site_url.length+16);
		console.log("id: "+id_tab_content_);
		src=$('#'+id_tab_content_+' > data').attr('link');
		console.log("link:"+src);
		var i=$('#'+id_tab_content_+' > data').attr("src");
		console.log("src_initial: "+i);
		var default_loading=$('#'+id_tab_content_ +' > img').attr("src");
		if (src==="" || src===undefined || src===null){
			text_preview="<strong>Carte en cours de mise en ligne!!!</strong>"
			$('#'+id_tab_content_).prepend(text_preview);
		}
		else{
			if (i=="" || i===undefined || i===null){
				if (default_loading=="" || default_loading===undefined || default_loading===null) $('#'+id_tab_content_).prepend(img_loading);
				else $('#'+id_tab_content_+' > img').css('display', 'block');
				loading_map(src,id_tab_content_);
			}
		}
		 
		

	});


	
	$(".tabs-left > .tab-content > .tab-pane").on('click', '.print-button', function(event){

		var id_parent= event.currentTarget.parentElement.parentElement.id;
		const dataUrl = document.getElementById(id_parent+'_canvas').toDataURL(); 

		var windowContent = '<!DOCTYPE html>';
		windowContent += '<html>'
		windowContent += '<head><title>Carte</title></head>';
		windowContent += '<body>'
		windowContent += '<img src="' + dataUrl + '">';
		windowContent += '</body>';
		windowContent += '</html>';
		var printWin = window.open('','','width=1080,height=360');
		printWin.document.open();
		printWin.document.write(windowContent);
		printWin.document.close();
		printWin.focus();
		printWin.print();
		printWin.close();

	});


	console.log(role_id);
	if (role_id==""){
		
		let login = document.querySelector('.login');
		login.addEventListener('input', function () {
			console.log(this.value)
			$(".login").attr("value",this.value);
		});
		

		let password = document.querySelector('.password');
		password.addEventListener('input', function () {
			$(".password").attr("value",this.value);
		});
	}
	

	function searchInContent(containerID_OfElements,valueToSearch){
		Elements=$(containerID_OfElements+">option")
		valueToSearch=valueToSearch.toLowerCase();
		Elements.each(function(){
			var text = $(this).context.textContent;
			if (text.toLowerCase().includes(valueToSearch)) $(this).css('display', 'block');	
			else $(this).css('display', 'none');		
		});
	}

	if (action_img=='Req_souple'){
		let search_req = document.querySelector('#c_rechA');
		search_req.addEventListener('input',function(){
			console.log(this.value);
			searchInContent("#sel_req",this.value);
		})
	}

	

});
