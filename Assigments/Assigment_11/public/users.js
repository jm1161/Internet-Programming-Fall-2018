$("button").click(function()
{
	username = $("#usernamebox").val()
	password = $("#passwordbox").val()

	$.ajax({
		url : baseurl+"/userLogin/",
		method: "POST",
		data: {"username": username, "password":password}
		}).done(function(userData)
	{
		if(userData.verified_password)
		{
			$(".container").attr("hidden", "true")
			$(".successful-template").removeAttr("hidden")
			$(".successful-template username").text(userData.username)
			$(".successful-template code").text(userData.hashed_password)
		}
		else
		{
			$(".alert-danger").removeAttr("hidden")
		}
	})
	return false
})