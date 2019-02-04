
function setDays(){
	var maand = document.getElementById("maand_select").value;
	var dag = document.getElementById("dag_select").value;

	if(maand == 2){
		document.getElementById("dag_select").setAttribute("max", 28);
		if(dag > 28){
		document.getElementById("dag_select").value = 28;
		}
	}
	else if(maand == 4 || maand == 6 || maand == 9 || maand == 11){
		document.getElementById("dag_select").setAttribute("max", 30);
		if(dag > 30){
			document.getElementById("dag_select").value = 30;
		}
	}
	else{
		document.getElementById("dag_select").setAttribute("max", 31);		
	}
}
