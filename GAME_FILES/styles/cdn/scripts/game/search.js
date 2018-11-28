function search(){

var name = $('#searchtext').val();
var type = $('#type').val();

if(name.length<3 && type != "allytag"){
	if(type == "playername")
		$('#recherche_resultat').html(lgnpsu);
	else if(type == "planetname")
		$('#recherche_resultat').html(lgnpla);
	else if(type == "allyname")
		$('#recherche_resultat').html(lgnall);
}else if(name.length<2 && type == "allytag"){
		$('#recherche_resultat').html(lgntag);
}else{
$.getJSON('game.php?page=search&mode=autocomplete&name='+name+'&type='+type, function(data) {
		
		$('#recherche_resultat').empty();
		$('#recherche_resultat').load('game.php?page=search&mode=result&search='+name+'&type='+type);
		
	});	
}
}


