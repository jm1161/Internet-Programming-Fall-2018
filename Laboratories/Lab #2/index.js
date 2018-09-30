

$("#b1").click(function()
{

	$.ajax("random_site1.html").done(function(data){
		$("#the_print").html(data)
	})
})

$("#b2").click(function()
{

	$.ajax("random_site2.html").done(function(data){
		$("#the_print").html(data)
	})
})