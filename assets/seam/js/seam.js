//recuperer dans un textbox les valeurs selectionnnées dans un menu déroulant
function recupSel(srce, dest1, dest2)
{
  var valeur = srce.options[srce.selectedIndex].value;
	var texte = srce.options[srce.selectedIndex].text;
	
//alert(valeur+' '+texte);
  if (valeur == 0) {
		dest1.value="";
		dest2.value="";
	}
	else
		if (dest1.value == '') {
			dest1.value='/'+valeur+'/';
			dest2.value='/'+texte+'/';
		}
		else {
			dest1.value += valeur + '/';                 //srce.options[srce.selectedIndex].value;
			dest2.value += texte +	'/';												//srce.options[srce.selectedIndex].text;
		}
    srce.selectedIndex = 0;
}

$(function() {
				$('#main-menu').smartmenus({
					subMenusSubOffsetX: 1,
					subMenusSubOffsetY: -8
				});
			});