// javascript here

var currentId = $(".commentBoard").attr("id"); //global variable to hold the currentId of the latest comment posted in the comment board

/////Login
$("#submitLogin").click(function()
{
	username = $("#usernamebox").val() //extract the username typed in the textbox.
	password = $("#passwordbox").val() //extract the password typed in the texbox.

	//ajax request to log in and retrieve the data of the user
	$.ajax(
	{ 
		url : baseurl+"/userLogin/",
		method: "POST",
		data: {"username": username, "password":password}
		}).done(function(userData)
	{
		//check if the user is verified
		if(userData.success) //if verified hide the login form, and display the welcome message, display the comment form
		{
			$("#login_form").attr("hidden", "true") //make the login form disappear
			$("#welcomeScreen").removeAttr("hidden") //display the welcome screen
			$("#comment_form").removeAttr("hidden") //display the comment form
			$("username").text(userData.username) //display the username in the welcome screen
			$("userId").text(userData.userID) //secretely in the html insert the userId of the current user login in a custom html tag
		}
		else //else not verified
		{
			$("#loginAlert").removeAttr("hidden") //display the danger banner(hidden = true by default) by removing the hidden attribute
		}
	})
	return false
})

/////////logout
$("#userLogout").click(function()
{
	$.ajax(baseurl+"/logout/").done(function(userData)
	{
		if(userData.success) 
		{
			$("#login_form").removeAttr("hidden") //make the container disappear so we don't reload the page
			$("#welcomeScreen").attr("hidden", "true")
			$("#comment_form").attr("hidden", "true") //display the template from the html file(hidden = true by default) by removing the hidden attribute
		}
	})
	return false
})

/////////post comment
$("#comment_submit_button").click(function()
{
 	comment_text = $("#comment_text").val(); //get the typed text from the comment form
 	user_id = $("userid").text(); //get the userId who made the post

	if(comment_text.trim()) //check if the comment text box is not empty
	{
		$.ajax({ 
			url : baseurl+"/submit/",
			method: "POST",
			data: {"body": comment_text, "userId":user_id}
			}).done(function(userData)
		{
			
			if(userData.success) //if the comment post was successful just blank the comment text box so the user does not submit the same text over and over
			{
				$("#comment_text").val("");
			}
			else 
			{
				$("#commentAlert").removeAttr("hidden") //if the comment was completed display an alert to let the user the post was not able to be posted
			}
		})
	}
	else
	{
		$("#commentAlert").removeAttr("hidden") //if the comment was emtpy display an alert to let the user the post cannot be empty
	}
	return false
})


////////update comment board
function repeat() 
{
	$.ajax(
		{
			url : baseurl + "/update/",
			data: {"commentId" : currentId}
		}).done(function(userData)
		{
			if(userData.success) //if we had a new comment to display from the DB
			{
				comment_name = userData.username //get the username
				comment_text = userData.comment //get the comment
				comment_date = userData.date.date //get the date
				comment_id = userData.comment_id //get the commentId

				comment_template = $("#commentTemplate").clone(); //clone the comment template hidden in the html code
				comment_template.removeAttr("id") //remove the id to give a custom one
				comment_template.removeAttr("hidden") //remove the hidden attribute
				comment_template.attr("id", comment_id) //give it and id same as the commentId from the DB

				comment_template.find("#comment_board-userName").text(comment_name).append( "<br>"  + comment_date); //set the text to the username
				comment_template.find("#comment_board-userText").text(comment_text); //set the comment 
				comment_template.insertAfter("#updatedList"); //insert the comment template object into the comment board
				currentId = comment_id; //update the latest comment that is in the site
				console.log("update complete") //consolelog just to be sure its updating
			}
			else
			{
				console.log("no update") //just to be sure there is no updates
			}
			
		})
	setTimeout(repeat, 2000);
}
repeat();