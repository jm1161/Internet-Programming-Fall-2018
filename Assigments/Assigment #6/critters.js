var imgs = { 0: "http://animalcontrolphx.com/wp-content/uploads/2013/05/gophers-400.jpg",
             1 : "https://kids.nationalgeographic.com/content/dam/kids/photos/animals/Mammals/Q-Z/wolverine-crouching.adapt.945.1.jpg",
             2 : "https://www.waikikiaquarium.org/wp-content/uploads/2013/11/octopus_620.jpg"
           }

$("#choice").change(function () 
{
	selection = $("#choice option:selected").val()
	
	$.ajax("data"+selection+".json").done(function (data) 
	{
		$(".pic").remove()
		data.forEach(function (item) 
		{
			img = $("<img/>")
			img.attr("class","pic")
			img.attr("src",imgs[selection])
			img.css("left",item[0])
			img.css("top",item[1])
			img.appendTo("#image_panel")	
		})
	})
})


