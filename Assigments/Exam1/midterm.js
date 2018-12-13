//////////////////////////////////////////
// Question 2
//
// Add and modify your JavaScript code below.

$("#button1").click(function() 
{
	$(this).text("Ouch!")
})

var hardcoded = 97
$("#button2").click(function()
{
	$("#list1").append("<li>"+hardcoded+" bottles of beer on the wall</li>")
	hardcoded--
})

$("#convertIn").keyup(function()
{
	a = $("#convertIn").val()
	far = a*(9/5) + 32
	$("#convertOut").val(far)
})



//////////////////////////////////////////

// function to make a mole appear or disappear
total = 0
function popup() 
{
	$(".whack").toggle()
    $(".whack").eq(Math.floor((Math.random() * 1) + 0)).toggle()
    $(".whack").toggle()
    $(".whack").eq(Math.floor((Math.random() * 4) + 2)).toggle()
    $(".whack").toggle()
    $(".whack").eq(Math.floor((Math.random() * 8) + 5)).toggle()

    $(".whack").click(function() 
    {
    	
    	$("#score").text(total+ " Points")
    	total+=10

    })


    // set timer to pop up in another 5 sec
    setTimeout(popup, 500)
}

// set initial timer to pop up in 5 sec
setTimeout(popup, 1000)





//////////////////////////////////////////
// Question 3
//
// Add and modify your JavaScript code below.


$("#button3").click(function()
{

	$.ajax("instructors.json").done(function(data) 
	{
		data.forEach(function(item)
		{
			$("#list2").append("<li>"+item.name+": "+item.awesomeness+"</li>")
		})
	})
})


//////////////////////////////////////////



