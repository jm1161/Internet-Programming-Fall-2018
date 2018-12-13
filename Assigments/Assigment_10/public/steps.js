$("#recipe_name").click(function()	//changes the recipe name
{
	box = $("<input>").attr("type","textbox").val($(this).text()) //create the box object
	recipe_id = $("recipe-id").attr("id")	//get the id of the recipe for easy search.

	box.blur(function() //text box on blur to create an event
	{
		$.ajax(base_url+"/updateTitle/rid="+recipe_id+"&rt="+$(this).val()).done(function() //do the ajax request and pass the recipe_id to update the recipe name
		{
			box.parent().text(box.val()) // append the box to the list so you dont have to update the website.
		})
	})

	$(this).text("")
	$(this).append(box)
	box.select()
})

$("li").click(function()	//change the text of a step.
{
	box = $("<input>").attr("type","textbox").val($(this).text()) //create the box object
	step_id = $(this).attr("id") //get the id of the recipe for easy search

	box.blur(function() //text box on blur to create an event
	{
		$.ajax(base_url+"/updateDescription/sid="+step_id+"&sd="+$(this).val()).done(function()  //do the ajax request and pass the step_id to update the recipe description
		{
			box.parent().text(box.val()) //update the text box with the value of the typed text.
			box.remove() //remove the box
		})
	})

	$(this).text("")
	$(this).append(box)
	box.select()
})

$("#addStep").click(function() //add a new step to the recipe
{
	box = $("<input>").attr("type","textbox") //create the box onbject
	recipe_id = $("recipe-id").attr("id") //get the recipe id for easy search
	step_number = $("#steps_list").children().length + 1 //add the step_number by just getting the lenght+1 of the list displayed in the html.

	box.blur(function() //text box on blur to create an event
	{
		$.ajax(base_url+"/addDescription/rid="+recipe_id+"&sn="+step_number+"&sd="+$(this).val()).done(function() //do the ajax request pass the recipe_id,step_number, and step descritpion
		{
			box.parent().append("<li>"+ box.val()) //append the <li> tag to the box so it displays as an item of a list in html
			box.remove() //remove the box of the display
		})
	})
	
	box.text("")
	$("#steps_list").append(box) //append the box to list of steps
	box.select()
})
$(function()	//takes care of the drag & drop (javascriptUI) 
{
	$( ".sortable" ).sortable(
	{
			update: function(event, ui) 
			{
				updatedList = $(this).sortable('toArray') //get the new list of re-ordered steps_id's and convert them to an array
				updatedList.forEach(function(element, index) //take the array of step_id's and indexes and create a for loop
				{
					stepId = updatedList[index] //get the step_id from the array
					stepNumber = index + 1 //identify each step to each index in the array simulating the new steps.

					$.ajax(base_url+"/editSteps/sid="+stepId+"&sn="+stepNumber).done()//do the ajax request and sent the step_id and the updated step_number of that step
				})
			}
		});
	
	$( ".sortable" ).disableSelection();
})

