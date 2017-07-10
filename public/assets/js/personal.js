$( "#reset_password" ).click(function() {
	var base_url = $('#base_url').val();
	var selected = new Array();
	$(document).ready(function() {
	  	$("input:checkbox[name=table_records]:checked").each(function() {
	       selected.push($(this).val());
	  	});
	});
    // $.ajaxSetup({
    //     headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // url: "<?php echo \Uri::create('auth/login'); ?>",
    $.ajax({
       	type:'POST',
       	url: base_url + 'resetmultiple',
       	data: {selected: selected},
       	success:function(rs){
             console.log(rs);
             alert(rs);
      	}
    });       
});
