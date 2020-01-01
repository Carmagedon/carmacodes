jQuery( document ).ready(function()
{
	jQuery('.btn-expand-collapse').click(function(e) {
		jQuery('.navbar-primary').toggleClass('collapsed');
	});
});