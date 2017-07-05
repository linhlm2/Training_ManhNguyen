function getValueChecked() {
	var selected = new Array();
	$(document).ready(function() {
	  $("input:checkbox[name=table_records]:checked").each(function() {
	       selected.push($(this).val());
	  });
	});
}

$( "#reset_password" ).click(function() {
	var selected = new Array();
	$(document).ready(function() {
	  $("input:checkbox[name=table_records]:checked").each(function() {
	       selected.push($(this).val());
	  });
	});
	// var a = new Array();
	// a = getValueChecked();
	alert(selected);
});


// $("input:checkbox[name=type]:checked").each(function(){
//     yourArray.push($(this).val());
// });

