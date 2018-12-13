$(".del").click( function() {
	

	btn = $(this);

	console.log(btn.attr("id"))
	
	userId = btn.attr("id")

	$.ajax({ 
		url : baseurl+"/delete",
		method: "POST",
		data: {"userId": userId}
		})
	
	btn.parent().parent().remove();
})


