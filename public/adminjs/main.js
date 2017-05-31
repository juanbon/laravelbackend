$(document).ready(function(){

	$(document).on('click', '.btnDelete', function() {
		$(this).parent().parent().find('form').submit();
    });
	
	$(document).on('click', '.delete-btn', function() {
		var url = $(this).attr('href');
        $('.modal-body').load(url, function() {
			$("#deleteModal").modal();
		});
		return false;
	});

	$(document).on('change', '#role',  function() {
		if ( $(this).val() == 'sadmin' ) {
			$("input[type=checkbox]").prop('checked', true);
		}else{
			$("input[type=checkbox]").prop('checked', false);
		}
	});

	$("a[rel=popover]").on({
	  mouseenter:
		function() {
	      $(this).popover('show');
	    },
	  mouseleave:
	    function() {
	      $(this).popover('hide');
	    }
	});

});