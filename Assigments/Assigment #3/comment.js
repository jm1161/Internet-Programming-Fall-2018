// javascript here

$("#comment_submit_button").click(function()
{
	
	comment_name = $("#comment_name").val();
	comment_text = $("#comment_text").val();
	comment_date = moment().format("l");
	
	if(!/^[a-zA-Z0-9]+/.test(comment_name))
	{
		comment_name = "Error_NoUsername-Violation"
		
	}
	if(!comment_text.trim())
	{
		comment_text = "Error_NoText_Violation"
	}
	
	comment_template = $("#test").clone();

	comment_template.find("#comment_board-userName").text(comment_name).append( "<br>"  + comment_date);
	comment_template.find("#comment_board-userText").text(comment_text);
	comment_template.insertBefore("#test");

	return false //equals like system("pause") in c++

})

$(document).on('click', '.delete_btn' , function()
{
    $(this).closest(".mt-3").remove();
    
})

